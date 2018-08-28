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
                             <div style="margin-left: 17px;">P.O BOX 170,E.MEADOM, NY 11554</div>
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
                <hr style="display: block; border-style: inset; border-color:  white; ">
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
                                    <h1 style=" color: #990000 !important;">Invoice-2</h1>
                                </li>
                                <li style="color: #555;">
                                    Date of Invoice: <?php echo date('Y-m-d'); ?>
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
                                        Expire Date
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
                                <?php foreach ($packagecustomers as $single):
//     pr($single);     exit();
                                    ?>
                                    <tr>
                                        <td  style=" text-align: center; background-color:#990000; font-size: 19px; font-weight: bold; color: white; width: 101px;">
                                            <?php echo $single['tr']['invoice_no']; ?>
                                        </td>
                                        <td style="background-color:whitesmoke">
                                            <?php echo $single['0']['name']; ?>
                                        </td>
                                        <td style="background-color:whitesmoke">
                                            <?php echo $single['pc']['exp_date']; ?>
                                        </td>
                                        <td style="background-color:whitesmoke">
                                            <b><?php echo $single['ps']['name']; ?></b><br>
                                            $ <?php echo $single['ps']['amount']; ?>.00
                                        </td> 
                                        <td style="background-color: silver; text-align: center;">
                                            <?php echo count(json_decode($single['pc']['mac'])); ?> 
                                        </td>
                                        <td style="background-color: silver">
                                            $ <?php echo $single['ps']['amount']; ?>.00
                                        </td>

                                        <td style="background-color:whitesmoke; text-align: center;">
                                            <?php echo $single['ps']['duration']; ?>
                                        </td>
                                        <td  style=" text-align: center; background-color: #990000; font-size: 19px; font-weight: bold; color: white; width: 151px;">
                                            $<?php echo $single['ps']['amount']; ?>.00 USD
                                        </td>
                                        <td>
                                            <div class="controls center text-center">
                                                <a   target="_blank" title="Add to pdf" href="<?php echo Router::url(array('controller' => 'reports', 'action' => 'invoice', $single['pc']['id'])) ?>" class="btn default btn-xs green-stripe">
                                                    Invoice </a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>                           
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="controls center text-center">
        <a   target="_blank" title="Add to pdf" href="<?php echo Router::url(array('controller' => 'reports', 'action' => 'printedInvoice')) ?>" class="btn default btn-xs green-stripe">
           Generate Invoice </a>
    </div>
</div>
<!-- END CONTENT -->



