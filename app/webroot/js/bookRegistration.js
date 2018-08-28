var request = null;
function postRequest(form, fields, processUrl) {
    alert('inside post request');
    $(form).submit(function (event) {
        alert('ajax working');
        event.preventDefault();

        $('.alert-error').remove();
        //  Abort any pending request
        if (request) {
            request.abort();
        }
        var $form = $(this);
        var $inputs = $form.find(fields);
        var serializedData = $form.serialize();
        $inputs.prop("disabled", true);
        request = $.ajax({
            url: processUrl,
            type: "post",
            data: serializedData
        });
        // Callback handler that will be called on failure
        request.fail(function (jqXHR, textStatus, errorThrown) {
            // Log the error to the console
            console.log(
                    "The following error occurred: " +
                    textStatus, errorThrown
                    );
        });
        request.always(function () {
            // Reenable the inputs
            $inputs.prop("disabled", false);
        });

        request.done(function (response, textStatus, jqXHR) {
            // Log a message to the console
            var arr = response.split('####');
            var redirectUrl = arr[0];
            alert(redirectUrl);

            if (redirectUrl.toLowerCase().indexOf("haserror") >= 0) {
                request.abort();
                $('.alert-error').remove();
                var errorMsg = redirectUrl.replace("hasError", "");
                $('#info-container').append(errorMsg);
            }
            else {
                redirectUrl = redirectUrl.replace("/frontends", "");
                window.location.replace(redirectUrl);
            }
        });
        // Prevent default posting of form
        event.preventDefault();
    });
}

$(document).ready(function () {
    $('#customerAcc').click(function () {
        $('#customerloginForm').hide();
        $('.customerregirtrationForm').show(1000);
    });

    $('#customerLogin').click(function () {
        $('#customerregirtrationForm').hide();
        $('#customerloginForm').show(1000);
    });
    var RegForm = '.customerregForm';
    var fields = "input, select, button, textarea";
    var processUrl = $('#webroot').text() + 'books/' + 'registration';
    $('#customerRegBtn').click(function (event) {
        event.preventDefault();
        alert('outside post request');
        postRequest(RegForm, fields, processUrl);
    });

    var formid2 = '#customerloginForm';
    var fields2 = "input, button";
    var processUrl2 = 'login';
    $('#customerloginBtn').click(function () {
        postRequest(formid2, fields2, processUrl2);
    });

});