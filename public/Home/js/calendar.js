

$(document).ready(function()
{
$('#month').on('change',displayCalendar);

function displayCalendar()
{
   var selectedMonth= parseInt($('#month').val());
   var selectedProject= parseInt($('#project').val());
   var currentYear = new Date().getFullYear();

   var startDate = new Date(currentYear, selectedMonth - 1, 1); // Months are zero-based in JavaScript
   var endDate = new Date(currentYear, selectedMonth, 0); // End date is one day before the start of the next month

   $('#calendar').empty();

   var calendar = createCalendar(startDate, endDate, selectedProject);
   $('#calendar').append(calendar);
   $('#timesheet-btn').removeClass('hidden');
}

});




function createCalendar(startDate, endDate, selectedProject) {
  const calendar = $('<div>').addClass('calendar');

  const monthYear = $('<div>').addClass('calendar-header');
  const month = $('<span>').addClass('month').text(startDate.toLocaleDateString('en-us', { month: 'long' }));
  const year = $('<span>').addClass('year').text(startDate.getFullYear());
  monthYear.append(month, year);
  calendar.append(monthYear);

  const days = $('<div>').addClass('days');

  // Create days labels starting from Sunday
  const daysLabels = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
  $.each(daysLabels, function(index, dayLabel) {
    const dayLabelEl = $('<span>').addClass('day-label').text(dayLabel);
    days.append(dayLabelEl);
  });

  // // Find the start day index of the month
   const firstDayIndex = startDate.getDay();

   startDate.setDate(startDate.getDate() - firstDayIndex);
   
  //  to display days with store data
  getCalendarData(selectedProject,function(calendarData)
  {
    for (let currentDate = new Date(startDate); currentDate <= endDate; currentDate.setDate(currentDate.getDate()+1)) {
      const dayEl = $('<span>').addClass('day');
    
       if(currentDate.getMonth() !=  endDate.getMonth())
       {
        dayEl.addClass('dull');
       }
    
      if (currentDate.toDateString() === new Date().toDateString()) {
          dayEl.addClass('today');
      }
  
      const dayOfWeek = $('<span>').addClass('day-of-week').text(currentDate.getDate());
      dayEl.append(dayOfWeek);
  
     // const contentEl = $('<span>').addClass('content').text('0.00');
      //console.log(new Date(currentDate));
      const date= moment(currentDate.toString()).format('YYYY-MM-DD');
     const matchingEntry = calendarData.data.find(entry => entry.Date === date);
     //console.log(matchingEntry);
      const contentEl = $('<span>').addClass('content').attr('data-date',date);
          if (matchingEntry) {
            contentEl.text(matchingEntry.working_hour).addClass('hours');
          }
          else{
                contentEl.text('0.00');
              }
  
  
    if(dayEl.hasClass('dull'))
    {
      contentEl.attr('contenteditable',false);
    }
    else{
      contentEl.attr('contenteditable',true);
    }   


    // to insert working_hours in the timesheet
          
          contentEl.on('focus', function() {
            $(this).data('previousContent', $(this).text()); // Store previous content when element gains focus
        });
        
        contentEl.on('blur', function() {
            const editedContent = $(this).text();
            const previousContent = $(this).data('previousContent');
          
            // Check if content has been edited
            if (editedContent !== previousContent && editedContent !== '.00') {
                $(this).data('edited', true); 
            } else {
                $(this).data('edited', false); 
            }
        });

      $('#timesheet-btn').click(function()
    {
       contentEl.each(function(){
        
        const editedContent = $(this).text(); // Get the edited content
  
        const date = $(this).data('date');
        const projectId = $('#project').val(); 
        const employeeId = $('#employee_id').val(); 
       if ($(this).data('edited')) {
          if(matchingEntry)
          {
            //console.log(matchingEntry.id);
             editCalendarData(editedContent, date, projectId, employeeId,matchingEntry.id);
             $(this).data('edited', false); 
          }
          else{
            saveCalendarData(editedContent, date, projectId, employeeId);
            $(this).data('edited', false); 
          }
    
            
         }
       })
    });
    // end of working_hour
      dayEl.append(contentEl);
     
      days.append(dayEl); 
  }
  });

  calendar.append(days);
  return calendar;
}





function getCalendarData($selectedProject,callback)
{
  $.ajax({
    type: "get",
    url:  '/projectdash/'+$selectedProject +'/timesheet/get-data',
    success: function (response) {
      callback(response);
      
    },
    error: function(xhr, status, error) {
      console.error("error occured",error);
  }
  });
}

function saveCalendarData(editedContent,date,projectId, employeeId)
{
  $.ajax({
    type: "post",
    url: '/projectdash/'+projectId +'/timesheet/store',
    data: {
      Date:date,
      working_hour:editedContent,
      project_id:projectId,
      employee_id:employeeId
      
    },
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Include CSRF token in header
  },
    success: function (response) {
      console.log("Data added success",response);
      var message=response.message;
      alert(message);
     // $('#response-container').html('<p>' + response.message + '</p>');
  
    },
    error: function(xhr, status, error) {
      console.log("error occured",error);
  }
  });
}

function editCalendarData(editedContent, date, projectId, employeeId,timesheetid)
{
  $.ajax({
    type: "post",
    url: '/projectdash/'+timesheetid +'/timesheet/edit-data',
    data: {
      id:timesheetid,
      Date:date,
      working_hour:editedContent,
      project_id:projectId,
      employee_id:employeeId
      
    },
    
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Include CSRF token in header
  },
    success: function (response) {
     // console.log("Data added success",response);
      var message=response.message;
      alert(message);
     // $('#response-container').html('<p>' + response.message + '</p>');
  
    },
    error: function(xhr, status, error) {
      console.log("error occured",error);
  }
  });
}


 

 