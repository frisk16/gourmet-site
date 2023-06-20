const dateForm = document.forms.reserve_form.date;
const timeForm = document.forms.reserve_form.time;

flatpickr(dateForm, {
    locale: 'ja',
    dateFormat: 'Y/m/d',
    minDate: new Date(),
});

flatpickr(timeForm, {
    locale: 'ja',
    dateFormat: 'H:i',
    enableTime: true,
    noCalendar: true,
    time_24hr: true,
});


