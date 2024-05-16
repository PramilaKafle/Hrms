
// for user to view eech employee timesheet
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

       $(document).on('click', '#timesheet-approve', function (e){
            e.preventDefault();
        var timesheetIds = [];
        $('#timesheettable tbody tr').each(function () {
            var timesheetId = $(this).find('td:eq(1)').text(); 
            timesheetIds.push(timesheetId);
        });
            $.ajax({
             type:'POST',
             url:'/timesheet/approve',
             data:{timesheet_ids : timesheetIds},
             headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             },
             success: function (response) {
                 console.log(response);
                
                
             },
             error: function (xhr, status, error) {
                var errorMessage = xhr.responseText;
                console.log(errorMessage);
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
                '<td>' + timesheet.status +'</td>'+
                '</tr>';

            tableBody.append(newRow);
        });
     
  
        var totalRow = '<tr>' +
        '<td colspan="4" ><strong>Action</strong></td>' +
        '<td> <button class="btn btn-success " id="timesheet-approve">Approve </button>'+
        '<button class="btn btn-danger mx-4">Decline </button></</td>' +
      
        '</tr>';
         tableBody.append(totalRow);
        $('#timesheet-data-not-found').addClass('hidden');
    } else {

        $('#timesheettable').addClass('hidden');
        $('#timesheet-data-not-found').removeClass('hidden');
    }
}



// user timesheet view ends here


// for the employee Timesheet View

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
            //console.log(response);
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
    var sl = 0;
     //console.log(response.data);
    $.each(response.data, function (index,data) {
        var entryDate = moment(data.Date);  
        if (entryDate.isBetween(startDate, endDate)){
            sl++;
            var newRow = '<tr>' +
                '<td>' + sl + '</td>' +
                '<td>' + data.id + '</td>' +
                '<td>' + data.Date + '</td>' +
                '<td>' + data.working_hour + '</td>' +
                '<td>' + data.status + '</td>' +
                '</tr>';
               
            tableBody.append(newRow);
            totalhours += parseFloat(data.working_hour);
        }
        
    });
    var totalRow = '<tr>' +
        '<td colspan="4" style="text-align:center"><strong>Total Hours Worked:</strong></td>' +
        '<td><strong>' + totalhours + '</strong></td>' +
        '</tr>';
    tableBody.append(totalRow);
    
}