function check_empty() {
    var haveItem = $('.addeditem').length;
    $('.top-cart-info').html(haveItem +' items');
    if (!haveItem) {
        $('.busket-head').hide();
        $('#buybtn').hide();            
        var msg = '<div class="alert alert-info"> <strong  style="padding-top:0px; margin-top: -8px;">' +
                'Your bag is empty' +
                '</strong></div>';
        if ($('#msg').is(':empty')) {
            $('#msg').append(msg);
        }
    }
    else {

        $('.busket-head').show();
        $('#buybtn').show(2000);
        $('#msg').empty();
    }
}
function getQuantity() {
    var pieces = 0;
    var tp = 0;
    $('.busket').find('.quantity-input').each(function () {
        var pid = $(this).attr('id');
        pid = pid.replace('addedq', '');
        var quantity = parseInt($(this).attr('value'));
        var p = Math.ceil(parseFloat($('#sppp' + pid).val()));
        tp += p * quantity;
        pieces += quantity;
    });
    var result = [];
    result['pieces'] = pieces;
    result['price'] = tp;
    return result;
}

function get_discount(items) {
    var sc = $('#scharge').val();
    var scs = $.parseJSON(sc);
    for (var i = 0; i < scs.length; i++) {
        var scobj = scs[i].ServiceCharge;
        if (scobj.pieces == items)
            return scobj.discount;
    }
}
function show_price() { // total price, total service charge, discount
    $('.price').empty();
    $('.sc').empty();
    $('#msg').empty();
    var p = getQuantity();
    console.log(p);
    
    var sc = parseInt($('#sc').val());
    
    var tp = p['price'] + sc;
    
    $('.price').append(tp);
    $('.sc').append(sc);
    
}



$(document).ready(function () {
    $(".top-cart-block").on("mouseover", function () {
        $('.top-cart-content').css("display", "block");
    });
    $(document).on('click', '#hide_btn', function (event) {
        event.preventDefault()
         $('.top-cart-content').hide(); 
    });
 
    // check bag is empty
    $('#msg').empty(); // remove unwanted white space
    check_empty();
    // End- check bag is empty
  

   

// ################## pass  id to form on showing modal ###############
    // hide  fields
    $('.hide').hide();
    $('#ID').hide();
    $('#quantity').hide();
    $('#sold').hide();
    // Order from front user management
    $('#orderForm').on('show.bs.modal', function (e) {
        
        var pid = '';
        var quantity = '';
        $('.busket').find('.quantity-input').each(function () {
            var PID = $(this).attr('id');
            PID = PID.replace('addedq', '');
            pid += ',' + PID;
            quantity += ',' + $(this).attr('value');
            $('#ID').val(pid);
            $('#quantity').val(quantity);
        });
    });
    // END- Order from front user management


// ################## End-pass  id to form on showing modal ###############


// ###################### add to busket ##############################
    var pid = '';
    var quanity = '';
    $(document).on('click', '.add-to-busket', function () {
        $('.top-cart-content-wrapper').show();
        $('.top-cart-content').show();
        // clear all temp-img
        $('.temp-img').empty();
        $('.temp-img').removeAttr("style");
        var addedItem = '';
        $('.busket').show();
        $('#buybtn').show(2000);
        var id = '#p-' + $(this).attr('id'); // i.e: #p-img1
        var ID = 'p-' + $(this).attr('id');
        var p_img = $(id).clone();
        var temp_img = '#temp-' + ID;
        $(temp_img).append(p_img);
        var PID = ID.replace("p-img", "");
        // if already added then increase quantity by one
        var selected = $('#addeditem' + PID).length;

        if (selected) {
            $('.temp-img').hide();
            var q = $('#q' + PID).val();
            q++;
            $('#addedq' + PID).attr('value', q);
            $('#q' + PID).attr('value', q);
            $('#amount' + PID).html($('#price-' + PID).text() * q + 'TK');
            show_price();
            return false;
        }
        var qid = '#q' + PID;
        var initialQuantity = $(qid).attr('value');
        // show check mark for added item
        $('#added' + PID).show();

// End pass selected product_id to 'buy' button modal data
        // busket position
        var y1 = $('.busket').offset().top;
        var y2 = $(id).offset().top;
        var x1 = $('.busket').offset().left;
        var x2 = $(id).offset().left;
        var y = y1 - y2;//- $(id).height() / 2;
        var x = x1 - x2;//- $(id).width() / 2;
        //  console.log(temp_img);
        move(temp_img)
                .ease('in-out')
                .to(x, y)
                .duration('1s')
                .end(function () {

                    addedItem = '<div class="addeditem" id="addeditem' + PID + '"><a href="javascript:void(0)">' +
                            '<img src="' +
                            $(id).attr('src') +
                            '" title="'+
                            $('#p-info' + PID).text()+
                            '" '+
                            '" width="' + '37" height="' + '34"></a>' +
                            '<div class="product-quantity">' +
                            '<input  type="text" value="' + initialQuantity + '" min="1" id="addedq' + PID + '"  class="form-control quantity-input input-sm">' +
                            '</div>' +
                            '<em id="amount' + PID + '">' + $('#price-' + PID).text() * initialQuantity + 'TK' +
                            '</em>' +
                            '<span class="del-goods remove-item" id="' + PID + '"></span>' +
                            '</div>'+
                            '<div class="clr">'+
                            '</div>';
                            

                    $(".busket").append(addedItem);
                    // the following js work on .product-quantity. Hence it is created dynamically it should be done by again calling the following codes
                    $(".product-quantity .form-control").TouchSpin({
                        buttondown_class: "btn quantity-down",
                        buttonup_class: "btn quantity-up"
                    });
                    $(".quantity-down").html("<i class='fa fa-angle-down'></i>");
                    $(".quantity-up").html("<i class='fa fa-angle-up'></i>");
                    // update quantity
                    $('.quantity-down,.quantity-up').click(function () {

                        // Get the spinner input jquery object

                        var $input = $(this).parent().siblings(".quantity-input");
                        // Get attribute values
                        var id = $input.attr('id');

                        var valueNow = $input.attr('value');
                        var newID;
                        if (id.indexOf("added") >= 0) {
                            newID = id.replace("added", "");
                        }
                        else {
                            newID = id.replace("q", "addedq");
                        }
                        newID = '#' + newID;
                        $(newID).attr('value', valueNow);

                        // $(newID).attr('value', valueNow);
                        show_price();
                    });

                    $('.quantity-input').change(function () {
                        var id = $(this).attr('id');
                        var valueNow = $(this).attr('value');
                        var newID;
                        if (id.indexOf("added") >= 0) {
                            newID = id.replace("added", "");
                        }
                        else {
                            newID = id.replace("q", "addedq");
                        }
                        newID = '#' + newID;
                        $(newID).attr('value', valueNow);
                        var PID = $(this).attr('id').match(/(\d+)/)[1];
                        $('#amount' + PID).html($('#price-' + PID).text() * valueNow + 'TK');
                        show_price();

                    });
                    // End-update quantity
                    $(temp_img).hide();
                    //  alert(temp_img);

                    // #####################  Remove from busket ############################## 
                    $('.remove-item').click(function () {

                        var id = $(this).attr('id');
                        
                        var itemToRemove = '#addeditem' + id;
                        $(itemToRemove).remove();
                        show_price();

                        $('#temp-p-img' + id).show();
                        $('.temp-img').empty();
                        check_empty();

                    });
                    // ##################### End- Remove from busket ############################## 
                    // service charge change 
                    show_price();
                    check_empty();
                });
    });
// ###################### End- add to busket ##############################



});