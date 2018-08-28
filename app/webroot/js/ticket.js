$(document).ready(function () {
    $(".comment_ticket").click(function (e) {
        var id = $(this).attr('id');
        var forwardForm = "#comment_dialog" + id;
        $('#forward_dialog' + id).hide();
        $('#solve_dialog' + id).hide();
        $('#unsolve_dialog' + id).hide();
        $(forwardForm).toggle();
        e.preventDefault();
    });
    $(".forward_ticket").click(function (e) {
        var id = $(this).attr('id');
        var forwardForm = "#forward_dialog" + id;
        $('#comment_dialog' + id).hide();
        $('#solve_dialog' + id).hide();
        $('#unsolve_dialog' + id).hide();
        $(forwardForm).toggle();
        e.preventDefault();
    });

    $(".solve_ticket").click(function (e) {
        var id = $(this).attr('id');
        var forwardForm = "#solve_dialog" + id;
        $('#comment_dialog' + id).hide();
        $('#forward_dialog' + id).hide();
        $('#unsolve_dialog' + id).hide();
        $(forwardForm).toggle();
        e.preventDefault();
    });

    $(".unsolve_ticket").click(function (e) {
        var id = $(this).attr('id');
        var forwardForm = "#unsolve_dialog" + id;
        $('#comment_dialog' + id).hide();
        $('#forward_dialog' + id).hide();
        $('#solve_dialog' + id).hide();
        $(forwardForm).toggle();
        e.preventDefault();
    });

  

//end tracks dialog box design



    //partial payment
    $(document).on("change", ".partial", function () {
        var sum = 0;
        $(".partial").each(function () {
            sum += +$(this).val();
        });
        $(".total").val(sum);
    });

    $("#action_type").change(function () {
        var selected = $(this).val().trim();
        if (selected == '') {
            $('.assign_single').show();
            $('.assign_group').show();
            $('.priority .priority_input').addClass('required');
            $('.priority').show();
            $('#shipmentshow_hide').hide();
        }
        if (selected == 'solved') {
            $('.assign_single').hide();
            $('.assign_group').hide();
            $('.priority .priority_input').removeClass('required');
            $('.priority').hide();
            $('#shipmentshow_hide').hide();
        }
        else if (selected == 'shipment' || selected == 'ready') {
            $('.assign_single').hide();
            $('.assign_group').hide();
            $('.priority .priority_input').addClass('required');
            $('.priority').show();
            $('#shipmentshow_hide').show();
        }
    });




    $('.issueChange').change(function () {
        var selected = $('.issueChange option:selected').text().toLowerCase();
        if (selected.trim() == "moving") {
            $('#action').hide();
            $('#new_addr').show();
        }
        else if (selected.trim() == "wiring problem") {
            $('#action').hide();
            $('#new_addr').hide();
        }
        else if (selected.trim() == "remote problem") {
            $('#action').show();
            $('#new_addr').hide();
        }
        else {
            $('#action').show();
            $('#new_addr').hide();
        }
    });




    $('.issueChange').change(function () {
        var selected = $('.issueChange option:selected').text().toLowerCase();
        var box = "2nd box";
        var twbox = "3rd box";
        var twthbox = "2nd & 3rd box";
        var thbox = "3rd & 4th box";
        var fobox = "4th box";
        var canceled = "cancel";
        var holded = "hold";
        var unholded = "unhold";
        var recono = "reconnect";
        var loutbound = "outbound";

        if (selected.trim() == "moving") {
            $('#action').hide();
            $('#new_addr').show();
        }
        else if (selected.trim() == "wiring problem") {
            $('#action').hide();
            $('#new_addr').hide();
        }
        else if (selected.trim() == "remote problem") {
            //$('#action').hide();
            $('#new_addr').hide();
        }
        else {
            $('#action').show();
            $('#new_addr').hide();
        }

        if (selected.indexOf(canceled) != -1) {
            $('#check_mac').show();
            $('#canceldate').show();
            $('#pickup_date').show();
            $('#hold').hide();
            $('#unhold').hide();
            $('#reconnect').hide();
            $('#action').hide();
            $('#equepment').hide();
            $('#outbound_list').hide();
        }
        else if (selected.indexOf(holded) != -1 && selected.indexOf(unholded) == -1) {
            $('#check_mac').show();
            $('#hold').show();
            $('#unhold').hide();
            $('#reconnect').hide();
            $('#canceldate').hide();
            $('#pickup_date').hide();
            $('#action').hide();
            $('#equepment').hide();
            $('#outbound_list').hide();
        }
        else if (selected.indexOf(loutbound) != -1) {
            $('#outbound_list').show();
            $('#hold').hide();
            $('#unhold').hide();
            $('#reconnect').hide();
            $('#canceldate').hide();
            $('#pickup_date').hide();
            $('#action').hide();
            $('#equepment').hide();
        }
        else if (selected.indexOf(unholded) != -1) {
            $('#check_mac').show();
            $('#unhold').show();
            $('#hold').hide();
            $('#reconnect').hide();
            $('#canceldate').hide();
            $('#pickup_date').hide();
            $('#action').hide();
            $('#equepment').hide();
            $('#outbound_list').hide();
        }
        else if (selected.indexOf(recono) != -1) {
            $('#check_mac').show();
            $('#reconnect').show();
            $('#hold').hide();
            $('#unhold').hide();
            $('#canceldate').hide();
            $('#pickup_date').hide();
            $('#action').hide();
            $('#equepment').hide();
            $('#outbound_list').hide();
        }
        else if (selected.indexOf(box) != -1 || selected.indexOf(twbox) != -1 || selected.indexOf(thbox) != -1 || selected.indexOf(fobox) != -1 || selected.indexOf(twthbox) != -1) {
            $('#equepment').show();
            $('#outbound_list').hide();
        }

        else {
            $('#check_mac').hide();
            $('#hold').hide();
            $('#unhold').hide();
            $('#reconnect').hide();
            $('#canceldate').hide();
            $('#pickup_date').hide();
            //$('#action').show();
            $('#equepment').hide();
            $('#outbound_list').hide();

        }

    });




})
