<style type="text/css">
    .alert {
        padding: 6px;
        margin-bottom: 5px;
        border: 1px solid transparent;
        border-radius: 4px;
        text-align: center;
    }

    .col-md-6 {
        margin-top: 10px;
    }
</style>
<div class="page-content-wrapper">
    <div class="page-content">
        <!-- BEGIN PAGE CONTENT-->
        <div class="row">
            <div class="col-md-12">
                <div class="portlet box green">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-paperclip"></i>All Reports
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <!-- BEGIN FORM-->
                        <?php
                        echo $this->Form->create('Role', array(
                            'inputDefaults' => array(
                                'label' => false,
                                'div' => false
                            ),
                            'id' => 'form_sample_3',
                            'class' => 'form-horizontal',
                            'novalidate' => 'novalidate',
                            'url' => array('controller' => 'reports', 'action' => 'test')
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
                                <div class="col-md-7" >                                   
                                    <div class="col-md-12 display-hide hide-rest" id="only-package">
                                        <div class="col-md-6">
                                            <?php
                                            echo $this->Form->input('mac', array(
                                                'type' => 'select',
                                                'options' => array('1' => '1', '2' => '2', '3' => '3'),
                                                'empty' => 'Select box',
                                                'class' => 'form-control select2me '
                                                    )
                                            );
                                            ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-5">
                                    <?php
                                    echo $this->Form->input('action', array(
                                        'type' => 'select',
                                        'options' => array(
                                            'allautorecurring' => 'All Auto Recurring',
                                            'allinvoice_print_preview' => 'All Invoice (should be paid within next 25 days)',
                                            'allinvoice' => 'All Invoice',
                                            'calllog' => 'Call Log',
                                            'cancel' => 'Cancel',
                                            'closedinvoice' => 'Closed Invoice',
                                            'customersummary' => 'Customer Summary',
                                            'failed' => 'Failed Auto Recurring',
                                            'failedpayment' => 'Failed Payment',
                                            'expirecustomer' => 'Expire Customer',
                                            'hold' => 'Hold Cusotmers',
                                            'newcustomer' => 'New Customer',
                                            'openInvoice' => 'Open Invoice',
                                            'overdueinvoice' => 'Over Due Invoice',
                                            'overallreport' => 'Over all Report',
                                            'paidinvoice' => 'Paid Invoice',
                                            'passedinvoice' => 'Passed Due Invoice',
                                            'paymenthistory' => 'Payment History',
                                            'package' => 'Package',
                                            'successful' => 'Succeeded Auto Recurring',
                                            'successful_payment' => 'Successful Payment',
                                            'summeryReport' => 'Summary'),
                                        'empty' => 'Select criteria',
                                        'class' => 'form-control select2me ',
                                        'id' => 'actionID'
                                    ));
                                    ?>

                                </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-6 col-md-4">
                                    <?php
                                    echo $this->Form->button(
                                            'Search', array('class' => 'btn green', 'type' => 'submit')
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
            
                <table class="table table-striped table-hover table-bordered" id="sample_editable_1">
        <thead>
            <tr>
                <th>Customer Detail</th>
                <th>Package info</th>
                <th>Payment Detail</th>
            </tr>
        </thead>
        <tbody>                                     
            <?php
            foreach ($package_info as $single):

                $pc = $single['pc'];
                $stbs = count($pc['stbs']);
//                              $stbs = json_decode($pc['mac']);+
                $boxes = $stbs;
                $customer_address = $pc['house_no'] . ' ' . $pc['street'] . ' ' .
                        $pc['apartment'] . ' ' . $pc['city'] . ' ' . $pc['state'] . ' '
                        . $pc['zip'];
                ?>

                <tr >
                    <td>
                        <ul>
                            <li><strong>Name:</strong>  
                                <a href="<?php
                                echo Router::url(array('controller' => 'customers',
                                    'action' => 'edit', $pc['id']))
                                ?>" 
                                   target="_blank">
                                       <?php
                                       echo $pc['first_name'] . ' ' . $pc['middle_name'] . ' ' . $pc['last_name'];
                                       ?>
                                </a><br>
                            </li> 
                            <li><strong> Cell: </strong>  <?php echo $pc['cell']; ?> </li> 
                            <li><strong> Mac: </strong> 
                                <ul>
                                    <?php if (is_array($stbs)) foreach ($stbs as $stb): ?>
                                            <li> <?php echo $stb; ?></li>
                                        <?php endforeach; ?>
                                </ul>
                            </li> 
                        </ul>
                    </td>
                    <td>
                        <ul>
                            <?php if ($single['pc']['psetting_id']) { ?>
                                <li><strong>Package Name :</strong> <?php echo $single['ps']['name']; ?></li>
                            <?php } elseif (!empty($single['pc']['custom_package_id'])) { ?>
                                <li><strong>Package Name :</strong> <?php echo $single['cp']['duration'] . ' Months, Custom package'; ?></li></br>
                                <li><strong>Charge :</strong> <?php echo $single['cp']['charge'] . '$'; ?></li>
                            <?php } else { ?>
                                <?php echo 'Package not set !'; ?>
                            <?php } ?> 
                        </ul>
                    </td>
                    <td>                                                    
                        <?php echo date('m-d-Y', strtotime($pc['date'])); ?>
                    </td>
                </tr>
                <?php
            endforeach;
            ?>   
        </tbody>
    </table>
            </div>
        </div>

    </div>
    
</div>
<!-- END CONTENT -->

