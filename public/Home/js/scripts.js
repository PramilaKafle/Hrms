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
    $('#startdate, #enddate').datepicker({
        format: 'yyyy-mm-dd', 
        autoclose: true       
    });

    $('#start_date, #end_date').datepicker({
        dateFormat: 'yy-mm-dd',
        autoclose: true     
        
    });
});