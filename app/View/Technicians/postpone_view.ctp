
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
           Postpone Request<small></small>
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
                                    <th>
                                        Contact Date
                                    </th>
                                    <th>
                                        Customer detail
                                    </th>
                                    <th>
                                        Comment
                                    </th>
                                    <th>
                                        Detail Information
                                    </th>
                                    <th>
                                        New Address
                                    </th>
                                    <th>
                                        Schedule date
                                    </th>
<!--                                    <th>
                                        Action
                                    </th>-->
                                </tr>
                            </thead>
                            <tbody>
                                <?php
//                                pr($filteredData);
//                                exit;
                                foreach ($filteredData as $results):


                                    $customer = $results['customers'];
//                                 pr($customer['repair_type']); exit; 
                                    $customer_address = $customer['house_no'] . ' ' . $customer['street'] . ' ' .
                                            $customer['apartment'] . ' ' . $customer['city'] . ' ' . $customer['state'] . ' '
                                            . $customer['zip'];
                                    ?>
                                    <tr>
                                        <td class="hidden-480">
                                            <?php echo date('m-d-Y', strtotime($results['customers']['modified'])); ?>
                                            <br>
                                            <?php echo $results['users']['name']; ?>  
                                        </td>
                                        <td>
                                            <ul>
                                                <b>  Name :</b>  <a href="<?php
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
                                                <b>  Address :  </b> <?php echo $customer_address; ?> <br>

                                                <?php if (!empty($customer['cell'])): ?>
                                                    <b> Cell :</b> <a href="tel:<?php echo $customer['cell'] ?>"><?php echo $customer['cell']; ?></a><br>
                                                <?php endif; ?>
                                                <?php if (!empty($customer['home'])): ?>
                                                    <b>  Home :</b>  <a href="tel:<?php echo $customer['home'] ?>"><?php echo $customer['home']; ?></a>
                                                <?php endif; ?> 
                                            </ul>

                                        </td>

                                        <td>
                                            <?php
                                            foreach ($results['comments'] as $comment):
                                                // pr($comment);
                                                ?>
                                                <span title="<?php echo $comment['content']['created']; ?>" class="fa fa-hand-o-right ">  <?php echo $comment['content']['content']; ?> &nbsp;&nbsp;</span> <i> <?php echo $comment['user']['name']; ?></i>
                                                <br> 
                                                <br> 

                                            <?php endforeach;
                                            ?>
                                        </td>

                                        <td>
                                            <?php if (trim($results['customers']['repair_type']) == 'old') { ?>
                                                <strong>Customer Type: </strong> Existing <br>
                                                <strong>Issue: </strong> <?php echo $results['issues'][0]['name']['name']; ?> <br>
                                                <strong>Equipment: </strong> <?php
                                                echo $results['customers']['shipment_equipment'] . ' ' .
                                                $results['customers']['shipment_note'] . '(' . $results['customers']['remote_no'] . ')';
                                                ?> <br>
                                                <strong>Mac: </strong> <?php echo $results['customers']['cancel_mac']; ?>
                                            <?php } else { ?>
                                                <strong>Customer Type: </strong> New <br>
                                                <strong>Package: </strong> <?php $results['package']['name']; ?> <br>
                                                <strong>Payment: </strong> <ul>
                                                    <li>SD: <?php echo $results['customers']['deposit']; ?>$</li>
                                                    <li>MB: <?php echo $results['customers']['monthly_bill']; ?>$</li>
                                                    <li>Equipment: <?php echo $results['customers']['others']; ?>$</li>
                                                    <li>Total: <?php echo $results['customers']['total']; ?>$</li>
                                                </ul>  <br>
                                                <strong>Equipment:</strong> <?php echo $results['customers']['shipment_equipment']; ?> 
                                                <br>
                                                <strong>Additional Note:</strong> <?php echo $results['customers']['shipment_note']; ?>
                                                <br>
                                                <strong>Quantity:</strong> <?php echo $results['customers']['remote_no']; ?>
                                                
                                            <?php }
                                            ?>


                                        </td>
                                        <td>
                                                <?php echo $customer['new_addr']; ?>
                                            </td>
                                            <td>
                                                <?php if (!empty($results['customers']['schedule_date'])): ?>    
                                                    <?php echo $results['customers']['schedule_date']; ?>
                                                <?php endif; ?>
                                            </td>
<!--                                        <td> 
                                            <div class="controls center text-center">
                                                <a 
                                                    href="doneDiv<?php echo $results['customers']['id']; ?>" title="Done" class="toggleDiv">

                                                    <span  class="fa fa-check fa-lg "></span>
                                                </a>
                                                <a 
                                                    href="commentDiv<?php echo $results['customers']['id']; ?>" title="Comment" class="toggleDiv">

                                                    <span  class="fa fa-comment fa-lg "></span>
                                                </a>
                                                &nbsp;
                                                <a 
                                                    href="postponeDiv<?php echo $results['customers']['id']; ?>"title="Post Pone" class="toggleDiv">
                                                    <span class="fa fa-pause fa-lg "></span>
                                                </a>
                                                &nbsp;
                                                <a 
                                                    href="rescheduleDiv<?php echo $results['customers']['id']; ?>" title="Reschedule" class="toggleDiv">
                                                    <span  class="fa fa-repeat fa-lg "></span>
                                                </a>

                                                &nbsp;
                                                <a 
                                                    href="cancelDiv<?php echo $results['customers']['id']; ?>" title="Cancel" class="toggleDiv">
                                                    <span class="fa fa-remove fa-lg "></span>
                                                </a>   

                                                <div id="doneDiv<?php echo $results['customers']['id']; ?>" class="hideRest portlet-body form" style="display: none;">
                                                     BEGIN FORM
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
                                                        'url' => array('controller' => 'technicians', 'action' => 'dodone')
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
                                                                    echo $this->Form->input('comment', array(
                                                                        'type' => 'textarea',
                                                                        'class' => 'form-control required txtArea',
                                                                        'placeholder' => 'Write your comments for done'
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
                                                     END FORM
                                                </div>

                                                <div id="commentDiv<?php echo $results['customers']['id']; ?>" class=" hideRest portlet-body form" style="display: none;">
                                                     BEGIN FORM
                                                    <?php
                                                    echo $this->Form->create('Comment', array(
                                                        'inputDefaults' => array(
                                                            'label' => false,
                                                            'div' => false,
                                                            'id' => false
                                                        ),
                                                        'id' => 'form_sample_3',
                                                        'class' => 'form-horizontal',
                                                        'novalidate' => 'novalidate',
                                                        'url' => array('controller' => 'technicians', 'action' => 'comment')
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
                                                                    echo $this->Form->input('content', array(
                                                                        'type' => 'textarea',
                                                                        'class' => 'form-control required txtArea',
                                                                        'placeholder' => 'Write your comments'
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
                                                     END FORM
                                                </div>

                                                <div id="postponeDiv<?php echo $results['customers']['id']; ?>" class="hideRest portlet-body form" style="display: none;">
                                                     BEGIN FORM
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
                                                        'url' => array('controller' => 'technicians', 'action' => 'postPone')
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
                                                                    echo $this->Form->input('comment', array(
                                                                        'type' => 'textarea',
                                                                        'class' => 'form-control required txtArea',
                                                                        'placeholder' => 'Write your comments for post pone'
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
                                                                        'Post pone', array('class' => 'btn green', 'type' => 'submit')
                                                                );
                                                                ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php echo $this->Form->end(); ?>
                                                     END FORM
                                                </div>

                                                <div id="rescheduleDiv<?php echo $results['customers']['id']; ?>" class="hideRest portlet-body form" style="display: none;">
                                                     BEGIN FORM
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
                                                        'url' => array('controller' => 'technicians', 'action' => 'reschedule')
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
                                                                    echo $this->Form->input('comment', array(
                                                                        'type' => 'textarea',
                                                                        'class' => 'form-control required txtArea',
                                                                        'placeholder' => 'Write your comments for reschedule'
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
                                                     END FORM
                                                </div>

                                                <div id="cancelDiv<?php echo $results['customers']['id']; ?>" class="hideRest portlet-body form" style="display: none;">
                                                     BEGIN FORM
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
                                                        'url' => array('controller' => 'technicians', 'action' => 'cancel')
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
                                                                    echo $this->Form->input('comment', array(
                                                                        'type' => 'textarea',
                                                                        'class' => 'form-control required txtArea',
                                                                        'placeholder' => 'Write your comments for cancel'
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
                                                                        'Cancel', array('class' => 'btn green', 'type' => 'submit')
                                                                );
                                                                ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php echo $this->Form->end(); ?>
                                                     END FORM
                                                </div>

                                            </div>
                                        </td>  -->
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



