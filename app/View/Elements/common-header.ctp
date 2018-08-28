<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->
    <head>
        <meta charset="utf-8"/>
        <meta name="google-site-verification" content="EehELcEVuQwNUOU8twYjFX9vmrosW3pMCpc7NNOeA00" />
        <title>Intra Net</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
        <meta http-equiv="Content-type" content="text/html; charset=utf-8">
        <link rel="shortcut icon" href="<?php echo $this->webroot; ?>images/icon-headset-blue.ico">

        <?php
        echo $this->Html->css(
        array(
        //BEGIN GLOBAL MANDATORY STYLES
        'http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all',
        'http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700|PT+Sans+Narrow|Source+Sans+Pro:200,300,400,600,700,900&amp;subset=all"',
        '/assets/global/plugins/font-awesome/css/font-awesome.min',
        '/assets/global/plugins/simple-line-icons/simple-line-icons.min',
        '/assets/global/plugins/bootstrap/css/bootstrap.min',
        '/assets/global/plugins/uniform/css/uniform.default',
        '/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min',
        //END GLOBAL MANDATORY STYLES
        // Start shope-product-list.html
        '/assets/global/plugins/fancybox/source/jquery.fancybox',
        '/assets/global/plugins/carousel-owl-carousel/owl-carousel/owl.carousel',
        'http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css',
        '/assets/global/plugins/rateit/src/rateit',
        // End Shope-product-list.html
        
        // Start components_pickers.html
        '/assets/global/plugins/clockface/css/clockface',
        '/assets/global/plugins/bootstrap-datepicker/css/datepicker3',
        '/assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min',
        '/assets/global/plugins/bootstrap-colorpicker/css/colorpicker',
        '/assets/global/plugins/bootstrap-daterangepicker/daterangepicker-bs3',
        '/assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min',
        // End components_pickers.html
        // 
        // Start form_validation.html
        '/assets/global/plugins/select2/select2',
        '/assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5',
        '/assets/global/plugins/bootstrap-markdown/css/bootstrap-markdown.min',
        '/assets/global/plugins/bootstrap-datepicker/css/datepicker',
        // End form_validation.html
        // table_advanced.html
        '/assets/global/plugins/datatables/extensions/Scroller/css/dataTables.scroller.min',
        '/assets/global/plugins/datatables/extensions/ColReorder/css/dataTables.colReorder.min',
        '/assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap',
        //END- table_advanced.html
        // login_soft
        '/assets/admin/pages/css/login-soft',
        // login_soft
        // extra_profile
        '/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput',
        '/assets/admin/pages/css/profile',
        '/assets/admin/pages/css/tasks',
        // END extra_profile
        // BEGIN THEME GLOBAL STYLES 
        '/assets/admin/layout/css/themes/darkblue',
        '/assets/global/css/components',
        '/assets/global/css/plugins',
        //END THEME GLOBAL STYLES

            // datepicker
            '/JqueryDatepicker/jquery-ui',
            // datepicker
        // common custom css
         'custom',
         'chat',
            
          //shipment picture file show pop up Start
        
        '/assets/admin/pages/css/portfolio',
        '/assets/admin/layout/css/layout',
        '/assets/admin/layout/css/custom',
        //shipment picture file show pop up End
            
        )
        );

        ?>

    <p class="hide" id="webroot"><?php echo $this->webroot; ?></p>

