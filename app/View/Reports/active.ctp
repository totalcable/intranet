<div class="page-content-wrapper">
    <div class="page-content">
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
                    <a id="btnclick" class="btn btn-lg blue hidden-print margin-bottom-5" target="_blank" onclick="printDiv('printableArea')">
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
                        <div class="col-xs-6">
                            <h3 class="page-title">
                                Active Customer List <small></small>
                            </h3>
                        </div>
                        <div class="col-xs-4">
                        </div>
                        <div class="col-xs-2 invoice-payment">
                            <div style="text-align: left;">
                                <div>   Total Cable USA</div>
                                <div>P.O. BOX 770068,</div>
                                <div>WOODSIDE,</div>
                                <div>NY 11377</div>
                                <div>
                                    <div style="left: 103.238px; top: 144.543px; font-size: 25px; font-family: sans-serif;">☎<small style="font-size: 12px;">&nbsp 1-212-444-8138</small></div>

                                </div>
                            </div>
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
                                <th>
                                    Account No
                                </th>
                                <th class="hidden-480">
                                    Name
                                </th>
                                <th class="hidden-480">
                                    Address
                                </th>
                                <th>
                                    Mac
                                </th>
                                <th class="hidden-480">
                                    Cell
                                </th>
                                <th>
                                    Package
                                </th>
                                <th class="hidden-480">
                                    Registration Date
                                </th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            foreach ($active_customers as $results):
                                ?>
                                <tr>
                                    <td>                          
                                        <?php echo $results['PackageCustomer']['c_acc_no']; ?>
                                    </td>
                                    <td>
                                        <a href="<?php echo Router::url(array('controller' => 'customers', 'action' => 'edit', $results['PackageCustomer']['id'])) ?>" target="_blank"><?php echo $results['PackageCustomer']['middle_name']. " " . $results['PackageCustomer']['last_name']; ?></a> 
                                    </td>
                                    <td class="hidden-480">
                                        <?php echo $results['PackageCustomer']['street'] .", ". $results['PackageCustomer']['apartment']; ?>                            
                                    </td>
                                    <td>
                                        <?php echo $results['PackageCustomer']['mac']; ?>
                                    </td>
                                    <td class="hidden-480">
                                        <?php echo $results['PackageCustomer']['cell']; ?>
                                    </td>
                                    <td class="hidden-480">
                                        <?php
                                        if($results['PackageCustomer']['custom_package_id'] == null){
                                          echo $results['Psetting']['name'];  
                                        }else{
                                          echo $results['CustomPackage']['duration']. ' Months, Custom package ' .$results['CustomPackage']['charge']. '$'; 
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php echo date_format( new DateTime($results['PackageCustomer']['created']) , 'm-d-Y' ); ?>
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
