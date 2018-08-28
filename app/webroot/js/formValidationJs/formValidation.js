$(document).ready(function () {

    $('.submitbtn').click(function (event) {
$('.info-container').remove();
        var error = 0;

        $('.info-container').remove();
       $(this).closest('form').find('.required').each(function () {

            if (!$(this).val()) {
                error++;
                $(this).css('border-color', 'red');
            }
            $(this).bind("change paste keyup", function () {
                var remainingError = 0;
                if (!$(this).val()) {
                    $(this).css('border-color', 'red');

                }
                else {
                    $(this).css('border-color', 'green');
                }

                $(this).closest('form').find('.required').each(function () {
                    if (!$(this).val()) {
                        remainingError++;
                    }
                });

//                    var msg = '<p class ="warning_msg"> You did not fill up ' + remainingError + ' required field(s). Fill up these and try again</p>';
                var msg = '<p class ="warning_msg"> You did not fill up ' + remainingError + ' required field(s).</p>';
               
                if (!remainingError) {
                    msg = '<div class="info-container"><p class ="success_msg"> You filled up all required field(s).</p></div>';
                }
               $('.info-container').html(msg);

            });

        });

        if (error) {

//            var msg = '<p class ="warning_msg"> You did not fill up ' + error + ' required field(s). Fill up these and try again</p>';
             var msg = '<div class="info-container"> <p class ="warning_msg"> You did not fill up ' + error + ' field(s)</p> </div>';
            $(this).closest('form').before(msg);
            event.preventDefault();
        }
    });

});






