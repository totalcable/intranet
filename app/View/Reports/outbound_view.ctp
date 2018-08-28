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

        <!-- END PAGE CONTENT -->


        <div class="page-content-wrapper" style="margin: 0px; padding: 0px;">
            <div class="">
                <!-- BEGIN PAGE HEADER-->

                <!-- END PAGE HEADER-->
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
                                        <th>Customer Details</th>
                                        <th>Instruction</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>                                     
                                    <?php
                                    foreach ($data as $single):
                                        ?>
                                        <tr>                                   
                                            <td>
                                                <a href="<?php echo Router::url(array('controller' => 'customers',
                                                'action' => 'edit_registration', $single['pc']['id']))?>">
                                    <li>Name: <?php echo $single['pc']['first_name'] . ' ' . $single['pc']['middle_name'] . ' ' . $single['pc']['last_name']; ?> </a></li>
                                    <li> Cell: <?php echo $single['pc']['cell']; ?> </li> 
                                    </td>                                    
                                    <td><?php echo $single['ti']['content']; ?></td> 
                                    <td>   
                                        <div class="controls center text-center">
                                            <?php if ($single['tr']['status'] == 'outbound') { ?>
                                                <a 
                                                    href="#" title="Solved">
                                                    <span id="<?php echo $single['tr']['id']; ?>" class="fa fa-check fa-lg solve_ticket"></span>
                                                </a>
                                                &nbsp;                                               
                                                <div id="solve_dialog<?php echo $single['tr']['id']; ?>" class="portlet-body form" style="display: none;">
                                                    <!-- BEGIN FORM-->
                                                    <?php
                                                    echo $this->Form->create('Track', array(
                                                        'inputDefaults' => array(
                                                            'label' => false,
                                                            'div' => false
                                                        ),
                                                        'id' => 'form_sample_3',
                                                        'class' => 'form-horizontal',
                                                        'novalidate' => 'novalidate',
                                                        'url' => array('controller' => 'reports', 'action' => 'called')
                                                            )
                                                    );
                                                    ?>

                                                    <?php
                                                    echo $this->Form->input('ticket_id', array(
                                                        'type' => 'hidden',
                                                        'value' => $single['tr']['id'],
                                                            )
                                                    );
                                                    ?>
                                                    <?php
                                                    echo $this->Form->input('id', array(
                                                        'type' => 'hidden',
                                                        'value' => $single['tr']['id'],
                                                            )
                                                    );
                                                    ?>

                                                    <?php
                                                    echo $this->Form->input('package_customer_id', array(
                                                        'type' => 'hidden',
                                                        'value' => $single['pc']['id'],
                                                            )
                                                    );
                                                    ?>

                                                    //<?php
//                                                    echo $this->Form->input('forwarded_by', array(
//                                                        'type' => 'hidden',
//                                                        'value' => $lasthistory['forwarded_by'],
//                                                            )
//                                                    );
//                                                    
                                                    ?>

                                                    //<?php
//                                                    echo $this->Form->input('user_id', array(
//                                                        'type' => 'hidden',
//                                                        'value' => $lasthistory['user_id'],
//                                                            )
//                                                    );
//                                                    
                                                    ?>
                                                    //<?php
//                                                    echo $this->Form->input('role_id', array(
//                                                        'type' => 'hidden',
//                                                        'value' => $lasthistory['role_id'],
//                                                            )
//                                                    );
//                                                    
                                                    ?>


                                                    <div class="form-body">
                                                        <div class="alert alert-danger display-hide">
                                                            <button class="close" data-close="alert"></button>
                                                            You have some form errors. Please check below.
                                                        </div>
                                                         <?php echo $this->Session->flash(); ?>

                                                        <div class="form-group">
                                                            <div class="form-group">
                                                                <div class="col-md-12">
                                                                    <?php
                                                                    echo $this->Form->input('content', array(
                                                                        'type' => 'textarea',
                                                                        'class' => 'form-control required txtArea',
                                                                        'placeholder' => 'Write conversation detail'
                                                                            )
                                                                    );
                                                                    ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-actions">
                                                        <div class="row">
                                                            <div class="col-md-offset-7 col-md-4">
                                                                <?php
                                                                echo $this->Form->button(
                                                                        'Done', array('class' => 'btn green', 'type' => 'submit')
                                                                );
                                                                ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php echo $this->Form->end(); ?>
                                                    <!-- END FORM-->
                                                </div> 
                                                <?php
                                            } else {
                                                echo 'Close';
                                            }
                                            ?>
                                        </div>
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
        </div>                             

    </div>
</div>
<!-- END CONTENT -->

