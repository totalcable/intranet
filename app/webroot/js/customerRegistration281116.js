/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function initialization() {
    if ($('#shipment').is(":checked")) {
        $('#shipmentshow_hide').show();
    }
    else {
        $('#shipmentshow_hide').hide();
    }

    if (selected.trim() == "moving") {

        $('#shipmentshow_hide').show();
    }
    else {
        $('#shipmentshow_hide').hide();
    }

    if ($('#additioninfo').is(":checked")) {
        $('#Additional_info').show();
    }
    else {
        $('#Additional_info').hide();
    }
    if ($('#dealer').is(":checked")) {
        $('#dshow').show();
    }
    else {
        $('#dshow').hide();
    }
}

$(document).ready(function () {
    if ($('#status').length) {
        var selected = $('#status').val().trim();
        selected = selected.substr(0, 1).toUpperCase() + selected.substr(1) + ' Date: ';
        $('.status-date').text(selected);
    }

//       alert(selected);
    $('#shipment_equipment_list').change(function () {
        var selected_equipment = $(this).val();
        if (selected_equipment == 'OTHER') {
            $('#other_shipment_equipment').show();
        }
        else {
            $('#other_shipment_equipment').hide();
        }
    });

    $("#status").change(function () {
        var selected = $(this).val().trim();
        selected = selected.substr(0, 1).toUpperCase() + selected.substr(1) + ' Date';
        $('.status-date').text(selected);
    });



    //  Reward add strat
    
 

    $('.packageChange').change(function () {
        var selected = $('.packageChange option:selected').text().toLowerCase();
        if (selected.trim() == "6 month package $180") {
            $('#reward6').show();
            $('#reward12').hide();
        }
        else if (selected.trim() == "1 year package $360") {
            $('#reward6').hide();
            $('#reward12').show();
        }
        else {
            $('#reward6').hide();
            $('#reward12').hide();
        }
    });
    
    //   Reward add end



    initialization();
});