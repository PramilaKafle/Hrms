/*!
    * Start Bootstrap - SB Admin v7.0.7 (https://startbootstrap.com/template/sb-admin)
    * Copyright 2013-2023 Start Bootstrap
    * Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-sb-admin/blob/master/LICENSE)
    */
    // 
// Scripts
// 

$(document).ready(function() {
    // Toggle the side navigation
    const sidebarToggle = $('#sidebarToggle');
    if (sidebarToggle.length > 0) {
        // Uncomment Below to persist sidebar toggle between refreshes
        // if (localStorage.getItem('sb|sidebar-toggle') === 'true') {
        //     $('body').toggleClass('sb-sidenav-toggled');
        // }
        sidebarToggle.on('click', function(event) {
            event.preventDefault();
            $('body').toggleClass('sb-sidenav-toggled');
            localStorage.setItem('sb|sidebar-toggle', $('body').hasClass('sb-sidenav-toggled'));
        });
    }
});



$(document).ready(function() {
    // for timesheets
    $('#startdate, #enddate,#start_date, #end_date').datepicker({
        dateFormat: 'yy-mm-dd', 
        autoclose: true       
    });

    // for leave request
    $('#from, #to').datepicker({
        dateFormat: 'yy-mm-dd',
        autoclose: true ,
        minDate: 0  
        
    });


    //search for the leave request in user side
    $('#searchInput').on('keyup', function() {
        var searchText = $(this).val().toLowerCase(); 
        $('tbody tr').each(function(){
            var rowVisibility=false;
            $(this).find('td').each(function(){
              var celltext=$(this).text().toLowerCase();
              if(celltext.includes(searchText))
                {
                    rowVisibility=true;
                    return false; // Exit the loop 
                }
            });

            if (rowVisibility) {
                $(this).show(); 
            } else {
                $(this).hide(); 
            }
        });
       
    });
 
        $('#check').change(function() {
            if ($(this).is(':checked')) {
                $('#review-input').show();
            } else {
                $('#review-input').hide();
            }
        });

        $('#approve').change(function() {
            if ($(this).is(':checked')) {
                $('#approve-input').show();
            } else {
                $('#approve-input').hide();
            }
        });

       
 
});