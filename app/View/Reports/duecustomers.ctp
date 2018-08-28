
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

<div class="page-content-wrapper">
    <div class="page-content">              
        <div class="page-content-wrapper" style="margin: 0px; padding: 0px;">
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
                <div class="invoice" id="printableArea">
                    <div class="row invoice-logo">
                        <div class="col-xs-12 invoice-logo-space">
                            <!--<img src="../../assets/admin/pages/media/invoice/walmart.png" class="img-responsive" alt="">-->
                            <div class="row">
                                <div class="col-xs-12" style="text-align: center; margin-bottom: 41px;">
                                    <h4 class="page-title"  style="color: #353535; font-weight: bold;"><u>Due Customers</u></h4>
                                    <div>Total Cable USA</div>
                                    <div>P.O. BOX 770068,</div>
                                    <div>WOODSIDE, NY 11377</div>
                                </div>                        
                            </div>
                        </div>
                        <div class="col-xs-6">
                        </div>
                    </div>
                    <hr>
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
                                        <th class="hidden-480">
                                            Account no.
                                        </th>
                                        <th class="hidden-480">
                                            Name
                                        </th>
                                        <th class="hidden-480">
                                            Address
                                        </th>
                                        <th class="hidden-480">
                                            Mac
                                        </th>
                                        <th class="hidden-480">
                                            Cell
                                        </th>
                                        <th>
                                            Package
                                        </th>
                                        <th class="hidden-480">
                                            Due
                                        </th>
                                        <th class="hidden-480">
                                            Exp Date
                                        </th>
                                        <th class="hidden-480">
                                            Registration Date
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>                                    
                                    <?php
                                    foreach ($due_customers as $info):
                                        ?>
                                        <tr>
                                            <td><?php echo $info['PackageCustomer']['c_acc_no']; ?></td>
                                            <td> <a href="<?php echo Router::url(array('controller' => 'customers', 'action' => 'edit', $info['PackageCustomer']['id'])) ?>" target="_blank"><?php echo $info['PackageCustomer']['middle_name'] . " " . $info['PackageCustomer']['last_name']; ?></a> </td>
                                            <td><?php echo $info['Transaction']['address']; ?></td>
                                            <td><?php echo $info['PackageCustomer']['mac']; ?></td>
                                            <td><?php echo $info['PackageCustomer']['cell']; ?></td>
                                            <td>
                                                <?php
                                                if ($info['PackageCustomer']['custom_package_id'] == null) {
                                                    echo $info['PackageCustomer']['Psetting']['name'];
                                                } else {
                                                    echo $info['PackageCustomer']['CustomPackage']['duration'] . ' Months, Custom package ' . $info['PackageCustomer']['CustomPackage']['charge'] . '$';
                                                }
                                                ?>
                                            </td>
                                            <td><?php echo $info['Transaction']['due']; ?></td>
                                            <td><?php echo $info['Transaction']['exp_date']; ?></td>
                                            <td><?php echo $info['PackageCustomer']['created']; ?></td>                                                                                        
                                        </tr>
                                    <?php endforeach; ?>                           
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>                               
    </div>
</div>
<!-- END CONTENT -->



