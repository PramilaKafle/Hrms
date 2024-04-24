





document.addEventListener('DOMContentLoaded', function () {
  document.getElementById('month').addEventListener('change', displayCalendar);
  //document.getElementById('project').addEventListener('change', displayCalendar);

  function displayCalendar() {
    var selectedMonth = parseInt(document.getElementById('month').value);
    var selectedProject = parseInt(document.getElementById('project').value);

    console.log(selectedProject);

    //if ((selectedMonth) && (selectedProject)) {
      var currentYear = new Date().getFullYear();


      var startDate = new Date(currentYear, selectedMonth - 1, 1); // Months are zero-based in JavaScript
      var endDate = new Date(currentYear, selectedMonth, 0); // End date is one day before the start of the next month


      const calendarContainer = document.getElementById('calendar');
      calendarContainer.innerHTML = '';

      const calendar = createCalendar(startDate, endDate, selectedProject);
      calendarContainer.appendChild(calendar);
   // }
  }



});

function createCalendar(startDate, endDate, selectedProject) {
  const calendar = document.createElement('div');
  calendar.classList.add('calendar');

  const monthYear = document.createElement('div');
  monthYear.classList.add('calender-header');
  const month = document.createElement('span');
  month.classList.add('month');

  //month.textContent=(startDate).getMonth()+1;
  month.textContent = startDate.toLocaleDateString('en-us', { month: 'long' });
  const year = document.createElement('span');
  year.classList.add('year');
  year.textContent = startDate.getFullYear();
  monthYear.appendChild(month);
  monthYear.appendChild(year);
  calendar.appendChild(monthYear);

  const days = document.createElement('div');
  days.classList.add('days');
  const daysLabels = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
  daysLabels.forEach(dayLabel => {
    const dayLabelEl = document.createElement('span');
    dayLabelEl.classList.add('day-label');
    dayLabelEl.textContent = dayLabel;
    days.appendChild(dayLabelEl);
  });

  calendar.appendChild(days);
  return calendar;
}
