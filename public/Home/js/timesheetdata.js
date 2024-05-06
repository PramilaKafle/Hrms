

    $(document).ready(function () {
        $('#timesheet-generate').click(function (e) {
            e.preventDefault();
            var projectId = $('#projectdata').val();
            var employeeId = $('#employeedata').val();
            var startDate = $('#startdate').val();
            var endDate = $('#enddate').val();
            // Make AJAX request to fetch timesheet data
            $.ajax({
                url: '/timesheet/generate-data',
                type: 'POST',
                data: {
                    project_id: projectId,
                    employee_id: employeeId,
                    start_date: startDate,
                    end_date: endDate,
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    //console.log(response);
                    PopulateTimesheetData(response);
                },
                error: function (xhr, status, error) {
                    const errors = xhr.responseJSON.errors;
                   // console.log(errors);
                    $('#response-container').empty();
                
                    if (errors) {
                        // Iterate over each error field and its messages
                        Object.keys(errors).forEach(field => {
                            // Get the array of error messages for the current field
                            const errorMessages = errors[field];
                            errorMessages.forEach(errorMessage => {
                                $('#response-container').append('<p>' + errorMessage + '</p>');
                            });
                        });
                        $('#response-container').css('display', 'block');
                        $('#response-container').fadeOut(3000);
                    }
                }
            });
        });
    });



function PopulateTimesheetData(response) {

    if (response !== null && response.timesheets.length > 0) {
        $('#timesheettable').removeClass('hidden');
    
        var tableBody = $('#timesheettable tbody');
        tableBody.empty();

        $.each(response.timesheets, function (index, timesheet) {
            var newRow = '<tr>' +
                '<td>' + (index + 1) + '</td>' +
                '<td>' + timesheet.id + '</td>' +
                '<td>' + timesheet.Date + '</td>' +
                '<td>' + timesheet.working_hour + '</td>' +
                '</tr>';

            tableBody.append(newRow);
        });
        $('#timesheet-data-not-found').addClass('hidden');
    } else {

        $('#timesheettable').addClass('hidden');
        $('#timesheet-data-not-found').removeClass('hidden');
    }
}



$(document).ready(function () {
    $('#monthselect').change(function(){
      var selectedMonth=$(this).val();
      var currentYear = new Date().getFullYear();
      var startDateString = new Date(currentYear, selectedMonth - 1, 0);
      var endDateString = new Date(currentYear, selectedMonth, 1);
      //console.log(endDateString);
      var startDate=moment(startDateString.toString()).format('YYYY-MM-DD');
      var endDate=moment(endDateString.toString()).format('YYYY-MM-DD');
     // console.log(startDate);
     
      var projectid=$('#projectid').val();

      $.ajax({
        type:'get',
        url:'/projectdash/'+projectid+'/get-data',
      
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (response) {
           // console.log(response);
            UpdateTimesheetData(response,startDate,endDate);
            
        },
        error: function (xhr, status, error) {
            const errors = xhr.responseJSON.errors;
            console.log(errors);
        }


      })

    });
});

function UpdateTimesheetData(response,startDate,endDate)
{
    var tableBody = $('#timesheet-table-data tbody');
    tableBody.empty();
    var totalhours = 0;

    $.each(response.data, function (index, data) {
        var entryDate = moment(data.Date);  
        if (entryDate.isBetween(startDate, endDate)){
           
            var newRow = '<tr>' +
                '<td>' + (index + 1) + '</td>' +
                '<td>' + data.id + '</td>' +
                '<td>' + data.Date + '</td>' +
                '<td>' + data.working_hour + '</td>' +
                '</tr>';
               
            tableBody.append(newRow);
            totalhours += parseFloat(data.working_hour);
        }
        
    });
    var totalRow = '<tr>' +
        '<td colspan="3" style="text-align:center"><strong>Total Hours Worked:</strong></td>' +
        '<td><strong>' + totalhours + '</strong></td>' +
        '</tr>';
    tableBody.append(totalRow);
    
}