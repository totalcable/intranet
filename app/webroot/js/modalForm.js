$(document).ready(function () {
    $(document).on("click", ".modal button[type='submit']", function (event) {
        var ModalId = $(this).closest('.modal').attr('id');
        var error = 0;
        $('#info-container').empty();
        $('#' + ModalId + ' .required').each(function () {
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
                    $('#' + ModalId + ' .required').each(function () {
                        if (!$(this).hasClass('select2-container')) {
                            if (!$(this).val()) {
                                remainingError++;
                            }
                        }
                    });
                    var msg = '<p class ="warning_msg"> You did not fill up ' + remainingError + ' required field(s). Fill up these and try again</p>';
                    $('#info-container').empty();
                    if (!remainingError) {
                        $('#' + ModalId + ' .required').each(function () {
                            if ($(this).attr('type') == 'email') {
                                if ($(this).attr('aria-invalid') == 'true') {
                                    msg = '<p class ="warning_msg">Invalid Email.</p>';
                                }
                                else {

                                    msg = '<p class ="success_msg">Everything is Okay. Now click on  button </p>';
                                }
                            }
                        });
                    }
                    $('#info-container').append(msg);
                });
            }
        });

        if (error) {
            var msg = '<p class ="warning_msg"> You did not fill up ' + error + ' required field(s). Fill up these and try again</p>';
            $('#info-container').append(msg);
        }
        else {
            if ($("#" + ModalId + " form" + " .required[type='email']").attr('aria-invalid') == 'true') {
                msg = '<p class ="warning_msg">Invalid Email.</p>';
                $('#info-container').append(msg);
            }
            else {
                // if (!$('#' + ModalId + ' form').hasClass('donotSubmitbyjqyery')) {
                //     $('#' + ModalId + ' form').unbind('submit').submit();
                // }
                $('#' + ModalId + ' form').unbind('submit').submit();

            }
        }
    });
});



