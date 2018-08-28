</div><!-- End #wrapper -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="../../webroot/assets/global/plugins/respond.min.js"></script>
<script src="../../webroot/assets/global/plugins/excanvas.min.js"></script> 
<![endif]-->

<!--[if lt IE 9]>
 <script src="../../webroot/assets/global/plugins/respond.min.js"></script>  
 <![endif]--> 

<?php
echo $this->Html->script(
        array(
            'https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js',
            '/assets/global/plugins/jquery.min',
            '/assets/global/plugins/jquery-migrate.min',
            '/assets/global/plugins/jquery-ui/jquery-ui-1.10.3.custom.min',
            '/assets/global/plugins/bootstrap/js/bootstrap.min',
            '/assets/frontend/layout/scripts/back-to-top',
            '/assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min',
            '/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min',
            '/assets/global/plugins/jquery.blockui.min',
            '/assets/global/plugins/jquery.cokie.min',
            '/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min',
        //END CORE PLUGINS 
        )
);
?>

<!-- Start shope-list.html -->
<?php
echo $this->Html->script(
        array(
            '/assets/global/plugins/fancybox/source/jquery.fancybox.pack',
            '/assets/global/plugins/carousel-owl-carousel/owl-carousel/owl.carousel.min',
            '/assets/global/plugins/zoom/jquery.zoom.min',
            '/assets/global/plugins/bootstrap-touchspin/bootstrap.touchspin',
            '/assets/global/plugins/uniform/jquery.uniform.min',
            '/assets/global/plugins/rateit/src/jquery.rateit',
            'http://code.jquery.com/ui/1.10.3/jquery-ui.js',
            '/assets/frontend/layout/scripts/layout'
        )
);
?>
<!--END shope-list.html-->
<!-- Start form_validation.html -->
<?php
echo $this->Html->script(
        array(
            '/assets/global/plugins/jquery-validation/js/jquery.validate.min',
            '/assets/global/plugins/backstretch/jquery.backstretch.min',
            '/assets/global/plugins/jquery-validation/js/additional-methods.min',
            '/assets/global/plugins/select2/select2.min',
            '/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker',
            '/assets/global/plugins/bootstrap-wysihtml5/wysihtml5-0.3.0',
            '/assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5',
            '/assets/global/plugins/ckeditor/ckeditor',
            '/assets/global/plugins/bootstrap-markdown/js/bootstrap-markdown',
            '/assets/global/plugins/bootstrap-markdown/lib/markdown',
        )
);
?>
<!--END form_validation.html-->

<!--(components_pickers.html) BEGIN PAGE LEVEL PLUGINS -->
<?php
echo $this->Html->script(
        array(
            '/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker',
            '/assets/global/plugins/bootstrap-timepicker/js/bootstrap-timepicker.min',
            '/assets/global/plugins/clockface/js/clockface',
            '/assets/global/plugins/bootstrap-daterangepicker/moment.min',
            '/assets/global/plugins/bootstrap-daterangepicker/daterangepicker',
            '/assets/global/plugins/bootstrap-colorpicker/js/bootstrap-colorpicker',
            '/assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min',
        )
);
?>

<!-- (components_pickers.html)END PAGE LEVEL PLUGINS -->



<!--Start table_editable.html-->
<?php
echo $this->Html->script(
        array(
            '/assets/global/plugins/datatables/media/js/jquery.dataTables.min',
            
        )
);
?>
<!--END table_editable.html-->

<!--Start table_advanced.html-->
<?php
echo $this->Html->script(
        array(
            '/assets/global/plugins/datatables/extensions/TableTools/js/dataTables.tableTools.min',
            '/assets/global/plugins/datatables/extensions/ColReorder/js/dataTables.colReorder.min',
            '/assets/global/plugins/datatables/extensions/Scroller/js/dataTables.scroller.min',
            '/assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap',
        )
);
?>
<!--END table_advanced.html-->


<!--Start extra_profile.html-->
<?php
echo $this->Html->script(
        array(
            '/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput',
            '/assets/global/plugins/jquery.sparkline.min',
        )
);
?>
<!--END extra_profile.html-->

<!--Start Theme js-->
<?php
echo $this->Html->script(
        array(
            '/assets/global/scripts/metronic',
            '/assets/admin/layout/scripts/layout',
            '/assets/admin/layout/scripts/quick-sidebar',
            '/assets/admin/layout/scripts/demo',
            '/assets/admin/pages/scripts/login-soft',
            '/assets/admin/pages/scripts/profile',
            '/assets/admin/pages/scripts/components-pickers',
            '/assets/admin/pages/scripts/table-editable',
            '/assets/admin/pages/scripts/table-advanced',
            '/assets/admin/pages/scripts/form-validation',
            'my_form_validation',
        )
);
?>
<!--END Theme js-->




<script>
    jQuery(document).ready(function () {     
        Metronic.init(); // init metronic core components
        AdminLayout.init();
        QuickSidebar.init(); // init quick sidebar
        Login.init();
        Profile.init();
        Demo.init(); // init demo features
        FormValidation.init();
        TableEditable.init();
        TableAdvanced.init();
        ComponentsPickers.init();
        // frontend 
        Layout.init();
        Layout.initOWL();
        Layout.initTwitter();
        Layout.initImageZoom();
        Layout.initTouchspin();
        Layout.initUniform();
        Layout.initSliderRange();

    });
</script>


<!--Common MY js-->
<?php
echo $this->Html->script(
        array(
            'modalForm',
            'normalForm',
            'tree',
            'multipleImgUpload',
            'singleImgUpload',
        )
);
?>
<!--End Common MY js-->

<script type="text/javascript">

// Update winner from reseller

(function updateWinner() {
    $.ajax({
        // var url = 'loadbookWriter';
        url: $("#webroot").text()  + 'resellers/ajaxLoadMonthlyWinner',
        success: function (data) {
            $('#winner').empty();
            $('#winner').append(data);
           console.log(data);

        },
        complete: function () {
            // Schedule the next request when the current one's complete
            setTimeout(updateWinner, 50000);
        }
    });
})();


// END winner from reseller
</script>


