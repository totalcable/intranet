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
            Shipment Request<small></small>
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
                                        Contact Info
                                    </th>
                                    <th>
                                        Customer detail
                                    </th>
<!--                                    <th>
                                        Comment
                                    </th>-->
                                    <th>
                                        Detail Information
                                    </th>
                                    <th>
                                        Issue
                                    </th>
                                    <th>
                                        Instruction
                                    </th>
                                    <th>
                                        Schedule date
                                    </th>
                                    <th>
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($filteredData as $results):

                                    $customer = $results['customers'];
//                                 pr($customer); exit;
                                    $customer_address = $customer['house_no'] . ' ' . $customer['street'] . ' ' .
                                            $customer['apartment'] . ' ' . $customer['city'] . ' ' . $customer['state'] . ' '
                                            . $customer['zip'];
                                    ?>
                                    <tr>
                                        <td class="hidden-480">
                                            <?php if (!empty($results['customers']['modified'])): ?>
                                                <?php if ($results['customers']['modified']): ?>
                                                    <b>  Contacted Date :  </b> 
                                                    <?php echo date('m-d-Y', strtotime($results['customers']['modified'])); ?>

                                                <?php endif; ?>
                                            <?php endif; ?>
                                            <br>
                                            <?php if (!empty($results['installations']['0']['user']['name'])): ?>
                                                <b>  Assign By :  </b><?php echo $results['installations']['0']['user']['name']; ?>
                                            <?php endif; ?> 
                                        </td>
                                        <td>
                                            <ul>
                                                <b>  Name :</b>  <a href="

                                                                    <?php
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
                                                <b>  Address :  </b>
                                                <?php if (!empty($customer_address)): ?>
                                                    <?php echo $customer_address; ?>
                                                <?php endif; ?>
                                                <br>

                                                <?php if (!empty($customer['cell'])): ?>
                                                    <b> Cell :</b> <a href="tel:<?php echo $customer['cell'] ?>"><?php echo $customer['cell']; ?></a><br>
                                                <?php endif; ?>
                                                <?php if (!empty($customer['home'])): ?>
                                                    <b>  Home :</b>  <a href="tel:<?php echo $customer['home'] ?>"><?php echo $customer['home']; ?></a>
                                                <?php endif; ?> 


                                            </ul>

                                        </td>

                                        <td>
                                            <?php if (trim($results['customers']['repair_type']) == 'old') { ?>
                                                <strong>Customer Type: </strong> Existing <br>
                                                <strong>Issue: </strong>
                                                <?php if (!empty($results['issues'][0]['name']['name'])): ?>
                                                    <?php echo $results['issues'][0]['name']['name']; ?>
                                                <?php endif; ?>
                                                <br>
        <!--                                                <strong>Equipment: </strong> <?php
//                                                echo $results['customers']['shipment_equipment'] . ' ' .
//                                                $results['customers']['shipment_note'] . '(' . $results['customers']['remote_no'] . ')';
                                                ?> <br>-->
                                                <strong>Mac: </strong> <?php echo $results['customers']['cancel_mac']; ?> <br>
                                                <strong>Payment: </strong> <ul>
                                                    <li>SD: $<?php echo $results['customers']['deposit']; ?></li>
                                                    <li>MB: $<?php echo $results['customers']['monthly_bill']; ?></li>
                                                    <li>Total: $<?php echo $results['customers']['total']; ?></li>
                                                </ul>  <br>
                                                <strong>Equipment:</strong> <?php echo $results['customers']['shipment_equipment']; ?>
                                                <br>
                                                <strong>Additional Note:</strong> <?php echo $results['customers']['shipment_note']; ?>
                                            <?php } else { ?>
                                                <strong>Customer Type: </strong> New <br>
                                                <strong>Package: </strong> <?php $results['package']['name']; ?> <br>
                                                <strong>Payment: </strong> <ul>
                                                    <li>SD: $<?php echo $results['customers']['deposit']; ?></li>
                                                    <li>MB: $<?php echo $results['customers']['monthly_bill']; ?></li>
                                                    <li>Total: $<?php echo $results['customers']['total']; ?></li>
                                                </ul>  <br>

                                                <strong>Equipment:</strong> <?php echo $results['customers']['shipment_equipment']; ?> 
                                                <br>
                                                <strong>Quantity:</strong> <?php echo $results['customers']['remote_no']; ?>
                                                <br>
                                                <strong>Additional Note:</strong> <?php echo $results['customers']['shipment_note']; ?>




                                            <?php }
                                            ?>
                                        </td>

                                        <td>                                            
                                            <?php if (count($results['issues'])) { ?>
                                                <?php echo $results['issues'][0]['name']['name']; ?> <br> 
                                                <?php
                                                $issue = strtolower($results['issues'][0]['name']['name']);
                                                if (trim($issue) == 'moving') {
                                                    echo $customer['new_addr'];
                                                }
                                                ?>
                                            <?php } ?>
                                        </td>
                                        <td><?php echo $results['installations']['0']['user_id']['instruction_tech']; ?></td>
                                        <td><?php // echo date('m-d-Y h:i A', strtotime($results['customers']['modified']));            ?>
                                            <?php
//                                            pr($results['installations']['0']['user_id']['date']);
                                            if ($results['installations']['0']['user_id']['date'] != 0000 - 00 - 00) {
                                                ?>
                                                <?php
                                                echo $results['installations']['0']['user_id']['date'] . '<br> ' . $results['installations']['0']['user_id']['from'] . ' ' . $results['installations']['0']['user_id']['to'];
                                                ?>
                                            <?php } else { ?>  
                                                <?php echo 'Please schedule set again'; ?>
                                                <?php // echo $results['ins']['schedule_date']; ?>
                                            <?php } ?>                                        
                                        </td>
                                        <td> 
                                            <div class="controls center text-center">  
                                                <?php if (empty($results['customers']['troubleshoot_shipment'] == 'tro' || $results['customers']['troubleshoot_shipment'] == 'shi')) { ?>
                                                   
                                                <a 
                                                    href="commentDiv<?php echo $results['customers']['id']; ?>" title="Comment" class="toggleDiv">
                                                    <span  class="fa fa-comment fa-lg "></span>
                                                </a>  

                                                &nbsp;
                                                <a 
                                                    href="cancelDiv<?php echo $results['customers']['id']; ?>" title="Reject" class="toggleDiv">
                                                    <span class="fa fa-remove fa-lg "> </span>
                                                </a>
                                                  <?php } ?>  
                                                
                                                <?php if ($results['customers']['troubleshoot_shipment'] == 'tro' || $results['customers']['troubleshoot_shipment'] == 'shi') { ?>
                                                       <a 
                                                    href="commentDiv<?php echo $results['customers']['id']; ?>" title="Comment" class="toggleDiv">
                                                    <span  class="fa fa-comment fa-lg "></span>
                                                </a>  

                                                &nbsp;
                                                    <a 
                                                        href="canceltroublemovingDiv<?php echo $results['customers']['id']; ?>" title="Reject" class="toggleDiv">
                                                        <span class="fa fa-remove fa-lg "> Troubleshoot/Moving</span>
                                                    </a>
                                                <?php } ?>       

                                                <div id="commentDiv<?php echo $results['customers']['id']; ?>" class=" hideRest portlet-body form" style="display: none;">
                                                    <!-- BEGIN FORM-->
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
                                                    echo $this->Form->input('id', array(
                                                        'type' => 'hidden',
                                                        'value' => $results['installations'][0]['user_id']['id'],
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
                                                                    echo $this->Form->input('tech_mac', array(
                                                                        'type' => 'textarea',
                                                                        'class' => 'form-control required',
                                                                        'title' => 'Write mac information of customer',
                                                                        'placeholder' => 'Write customer mac info'
                                                                            )
                                                                    );
                                                                    ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="form-group">
                                                                <div class="col-md-12">
                                                                    <?php
                                                                    echo $this->Form->input('tech_payment', array(
                                                                        'type' => 'textarea',
                                                                        'class' => 'form-control required',
                                                                        'title' => 'Write payment information of customer',
                                                                        'placeholder' => 'Write payment info'
                                                                            )
                                                                    );
                                                                    ?>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <div class="form-group">
                                                                <div class="col-md-12">
                                                                    <?php
                                                                    echo $this->Form->input('content', array(
                                                                        'type' => 'textarea',
                                                                        'class' => 'form-control required txtArea',
                                                                        'placeholder' => 'Write your comments',
                                                                        'title' => 'Write your comments here',
                                                                            )
                                                                    );
                                                                    ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div  style="float: left; ">
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


                                                <div id="cancelDiv<?php echo $results['customers']['id']; ?>" class="hideRest portlet-body form" style="display: none;">
                                                    <!-- BEGIN FORM-->
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
                                                        'url' => array('controller' => 'technicians', 'action' => 'postPone_customer')
                                                            )
                                                    );
                                                    ?>

                                                    <?php
                                                    echo $this->Form->input('id', array(
                                                        'type' => 'hidden',
                                                        'value' => $results['installations'][0]['user_id']['id'],
                                                            )
                                                    );
                                                    ?>

                                                    <?php
                                                    echo $this->Form->input('shipment', array(
                                                        'type' => 'hidden',
                                                        'value' => $customer['shipment'],
                                                            )
                                                    );
                                                    ?>

                                                    <?php
                                                    echo $this->Form->input('dealer', array(
                                                        'type' => 'hidden',
                                                        'value' => $customer['dealer'],
                                                            )
                                                    );
                                                    ?>

                                                    <?php
                                                    echo $this->Form->input('follow_up', array(
                                                        'type' => 'hidden',
                                                        'value' => $customer['follow_up'],
                                                            )
                                                    );
                                                    ?>

                                                    <?php
                                                    echo $this->Form->input('status', array(
                                                        'type' => 'hidden',
                                                        'value' => $customer['status'],
                                                            )
                                                    );
                                                    ?>

                                                    <?php
                                                    echo $this->Form->input('follow_date', array(
                                                        'type' => 'hidden',
                                                        'value' => $customer['follow_date'],
                                                            )
                                                    );
                                                    ?>

                                                    <?php
                                                    echo $this->Form->input('troubleshoot_moving_issue', array(
                                                        'type' => 'hidden',
                                                        'value' => $customer['troubleshoot_moving_issue'],
                                                            )
                                                    );
                                                    ?>
                                                    <?php
                                                    echo $this->Form->input('package_customer_id', array(
                                                        'type' => 'hidden',
                                                        'value' => $customer['id'],
                                                            )
                                                    );
                                                    ?>
                                                    <?php
                                                    echo $this->Form->input('troubleshoot_moving_date', array(
                                                        'type' => 'hidden',
                                                        'value' => $customer['troubleshoot_moving_date'],
                                                            )
                                                    );
                                                    ?>
                                                    <?php
                                                    echo $this->Form->input('troubleshoot_shipment', array(
                                                        'type' => 'hidden',
                                                        'value' => $customer['troubleshoot_shipment'],
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
                                                            <div class="col-md-offset-3 col-md-4">
                                                                <?php
                                                                echo $this->Form->button(
                                                                        'Post pone', array('class' => 'btn green', 'type' => 'submit')
                                                                );
                                                                ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php echo $this->Form->end(); ?>
                                                    <!-- END FORM-->
                                                </div>

                                                <div id="canceltroublemovingDiv<?php echo $results['customers']['id']; ?>" class="hideRest portlet-body form" style="display: none;">
                                                    <!-- BEGIN FORM-->
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
                                                        'url' => array('controller' => 'technicians', 'action' => 'postPone_troubleshoot')
                                                            )
                                                    );
                                                    ?>

                                                    <?php
                                                    echo $this->Form->input('id', array(
                                                        'type' => 'hidden',
                                                        'value' => $results['installations'][0]['user_id']['id'],
                                                            )
                                                    );
                                                    ?>

                                                    <?php
                                                    echo $this->Form->input('shipment', array(
                                                        'type' => 'hidden',
                                                        'value' => $customer['shipment'],
                                                            )
                                                    );
                                                    ?>

                                                    <?php
                                                    echo $this->Form->input('dealer', array(
                                                        'type' => 'hidden',
                                                        'value' => $customer['dealer'],
                                                            )
                                                    );
                                                    ?>

                                                    <?php
                                                    echo $this->Form->input('follow_up', array(
                                                        'type' => 'hidden',
                                                        'value' => $customer['follow_up'],
                                                            )
                                                    );
                                                    ?>

                                                    <?php
                                                    echo $this->Form->input('status', array(
                                                        'type' => 'hidden',
                                                        'value' => $customer['status'],
                                                            )
                                                    );
                                                    ?>

                                                    <?php
                                                    echo $this->Form->input('follow_date', array(
                                                        'type' => 'hidden',
                                                        'value' => $customer['follow_date'],
                                                            )
                                                    );
                                                    ?>

                                                    <?php
                                                    echo $this->Form->input('troubleshoot_moving_issue', array(
                                                        'type' => 'hidden',
                                                        'value' => $customer['troubleshoot_moving_issue'],
                                                            )
                                                    );
                                                    ?>
                                                    <?php
                                                    echo $this->Form->input('package_customer_id', array(
                                                        'type' => 'hidden',
                                                        'value' => $customer['id'],
                                                            )
                                                    );
                                                    ?>
                                                    <?php
                                                    echo $this->Form->input('troubleshoot_moving_date', array(
                                                        'type' => 'hidden',
                                                        'value' => $customer['troubleshoot_moving_date'],
                                                            )
                                                    );
                                                    ?>
                                                    <?php
                                                    echo $this->Form->input('troubleshoot_shipment', array(
                                                        'type' => 'hidden',
                                                        'value' => $customer['troubleshoot_shipment'],
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
                                                                        'placeholder' => 'Write your comments for post pone torubleshoot/moving'
                                                                            )
                                                                    );
                                                                    ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-actions">
                                                        <div class="row">
                                                            <div class="col-md-offset-3 col-md-4">
                                                                <?php
                                                                echo $this->Form->button(
                                                                        'Post pone', array('class' => 'btn green', 'type' => 'submit')
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



