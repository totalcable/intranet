<style>
    .ui-datepicker-multi-3 {
        display: table-row-group !important;
    }
</style>

<style type="text/css">
    .alert {
        padding: 6px;
        margin-bottom: 5px;
        border: 1px solid transparent;
        border-radius: 4px;
        text-align: center;
    }
</style>
<div class=""></div>
<div class="page-content-wrapper">
    <div class="page-content">
        <!-- BEGIN PAGE CONTENT-->
        <div class="row">
            <div class="col-md-12">
                <div class="portlet box green">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-plus"></i>Close invoice
                        </div>
                        <div class="tools">
                            <a href="javascript:;" class="reload">
                            </a>
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <!-- BEGIN FORM-->
                        <?php
                        echo $this->Form->create('Package_customer', array(
                            'inputDefaults' => array(
                                'label' => false,
                                'div' => false
                            ),
                            'id' => 'form-validate',
                            'class' => 'form-horizontal',
                            'novalidate' => 'novalidate'
                                )
                        );
                        ?>
                        <div class="form-body">
                            <div class="alert alert-danger display-hide">
                                <button class="close" data-close="alert"></button>
                                You have some form errors. Please check below.
                            </div>
                            <?php echo $this->Session->flash(); ?>
                            <div class="form-group">                                
                                <label class="control-label col-md-3" for="required">Select date</label>
                                <div class="col-md-4">
                                    <?php
                                    echo $this->Form->input(
                                            'daterange', array(
                                        'id' => 'e1', /* e1 is past to current date, e2 is past to future date */
                                        'class' => 'span9 text'
                                            )
                                    );
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-5 col-md-4">
                                    <?php
                                    echo $this->Form->button(
                                            'Search', array('class' => 'btn btn-success', 'type' => 'submit')
                                    );
                                    ?>
                                </div>
                            </div>
                        </div>
                        <?php echo $this->Form->end(); ?>
                        <!-- END FORM-->
                    </div>
                    <!-- END VALIDATION STATES-->
                </div>                
            </div>
        </div>
        <!-- END PAGE CONTENT -->
        <?php if ($clicked): ?> 
            <div class="">
                <!-- BEGIN PAGE HEADER-->
                <div class="page-bar">
                    <ul class="page-breadcrumb">
                        <li>   </li>
                        <li>   </li>
                        <li>   </li>
                    </ul>
                    <script></script>
                    <div class="page-toolbar">
                        <div class="btn-group pull-right">
                            <a class="btn btn-lg blue hidden-print margin-bottom-5" target="_blank" onclick="printDiv('printableArea')">
                                Print <i class="fa fa-print"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- END PAGE HEADER-->
                <!-- BEGIN PAGE CONTENT-->
                <div  id="printableArea">               
                    <div class="row">
                        <div class="col-xs-4">                              
                            <ul class="list-unstyled" style=" text-align: left; color: #555; margin-left: 10px;">
                                <img style="margin-top: 41px;"src="<?php echo $this->webroot; ?>assets/frontend/layout/img/totalcable.jpg">                                                  
                            </ul>
                        </div>
                        <div class="col-xs-3">                               
                            <ul class="list-unstyled">                                   
                            </ul>
                        </div>
                        <div class="col-xs-5 invoice-payment">                             
                            <ul class="list-unstyled" style=" text-align: right; color: #555; margin-right: 10px;">
                                <li style="font-size: 17px; color: #555;">
                                    <h3>Total Cable USA</h3>
                                </li>
                                <li style="color: #555;">
                                    37-19 57th Street, Woodside, NY 11377
                                </li>
                                <li style="color: #555;">
                                    +1212-444-8138
                                <li style="color: dodgerblue !important;">
                                    info@totalcableusa.com
                                </li>
                            </ul>
                        </div>
                    </div>                  
                    <hr style="display: block; border-style: inset; border-color:  darkmagenta; ">
                    <div class="row invoice-logo">
                        <div class="row" >                          
                            <div class="col-xs-4">                              
                                <ul class="list-unstyled" style="text-align: left; padding: 45px;">                                    
                                    <li style="color: #555; border-left: #990000 7px  solid;">
                                        &nbsp; INVOICE TO: LIST 
                                    </li>
                                </ul>
                            </div>
                            <div class="col-xs-3">                               
                                <ul class="list-unstyled">                                   
                                </ul>
                            </div>
                            <div class="col-xs-5 invoice-payment">                             
                                <ul class="list-unstyled" style=" text-align: right; color: #555; margin-right: 17px;">
                                    <li>
                                        <h1 style=" color: #990000 !important;">INVOICE Inv-2</h1>
                                    </li>
                                    <li style="color: #555;">
                                        Date of Invoice: <?php echo date('m-d-Y'); ?>
                                         
                                    </li>

                                </ul>
                            </div>
                        </div>
                    </div>
                    <hr  style="border-color: white;">
                    <div class="row">
                        <div class="col-xs-6">                    
                        </div>
                        <div class="col-xs-4">
                        </div>
                        <div class="col-xs-2 invoice-payment">
                            <div style="text-align: left;">

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th class="hidden-480" style=" text-align: center; background-color:   #990000; color: white; width: 51px;font-size: 19px; font-weight: bold;">
                                            #
                                        </th>
                                        <th class="hidden-480" style="background-color:whitesmoke">
                                            Name
                                        </th>
                                        <th class="hidden-480" style="background-color:whitesmoke">
                                            DESCRIPTION
                                        </th>
                                        <th class="hidden-480"  style="background-color: silver; text-align: center;">
                                            STB QUANTITY
                                        </th>
                                        <th class="hidden-480" style="background-color: silver">
                                            PRICE
                                        </th>
                                        <th class="hidden-480" style="background-color: silver">
                                           Paid Amount
                                        </th>
                                        <th class="hidden-480" style="background-color:whitesmoke; text-align: center;">
                                            SUBSCRIPION
                                        </th>

                                        <th class="hidden-480"  style=" text-align: center; background-color: #990000; font-size: 16px; font-weight: bold; color: white; width: 101px;">
                                            TOTAL
                                        </th>
                                        <th class="hidden-480  center text-center">
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>                                    
                                    <?php
                                   
                                    foreach (
                                    
                                            
                                            $packagecustomers as $single):
                                        ?>
                                        <tr>
                                            <td  style=" text-align: center; background-color:#990000; font-size: 19px; font-weight: bold; color: white; width: 101px;">
                                                <?php
                                                echo getInvoiceNumbe($single['tr']['id']);
                                                ?>
                                            </td>
                                            <td style="background-color:whitesmoke">
                                                <?php echo $single['0']['name']; ?>
                                            </td>
                                            <td style="background-color:whitesmoke">
                                                <b><?php echo $single['ps']['name']; ?></b><br>
                                                <?php echo $single['p']['name']; ?>
                                            </td> 
                                            <td style="background-color: silver; text-align: center;">
                                                <?php echo count(json_decode($single['pc']['mac'])); ?> 
                                            </td>
                                             <td style="background-color: silver">
                                                $ <?php echo $single['ps']['amount']; ?>.00
                                            </td>
                                            <td style="background-color: silver">
                                                $ <?php echo $single['tr']['paid_amount']; ?>.00
                                            </td>
                                            <td style="background-color:whitesmoke; text-align: center;">
                                                <?php echo $single['ps']['duration']; ?>
                                            </td>
                                            <td  style=" text-align: center; background-color: #990000; font-size: 19px; font-weight: bold; color: white; width: 151px;">
                                                $<?php echo $single['ps']['amount']; ?>.00 USD
                                            </td>
                                            <td>
                                                <div class="controls center text-center">
                                                    <a   target="_blank" title="Add to pdf" href="<?php echo Router::url(array('controller' => 'reports', 'action' => 'invoice', $single['tr']['id'])) ?>" class="btn default btn-xs green-stripe">
                                                        Invoice </a>
                                                </div>
                                                <!--                                                <div class="controls center text-center">
                                                                                                    <a   target="_blank" title="Add to pdf" href="<?php echo Router::url(array('controller' => 'reports', 'action' => 'invoice', $single['tr']['id'])) ?>" class="btn default btn-xs green-stripe">
                                                                                                        Invoice </a>
                                                                                                </div>-->
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>                           
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
<!--                 <div class="controls center text-center">
        <a   target="_blank" title="Add to pdf" href="<?php // echo Router::url(array('controller' => 'reports', 'action' => 'all_invoice_close')) ?>" class="btn default btn-xs green-stripe">
           Generate Invoice </a>
    </div>-->
            </div>
        <?php endif; ?>

    </div>
    
</div> 


<!-- END CONTENT -->



