

$(document).ready(function () {
  $('#month').on('change', displayCalendar);


  function displayCalendar() {
    var selectedMonth = parseInt($('#month').val());
    var selectedProject = parseInt($('#project').val());
    reloadCalendar(selectedMonth, selectedProject);
    $('#timesheet-btn').removeClass('hidden');
  }

});

let timesheetdata = [];

// saving calendar input data
$('#timesheet-btn').click(function () {
  var selectedMonth = parseInt($('#month').val());
  let calendarData = []; 

  $('.content').each(function () {
    const editedContent = $(this).text(); // Get the edited content
    const date = $(this).data('date');
    const projectId = $('#project').val();
    const employeeId = $('#employee_id').val();
    const timesheetId = $(this).data('timesheet-id') ? $(this).data('timesheet-id') : '';
    const isEdited = $(this).data('edited');
    const currentDateMonth= new Date(date).getMonth()+1;
    
  
    if (isEdited && (currentDateMonth == selectedMonth)) {
      //console.log(currentDateMonth);
       const items={
        timesheetId:timesheetId,
        editedContent: editedContent,
        date: date,
        projectId: projectId,
        employeeId: employeeId

      };   
      calendarData.push(items);  
      $(this).data('edited', false);
    }
  });

  if (calendarData.length > 0) {
    timesheetdata.push(...calendarData);

     saveCalendarData(timesheetdata);
     timesheetdata=[];
  }

});
// saving calendar input ends here

function reloadCalendar(selectedMonth, selectedProject) {
  var currentYear = new Date().getFullYear();
  var startDate = new Date(currentYear, selectedMonth - 1, 1);
  var endDate = new Date(currentYear, selectedMonth, 0);
  $('.content').data('edited', false);
  $('#calendar').empty(); // Clear existing calendar
 
  var calendar = createCalendar(startDate, endDate, selectedProject);
  $('#calendar').append(calendar);
}

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
  $.each(daysLabels, function (index, dayLabel) {
    const dayLabelEl = $('<span>').addClass('day-label').text(dayLabel);
    days.append(dayLabelEl);
  });

  // // Find the start day index of the month
  const firstDayIndex = startDate.getDay();

  startDate.setDate(startDate.getDate() - firstDayIndex);

  //  to display days with store data
  getCalendarData(selectedProject, function (calendarData) {
    for (let currentDate = new Date(startDate); currentDate <= endDate; currentDate.setDate(currentDate.getDate() + 1)) {
      const dayEl = $('<span>').addClass('day');

      if (currentDate.getMonth() != endDate.getMonth()) {
        dayEl.addClass('dull');
      }

      if (currentDate.toDateString() === new Date().toDateString()) {
        dayEl.addClass('today');
      }

      const dayOfWeek = $('<span>').addClass('day-of-week').text(currentDate.getDate());
      dayEl.append(dayOfWeek);

      const date = moment(currentDate.toString()).format('YYYY-MM-DD');
      const matchingEntry = calendarData.data.find(entry => entry.Date === date);
   
      const currentDayMonth = new Date(date).getMonth() + 1;
      const selectedMonth = ($('#month').val());

      const contentEl = $('<span>').addClass('content').attr('data-date', date);
      if (matchingEntry) {
        contentEl.text(matchingEntry.working_hour).attr('data-timesheet-id', matchingEntry.id);
        if (currentDayMonth == selectedMonth) {
          const deleteBtn = $('<button>').addClass('btn btn-danger delete-btn').text('Delete');
          deleteBtn.on('click', function () {
            deleteCalendarData(matchingEntry.id);
          });
          deleteBtn.hide();
          dayEl.dblclick(function () {
            $('.delete-btn').hide();
            deleteBtn.show();

          });

          dayEl.append(deleteBtn);
        }


      }
      else {
        contentEl.text('0.00');
      }
      if (dayEl.hasClass('dull')) {
        contentEl.attr('contenteditable', false);
      }
      else {
        contentEl.attr('contenteditable', true);
      }


      //to insert working_hours in the timesheet
      contentEl.on('focus', function () {
        $(this).data('previousContent', $(this).text()); // Store previous content when element gains focus
      });

      contentEl.on('blur', function () {
        const editedContent = $(this).text();
        const previousContent = $(this).data('previousContent');

        // Check if content has been edited
        if (editedContent !== previousContent) {
          $(this).data('edited', true);

        } else {
          $(this).data('edited', false);
        }

      });

      // end of working_hour
      dayEl.append(contentEl);

      days.append(dayEl);

     

    }
  });

  calendar.append(days);
  return calendar;
}







function getCalendarData($selectedProject, callback) {
  $.ajax({
    type: "get",
    url: '/projectdash/' + $selectedProject + '/timesheet/get-data',
    success: function (response) {
      callback(response);

    },
    error: function (xhr, status, error) {
      console.error("error occured", error);
    }
  });
}

function saveCalendarData(timesheetdata) {
  let requestData = [];
  timesheetdata.forEach(item => {
    let date = item.date;
    let editedContent = item.editedContent;
    let projectId = item.projectId;
    let employeeId = item.employeeId;
    let timesheetId = item.timesheetId;

    // Push formatted data for each item into the requestData array
    requestData.push({
      id: timesheetId,
      Date: date,
      working_hour: editedContent,
      project_id: projectId,
      employee_id: employeeId
    });
  });

  //console.log(requestData);
  $.ajax({
    type: "post",
    url: '/projectdash/batch/timesheet/store-data', 
    data: JSON.stringify(requestData),
    contentType: 'application/json', // Set content type to JSON
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') 
    },
    success: function (response) {
      console.log("Data added success", response);
      $('#response-container').css('display', 'block');
      $('#response-container').html('<p>' + response.message + '</p>');
      $('#response-container').fadeOut(2000);
  
      reloadCalendar($('#month').val(), $('#project').val());
    },
    error: function (xhr, status, error) {
      try {
        const errors = xhr.responseJSON.errors;
        //console.log(errors);
        
        if (errors) {
         
            const workingHourErrors = errors['0.working_hour'];
            //console.log(workingHourErrors);

            if (workingHourErrors && Array.isArray(workingHourErrors) && workingHourErrors.length > 0) {
                
                let errorMessageHtml = '<ul>';
                workingHourErrors.forEach(errorMessage => {
                    errorMessageHtml += '<li>' + errorMessage + '</li>';
                });
                errorMessageHtml += '</ul>';

                // Display error message in response container
                $('#response-container').css('display', 'block');
                $('#response-container').html(errorMessageHtml);
                $('#response-container').fadeOut(3000);
            }
        }
    } catch (e) {
        console.error("Error occurred while processing error response:", e);
    }
      reloadCalendar($('#month').val(), $('#project').val());

    }
  });

}

// function editCalendarData(editedContent, date, projectId, employeeId, timesheetid) {
//   $.ajax({
//     type: "post",
//     url: '/projectdash/' + timesheetid + '/timesheet/edit-data',
//     data: {
//       id: timesheetid,
//       Date: date,
//       working_hour: editedContent,
//       project_id: projectId,
//       employee_id: employeeId

//     },

//     headers: {
//       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Include CSRF token in header
//     },
//     success: function (response) {
//       // console.log("Data added success",response);
//       $('#response-container').css('display', 'block');
//       $('#response-container').html('<p>' + response.message + '</p>');
//       $('#response-container').fadeOut(3000);
//       reloadCalendar($('#month').val(), $('#project').val());


//     },
//     error: function (xhr, status, error) {
//       console.log("error occured", error);
//       const errors = xhr.responseJSON.errors;
//       if (errors) {
//         console.log(errors.working_hour);
//         $('#response-container').css('display', 'block');
//         $('#response-container').html('<p>' + errors.working_hour + '</p>');
//         $('#response-container').fadeOut(3000);
//       }
//       reloadCalendar($('#month').val(), $('#project').val());
//     }
//   });
// }

function deleteCalendarData(timesheetid) {
  console.log(timesheetid);
  $.ajax({
    type: "POST",
    url: '/projectdash/' + timesheetid + '/timesheet/delete-data',
    data: {
      id: timesheetid
    },
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    success: function (response) {
      console.log(response);
      var message = response.message;
      alert(message);
      reloadCalendar($('#month').val(), $('#project').val());
    },
    error: function (xhr, status, error) {
      console.log("An error occurred:", error);
      alert("An error occurred while deleting data.");
    }
  });
}



$(document).on('click', function (event) {
  // Check if the click target is not within a day element
  if (!$(event.target).closest('.day').length) {
    $('.delete-btn').hide();
  }
});