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
                            <i class="fa fa-plus"></i>Schedule done List
                        </div>
                        <div class="tools">
                            <a href="javascript:;" class="reload">
                            </a>
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
                                <label class="control-label col-md-3" for="required">Select Date:</label>
                                <div class="col-md-4">
                                    <?php
                                    echo $this->Form->input(
                                            'daterange', array(
                                        'id' => 'e2', /* e1 is past to current date, e2 is past to future date */
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
                                            <th class="sorting_desc">
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
                                                Comment
                                            </th>
                                            <th>
                                                Attachment
                                            </th>                                    

                                            <th>
                                                Assigned to
                                            </th>
                                            <th>
                                                Schedule
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

                                            $customer_address = $customer['house_no'] . ' ' . $customer['street'] . ' ' .
                                                    $customer['apartment'] . ' ' . $customer['city'] . ' ' . $customer['state'] . ' '
                                                    . $customer['zip'];
                                            ?>
                                            <tr>
                                                <td class="hidden-480">
                                                    <?php echo $results['customers']['id']; ?>                            
                                                </td>
                                                <td class="hidden-480">
                                                    <?php echo date('m-d-Y', strtotime($results['customers']['modified'])); ?> <br>


                                                    <?php echo $results['users']['name']; ?>                            
                                                </td>
                                                <td>
                                                    <a href="<?php
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
                                                        Name:<?php echo $results['package']['name'] ?><br>
                                                        Duration:<?php echo $results['package']['duration']; ?><br>
                                                        Amount: <?php echo $results['package']['amount']; ?>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <?php if (!empty($results['issue']['name'])): ?>
                                                        <?php echo $results['issue']['name']; ?>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <strong>Equipment:</strong> <?php echo $results['customers']['shipment_equipment']; ?>
                                                    <br>
                                                    <strong>Quantity:</strong> <?php echo $results['customers']['remote_no']; ?>
                                                    <br>
                                                    <strong>Additional Note:</strong> <?php echo $results['customers']['shipment_note']; ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    foreach ($results['comments'] as $comment):
                                                        ?>
                                                        <span title="<?php echo $comment['content']['created']; ?>" class="fa fa-hand-o-right ">  <?php echo $comment['content']['content']; ?> &nbsp;&nbsp;</span> <i> <?php echo $comment['user']['name']; ?></i>
                                                        <br> 
                                                        <br> 
                                                    <?php endforeach;
                                                    ?>
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
                                                    <ul>
                                                        <li > <?php echo $results['tech']['name']; ?> </li>
                                                        <li > <?php echo $results['tech']['email']; ?> </li> 
                                                    </ul>
                                                </td>

                                                <td><?php // echo date('m-d-Y h:i A', strtotime($results['customers']['modified']));    ?>
                                                    <?php if ($results['ins']['date'] != 0000 - 00 - 00) { ?>
                                                        <?php
                                                        echo $results['ins']['date'] . '<br> ' . $results['ins']['from'] . ' ' . $results['ins']['to'];
                                                        ?>
                                                    <?php } else { ?>  
                                                        <?php echo 'Please schedule set again'; ?>
                                                        <?php // echo $results['ins']['schedule_date']; ?>
                                                    <?php } ?>                                        
                                                </td>

                                                <td> 
                                                    <div class="controls center text-center">
                                                        <a 
                                                            href="commentDiv<?php echo $results['customers']['id']; ?>" title="Comment" class="toggleDiv">
                                                            <span  class="fa fa-comment fa-lg "></span>
                                                        </a>
                                                        &nbsp;
                                                        <a onclick="if (confirm('Are you sure to approve this data?')) {
                                                                            return true;
                                                                        }
                                                                        return false;"
                                                           href="<?php echo Router::url(array('controller' => 'admins', 'action' => 'approved', $results['customers']['id'], $results['tech']['id'])) ?>" title="Approve">
                                                            <span class="fa fa-check"></span>
                                                        </a>
                                                        <div id="commentDiv<?php echo $results['customers']['id']; ?>" class=" hideRest portlet-body form" style="display: none;">
                                                            <!-- BEGIN FORM-->
                                                            <?php
                                                            echo $this->Form->create('Comment', array(
                                                                'inputDefaults' => array(
                                                                    'label' => false,
                                                                    'div' => false,
                                                                    'id' => false
                                                                ),
                                                                'class' => 'form-horizontal normalForm',
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
                    </div>
                </div>
            </div>                             
        <?php endif; ?>
    </div>
</div>
<!-- END CONTENT -->

