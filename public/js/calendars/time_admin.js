
jQuery(function () {
    var al1 = array;
    jQuery('#date_timepicker_start').datetimepicker({
        format: 'H:i',
        allowTimes: al1,
        onShow: function (ct) {
            this.setOptions({
                maxDate: jQuery('#date_timepicker_end').val() ? jQuery('#date_timepicker_end').val() : false
            })
        },
        datepicker: false,

    });
    jQuery('#date_timepicker_end').datetimepicker({
        format: 'H:i',
        onShow: function (ct) {
            this.setOptions({
                minDate: jQuery('#date_timepicker_start').val() ? jQuery('#date_timepicker_start').val() : false
            })
        },
        datepicker: false,
        allowTimes: al1,
    });
});