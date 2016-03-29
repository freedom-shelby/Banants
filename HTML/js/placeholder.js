

$(document).ready(function() {
    
    /* Placeholder for IE */
    if($.browser.msie) { // Условие для вызова только в IE
        $("form").find("[placeholder]").each(function() {
            if($(this).val() == ''){
                var tp = $(this).attr("placeholder");
                $(this).attr('value',tp);
            }
        }).focusin(function() {
            var val = $(this).attr('placeholder');
            if($(this).val() == val) {
                $(this).attr('value','');
            }
        }).focusout(function() {
            var val = $(this).attr('placeholder');
            if($(this).val() == "") {
                $(this).attr('value', val);
            }
        });

        /* Protected send form */
        $("form").submit(function() {
            $(this).find("[placeholder]").each(function() {
                var val = $(this).attr('placeholder');
                if($(this).val() == val) {
                    $(this).attr('value','');
                }
            })
        });
    }
});