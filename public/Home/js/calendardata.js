



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
     reloadCalendar($('#month').val(), $('#project').val());
  
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
     reloadCalendar($('#month').val(), $('#project').val());
  
    },
    error: function(xhr, status, error) {
      console.log("error occured",error);
  }
  });
}

