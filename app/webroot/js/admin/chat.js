// open requested chat form in admin panel
(function keepOepn() {
    $.ajax({
        type: 'POST',
        dataType: 'json',
        data: 'c_id=' + $.cookie("c_id"),
        url: $("#webroot").text() + 'chats/shouldOpen',
        success: function (data) {
            console.log(data);
            var width = $('.admin-msg-box').width()*$('.admin-msg-box').length;
            var space = 7;
            $.each(data, function (i, item) {
                 space = space + 3;
                if (!$('.' + item.Chat.c_id)[0]) {

                    var chatBox = '<div  class = "msg_box admin-msg-box  ' + item.Chat.c_id +
                            '" style = "right:' + width + 'px; margin-right:' + space + 'px;" >';

                    if (item.Chat.status == "requested") {
                        chatBox = chatBox + '<div class = "msg_head requested" data-offset="0" data-c_id="' + item.Chat.c_id + '" >' +
                                '<a  id="' + item.Chat.id + '"' +
                                ' class="activateChat" title="Active">' +
                                '<span class="fa fa-check"></span>';
                    }
                    else if (item.Chat.status == "active") {
                        chatBox = chatBox + '<div class = "msg_head activated" data-offset="0" data-c_id="' + item.Chat.c_id + '" >' +
                                '<a  id="' + item.Chat.id + '"' +
                                ' class="closeChat" title="End Chat">' +
                                '<span class="fa fa-ban"></span>';
                    }
                    else {
                        $('.' + item.Chat.c_id).remove();
                    }


                    chatBox = chatBox + '</a>' +
                            '&nbsp;&nbsp;' +
                            '</div>' +
                            '<div class="msg_wrap display-hide" >' +
                            '<div class="msg_body" >' +
                            '<div class="msg_push" ></div>' +
                            '</div>' +
                            '<div class="msg_footer" > <textarea class = "msg_input" rows = "4" ></textarea></div >' +
                            '</div>' +
                            '</div>';

                    $('#admin_chatRoom').append(chatBox);
                    var n = i + 1;
                    width = $('.admin-msg-box').width() * n;
                   
                }

            });

        },
        complete: function () {
            // Schedule the next request when the current one's complete
            setTimeout(keepOepn, 10000);
        }
    });
})();
// END open requested chat form in admin panel

function activateChat(id) {
    $.ajax({
        type: 'POST',
        data: 'id=' + id,
        url: $("#webroot").text() + 'chats/activate',
        success: function (status) {
            $('#' + id).closest('.msg_head').removeClass('requested');
            $('#' + id).closest('.msg_head').addClass('activated');
            $('#' + id).attr('title', 'End Chat');
            $('#' + id + ' span').removeClass('fa-check');
            $('#' + id ).removeClass('activateChat');
            $('#' + id ).addClass('closeChat');
            $('#' + id + ' span').addClass('fa-ban');
            // alert(head);
        }
    });
}
function closeChatByAdmin(id) {
    $.ajax({
        type: 'POST',
        data: 'id=' + id,
        url: $("#webroot").text() + 'chats/closeByAdmin',
        success: function (status) {
            $('#' + id).closest('.admin-msg-box').remove();
        }
    });
}
// Save  message
function saveAdminMsg(c_id, msg) {
    $.ajax({
        type: 'POST',
        data: 'c_id=' + c_id + '&msg=' + msg, //'foo='+ bar+'&calibri='+ nolibri,
        dataType: 'json',
        url: $("#webroot").text() + 'chats/saveAdminMsg',
        success: function (data) {
        }
    });
}
;
// END Save message


// Load  message
function loading(c_id, offset) {
        $.ajax({
            type: 'POST',
            data: 'c_id=' + c_id + '&offset=' + offset, //'foo='+ bar+'&calibri='+ nolibri,
            dataType: 'json',
            url: $("#webroot").text() + 'chats/loadMsg',
            success: function (data) {
                var id = 0;
                $.each(data, function (i, item) {
                    if (item.Chat.status == 'active') {
                        $('.temp_msg').remove();
                    }
                    if (!$('#' + item.Chat.id)[0]) {
                        if (item.Chat.admin_message) {
                            $('<div class="msg_a" id="' + item.Chat.id + '">' + item.Chat.admin_message + '</div>').insertBefore('.' + c_id + ' .msg_push');
                        }
                        if (item.Chat.client_message) {
                            $('<div class="msg_b" id="' + item.Chat.id + '">' + item.Chat.client_message + '</div>').insertBefore('.' + c_id + ' .msg_push');
                        }
                        $('.msg_body').scrollTop($('.msg_body')[0].scrollHeight);
                    }
                    id = item.Chat.id;
                });
                $('.' + c_id + ' .msg_head').data('offset', id)
            }
        });
    
};
(function loadAdminMsg() {
  $('.activated').each(function () {
     loading($(this).data('c_id'),$(this).data('offset'));
  });
  
   setTimeout(loadAdminMsg, 1000);
})();

// END load message

$(document).ready(function () {
    $(document).on("click", ".activateChat", function () {
        if (confirm("Are you sure to activate?")) {
            activateChat($(this).attr('id'));
        }
    });
    $(document).on("click", ".closeChat", function () {
        if (confirm("Are you sure to close?")) {
            closeChatByAdmin($(this).attr('id'));
        }
    });
    $(document).on("keypress", ".admin-msg-box textarea", function (e) {
        if (e.keyCode == 13) {
            var msg = $(this).val();
            var c_id = $(this).closest('.msg_box').find('.msg_head').data('c_id');
            if ($.trim(msg).length !== 0) {
                saveAdminMsg(c_id, msg);
                $('<div class="msg_a temp_msg">' + msg + '</div>').insertBefore('.' + c_id + ' .msg_push');
                $('.msg_body').scrollTop($('.msg_body')[0].scrollHeight);
            }
            $(this).val("");
        }
    });
});


