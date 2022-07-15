
jQuery.datetimepicker.setLocale('ru');
jQuery('#datetimepicker1').datetimepicker({
    weekends:['16.01.2022','17.01.2022','18.01.2022','19.01.2022'],
    startDate:'+1970/01/01',//or 1986/12/08
    minDate:'+1970/01/01',//yesterday is minimum date(for today use 0 or -1970/01/01)
    maxDate:'+1971/01/03',//tomorrow is maximum date calendar
    inline: true,
    timepicker: false,
    format:'d.m.Y',
});

