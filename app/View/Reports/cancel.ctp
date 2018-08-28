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
                            <i class="fa fa-plus"></i>Payment History
                        </div>   
                    </div>
                    <div class="portlet-body form">
                        <!-- BEGIN FORM-->
                         <?php
                        echo $this->Form->create('PackageCustomer', array(
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
                                <label class="control-label col-md-3">Select Date:</label>
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
            <div class="page-content-wrapper" style="margin: 0px; padding: 0px;">                
                    <!-- BEGIN PAGE CONTENT-->
                    <div class="invoice"  id="printableArea">

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
                               <table class="table table-striped table-hover table-bordered" id="sample_editable_1">
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
                                        </tr>
                                    </thead>
                                    <tbody>                                    
                                        <?php
                                        foreach ($block_customers as $info):
                                            ?>
                                            <tr>
                                                <td>                                                    
                                                    <?php echo $info['package_customers']['id']; ?>                                                
                                                </td>
                                                <td> <a href="<?php echo Router::url(array('controller' => 'customers', 'action' => 'edit', $info['package_customers']['id'])) ?>" target="_blank"><?php echo $info['package_customers']['middle_name'] . " " . $info['package_customers']['last_name']; ?></a> </td>
                                                <td>
                                                    <?php if (!empty($info['package_customers']['address'])): ?>
                                                        <?php echo $info['package_customers']['address']; ?>
                                                    <?php endif; ?>
                                                </td>
                                                <td><?php echo $info['package_customers']['mac']; ?></td>
                                                <td><?php echo $info['package_customers']['cell']; ?></td>
                                                <td>
                                                    <?php
                                                    if (!empty($info['package_customers']['psetting_id'])) {
                                                        echo $info['psettings']['name'];
                                                    } elseif (!empty($info['package_customers']['custom_package_id'])) {
                                                        echo $info['custom_packages']['duration'] . ' Months, Custom package ' . $info['custom_packages']['charge'] . '$';
                                                    } else {
                                                        echo 'Package not set !';
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    $<?php
                                                    $paid = 0;
                                                    if (!empty($info['transactions']['id'])) {
                                                        $paid = getPaid($info['transactions']['id']);
                                                    }

                                                    echo $info['transactions']['payable_amount'] - $paid;
                                                    ?> USD
                                                </td>
                                                <td><?php echo date('m-d-Y', strtotime($info['package_customers']['modified'])); ?></td>                                              

                                                <td><?php // echo date('m-d-Y', strtotime($info['package_customers']['created']));  ?></td>                                                
                                            </tr>
                                        <?php endforeach; ?>                           
                                    </tbody>
                                </table>
                            </div>


                        </div>
                    </div>
               
            </div>                             
        <?php endif; ?>
    </div>
</div>
<!-- END CONTENT -->

