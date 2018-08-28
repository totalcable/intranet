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
                        <ul class="list-unstyled" style=" text-align: left; color: #555; margin-left: 1px;">
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
                <hr style="display: block; border-style: inset; border-color:  darkmagenta;">
                <div class="row invoice-logo">
                    <div class="row" >                          
                        <div class="col-xs-5">                              
                            <ul class="list-unstyled" style="text-align: left; padding: 45px 0px 0px 13px;">                                    
                                <li style="color: #555; border-left: #990000 7px  solid;">
                                    <?php
//                                    pr($transactions); exit;
                                    foreach ($transactions as $single):
                                        $pcaddress = $single['pc'];
                                        $customer_address = $pcaddress['house_no'] . ' ' . $pcaddress['street'] . ' ' .
                                                $pcaddress['apartment'] . ' ' . $pcaddress['city'] . ' ' . $pcaddress['state'] . ' '
                                                . $pcaddress['zip'];
                                        ?>
                                        &nbsp; INVOICE TO:   <b><?php echo $single['0']['name']; ?></b><br>
                                        &nbsp; Address : <i><b><?php echo $customer_address; ?></b></i>
                                        <?php
                                    endforeach
                                    ?>
                                </li>
                            </ul>
                        </div>
                        <div class="col-xs-2">                               
                            <ul class="list-unstyled">                                   
                            </ul>
                        </div>
                        <div class="col-xs-5 invoice-payment">                             
                            <ul class="list-unstyled" style=" text-align: right; color: #555; margin-right: 17px;">
                                <li>
                                    <h1 style=" color: #990000 !important;">INVOICE Inv #<?php echo getInvoiceNumbe($single['tr']['id']); ?></h1>
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
                            <thead style="border-bottom: 10px solid whitesmoke;">
                                <tr style="height: 101px;">
                                    <th class="hidden-480" style=" padding-bottom: 39px; text-align: center; color: white !important; background-color: #990000 !important; color: white; width: 51px;font-size: 19px; font-weight: bold;">
                                        #
                                    </th>                                    
                                    <th class="hidden-480" style="background-color:whitesmoke !important; color: #333 !important; padding: 0px 0px 39px 19px;">
                                        DESCRIPTION
                                    </th>
                                    <th class="hidden-480"  style="background-color: #ccc !important; color: #333 !important; text-align: center; padding-bottom: 39px;">
                                        STB QUANTITY
                                    </th>
                                    <th class="hidden-480" style="background-color: #ccc !important; color: #333 !important; padding-bottom: 39px; text-align: center;">
                                        PRICE
                                    </th>
                                    <th class="hidden-480" style="background-color:whitesmoke !important; color: #333 !important; text-align: center; padding-bottom: 39px;">
                                        SUBSCRIPION
                                    </th>
                                    <th class="hidden-480"  style=" padding-bottom: 39px; text-align: center; background-color: #990000 !important; font-size: 15px;  color: whitesmoke !important; width: 101px;">
                                        TOTAL
                                    </th>                                      
                                </tr>
                            </thead>
                            <tbody>                                    
                                <?php
                                foreach ($transactions as $single):
                                    ?>
                                    <tr style="height: 101px;">
                                        <td  style=" padding: 39px; text-align: center; background-color:#990000 !important; font-size: 19px; font-weight: bold; color: white !important; width: 101px;">
                                            <?php echo $single['tr']['id']; ?>
                                        </td>
                                        <td style="background-color:whitesmoke !important; color: #333 !important; padding: 43px 0px 0px 19px ;">
                                            <b style="color: #333 !important;"><?php echo $single['ps']['name']; ?></b><br>    
                                            <?php echo $single['p']['name']; ?>
                                        </td> 
                                        <td style="background-color: #ccc !important; color: #333 !important; text-align: center;  padding: 43px 0px 0px 9px ;">
                                            <?php echo $single['pc']['mac']; ?>
                                        </td>
                                        <td style="background-color: #ccc !important; color: #333 !important; padding: 43px 0px 0px 9px; text-align: center;">
                                            $ <?php echo $single['ps']['amount']; ?>.00
                                        </td>

                                        <td style="background-color:whitesmoke; color: #333 !important; text-align: center; padding: 43px 0px 0px 9px ;">
                                            <?php echo $single['ps']['duration']; ?>
                                        </td>
                                        <td  style=" padding: 43px 0px 0px 9px ; text-align: center; background-color: #990000 !important; font-size: 19px; font-weight: bold; color: white !important; width: 151px;">
                                            $<?php echo $single['ps']['amount']; ?>.00 USD
                                        </td>                                          
                                    </tr>
                                <?php endforeach; ?>                           
                            </tbody>
                        </table><br>
                        <div class="row" style=" margin-top: 49px;">
                            <div class="col-xs-3">                    
                            </div>
                            <div class="col-xs-4">
                            </div>
                            <div class="col-xs-5 invoice-payment">
                                <div class="col-xs-6"style="text-align: right;">  
                                    SUBTOTAL 
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
                            <div class="col-xs-4">
                            </div>
                            <div class="col-xs-5 invoice-payment">
                                <div class="col-xs-6"style="text-align: right;">  
                                    GRAND TOTAL 
                                </div>
                                <div class="col-xs-6" style="text-align: right;">
                                    $<?php echo $single['ps']['amount']; ?>.00 USD      
                                </div>
                                <hr style="border-color: #990000 !important; ">
                            </div>
                        </div>
                    </div>
                </div>

                <hr style="border-color: #ccc !important; margin-top: 175px;  border-width: 1px;">
                <div class="row">
                    <div class="col-md-12">                              
                        <ul class="list-unstyled" style=" text-align: left; color: #555; margin-left: 10px;">                           
                            <h5 style="display:inline;">নিরবিছিন্ন  সংযোগের  জন্য  প্রতি  মাসের ৮ তারিখের মধ্যে বিল পরিশোধ  করুন |</h5>  <h5 style="font-weight: bold; display:inline;">Follow us on Facebook:</h5><h5 style="display:inline;">Total Cable </h5></span>
                            <li style="color: #555;">
                                <h4 style="font-weight: bold; color: black !important; background:#990000"> tel:(212)444-8138,(646)395-9958,(718)569-7014 &nbsp; &bull; e-mail:info@totalcableusa.com &nbsp;&bull; web:totalcableusa.com</h4>
                            </li>
                        </ul>
                    </div>
                    <div class="col-xs-3">                               
                        <ul class="list-unstyled">                                   
                        </ul>
                    </div>
                    <div class="col-xs-3 invoice-payment">                             
                        <ul class="list-unstyled" style=" text-align: right; color: #555; margin-right: 10px;">                            
                        </ul>
                    </div>
                </div> 
            </div>           
        </div>          
    </div> 
</div>
<!-- END CONTENT -->



