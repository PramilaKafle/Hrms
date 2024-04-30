$(document).ready(function()
{

    $('#projectdata').on('change', updateTimesheetData);
   


    function updateTimesheetData() {

        const selectedProject=$('#projectdata').val();
        console.log(selectedProject);
        $('.table tbody tr').each(function() {
            const projectId = $('#projectid').val();
               // Check if the row matches the selected Project and Month
            const isProjectMatch = (projectId === selectedProject);
                  //console.log(isProjectMatch);
            if ( isProjectMatch) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    }
});