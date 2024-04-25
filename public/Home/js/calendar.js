

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

  //  to display days
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

    //console.log(currentDate);
    const contentEl = $('<span>').addClass('content').text('0.00');
    
    if(dayEl.hasClass('dull'))
    {
      contentEl.attr('contenteditable',false);
    }
    else{
      contentEl.attr('contenteditable',true);
    }
    

    contentEl.on('blur',function()
    {
      const contentEl = $(this);
      const editedContent = contentEl.text();
      const date = contentEl.closest(".day").find(".day-of-week").text();
  
  
     const projectId= $('#project').val();
     const employeeId = $('#employee_id').val();
     //console.log(employeeId);
     saveCalendarData(editedContent,date,projectId, employeeId)
    });
  
     dayEl.append(contentEl);
   
    days.append(dayEl);
}

  calendar.append(days);
  return calendar;




}

function saveCalendarData(editedContent,date,projectId, employeeId)
{
  $.ajax({
    type: "post",
    url: "/timesheet/store",
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
      //console.log('data added');
      console.log("Data added success",response);
      
    },
    error: function(xhr, status, error) {
      console.error("error occured",error);
  }
  });
}
 

