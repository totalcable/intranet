var request = null;
function saveData(formid, fields, processUrl, updateSection) {
    $(formid).submit(function (event) {
        $('.alert').remove();
        event.preventDefault();

        //  Abort any pending request
        if (request) {
            request.abort();
        }
        var $form = $(this);
        var $inputs = $form.find(fields);
        var serializedData = $form.serialize();

        $inputs.prop("disabled", true);
        var request = $.ajax({
            url: processUrl,
            dataType: 'json',
            type: "post",
            data: serializedData
        });
        // Callback handler that will be called on failure
        request.fail(function (jqXHR, textStatus, errorThrown) {

            console.log(
                    "The following error occurred: " +
                    textStatus + errorThrown
                    );

        });
        request.always(function () {
            // Reenable the inputs
            $inputs.prop("disabled", false);
        });

        request.done(function (response, textStatus, jqXHR) {

            $(updateSection + ' .bubblingG').fadeOut(2000, function () {
                $(updateSection).before(response.msg);

                if (updateSection == '#personalInfo') {
                    $('#avatar #ResellerEmail').val(response.reseller.email);
                    $('#password_change #ResellerEmail').val(response.reseller.email);
                }
                else if (updateSection == '#password_change') {

                    $('#password_change #ResellerOldPassword').val('');
                    $('#password_change #ResellerPassword').val('');
                    $('#password_change #ResellerRpassword').val('');
                }
                else if (updateSection == '#withdrawAction') {
                    $('#withdrawAction #balance-txt').text('BALANCE: ' + response.balance + ' TK');
                    $('#withdrawAction #ResellerAccountBalance').val(response.balance);
                    $('#withdrawAction #ResellerAccountWithdraw').val('');
                }
            });//({visibility: 'hidden'}, 2000, 'linear');//css("visibility", "hidden");

        });

        // Prevent default posting of form
//        event.preventDefault();
    });
}

function saveFile(formid, processUrl, updateSection) {
    $(formid).submit(function () {
        $('.alert').remove();
        var formData = new FormData($(formid)[0]);
        xhr = $.ajax({
            url: processUrl,
            type: 'POST',
            data: formData,
            dataType: 'json',
            async: false,
            success: function (response) {
                $(updateSection + ' .bubblingG').fadeOut(2000, function () {
                    if (!$('.alert').length) {
                        $(updateSection).before(response.msg);
                    }

                });
            },
            cache: false,
            contentType: false,
            processData: false
        });

        return false;
    });
}

//END Save File


function getFeedback(url, data) {

    $.ajax({
        type: 'POST',
        url: url,
        dataType: 'json',
        data: data, //'foo='+ bar+'&calibri='+ nolibri,
        success: function (msg) {

            if (Object.keys(msg).length !== 0) {

                $('#FeedbackName').val(msg.Feedback.name);
                $('#feedbackId').val(msg.Feedback.id);
                $('#FeedbackMobile').val(msg.Feedback.mobile);
                $('#FeedbackComment').val(msg.Feedback.comment);
                var webroot = $("#webroot").text();
                var img = '<div class="col-md-4 img_prev" >' +
                        '<img style="height:120px; width: 120px;"  src="' +
                        webroot +
                        'feedback/' +
                        msg.Feedback.img +
                        '"/>' +
                        '</div>';


                $('#prev_image1').html(img);
                $('.feedbackImg span').text('Change Your Image');
                $('.required_toggle').removeClass('required');
            }
            else {

                $('#FeedbackName').val('');
                $('#FeedbackComment').val('');
                $('#prev_image1').empty();

                $('.feedbackImg span').text('Add Your Image');
            }

        }
    });
}
// END getFeedback

// load review
function getReview(url, data) {

    $.ajax({
        type: 'POST',
        url: url,
        dataType: 'json',
        data: data, //'foo='+ bar+'&calibri='+ nolibri,
        success: function (msg) {

            if (Object.keys(msg).length !== 0) {
                $('#ReviewName').val(msg.Review.name);
                $('#reviewId').val(msg.Review.id);
                $('#ReviewContent').val(msg.Review.content);
                $('#backing5').val(msg.Review.rating);
            }
            else {
                $('#ReviewName').val('');
                $('#ReviewId').val('0');
                $('#ReviewContent').val('');
            }
        }
    });
}

// END getReview

function getCustomer(url, data) {
    $.ajax({
        type: 'POST',
        url: url,
        dataType: 'json',
        data: data, //'foo='+ bar+'&calibri='+ nolibri,
        success: function (msg) {

            if (Object.keys(msg).length !== 0) {
                $('#customer_id').val(msg.Customer.id);
                $('#CustomerName').val(msg.Customer.name);
                $('#CustomerMobile').val(msg.Customer.mobile);
                $('#CustomerAltMobile').val(msg.Customer.alt_mobile);
                $("#CustomerCityId").select2("val", msg.Customer.city_id);
                $("#cid").select2("val", msg.Customer.location_id);
                $('#CustomerDetailAddr').val(msg.Customer.detail_addr);

            }
            else {
                $('#customer_id').val(0);
                $('#CustomerName').val('');
                $('#CustomerMobile').val('');
                $('#CustomerAltMobile').val('');
                $("#CustomerCityId").select2("val", '');
                $("#cid").select2("val", '');
                $('#CustomerDetailAddr').val('');
            }

        }
    });


}

$(document).ready(function () {
    //  Load Feedback
    $('.feedbackEmail').on("keyup change paste input", function () {
        var url = $('#webroot').text() + 'feedbacks/' + 'loadFeedback';
        var field = $(this).val();
        var data = 'email=' + field;// +'&calibri=' + 'nolibri';
        getFeedback(url, data);
    });
    // END-Feedback
    // load review
    $('.reviewEmail').on("keyup change paste input", function () {
        var url = $('#webroot').text() + 'reviews/' + 'loadReview';
        var field = $(this).val();
        var data = 'email=' + field;// +'&calibri=' + 'nolibri';
        getReview(url, data);
    });
    // END-review

    // Customer info Load on changing customer email
    $('#CustomerEmail').on("keyup change paste input", function () {

        var url = $('#webroot').text() + 'orders/' + 'loadCustomer';
        var field = $(this).val();
        var data = 'email=' + field;// +'&calibri=' + 'nolibri';
        getCustomer(url, data);


    });
    // END-Customer info Load on changing customer email

    //    Update reseller personal info
    $('#resellerPersonalInfoChangeBtn').on('click', function (event) {

        $('.alert').remove();
        $('#personalInfo .bubblingG').css({'display': ''});
        $('#personalInfo .bubblingG').css("visibility", "visible");
        var formid = '#changePersonalInfoForm';
        var fields = "input, select, button, textarea";
        var processUrl = $('#webroot').text() + 'resellers/' + 'changePersonalInfo';
        saveData(formid, fields, processUrl, '#personalInfo');


    });
//    END Update reseller personal info

    //    Update reseller profile pic
    $('#changeAvatarBtn').on('click', function (event) {
        $('#avatar .bubblingG').css({'display': ''});
        $('#avatar .bubblingG').css("visibility", "visible");
        var formid = '#changeAvatarForm';
        var fields = "input, select, button, textarea";
        var processUrl = $('#webroot').text() + 'resellers/' + 'changeAvatar';
        saveFile(formid, processUrl, '#avatar');

    });
//    END Update reseller profile pic

    //    Update reseller password 
    $('#changePasswordBtn').on('click', function (event) {
        //event.preventDefault();
        $('.alert').remove();
        $('#password_change .bubblingG').css({'display': ''});
        $('#password_change .bubblingG').css("visibility", "visible");
        var formid = '#changePasswordForm';
        var fields = "input, select, button, textarea";
        var processUrl = $('#webroot').text() + 'resellers/' + 'changePassword';
        saveData(formid, fields, processUrl, '#password_change');

    });
//    END Update reseller paasword



    // Update reseller withdraw 
    $('#resellerWithdrawBtn').on('click', function (event) {
//        event.preventDefault();
        $('.alert').remove();
        $('#earning .bubblingG').css({'display': ''});
        $('#earning .bubblingG').css("visibility", "visible");
        var formid = '#resellerWithdrawForm';
        var fields = "input, select, button, textarea";
        var processUrl = $('#webroot').text() + 'resellers/' + 'withdraw';
        saveData(formid, fields, processUrl, '#withdrawAction');

    });
//    END Update reseller withdraw

// // Registration to order book
//   $('#customerRegBtn').on('click', function (event) {
//         event.preventDefault();
//         $('.alert').remove();
//         $('#orderForm .bubblingG').css({'display': ''});
//         $('#orderForm .bubblingG').css("visibility", "visible");
//         var formid = '.customerregForm';
//         var fields = "input, select, button, textarea";
//         var processUrl = $('#webroot').text() + 'books/' + 'registration';
//         saveData(formid, fields, processUrl, '#orderForm#info-container');

//     });
// // END Registration to order book

});