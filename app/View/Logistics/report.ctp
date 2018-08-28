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
    ul.pagination {
        display: flex;
        justify-content: center;
        color: blue;
    }
</style>
<br><br><br>
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
    <div class="col-xs-4"></div>
    <div class="col-xs-8 invoice-payment"> 
        <div style="background-color: whitesmoke; height: auto; width:806px;"><br>
            <h1 style="text-align: center; ">Logistics Maintenance form</h1>
            <br><br><br>
            <ul class="list-unstyled" style=" text-align: right; color: #000; margin-right: 17px;">
                <table class="table table-striped table-hover margin-top-20" style=" margin-top: 60px">
                    <thead>
                        <tr style=" height: 101px;">
                            <th class="hidden-480" style="text-align: center; color: #333 !important; padding: 0px 0px 39px 19px;">
                                Product Name
                            </th>
                            <th class="hidden-480"  style=" color: #333 !important; text-align: center; padding-bottom: 39px;">
                                Requisition Date
                            </th>
                            <th class="hidden-480" style=" color: #333 !important; text-align: center; padding-bottom: 39px;">
                                Requisition By
                            </th>

                            <th class="hidden-480"  style=" padding-bottom: 39px; text-align: center; font-size: 15px;  color: #000 !important; width: 101px;">
                                Allocated time
                            </th>   
                            <th class="hidden-480"  style=" padding-bottom: 39px; text-align: center; font-size: 15px;  color: #000 !important; width: 101px;">
                                Approved By
                            </th>   
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($logistics as $single):
                            $logistic = $single['l'];
                            $logistic_p = $single['p'];
                            $user = $single['u'];
                            ?>
                            <tr style="height: 101px;text-align: center;">
                                <td><?php echo $logistic_p['name']; ?></td>
                                <td><?php echo $logistic['requisition_date']; ?></td>
                                <td><?php echo $logistic['requisition_by']; ?></td> 
                                <td> 
                                    <?php echo $logistic['from_date'] . ' To<br> ' . $logistic['to_date']; ?><br>
                                </td>
                                <td><?php echo $logistic['approved_by']; ?></td>
                            </tr>
                            <?php
                        endforeach;
                        ?>
                    </tbody>
                </table>
            </ul>

        </div>                       
    </div>

    <div  id="printableArea"  style="display: none;">  
        <div style=" height:637px; width:825px;">            
            <!--<div style=" page-break-after: always"></div>-->         
            <div class="row invoice-logo">
                <div class="row">                          
                    <div class="col-xs-1">                             

                    </div>                            
                    <div class="col-xs-11 invoice-payment"> 
                        <div style="background-color: whitesmoke; height:637px; width:825px;"><br>
                            <h1 style="text-align: center !important;">Logistics Maintenance form</h1>
                            <br><br><br><br><br><br>
                            <?php
                            foreach ($logistics as $single):
                                $logistic = $single['l'];
                                $logistic_p = $single['p'];
                                $user = $single['u'];
                                ?>
                                <div class="row margin-bottom-30"> 
                                    <div class="col-xs-12">
                                        <b>Product details</b>: <?php echo $logistic_p['name']; ?>
                                    </div> 
                                </div> 

                                <div class="row margin-bottom-30">                                    
                                    <div class="col-xs-6">
                                        <b>Product Details</b>: <?php echo $logistic['requisition_date']; ?>
                                    </div>

                                    <div class="col-xs-6">                                    
                                        <b>Requisition By</b>: <?php echo $logistic['requisition_by']; ?>
                                    </div>                                   
                                </div>                               

                                <div class="row margin-bottom-30">
                                    <div class="col-xs-12">
                                        <b>Allocated time</b>: From: <?php echo $logistic['from_date'] . ' To ' . $logistic['to_date']; ?>
                                    </div>
                                </div>

                                <div class="row margin-bottom-30">
                                    <div class="col-xs-12">
                                        <b>Approved By</b>: <?php echo $logistic['approved_by']; ?>
                                    </div>
                                </div>

                                <div class="row margin-bottom-30">
                                    <div class="col-xs-4" style="text-align: center;">
                                        <hr style="border-top: dotted 1px !important; margin-bottom: 0px; padding-bottom: 0px !important;">
                                        <b style="margin-top: 0px; padding-top: 0px !important;">(Line Manager name & Date)</b>
                                    </div>
                                </div>

                                <div class="row margin-bottom-30">
                                    <div class="col-xs-6">
                                        <b>Received in (Type of condition)</b>: <?php echo $logistic['received_condition']; ?><br>
                                        <b>Date</b>: <?php echo $logistic['received_date']; ?>
                                    </div>
                                    <div class="col-xs-6">
                                        <b>Receiver of the product (Name)</b>: <?php echo $logistic['receiver_name']; ?><br>
                                        <b>Date</b>: <?php echo $logistic['product_receive_date']; ?>
                                    </div>
                                </div>

                                <div class="row margin-bottom-30">
                                    <div class="col-xs-12">
                                        <b>Product Hand over/Delivered(Type of condition)</b>: <?php echo $logistic['hand_over_condition']; ?><br>
                                        <b>Received by</b>: <?php echo $logistic['hand_over_by']; ?>
                                    </div>
                                </div>                            

                                <div class="row margin-bottom-30">
                                    <div class="col-xs-4" style="text-align: center;">
                                        <hr style="border-top: dotted 1px !important; margin-bottom: 0px; padding-bottom: 0px !important;">
                                        <b style="padding-top: 0px !important;">(Name of the receiver & Date)</b>
                                    </div>
                                </div>

                            </div> 
                            <?php
                        endforeach;
                        ?>
                    </div>                       
                </div>
            </div>
        </div>
    </div> 
</div>
</div>          




