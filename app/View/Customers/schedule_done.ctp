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
                                New Customer Informations <small></small>
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
                                <th class="hidden-480">
                                    Name
                                </th>
                                <th class="hidden-480">
                                    Address
                                </th>
                                <th class="hidden-480">
                                    Emergency Contact
                                </th>
                                <th class="hidden-480">
                                    Dead line
                                </th>
                                <th>
                                    Wear
                                </th>
<!--                                <th>
                                    Action
                                </th>-->
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($allData as $customer):
                                $customer = $customer['pc'];
                                ?>
                                <tr>
                                    <td>                                       
                                        <?php
                                        echo $customer['first_name'] . " " .
                                        $customer['middle_name'] . " " .
                                        $customer['last_name'];
                                        ?>

                                    </td>
                                    <td class="hidden-480">
                                        <ul>
                                            <li>Address:  <?php echo $customer['address']; ?> </li>
                                            <li>State:  <?php echo $customer['state']; ?> </li>
                                            <li>Apartment:  <?php echo $customer['apartment']; ?> </li>
                                            <li>City:  <?php echo $customer['city']; ?> </li>
                                            <li>Street:  <?php echo $customer['street']; ?> </li>
                                            <li>Zip:  <?php echo $customer['zip']; ?> </li>
                                        </ul>
                                    </td>
                                    <td class="hidden-480">  
                                        <?php if (!empty($customer['cell'])): ?> 
                                            Cell:    <?php echo $customer['cell']; ?>   
                                        <?php endif; ?>
                                        <br>
                                        <?php if (!empty($customer['home'])): ?>
                                            Home : <?php echo $customer['home']; ?>
                                        <?php endif ?>
                                    </td>
                                    <td>
                                        <?php echo $customer['from']; ?>- -
                                        <?php echo $customer['to']; ?> 
                                    </td>
                                    <td class="hidden-480">
                                        <?php echo $customer['wire']; ?> 
                                    </td>
    <!--                                    <td>   
                                        <div class="controls center text-center">
                                            <a  target="_blank" title="edit" href="<?php echo Router::url(array('controller' => 'customers', 'action' => 'edit_registration', $customer['id'])) ?>" >
                                                <span class="fa fa-pencil"></span></a>                                                                        
                                            &nbsp;&nbsp;
                                            <a 
                                                onclick="if (confirm( & quot; Are you sure to done this Admin? & quot; )) {
                                                            return true;
                                                        }
                                                        return false;"
                                                href="<?php echo Router::url(array('controller' => 'technicians', 'action' => 'status_done', $customer['id'])) ?>" title="Done">
                                                <span class="fa  fa-check"></span>
                                            </a>
                                        </div>
                                    </td>-->
                                </tr>
                            <?php endforeach; ?>                           
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
