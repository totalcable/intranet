//    check agent active or not
(function isAgentOnline() {
    $.ajax({
        // var url = 'loadbookWriter';
        url: $("#webroot").text() + 'admins/getIsChatAgent',
        success: function (data) {
            var status = data;
            var name = '';
            if (data != 'offline') {
                var statusName = data.split(',');
                status = statusName[0];
                name = statusName[1];
            }
            $('.liveSupport').attr('class', 'liveSupport');
            $('.liveSupport').addClass(status);
            $('#c_name_msgHead').text(name);
            var imgUrl = 'img/' + status + '.png';
            $('.liveSupport img').attr('src', '');
            $('.liveSupport img').attr('src', imgUrl);

        },
        complete: function () {
            // Schedule the next request when the current one's complete
            setTimeout(isAgentOnline, 5000);
        }
    });
})();
// END check agent active or not

(function checkStatus() {
    $.ajax({
        type: 'POST',
        data: 'c_id=' + $.cookie("c_id"),
        url: $("#webroot").text() + 'chats/checkStatus',
        success: function (status) {
            $.cookie("status", status, {'path': '/'});
            if (status == 'requested') {
                $('.chatForm').hide();
                //var msg ='Hi, <i><strong>'+$('#c_name').val()+' </strong></i> how can I help you?';
                if (!$(".msg_intial")[0]) {
                    var msg = 'Hi, <i><strong>' + $.cookie("c_name") + ' </strong></i> One of our agent will be with you within very short time. Thank you for your patient.';
                    $('<div class="msg_intial temp_msg">' + msg + '</div>').insertBefore('.client_area .msg_push');
                }

                $('.msg_body').scrollTop($('.msg_body')[0].scrollHeight);
                $('li.liveSupport img').hide();
                $('.msg_input').show();

                // $('.msg_wrap').show();
                $('.msg_box').show(1000);
            }
            if (status == 'active') {
                $('.chatForm').hide();
                $('.msg_body').scrollTop($('.msg_body')[0].scrollHeight);
                $('li.liveSupport img').hide();
                $('.msg_input').show();
                $('.temp_msg').remove();
                // $('.msg_wrap').show();
                $('.msg_box').show(1000);
            }
            if(status == 'close'){

                $('.chatForm').show();
                $('.msg_b').remove();
                $('.msg_a').remove();
            }
        },
        complete: function () {
            // Schedule the next request when the current one's complete
            setTimeout(checkStatus, 3000);
        }
    });
})();

// Save  message
function saveClientMsg(msg) {
    $.ajax({
        type: 'POST',
        data: 'c_id=' + $.cookie("c_id") + '&msg=' + msg, //'foo='+ bar+'&calibri='+ nolibri,
        dataType: 'json',
        url: $("#webroot").text() + 'chats/saveClientMsg',
        success: function (data) {
        }
    });
};
// END Save message



// Load  message
(function loadClient() {
    $.ajax({
        type: 'POST',
        data: 'c_id=' + $.cookie("c_id") + '&offset=' + $('#c_name_msgHead').data('offset'), //'foo='+ bar+'&calibri='+ nolibri,
        dataType: 'json',
        url: $("#webroot").text() + 'chats/loadMsg',
        success: function (data) {
            var id =0;
              if ($.cookie("status") == "active"){

            $.each(data, function (i, item) {

                    if(item.Chat.status == 'active'){
                        $('.temp_msg').remove();
                    }
                    
                    if (!$('#' + item.Chat.id)[0]) {
                        if (item.Chat.admin_message) {
                            $('<div class="msg_b" id="' + item.Chat.id + '">' + item.Chat.admin_message + '</div>').insertBefore('.client_area .msg_push');
                        }
                        if (item.Chat.client_message) {
                            $('<div class="msg_a" id="' + item.Chat.id + '">' + item.Chat.client_message + '</div>').insertBefore('.client_area .msg_push');
                        }
                        $('.msg_body').scrollTop($('.msg_body')[0].scrollHeight);
                    }
                

                 id = item.Chat.id;
            });
            
            $('#c_name_msgHead').data('offset', id);

              } 


        },
        complete: function () {
            // Schedule the next request when the current one's complete
            setTimeout(loadClient, 3000);
        }
    });
})();
// END load message

$(document).ready(function () {
    // alert($("#webroot").text());
    $('.msg_box').hide();
    $('#admin_chatRoom .msg_box').show();
    $('li.liveSupport img').click(function () {
        if ($('li.liveSupport').hasClass('offline')) {
            alert('All customer care executive are offline. Please try again.');
        }
        else {
            $(this).hide(1000);
            $('.msg_wrap').show();
            $('.msg_box').show(1000);
        }
    });
    $(document).on("click", ".msg_head", function () {
        $(this).next('.msg_wrap').slideToggle('slow');
    });
    $('.client_area textarea').keypress(
            function (e) {
                if (e.keyCode == 13) {
                    var msg = $(this).val();
                    $(this).val('');
                    if ($.trim(msg).length !== 0) {
                        if ($.cookie("status") == "requested") {
                            alert('Please wiat some momment. A agent will response first within very short time, then you can start live chating. Thanks for your patient');
                        }
                        else {
                            saveClientMsg(msg);
                            $('<div class="msg_a temp_msg">' + msg + '</div>').insertBefore('.msg_push');
                            $('.msg_body').scrollTop($('.msg_body')[0].scrollHeight);
                        }
                    }
                }
            });
});


