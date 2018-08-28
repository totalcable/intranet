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
        <!-- BEGIN PAGE HEADER-->
        <h3 class="page-title">
            Rescheduled by  tech <small></small>
        </h3>

        <!-- END PAGE HEADER-->
        <!-- BEGIN PAGE CONTENT-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet box green">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-user"></i>
                        </div>

                        <div class="tools">
                            <a href="javascript:;" class="reload">
                            </a>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <?php echo $this->Session->flash(); ?> 
                        <table class="table table-striped table-hover table-bordered" id="sample_editable_1">
                            <thead>
                                <tr>
                                    <th >
                                        SL.
                                    </th>
                                    <th>
                                        Contact Date
                                    </th>

                                    <th>
                                        Customer Detail
                                    </th>

                                    <th>
                                        Package
                                    </th>
                                    <th>
                                        Issue
                                    </th>

                                    <th>
                                        Detail Information 
                                    </th>

                                    <th>
                                        Payment
                                    </th>

                                    <th>
                                        Comment
                                    </th>

                                    <th>
                                        Attachment
                                    </th>                                    

                                    <th>
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($filteredData as $results):
//                                    pr($results); exit;
//                                      pr($results['issue'][0]['name']['name']); exit;
                                    $customer = $results['customers'];
                                    $customer_address = $customer['house_no'] . ' ' . $customer['street'] . ' ' .
                                            $customer['apartment'] . ' ' . $customer['city'] . ' ' . $customer['state'] . ' '
                                            . $customer['zip'];
                                    ?>
                                    <tr>
                                        <td class="hidden-480">
                                            <?php echo $results['customers']['id']; ?>                            
                                        </td>
                                        <td class="hidden-480">                                            
                                            <?php echo date('m-d-Y', strtotime($results['customers']['modified'])); ?><br>                                            
                                            <?php echo $results['users']['name']; ?>                            
                                        </td>
                                        <td>
                                           <b>Name:</b> <a href="<?php
                                            echo Router::url(array('controller' => 'customers',
                                                'action' => 'edit_registration', $results['customers']['id']))
                                            ?>" 
                                               target="_blank">
                                                 <?php
                                                echo $results['customers']['first_name'] . " " .
                                                $results['customers']['middle_name'] . " " .
                                                $results['customers']['last_name'];
                                                ?>
                                            </a><br>
                                            <?php if (!empty($customer['cell'])): ?>
                                                <b>Cell:</b>  <a href="tel:<?php echo $customer['cell'] ?>"><?php echo $customer['cell']; ?></a> &nbsp;&nbsp;
                                            <?php endif; ?><br>
                                            <?php if (!empty($customer['home'])): ?>
                                                <b> Phone: </b> <a href="tel:<?php echo $customer['home'] ?>"><?php echo $customer['home']; ?></a>
                                            <?php endif; ?> <br>

                                            <b> Address: </b> <?php echo $customer_address; ?> 
                                        </td>

                                        <td>
                                            <?php if (!empty($results['package']['name'])): ?>
                                                Name: <?php echo $results['package']['name'] ?><br>
                                                Duration: <?php echo $results['package']['duration']; ?><br>
                                                Total: $<?php echo $customer['total']; ?>
                                                <?php // echo $results['package']['amount'];  ?>
                                            <?php endif; ?>
                                        </td>

                                        <td>
                                            <?php if (!empty($results['issue'][0]['name']['name'])): ?>
                                                <?php echo $results['issue'][0]['name']['name']; ?>
                                            <?php endif; ?>
                                        </td>

                                        <td>
                                            <?php echo $customer['shipment_equipment'] . ' ' . $customer['shipment_note']; ?>
                                        </td>
                                        <td> 
                                            <strong>Payment: </strong>
                                            <ul>
                                                <li>SD: $<?php echo $customer['deposit']; ?></li>
                                                <li>MB: $<?php echo $customer['monthly_bill']; ?></li>
                                                <li>Equipment: $<?php echo $customer['others']; ?></li>
                                                <li>Total: $<?php echo $customer['total']; ?></li>
                                            </ul>                                           
                                        </td>
                                        <td>
                                            <ul>
                                                <?php if (!empty($results['customers']['comments'])): ?>
                                                    <?php echo $results['customers']['comments'] ?> 
                                                <?php endif ?>
                                            </ul>
                                        </td>
                                        <td>
                                            <div class="col-md-12 col-sm-12 mix category_2 category_1">
                                                <div class="mix-inner">
                                                    <?php if (!empty($customer['attachment'])) { ?>
                                                        <img class="img-responsive" src="<?php echo $this->webroot . 'attchment' . '/' . $customer['attachment']; ?>" alt="">
                                                        <div class="mix-details">
                                                            <a class="mix-preview fancybox-button" href="<?php echo $this->webroot . 'attchment' . '/' . $customer['attachment']; ?>" title="Project Name" data-rel="fancybox-button">
                                                                <i class="fa fa-eye pull-right"></i>
                                                            </a>
                                                        </div>
                                                    <?php } else { ?>
                                                        <h4> No Attachment</h4>

                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="controls center text-center">
                                                <a 
                                                    title="Approve">
                                                    <span data-form="approve<?php echo $results['customers']['id']; ?>" class="fa fa-check openForm"></span>
                                                </a>

                                                <a 
                                                    title="Comment" class="comment">
                                                    <span  data-form="comment<?php echo $results['customers']['id']; ?>" class="fa fa-comment fa-lg openForm"></span>
                                                </a>

                                                &nbsp;
                                                <a 
                                                    href="#" title="Forward">
                                                    <span data-form="assign<?php echo $results['customers']['id']; ?>" class="fa fa-mail-forward fa-lg openForm"></span>
                                                </a>

                                                <div id="assign<?php echo $results['customers']['id']; ?>" class="portlet-body form hideForm" style="display: none;">
                                                    <!--BEGIN FORM-->
                                                    <?php
                                                    echo $this->Form->create('PackageCustomer', array(
                                                        'inputDefaults' => array(
                                                            'label' => false,
                                                            'div' => false,
                                                            'id' => false
                                                        ),
                                                        'id' => 'form_sample_3',
                                                        'class' => 'form-horizontal',
                                                        'novalidate' => 'novalidate',
                                                        'url' => array('controller' => 'customers', 'action' => 'shedule_assian')
                                                            )
                                                    );
                                                    ?>

                                                    <?php
                                                    echo $this->Form->input('id', array(
                                                        'type' => 'hidden',
                                                        'value' => $results['customers']['id'],
                                                            )
                                                    );
                                                    ?>
                                                    <?php
                                                    echo $this->Form->input('repair_type', array(
                                                        'type' => 'hidden',
                                                        'value' => 'new',
                                                            )
                                                    );
                                                    ?>
                                                    <div class="form-body">
                                                        <div class="alert alert-danger display-hide">
                                                            <button class="close" data-close="alert"></button>
                                                            You have some form errors. Please check below.
                                                        </div>

                                                        <div class="form-group">
                                                            <div class="col-md-12">
                                                                <?php
                                                                echo $this->Form->input('technician_id', array(
                                                                    'type' => 'select',
                                                                    'options' => $technician,
                                                                    'empty' => 'Select Technician',
                                                                    'class' => 'form-control select2me required',
                                                                        )
                                                                );
                                                                ?>
                                                            </div>
                                                        </div>


                                                        <div class="form-group">                               
                                                            <div class="col-md-12">
                                                                <?php
                                                                echo $this->Form->input(
                                                                        'schedule_date', array(
                                                                    'type' => 'text',
                                                                    'placeholder' => 'Select date',
                                                                    'class' => "datepicker form-control",
                                                                    'title' => 'Click & select date'
                                                                ));
                                                                ?>
                                                            </div>
                                                        </div> 

                                                        <div class="form-group input-icon">                                                            
                                                            <?php
                                                            echo $this->Form->input(
                                                                    'from', array(
                                                                'type' => 'text',
                                                                'class' => 'fa fa-clock-o form-control timepicker timepicker-default',
                                                                'placeholder' => 'Select time range',
                                                                'title' => 'Select time range'
                                                                    )
                                                            );
                                                            ?> 
                                                            <span>To</span>                                                           
                                                            <?php
                                                            echo $this->Form->input(
                                                                    'to', array(
                                                                'type' => 'text',
                                                                'class' => 'fa fa-clock-o form-control timepicker timepicker-default',
                                                                'placeholder' => 'Select time range',
                                                                'title' => 'Select time range'
                                                                    )
                                                            );
                                                            ?> 
                                                        </div> 
                                                        
                                                        <div class="form-group">
                                                            <div class="col-md-12">
                                                                <?php
                                                                $inform_status = array("Yes" => "Yes", "No" => "No", "VM" => "VM");
                                                                echo $this->Form->input(
                                                                        'c_inform', array(
                                                                    'class' => 'form-control',
                                                                    'options' => $inform_status,
                                                                    'label' => false,
                                                                    'title' => 'Cusotmer Informed ?',
                                                                    'empty' => '--Select Inform status--'
                                                                        )
                                                                );
                                                                ?>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <div class="col-md-12">
                                                                <?php
                                                                echo $this->Form->input('instruction_tech', array(
                                                                    'type' => 'textarea',
                                                                    'class' => 'form-control',
                                                                    'title' => 'Instruction for technician',
                                                                    'placeholder' => 'Instruction for tech'
                                                                        )
                                                                );
                                                                ?>
                                                            </div>
                                                        </div>                                                        
                                                    </div>

                                                    <div style="float: left; ">
                                                        <div class="row">
                                                            <div class="col-md-offset-7 col-md-4">
                                                                <?php
                                                                echo $this->Form->button(
                                                                        'Submit', array('class' => 'btn green', 'type' => 'submit')
                                                                );
                                                                ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php echo $this->Form->end(); ?>
                                                </div>

                                                <div id="approve<?php echo $results['customers']['id']; ?>" class=" hideRest portlet-body form hideForm" style="display: none;">
                                                    <!-- BEGIN FORM-->
                                                    <?php
                                                    echo $this->Form->create('Comment', array(
                                                        'inputDefaults' => array(
                                                            'label' => false,
                                                            'div' => false
                                                        ),
                                                        'id' => 'form_sample_3',
                                                        'class' => 'form-horizontal',
                                                        'novalidate' => 'novalidate',
                                                        'url' => array('controller' => 'admins', 'action' => 'shortapprove')
                                                            )
                                                    );
                                                    ?>
                                                    <?php
                                                    echo $this->Form->input('package_customer_id', array(
                                                        'type' => 'hidden',
                                                        'value' => $results['customers']['id'],
                                                            )
                                                    );
                                                    ?>
                                                    <?php
                                                    echo $this->Form->input('status', array(
                                                        'type' => 'hidden',
                                                        'value' => 'sales done',
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
                                                            <div class="form-group">
                                                                <div class="col-md-12">
                                                                    <?php
                                                                    echo $this->Form->input('comments', array(
                                                                        'type' => 'textarea',
                                                                        'class' => 'form-control required txtArea',
                                                                        'placeholder' => 'Write additional note for approve'
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
                                                                        'Approve', array('class' => 'btn green', 'type' => 'submit')
                                                                );
                                                                ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php echo $this->Form->end(); ?>
                                                    <!-- END FORM-->
                                                </div>

                                                <div id="comment<?php echo $results['customers']['id']; ?>" class=" hideRest portlet-body form hideForm" style="display: none;">
                                                    <!-- BEGIN FORM-->
                                                    <?php
                                                    echo $this->Form->create('Comment', array(
                                                        'inputDefaults' => array(
                                                            'label' => false,
                                                            'div' => false
                                                        ),
                                                        'id' => 'form_sample_3',
                                                        'class' => 'form-horizontal',
                                                        'novalidate' => 'novalidate',
                                                        'url' => array('controller' => 'admins', 'action' => 'pcComment')
                                                            )
                                                    );
                                                    ?>
                                                    <?php
                                                    echo $this->Form->input('package_customer_id', array(
                                                        'type' => 'hidden',
                                                        'value' => $results['customers']['id'],
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
                                                            <div class="form-group">
                                                                <div class="col-md-12">
                                                                    <?php
                                                                    echo $this->Form->input('comments', array(
                                                                        'type' => 'textarea',
                                                                        'class' => 'form-control required txtArea',
                                                                        'placeholder' => 'Write your comments here'
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
                                                                        'Comment', array('class' => 'btn green', 'type' => 'submit')
                                                                );
                                                                ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php echo $this->Form->end(); ?>
                                                    <!-- END FORM-->
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>  

                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- END EXAMPLE TABLE PORTLET-->
            </div>
        </div>
        <!-- END PAGE CONTENT -->
    </div>
</div>
<!-- END CONTENT -->



