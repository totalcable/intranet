
<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.js"></script>

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

<script>
    $(document).ready(function () {
        $('.nav-toggle').click(function () {
            //get collapse content selector
            var collapse_content_selector = $(this).attr('href');

            //make the collapse content to be shown or hide
            var toggle_switch = $(this);
            $(collapse_content_selector).toggle(function () {
                if ($(this).css('display') == 'none') {
                    //change the button label to be 'Show'
                    toggle_switch.html('Ref.By:');
                } else {
                    //change the button label to be 'Hide'
                    toggle_switch.html('Ref.By:');
                }
            });
        });

    });
</script>
<script>
    $(document).ready(function () {
        $('.nav-toggle1').click(function () {
            //get collapse content selector
            var collapse_content_selector = $(this).attr('href');
            //make the collapse content to be shown or hide
            var toggle_switch = $(this);
            $(collapse_content_selector).toggle(function () {
                if ($(this).css('display') == 'none') {
                    //change the button label to be 'Show'                    
                    toggle_switch.html('Internet Carrier');
                } else {
                    //change the button label to be 'Hide'                 
                    toggle_switch.html('Internet Carrier');
                }
            });
        });

    });
</script>

<div class="page-content-wrapper">
    <div class="page-content">
        <!-- BEGIN PAGE CONTENT-->
        <div class="col-md-12">
            <div class="portlet box green">
                <div class="portlet-title">
                    <div class="caption">
                        <b style="color: white;">Search by date </b>                             
                    </div>
                    <div class="tools">
                        <a  class="fa-hand-o-down toggle" ></a>
                    </div>
                </div>
                <div class="portlet-body">  
                    <div class="portlet-body form">
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
                    </div>
                </div>                
            </div>
        </div>
        <!-- END PAGE CONTENT -->
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
                                        <th>
                                            Customer Detail
                                        </th> 
                                        <th>
                                            Package Detail
                                        </th>

                                        <th>
                                            Schedule
                                        </th>
<!--                                        <th>
                                            Date
                                        </th>-->
                                        <th>
                                            Comment
                                        </th>
                                        <th>
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($filteredData as $result):

//                                        pr($result['ins']['id']); exit;
                                        $i = 0;
                                        $customer = $result['customers'];
                                        $customer_address = $customer['house_no'] . ' ' . $customer['street'] . ' ' .
                                                $customer['apartment'] . ' ' . $customer['city'] . ' ' . $customer['state'] . ' '
                                                . $customer['zip'];
                                        ?>
                                        <tr>  
                                            <td>
                                                <a title="You can open edit registration page :-)" href="<?php
                                                echo Router::url(array('controller' => 'customers',
                                                    'action' => 'edit_registration', $customer['id']))
                                                ?>" 
                                                   target="_blank">
                                                       <?php
                                                       echo $customer['first_name'] . " " .
                                                       $customer['middle_name'] . " " .
                                                       $customer['last_name'];
                                                       ?>
                                                </a><br>
                                                <b>ID:</b>                                                
                                                <a title="You can open edit customer page :-)" href="<?php
                                                echo Router::url(array('controller' => 'customers',
                                                    'action' => 'edit', $customer['id']))
                                                ?>" 
                                                   target="_blank" style="color: darkred;">
                                                    <b><?php echo $customer['id']; ?></b>
                                                </a><br>

                                                <?php if (!empty($customer['cell'])): ?>
                                                    <b>Cell:</b>  tel:<?php echo $customer['cell'] ?><?php echo $customer['cell']; ?> &nbsp;&nbsp;
                                                <?php endif; ?><br>
                                                <?php if (!empty($customer['home'])): ?>
                                                    <b> Phone: </b> tel:<?php echo $customer['home'] ?><br><?php echo $customer['home']; ?>
                                                <?php endif; ?> <br>
                                                <b> Address: </b> <?php echo $customer_address; ?>  <br>
                                                <b>SD: </b>    <?php echo $customer['deposit']; ?> <br>
                                                <b>Monthly Bill:</b>   <?php echo $customer['monthly_bill']; ?> 
                                            </td>
                                            <td>
                                                <b>Package :</b>
                                                <?php if (!empty($results['package']['name'])): ?>
                                                    <?php echo $results['package']['name'] ?><br>
                                                    <b>Duration:</b> <?php echo $results['package']['duration']; ?><br>
                                                    <b>Amount:</b>  <?php echo $results['package']['amount']; ?>
                                                <?php endif; ?><br>
                                                <strong>Equipment:</strong> <?php echo $customer['shipment_equipment']; ?>
                                                <br>
                                                <strong>Quantity:</strong> <?php echo $customer['remote_no']; ?>
                                                <br>
                                                <strong>Additional Note:</strong> <?php echo $customer['shipment_note']; ?>
                                                <p title="Click here for view Internet Carrier" href=".collapse11<?php echo $customer['id']; ?>" class="nav-toggle1"><b style="color: darkred">Internet Carrier</b></p>
                                                <div class="collapse11<?php echo $customer['id']; ?>" style="display:none ; color: orangered">
                                                    <?php if (!empty($customer['current_isp_speed'])): ?>
                                                        & Speed(MBPS) : <?php echo $customer['current_isp_speed'] . ' MBPS'; ?>
                                                    <?php endif; ?>
                                                </div>
                                                <br>
                                                <b>Status: </b><b style="color: orangered"><?php echo $customer['status']; ?></b> 
                                            </td>
                                            <td>
                                                <?php if (!empty($result['ins']['date'])) { ?>
                                                    <?php
                                                    echo $result['ins']['date'] . '<br> ' . $result['ins']['from'] . ' ' . $result['ins']['to'];
                                                    ?>
                                                <?php } else { ?>  
                                                    <?php echo 'Please schedule set again'; ?>
                                                    <?php // echo $results['ins']['schedule_date']; ?>
                                                <?php } ?> <br>

                                                <?php if (!empty($result['issue']['name'])): ?>                                                      
                                                    <b> Issue :</b> <b style="color: orangered"><?php echo $result['issue']['name']; ?></b> 
                                                <?php endif; ?><br>

                                                <?php if (!empty($result['ins']['c_inform'])): ?>
                                                    <b>Inform status:</b>  <?php echo $result['ins']['c_inform']; ?>
                                                <?php endif; ?>
                                            </td>
    <!--                                            <td>
                                            <?php if (!empty($customer['created'])) { ?>
                                                <?php echo $customer['created']; ?>
                                            <?php } ?>
                                            </td>-->
                                            <td>
                                                <?php if (!empty($result['comments']['content'])) { ?>
                                                    <?php echo $result['comments']['content']; ?>
                                                <?php } ?>
                                            </td>
                                            <td>
                                            <td> 
                                                <div class="controls center text-center">
                                                    <?php                                                                                                   
                                                    if (!empty($result['ins']['id'])): ?>
                                                        <a 
                                                            href="doneDiv<?php echo $result['ins']['id']; ?>" title="Done" class="toggleDiv">
                                                            <span  class="fa fa-check fa-lg "></span>
                                                        </a>
                                                    <?php endif; ?>
                                                    
                                                    <!--<a href="commentDiv<?php echo $customer['id']; ?>" title="Comment" class="toggleDiv">
                                                        <span  class="fa fa-comment fa-lg "></span>
                                                        </a>-->
                                                    
                                                    &nbsp;
                                                    <a 
                                                        href="postponeDiv<?php echo $customer['id']; ?>"title="Post Pone" class="toggleDiv">
                                                        <span class="fa fa-pause fa-lg "></span>
                                                    </a>
                                                    &nbsp;
                                                    <a 
                                                        href="rescheduleDiv<?php echo $customer['id']; ?>" title="Reschedule" class="toggleDiv">
                                                        <span  class="fa fa-repeat fa-lg "></span>
                                                    </a>
                                                    &nbsp;
                                                    <a 
                                                        href="cancelDiv<?php echo $customer['id']; ?>" title="Cancel" class="toggleDiv">
                                                        <span class="fa fa-remove fa-lg "></span>
                                                    </a>   
                                                    <?php // if (!empty($result['ins']['id'])): ?>   
                                                        <div id="doneDiv<?php echo $result['ins']['id']; ?>" class="hideRest portlet-body form" style="display: none;">

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
                                                                'url' => array('controller' => 'technicians', 'action' => 'managerdone')
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
                                                            echo $this->Form->input('id', array(
                                                                'type' => 'hidden',
                                                                'value' => $result['ins']['id'],
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
                                                            <!-- END FORM-->
                                                        </div>
                                                    <?php // endif; ?>
                                                    <div id="commentDiv<?php echo $customer['id']; ?>" class=" hideRest portlet-body form" style="display: none;">
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
                                                            'value' => $results['ins']['id'],
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
                                                        <!-- END FORM-->
                                                    </div>

                                                    <div id="postponeDiv<?php echo $customer['id']; ?>" class="hideRest portlet-body form" style="display: none;">
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
                                                            'url' => array('controller' => 'technicians', 'action' => 'postPone')
                                                                )
                                                        );
                                                        ?>
                                                        <?php
                                                        echo $this->Form->input('id', array(
                                                            'type' => 'hidden',
                                                            'value' => $result['ins']['id'],
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
                                                        <!-- END FORM-->
                                                    </div>

                                                    <div id="rescheduleDiv<?php echo $customer['id']; ?>" class="hideRest portlet-body form" style="display: none;">
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
                                                            'url' => array('controller' => 'technicians', 'action' => 'reschedule')
                                                                )
                                                        );
                                                        ?>

                                                        <?php
                                                        echo $this->Form->input('id', array(
                                                            'type' => 'hidden',
                                                            'value' => $results['ins']['id'],
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
                                                        <!-- END FORM-->
                                                    </div>
                                                    <div id="cancelDiv<?php echo $customer['id']; ?>" class="hideRest portlet-body form" style="display: none;">
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
                                                            'url' => array('controller' => 'technicians', 'action' => 'cancel')
                                                                )
                                                        );
                                                        ?>

                                                        <?php
                                                        echo $this->Form->input('id', array(
                                                            'type' => 'hidden',
                                                            'value' => $result['ins']['id'],
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
                                                        <!-- END FORM-->
                                                    </div>
                                                </div>
                                            </td> 
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

    </div>
</div>