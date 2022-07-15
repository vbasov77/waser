
jQuery.datetimepicker.setLocale('ru');
jQuery('#timepicker').datetimepicker({
    inline: true,
    timepicker: false,
    format:'d.m.Y',
    minDate: new Date(),
    dayOfWeekStart: 1,
});

