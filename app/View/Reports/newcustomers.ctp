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
        <!-- BEGIN PAGE CONTENT-->
        <div class="row">
            <div class="col-md-12">
                <div class="portlet box green">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-plus"></i>New Customers 
                            <?php if ($clicked): ?>                              
                                Total Customers: <?php echo count($transactions); ?> 
                            <?php endif; ?>
                        </div>
                        <div class="tools">
                            <a href="javascript:;" class="reload">
                            </a>
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <!-- BEGIN FORM-->
                        <?php
                        echo $this->Form->create('StatusHistory', array(
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
                                <label class="control-label col-md-3" for="required">Select Date:</label>
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
                <div class="">
                    <!-- BEGIN PAGE CONTENT-->
                    <div class="invoice" id="printableArea">

                        <hr>
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
                                                Registration Date
                                            </th>
                                             <th class="hidden-480">
                                                Installation Date
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>                                    
                                        <?php
                                        foreach ($transactions as $info):
                                            $pc = $info['pc'];
                                            $customer_address = $pc['house_no'] . ' ' . $pc['street'] . ' ' .
                                                    $pc['apartment'] . ' ' . $pc['city'] . ' ' . $pc['state'] . ' '
                                                    . $pc['zip'];
                                            ?>
                                            <tr>
                                                <td><?php echo $info['pc']['id']; ?></td>
                                                <td> <a href="<?php echo Router::url(array('controller' => 'customers', 'action' => 'edit', $info['pc']['id'])) ?>" target="_blank"><?php echo $info['pc']['first_name'] . " " .$info['pc']['middle_name'] . " " . $info['pc']['last_name']; ?></a> </td>
                                                <td><?php echo $customer_address; ?></td>
                                                <td><?php echo $info['pc']['mac']; ?></td>
                                                <td><?php echo $info['pc']['cell']; ?></td>
                                                <td>
                                                    <?php
                                                    if (!empty($info['pc']['psetting_id'])) {
                                                        echo $info['ps']['name'];
                                                    } elseif (!empty ($info['pc']['custom_package_id'])) {
                                                        echo $info['cp']['duration'] . ' Months, Custom package ' . $info['cp']['charge'] . '$';
                                                    }else {
                                                      echo 'Package not set !';
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php // echo $info['Transaction']['due']; ?>
                                                    $<?php
                                                    $paid = 0;
                                                    if (!empty($info['tr']['id'])) {
                                                        $paid = getPaid($info['tr']['id']);
                                                    }
                                                    echo $info['tr']['payable_amount'] - $paid;
                                                    ?> USD
                                                </td>
                                                <!--<td><?php // echo date('m-d-Y', strtotime($info['tr']['exp_date']));  ?></td>-->                                                
                                                <td><?php echo date('m-d-Y', strtotime($info['pc']['created'])); ?></td>  
                                                <td><?php echo date('m-d-Y', strtotime($info['pc']['modified'])); ?></td>  
                                            </tr>
                                        <?php endforeach; ?>                           
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>                            
        <?php endif; ?>
    </div>
</div>
<!-- END CONTENT -->


