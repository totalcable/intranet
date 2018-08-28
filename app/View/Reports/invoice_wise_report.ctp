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
                <?php
                foreach ($packagecustomers as $single):
                    $pcaddress = $single['pc'];

                    $customer_address_one = $pcaddress['house_no'] . ' ' . $pcaddress['street'] . ' ' .
                            $pcaddress['apartment'];
                    
                   $customer_address_two = $pcaddress['city'] . ' ' . $pcaddress['state'] . ' '
                            . $pcaddress['zip'];
                    ?>                
                    <div style="page-break-before:always" >&nbsp;</div> 
                    <div class="row">
                        <div class="col-xs-4">                              
                            <ul class="list-unstyled" style=" text-align: left; color: #555; margin-left: 1px;">
                                <img style="margin-top: 31px;"src="<?php echo $this->webroot; ?>assets/frontend/layout/img/totalcable.jpg">                                                  
                                <div style="margin-left: 17px;">P.O BOX 170,E.MEADOM, NY 11554</div>
                            </ul>
                        </div>
                        <div class="col-xs-3">                               
                            <ul class="list-unstyled">                                   
                            </ul>
                        </div>
                        <div class="col-xs-5 invoice-payment">                             
<!--                            <ul class="list-unstyled" style=" text-align: right; color: #555; margin-right: 10px;">
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
                            </ul>-->
                        </div>
                    </div>                  
                    <hr style="display: block; border-style: inset; border-color:  darkmagenta;">
                    <div class="row invoice-logo">
                        <div class="row" style="margin-top: 0;">                          
                            <div class="col-xs-7">                              
                                                                   
                                    <!--                                    <li style="color: #555; border-left: #990000 7px  solid;">
                                    
                                                                            &nbsp; INVOICE TO:   
                                                                            &nbsp; Address : <i></b></i>
                                    
                                                                        </li>-->
                                    <table style=" margin-left: 105px; border: #555 solid 1px; min-width: 275px;">
                                        <th style=" border: #555 solid 1px; padding-left: 2px;">
                                            <b style=" color: #000;">Bill To</b>
                                        </th>
                                        <tr>
                                            <td style="padding-left: 5px; min-height: 115px; line-height: 15px;">
                                                <?php echo $single['0']['name']; ?><br>
                                                <?php echo $customer_address_one; ?><br>
                                                <?php echo $customer_address_two; ?>

                                            </td>
                                        </tr>
                                    </table>                               
                            </div>                            
                            <div class="col-xs-5 invoice-payment">                             
                                <ul class="list-unstyled" style=" text-align: right; color: #000; margin-right: 17px;">
                                    <li>
                                        <h1 style=" color: #000 !important;">Invoice #<?php echo getInvoiceNumbe($single['tr']['id']); ?></h1>
                                    </li>
                                    <li style="color: #555;">
                                        <b style=" color: #000;">Date of Invoice: </b><?php echo date('Y-m-d'); ?>
                                    </li>
                                    <li style="color: #555;">
                                       <b style=" color: #000;">Terms:</b> Net 7 Days
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
                    <div class="row"style=" margin-top: 9px;">
                        <div class="col-xs-12 ">
                            <table class="table table-striped table-hover margin-top-20" style=" margin-top: 60px; border:  #555 solid 1px;">
                                <thead  style="border-bottom: #555 solid 3px;">
                                    <tr style="height: 101px; border:  #555 solid 1px;">
                                        <th class="hidden-480" style=" padding-bottom: 39px; text-align: center; color: #000 !important; color: white; width: 51px;font-size: 19px; font-weight: bold;">
                                            #
                                        </th>                                    
                                        <th class="hidden-480" style=" color: #333 !important; padding: 0px 0px 39px 19px;">
                                            DESCRIPTION
                                        </th>
                                        <th class="hidden-480"  style=" color: #333 !important; text-align: center; padding-bottom: 39px;">
                                            STB QUANTITY
                                        </th>
                                        <th class="hidden-480" style=" color: #333 !important; padding-bottom: 39px; text-align: center;">
                                            PRICE
                                        </th>
                                        <th class="hidden-480" style=" color: #333 !important; text-align: center; padding-bottom: 39px;">
                                            SUBSCRIPION
                                        </th>
                                        <th class="hidden-480"  style=" padding-bottom: 39px; text-align: center; font-size: 15px;  color: #000 !important; width: 101px;">
                                            TOTAL
                                        </th>                                      
                                    </tr>
                                </thead>
                                <tbody>                                   
                                    <tr style="height: 101px;">
                                        <td  style=" padding: 39px; text-align: center; font-size: 19px; font-weight: bold; color: #000 !important; width: 101px;">
                                            <?php echo getInvoiceNumbe($single['tr']['id']); ?>
                                        </td>
                                        <td style=" color: #333 !important; padding: 43px 0px 0px 19px ;">
                                            <b style="color: #333 !important;"><?php echo $single['ps']['name']; ?></b><br>    
                                            <?php echo $single['p']['name']; ?>
                                        </td> 
                                        <td style=" color: #333 !important; text-align: center;  padding: 43px 0px 0px 9px ;">
                                            <?php echo $single['pc']['mac']; ?>
                                        </td>
                                        <td style=" color: #333 !important; padding: 43px 0px 0px 9px; text-align: center;">
                                            $ <?php echo $single['ps']['amount']; ?>.00
                                        </td>

                                        <td style=" color: #333 !important; text-align: center; padding: 43px 0px 0px 9px ;">
                                            <?php echo $single['ps']['duration']; ?>
                                        </td>
                                        <td  style=" padding: 43px 0px 0px 9px ; text-align: center; font-size: 19px; font-weight: bold; color: #000 !important; width: 151px;">
                                            $<?php echo $single['ps']['amount']; ?>.00 USD
                                        </td>                                          
                                    </tr>
                                </tbody>
                            </table>
                            <br>
                            <div class="row " style=" margin-top: 44px;">
                                <div class="col-xs-3">                    
                                </div>
                                <div class="col-xs-3">
                                </div>
                                <div class="col-xs-6 invoice-payment">
                                    <div class="col-xs-6">  
                                        <b style=" color: #000;">Total Of New Charges</b>
                                    </div>
                                    <div class="col-xs-6" style="text-align: right;">
                                        $<?php echo $single['ps']['amount']; ?>.00 USD      
                                    </div>
                                    <hr style="border-color: #990000 !important; ">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-3">                    
                                </div>
                                <div class="col-xs-3">
                                </div>
                                <div class="col-xs-6 invoice-payment">
                                    <div class="col-xs-6">  
                                        <b style=" color: #000;">TOTAL Amount Due</b>
                                    </div>
                                    <div class="col-xs-6" style="text-align: right;">
                                        $<?php // echo $single['ps']['amount']; ?>.00 USD      
                                    </div>
                                    <hr style="border-color: #990000 !important; ">
                                </div>
                            </div>
                        </div>
                    </div>
                    
                     <div class="row" style="margin-top: 141px;">
                        <div class="col-xs-4">                              
                            <h6>Please write <b style="font-weight: normal !important; color:red !important;">INVOICE NUMBER</b> on check</h6>
                        </div>
                        <div class="col-xs-4">                               
                           
                        </div>
                       
                         <div class="col-xs-4">                             
                             <h6>Make check payable to <b style="font-weight: normal !important; color:red !important;">TOTAL CABLE BD</b></h6>
                        </div>
                    </div> 
                   
                    
                    <div class="row" style="background-color:  yellowgreen !important; border-top:  red solid 1px;">
                        <div class="col-xs-4" style="text-align: center;">                              
                            <h5 style=" color: white !important;"> e-mail: info@totalcablebd.com</h5>
                        </div>
                        <div class="col-xs-4">                               
                           
                        </div>
                        <div class="col-xs-4" style="text-align: center;">                             
                            <h5 style=" color: white !important;">Web: totalcablebd.com</h5>
                        </div>
                    </div>                
                <?php endforeach; ?>  
            </div>
        </div>          
    </div> 
</div>
<!-- END CONTENT -->



