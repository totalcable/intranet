$(document).ready(function () {
    $('.toggle').click(function () {
        var toggleElementID = $(this).data('id');
        $('#' + toggleElementID).toggle();
    });
    $("#autofillAddrCheck").change(function () {

        if (this.checked) {
//get the values of the filled fields
            var name = $("#first").val();
            var last = $("#last").val();
            var expyear = $("#year").val();
            var expmonth = $("#month").val();
            var zipcode = $("#zip").val();
            var addressdetails = ' ' + $("#street").val();
            addressdetails += ' ' + $("#apartment").val();
//            addressdetails += ' ' + $("#city").val();
//            addressdetails += ' ' + $("#state").val();

            var state = $("#state").val();
            var cvvcode = $("#cvvcode").val();
            var phone = $("#PackageCustomerCell").val();
            var fax = $("#fax").val();
            var email = $("#email").val();
            var city = $("#city").val();

            //set the in the feild
            $("#firstname").val(name);
            $("#lastname").val(last);
            $("#showyear").val(expyear);
            $("#showmonth").val(expmonth);
            $("#zip_code").val(zipcode);
            $("#TransactionAddress").val(addressdetails);
            $("#statename").val(state);
            $("#cvv_code").val(cvvcode);
            $("#phoneno").val(phone);
            $("#faxno").val(fax);
            $("#emailadd").val(email);
            $("#cityname").val(city);
            // then form will be automatically filled .. 

        }
        else {
            $('#firstname').val('');
            $("#lastname").val('');
            $("#zip_code").val('');
            $("#addressdetail").val('');
            $("#card_number").val('');
            $("#cvv_code").val('');
            $("#showyear").val('');
            $("#showmonth").val('');
            $("#statename").val('');
            $("#phoneno").val('');
            $("#faxno").val('');
            $("#emailadd").val('');
            $("#cityname").val('');

        }
    });

    $('.pmode').change(function () {
        var pmode = $(this).filter(':checked').val();
        if (pmode == 'card') {
            $("#option_card").show();
            $("#option_cash").hide();
            $("#option_check").hide();
            $("#option_moneyorder").hide();
            $("#option_onlinebill").hide();
            $("#option_paidinvoice").hide();
        }
        if (pmode == 'cash') {
            $("#option_card").hide();
            $("#option_cash").show();
            $("#option_check").hide();
            $("#option_onlinebill").hide();
            $("#option_moneyorder").hide();
            $("#option_paidinvoice").hide();
        }
        if (pmode == 'check') {
            $("#option_card").hide();
            $("#option_cash").hide();
            $("#option_check").show();
            $("#option_onlinebill").hide();
            $("#option_moneyorder").hide();
            $("#option_paidinvoice").hide();
        }

        if (pmode == 'money order') {
            $("#option_card").hide();
            $("#option_cash").hide();
            $("#option_check").hide();
            $("#option_moneyorder").show();
            $("#option_onlinebill").hide();
            $("#option_paidinvoice").hide();
        }
        if (pmode == 'online bill') {
            $("#option_card").hide();
            $("#option_cash").hide();
            $("#option_check").hide();
            $("#option_moneyorder").hide();
            $("#option_onlinebill").show();
            $("#option_paidinvoice").hide();
        }
        if (pmode == 'paid invoice') {
            $("#option_card").hide();
            $("#option_cash").hide();
            $("#option_check").hide();
            $("#option_moneyorder").hide();
            $("#option_onlinebill").hide();
            $("#option_paidinvoice").show();
        }

        console.log(pmode);
    });
    $('select[name=stb]').change(function () {
        var value = $(this).val();
        var htmlContent = "";
        for (var i = 0; i < value; i++) {
            htmlContent = htmlContent + "<div class='row'><div class='col-md-12'><div class='col-md-1 signupfont '>Mac no:</div><div class='col-md-2'><div class='input-list style-4 clearfix'><div><input name='data[PackageCustomer][mac][]' maxlength='220' type='text' id='PackageCustomerMac' class='required' ></div></div></div><div class='col-md-1 signupfont'>System:</div> <div class='col-md-2'><div class='input-list style-4 clearfix'><div><select name='data[PackageCustomer][system][]' class='span6 uniform nostyle select1 required' id='PackageCustomerNumberOfSTBs:s' ><option value=''>Select System</option><option value='CMS1'>CMS1</option><option value='CMS2'>CMS2</option><option value='CMS3'>CMS3</option><option value='PORTAL'>PORTAL</option><option value='PORTAL1'>PORTAL1</option></select></div></div></div>  </div></div>&nbsp;";
        }

        $("#addmac").html(htmlContent);

    });

    var due = $('.due-amount-2').text();
    $('.due-amount').text(due);

//    auto recurring strat
    var selected = $('.recurringChange option:selected').text().toLowerCase();
    if (selected.trim() == "yes") {
        $('#recurring').show();
    }

    $('.recurringChange').change(function () {
        var selected = $('.recurringChange option:selected').text().toLowerCase();
        if (selected.trim() == "yes") {
            $('#recurring').show();
        } else {
            $('#recurring').hide();
        }
    });
    //    auto recurring end
   
    
//    next recurring strat
     
    var selected = $('.nextrecurringChange option:selected').text().toLowerCase();
    if (selected.trim() == "yes") {
        $('#nextrecurring').show();
    }

    $('.nextrecurringChange').change(function () {
        var selected = $('.nextrecurringChange option:selected').text().toLowerCase();
        if (selected.trim() == "yes") {
            $('#nextrecurring').show();
        } else {
            $('#nextrecurring').hide();
        }
    });
    //    next recurring end

    //    Net price calculation strat

    $('#priceAmount').on('change', function () {
        var price = $('#priceAmount').val();
        $('#netPrice').val(price);
    });

    $('.minusAmount').on('change', function () {
        var net = $('#netPrice').val() - $(this).val();
        $('#netPrice').val(net);
    });

    //    Net price calculation end

    $('.openForm').click(function (e) {
        e.preventDefault();
        $('.hideForm').hide();
        var formId = '#' + $(this).data('form');
        $(formId).show();
        //alert(formId);
    });

    var valueContainer = $('.showthis').data('box');
    var totalBox = $('#' + valueContainer).text();
    $('.showthis').text(totalBox);

    //    auto adjusment strat

    $('.adjusmentChange').change(function () {
        var selected = $('.adjusmentChange option:selected').text().toLowerCase();
//        alert(selected);
        if (selected.trim() == "sd refund") {
            $('#referralbonus').hide();
            $('#attachment').show();
            $('#amount').show();
        }
        else if (selected.trim() == "referral bonus") {
            $('#referralbonus').show();
            $('#attachment').hide();
            $('#amount').show();
        }
        else {
            $('#attachment').hide();
            $('#referralbonus').hide();
            $('#amount').show();
        }
    });

    //    auto adjusment end

    $('#actionID').change(function () {
        var action = $(this).val();
        //alert(action);
        if (action == 'calllog') {
            $('.hide-rest').hide(100);
            $('#callog').show(1000);
        }
        else if (action == 'paymenthistory') {
            $('.hide-rest').hide(100);
            $('#date-range-pay-mode').show(1000);
        }
        else if (action == 'allinvoice' || action == 'allinvoice_print_preview' || action == 'openinvoice' || action == 'passedinvoice' || action == 'customersummary') {
            $('.hide-rest').hide(100);
        }
        else if (action == 'package'){
             $('.hide-rest').hide(100);
             $('#only-package').show(1000);
        }
        else if (action == 'customerbyloaction') {
            $('.hide-rest').hide(100);
            $('#only-date-range').hide(1000);
            $('#only-city').show(1000);
        }
        else {
            $('.hide-rest').hide(100);
            $('#only-date-range').show(1000);
        }
    });



    //    Search by location

    $('#actionforSearch').change(function () {
        var action = $(this).val();
        if (action == '4') {
            $('.hide-rest').hide(100);
            $('#only-city').show(1000);
        } else {
            $('.hide-rest').hide(100);
            $('#only-date-range').show(1000);
        }
    });


    $('#autoRecurringBtn').click(function (e) {
        //  e.preventDefault();
        $("#initialMsg").hide();
        $("#processing").show(1000);
        //  alert('wait..');
    });

    $('.card').click(function (e) {
        //  e.preventDefault();
        $("#initialMsg").hide();
        $("#processing").show(1000);
        //  alert('wait..');
    });

});