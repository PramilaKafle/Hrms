// for monthy timesheet report generation
$(document).ready(function () {

    $('#report-generate').click(function (e) {
        e.preventDefault();

        var StartDate = $('#start_date').val();
        var EndDate = $('#end_date').val();

        $.ajax({
            type: 'post',
            url: '/report/monthlytimesheet/get-data',
            data:
            {
                start_date: StartDate,
                end_date: EndDate
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                console.log(response);
                DisplayTimesheetTable(response, StartDate, EndDate);
              // DisplayTimesheet(response);
            },
            error: function (xhr, status, error) {
                //const errors = xhr.responseJSON.errors;
                console.log(error);
            }
        })
    });
});


// function DisplayTimesheet(response)
// { 
//     //tableHtml ='<table class="table"> <thead> <tr><th>EmployeeName</th>';
//    response.data.forEach(function(entry){
//      var employeeId=entry.id;
    
     
//    }); 
//    $('#report-table').html(tableHtml);
// }

function DisplayTimesheetTable(response, StartDate, EndDate) {
    var startDate = new Date(StartDate);
    var endDate = new Date(EndDate);

    var monthsApart = getmonthsapart(startDate, endDate);
    tableHtml = '<table class="table mt-4" ><thead class="monthlytimesheethead"><tr><th>Employee Name </th>';

    currentDate = new Date(startDate);
    for (var i = 0; i < monthsApart; i++) {
        var year = currentDate.getFullYear();
        var monthname = currentDate.toLocaleDateString('en-us', { month: 'long' });
        tableHtml += '<th>' + monthname + ' ' + year + '</th>';

        currentDate.setMonth(currentDate.getMonth() + 1);
    }
    tableHtml += '</tr></thead><tbody>';

    timesheetByEmployee = {};

    response.data.forEach(function (entry) {
        var employeeId = entry.employee_id;
        var employeeName = entry.name;
        var date = new Date(entry.Date);
        var monthKey = date.getFullYear() + '-' + (date.getMonth() + 1);
        if (!timesheetByEmployee[employeeId]) {
            timesheetByEmployee[employeeId] = { name: employeeName };
        }
        if (!timesheetByEmployee[employeeId][monthKey]) {
            timesheetByEmployee[employeeId][monthKey] = [];
        }
        timesheetByEmployee[employeeId][monthKey].push(entry.working_hour);
    });
    console.log(timesheetByEmployee);

    Object.keys(timesheetByEmployee).forEach(function (employeeId) {
        var employeename=timesheetByEmployee[employeeId].name;
       tableHtml +='<tr><td>'+employeename+'</td>';
       var currentDate =new Date(startDate);
       for(var j=0; j< monthsApart ; j++)
        {
            monthkey = currentDate.getFullYear()+ '-' + (currentDate.getMonth()+1);
            monthentries = timesheetByEmployee[employeeId][monthkey] || [];
            var totalworkinghours = monthentries.reduce(function(sum, hours){
                return sum + parseFloat(hours);
            },0);

            tableHtml +='<td>'+totalworkinghours +'</td>';
            currentDate.setMonth(currentDate.getMonth()+1);
        }
         tableHtml +='</tr>';
    });

    tableHtml +='</tbody></table>';

    $('#report-table').html(tableHtml);
}


function getmonthsapart(startDate, endDate) {

    var monthsApart = (endDate.getFullYear() - startDate.getFullYear()) * 12;
    monthsApart -= startDate.getMonth();
    monthsApart += endDate.getMonth() + 1;

    return monthsApart;

}