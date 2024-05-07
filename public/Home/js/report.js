$(document).ready(function () {

    $('#report-generate').click(function (e) {
        e.preventDefault();

        var StartDate = $('#start_date').val();
        var EndDate = $('#end_date').val();

        $.ajax({
            type: 'post',
            url: '/report/get-data',
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

            },
            error: function (xhr, status, error) {
                //const errors = xhr.responseJSON.errors;
                console.log(error);
            }
        })
    });
});


function DisplayTimesheetTable(response, StartDate, EndDate) {
    var startDate = new Date(StartDate);
    var endDate = new Date(EndDate);
    var monthsApart = getmonthsapart(startDate, endDate);

    var timesheetByEmployee = {};
    response.data.forEach(function (entry) {
        var employeeId = entry.employee_id;
        var employeeName = entry.name;
        var date = new Date(entry.Date);
        var monthKey = date.getFullYear() + '-' + (date.getMonth() + 1);
        // console.log(monthKey);

        if (!timesheetByEmployee[employeeId]) {
            timesheetByEmployee[employeeId] = { name: employeeName };
        }


        if (!timesheetByEmployee[employeeId][monthKey]) {
            timesheetByEmployee[employeeId][monthKey] = [];
        }

        timesheetByEmployee[employeeId][monthKey].push(entry.working_hour);

    });
    console.log(timesheetByEmployee);
    var tableHtml = '<table  class="table"><thead><tr><th>Employee Name</th>';

    // Loop through each month within the date range to create table headers
    var currentDate = new Date(startDate);
    for (var i = 0; i < monthsApart; i++) {
        var monthName = currentDate.toLocaleString('en', { month: 'long' });
        var year = currentDate.getFullYear();
        //var month = currentDate.getMonth()+1;

        tableHtml += '<th>' + monthName + ' ' + year + '</th>';
        currentDate.setMonth(currentDate.getMonth() + 1);
    }

    tableHtml += '</tr></thead><tbody>';
     Object.keys(timesheetByEmployee).forEach(function(employeeId){
        var employeename=timesheetByEmployee[employeeId].name;
        console.log(employeename);
        tableHtml +='<tr><td>'+employeename+'</td>';
     });
        
    
    tableHtml += '</tbody></table>';

    $('#report-table').html(tableHtml);
}


function getmonthsapart(startDate, endDate) {

    var monthsApart = (endDate.getFullYear() - startDate.getFullYear()) * 12;
    monthsApart -= startDate.getMonth();
    monthsApart += endDate.getMonth() + 1;

    return monthsApart;

}