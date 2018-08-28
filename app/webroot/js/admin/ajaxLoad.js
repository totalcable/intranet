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

                if (updateSection == '#eventRegChecking') {
                    $('#CustomerInput').val('');
                    if(!response.exist){
                       $('#eventRegForm').show();
                    }
                }

               
            });//({visibility: 'hidden'}, 2000, 'linear');//css("visibility", "hidden");

        });

        // Prevent default posting of form
//        event.preventDefault();
    });
}



function getWriterBookName(url, data) {
    $.ajax({
        type: 'POST',
        url: url,
        dataType: 'json',
        data: data, //'foo='+ bar+'&calibri='+ nolibri,
        success: function (msg) {

            $('#pname').val(msg.Product.name);
            $('#writerName').val(msg.Product.writer);

        }
    });
}
function getLevel(url, data) {
    $.ajax({
        type: 'POST',
        url: url,
        dataType: 'json',
        data: data, //'foo='+ bar+'&calibri='+ nolibri,
        success: function (msg) {
            console.log(msg);
            var value = '';
            var name = '';
            if (msg.length != 0) {
                value = msg.Level.option_id;
                name = msg.Level.name;
            }
            $("#format").select2("val", value);
            $('#lname').val(name);
        }
    });
}
function getUni(url, data) {
    $.ajax({
        type: 'POST',
        url: url,
        dataType: 'json',
        data: data, //'foo='+ bar+'&calibri='+ nolibri,
        success: function (msg) {
            console.log(msg);
            var op = '';
            var uniname = '';
            if (msg.length != 0) {
                op = msg.Option.id;
                uniname = msg.University.name;
            }
            $("#opFormat").select2("val", op);
            $('#uniName').val(uniname);
        }
    });
}
function getFsetting(url, data) {
    $.ajax({
        type: 'POST',
        url: url,
        dataType: 'json',
        data: data, //'foo='+ bar+'&calibri='+ nolibri,
        success: function (msg) {

            if (Object.keys(msg).length !== 0) {

                CKEDITOR.instances.fvalue.insertHtml(msg.Footer.fvalue);
            }
            else {
                CKEDITOR.instances.fvalue.setData('');
            }

        }
    });
}
function getResellerType(url, data) {
    $.ajax({
        type: 'POST',
        url: url,
        dataType: 'json',
        data: data, //'foo='+ bar+'&calibri='+ nolibri,
        success: function (msg) {
            if (msg.length != 0) {
                $('#ResellerTypePoint').val(msg.ResellerType.point);
                $('#ResellerTypeColor').val(msg.ResellerType.color);
                $('#ID').val(msg.ResellerType.id);
            }
            else {
                $('#ResellerTypePoint').val('');
                $('#ResellerTypeColor').val('');
                $('#ID').val('0');
            }
        }
    });
}
function getPointSetting(url, data) {
    $.ajax({
        type: 'POST',
        url: url,
        dataType: 'json',
        data: data, //'foo='+ bar+'&calibri='+ nolibri,
        success: function (msg) {
            if (msg.psetting.length != 0) {
                var discount = msg.psetting.Psetting.sppp * msg.psetting.Psetting.discount;
                discount = discount / 100;
                var sp = msg.psetting.Psetting.sppp - discount - msg.psetting.Psetting.service_charge;
                var bp = msg.psetting.Psetting.bppp;
                var profit = sp - bp;
                var html = '<span style="font-weight: strong; color: green;" class="col-md-3"> SELLING PRICE:' + sp + '</span>' +
                        '<span style="font-weight: strong; color: blue; " class="col-md-3"> BUYING PRICE:' + bp + '</span>' +
                        '<span style="font-weight: strong; color: red;" class="col-md-3">PROFIT: ' + profit + '</span>' +
                        '<span style="font-weight: strong; color: #666;" class="col-md-3"> DISCOUNT: ' + msg.psetting.Psetting.discount + '</span>';
                $('.warning_text').html(html);
            }
            else {
                $('.warning_text').html('<span style="font-weight: strong; color: red;" >Warning: Setting of this product is not complete. Please Do this first');
            }
            $('.warning_info').show();
            if (msg.point.length != 0) {
                $('#pid').val(msg.point.Point.id);
                $('#PointSold').val(msg.point.Point.sold);
                $('#PointFake').val(msg.point.Point.fake);
            }
            else {
                $('#pid').val(0);
                $('#PointSold').val('');
                $('#PointFake').val('');
            }
           // console.log(msg);

        }
    });
}

function getPesettings(url, data) {
    $.ajax({
        type: 'POST',
        url: url,
        dataType: 'json',
        data: data, //'foo='+ bar+'&calibri='+ nolibri,
        success: function (msg) {
            //  $('textarea#id_body').ckeditor().editor.insertHtml('<a href="#">text</a>');
            $('#bppp').val(msg.Psetting.bppp);
            $('#sppp').val(msg.Psetting.sppp);
            $('#sc').val(msg.Psetting.service_charge);
            $('#discount').val(msg.Psetting.discount);
            CKEDITOR.instances.desc.insertHtml(msg.Psetting.desc);
            CKEDITOR.instances.index.insertHtml(msg.Psetting.index);
            // Here-> CKEDITOR ->Your editor Name, 
            // desc -> Id of your textarea(to which u bind the ckeditor),
            //  msg.Psetting.desc->is the value that u want to bind
            var webroot = $("#webroot").text();
            var thum_Img = '<div class="col-md-4 img_prev" >' +
                    '<img style="height:240px; width: 240px;"  src="' +
                    webroot +
                    'productImages/thum/' +
                    msg.Psetting.thum_img +
                    '"/>' +
                    '</div>';

            console.log(thum_Img);
            $('#prev_image1').html(thum_Img);
            var small_Img = '<div class="col-md-4 img_prev" >' +
                    '<img style="height:80px; width: 80px;"  src="' +
                    webroot +
                    'productImages/small/' +
                    msg.Psetting.small_img +
                    '"/>' +
                    '</div>';
            $('#prev_image2').html(small_Img);
            console.log(msg);
        }
    });
}

// ############## get data by AJAX ######################
function getAnsInput(url, callback) {
    $.ajax({
        type: 'GET',
        url: url,
        success: function (data) {
            try {

                var option = '<label class="control-label col-md-1">' +
                        'Answer <span class="required">*</span>' +
                        '</label>';
                data = $.parseJSON(data);
                $.each(data, function (i, item) {
                    //  alert(i+'>'+item);
                    option += '<div class="col-md-2">' +
                            '<span>' + item + '</span> <input name="data[Question][ans][]" type="checkbox" id="inlineCheckbox1" value="' + i + '"  class="styled" /> <input name="data[Question][options][]" class="form-control required"  type="text">' +
                            '</div>';
                });

                $('#optionFormat').append(option);
                //console.log(option);

            } catch (e) {
                alert("Error trying to parse JSON. Is your server returning JSON? " + e.message);
            }

        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            //$('#login_error').show();
            alert("error :: " + textStatus + " : " + errorThrown);
        }
    });
}
// ############## End get data by AJAX ######################

$(document).ready(function () {
    // Edit product info

    $(".startLoading").on("change", function () {
        var url = 'loadbookWriter';
        var pid = $(this).val();
        var data = 'id=' + pid;// +'&calibri=' + 'nolibri';
        getWriterBookName(url, data);
    });
    // End edit product info
    // Edit product Setting

    $(".Loadingpsetting").on("change", function () {
        var url = 'loadpsetting';
        var pid = $(this).val();
        var data = 'id=' + pid;// +'&calibri=' + 'nolibri';
        getPesettings(url, data);
    });
    // End product Setting

    // Footer Setting Load value
    $('.fieldInput').on("keyup", function () {
        // alert($('#webroot').val());
        var url = 'loadfsetting';
        var field = $(this).val();
        var data = 'field=' + field;// +'&calibri=' + 'nolibri';
        getFsetting(url, data);
    });
    // END-Footer Setting Load value
    // Reseller type Setting Load value
    $('.reseller-badge').on("keyup", function () {
        // alert($('#webroot').val());
        var url = $('#webroot').text() + 'resellers/' + 'loadtypesetting';
        var name = $(this).val();
        var data = 'name=' + name;// +'&calibri=' + 'nolibri';
        getResellerType(url, data);
    });
    // END Reseller type Setting Load value
    // Point for different product's Setting 
    $('.product_id_input').on("change", function () {
        // alert($('#webroot').val());
        var url = $('#webroot').text() + 'resellers/' + 'loadpointsetting';
        var pid = $(this).val();
        var data = 'pid=' + pid;// +'&calibri=' + 'nolibri';
        getPointSetting(url, data);
    });
    // END-Point for different product's Setting

    // Edit level

    $('.level').on("change", function () {
        var url = 'loadLevel';
        var lid = $(this).val();
        var data = 'id=' + lid;// +'&calibri=' + 'nolibri';
        getLevel(url, data);
    });
    // End Edit level
    // Edit University/Board

    $('#uniList').on("change", function () {
        var url = 'loadUni';
        var uid = $(this).val();
        var data = 'id=' + uid;// +'&calibri=' + 'nolibri';
        getUni(url, data);
    });

    // End Edit level

    //####### get format info on change uni or board
    $('#uniBoard').change(function () {
        $('#optionFormat').empty();
        var id = $(this).val();
        var address = 'passOptionsFormat/' + id;
        getAnsInput(address);

    });

    //######### END get format info on change uni or board

        //    Check event registration
    $('#checkEventRegBtn').on('click', function (event) {
        alert('clicked');

        $('.alert').remove();
        $('#eventRegChecking .bubblingG').css({'display': ''});
        $('#eventRegChecking .bubblingG').css("visibility", "visible");
        var formid = '#eventRegChecking';
        var fields = "input, select, button, textarea";
        var processUrl = $('#webroot').text() + 'events/' + 'checkEventReg';
        saveData(formid, fields, processUrl, '#eventRegChecking');


    });
//    END event registration


});