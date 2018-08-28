
$(document).ready(function () {
    $(document).on("click", ".normalForm button", function () {
        var error = 0;
        $('#info-container2').empty();
        $(this).closest('form').find('.required').each(function () {
            if (!$(this).hasClass('select2-container')) {
                if (!$(this).val()) {
                    error++;
                    $(this).css('border-color', 'red');
                    $(this).parent().find('.required').css('border-color', 'red');
                }
                $(this).bind("change paste keyup", function () {
                    var remainingError = 0;
                    if (!$(this).val()) {
                        $(this).css('border-color', 'red');
                        $(this).parent().find('.required').css('border-color', 'red');
                    }
                    else {
                        $(this).css('border-color', 'green');
                        $(this).parent().find('.required').css('border-color', 'green');
                    }
                    $(this).closest('form').find('.required').each(function () {
                        if (!$(this).hasClass('select2-container')) {
                            if (!$(this).val()) {
                                remainingError++;
                            }
                        }
                    });
                    var msg = '<p class ="warning_msg"> You did not fill up ' + remainingError + ' required field(s). Fill up these and try again</p>';

                    $(this).closest('form').find('#info-container2').empty()
                    if (!remainingError) {
                        $(this).closest('form').find('.required').each(function () {
                            if ($(this).attr('type') == 'email') {
                                if ($(this).attr('aria-invalid') == 'true') {
                                    msg = '<p class ="warning_msg">Invalid Email.</p>';
                                }
                                else {
                                    msg = '<p class ="success_msg">Everything is Okay. Now click on button </p>';
                                }
                            }
                        });
                    }
                    $(this).closest('form').find('#info-container2').append(msg);
                });
            }
        });
        if (error) {
            var msg = '<p class ="warning_msg"> You did not fill up ' + error + ' required field(s). Fill up these and try again</p>';
            $(this).closest('form').find('#info-container2').append(msg);
        }
        else {
            if ($(this).closest('form').find(".required[type='email']").attr('aria-invalid') == 'true') {
                msg = '<p class ="warning_msg">Invalid Email.</p>';
                $('#info-container2').append(msg);
            }
            else {
                    $(this).closest('form').unbind('submit').submit();    
            }
        }
    });
});



