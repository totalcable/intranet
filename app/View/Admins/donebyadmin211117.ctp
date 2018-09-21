
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
                                            Sales Receive By
                                        </th>
                                        <th>
                                            Customer Detail
                                        </th> 
                                        <th>
                                            Package Detail
                                        </th>

                                        <th>
                                            Schedule
                                        </th>

                                        <!--<th title="NAME OF THE BANK ACCOUNT  HOLDER, DOLLAR AMOUNT, BANK NAME & CHECK NO" style="color:steelblue;">-->
                                        <th>
                                            Payment  info
                                        </th>
                                        <th>
                                            Comment
                                        </th>
                                        <th>
                                            MAC
                                        </th> 
                                        <th>
                                            Instruction For Tech
                                        </th>                             
                                        <th>
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($filteredData as $results):
                                           
                                        $ins_id = $results['ins']['id'];
                                     pr($ins_id); exit;
                                        $customer = $results['customers'];
                                        $customer_address = $customer['house_no'] . ' ' . $customer['street'] . ' ' .
                                                $customer['apartment'] . ' ' . $customer['city'] . ' ' . $customer['state'] . ' '
                                                . $customer['zip'];
                                        ?>
                                        <tr>  

                                            <td class="hidden-480">
                                                <?php echo date('m-d-Y', strtotime($results['customers']['modified'])); ?> <br>
                                                <?php echo $results['users']['name']; ?> 

                                                <br>
                                                <br>                                                   
                                                <b> Assigned to</b> <br>
                                                <b>Name:</b> <?php echo $results['tech']['name']; ?>
                                                <b>Email:</b>  <?php echo $results['tech']['email']; ?> 
                                            </td>

                                            <td>
                                                <a title="You can open edit registration page :-)" href="<?php
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
                                                <b>ID:</b>                                                
                                                <a title="You can open edit customer page :-)" href="<?php
                                                echo Router::url(array('controller' => 'customers',
                                                    'action' => 'edit', $results['customers']['id']))
                                                ?>" 
                                                   target="_blank" style="color: darkred;">
                                                    <b><?php echo $results['customers']['id']; ?></b>
                                                </a><br>

                                                <?php if (!empty($customer['cell'])): ?>
                                                    <b>Cell:</b>  tel:<?php echo $customer['cell'] ?><?php echo $customer['cell']; ?> &nbsp;&nbsp;
                                                <?php endif; ?><br>
                                                <?php if (!empty($customer['home'])): ?>
                                                    <b> Phone: </b> tel:<?php echo $customer['home'] ?><br><?php echo $customer['home']; ?>
                                                <?php endif; ?> <br>

                                                <b> Address: </b> <?php echo $customer_address; ?>  <br>

                                                <p title="Click here for view Referal Name" href=".collapse1<?php echo $customer['id']; ?>" class="nav-toggle"><b style="color: darkred"> Ref.By:</b></p>
                                                <div class="collapse1<?php echo $customer['id']; ?>" style="display:none ;color: orangered">
                                                    <?php echo $customer['referred_name']; ?>  <br>
                                                </div>

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
                                                <strong>Equipment:</strong> <?php echo $results['customers']['shipment_equipment']; ?>
                                                <br>
                                                <strong>Quantity:</strong> <?php echo $results['customers']['remote_no']; ?>
                                                <br>
                                                <strong>Additional Note:</strong> <?php echo $results['customers']['shipment_note']; ?>
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
                                                <?php if ($results['ins']['date'] != 0000 - 00 - 00) { ?>
                                                    <?php
                                                    echo $results['ins']['date'] . '<br> ' . $results['ins']['from'] . ' ' . $results['ins']['to'];
                                                    ?>
                                                <?php } else { ?>  
                                                    <?php echo 'Please schedule set again'; ?>
                                                    <?php // echo $results['ins']['schedule_date']; ?>
                                                <?php } ?> <br>

                                                <?php if (!empty($results['issue']['name'])): ?>                                                      
                                                    <b> Issue :</b> <b style="color: orangered"><?php echo $results['issue']['name']; ?></b> 
                                                <?php endif; ?><br>

                                                <?php if (!empty($results['ins']['c_inform'])): ?>
                                                    <b>Inform status:</b>  <?php echo $results['ins']['c_inform']; ?>
                                                <?php endif; ?>
                                            </td>
                                            <td>                                                   
                                                <a title="Click here for edit data" href="#product-pop-up<?php echo $results['ins']['id']; ?>" class=" fancybox-fast-view" style="overflow: -webkit-paged-x;">
                                                    <?php if (!empty($results['ins']['tech_payment'])): ?>
                                                        <?php echo $results['ins']['tech_payment']; ?>
                                                    <?php endif; ?>
                                                </a> 
                                            </td>
                                            <td>
                                                <a title="Click here for edit data" href="#product-pop-up<?php echo $results['ins']['id']; ?>" class="fancybox-fast-view" style="overflow: -webkit-paged-x;">
                                                    <?php if (!empty($customer['tech_comments'])): ?>
                                                        <?php echo $customer['tech_comments']; ?>
                                                    <?php endif; ?>
                                                </a>
                                            </td>

                                            <td>
                                                <a title="Click here for edit data" href="#product-pop-up<?php echo $results['ins']['id']; ?>" class=" fancybox-fast-view" style="overflow: -webkit-paged-x;">
                                                    <?php if (!empty($results['ins']['tech_mac'])): ?>
                                                        <?php echo $results['ins']['tech_mac']; ?>
                                                    <?php endif; ?>
                                                </a>
                                            </td>

                                            <!-- BEGIN fast view of a product -->
                                    <div id="product-pop-up<?php echo $ins_id; ?>" style="overflow: -webkit-paged-x;display: none; height: 385px; width: 700px;">
                                        <div class="product-page product-pop-up">
                                            <div class="row">
                                                <div class="controls center text-center">                                              
                                                    <h3>You can easily modify information here</h3><br>
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
                                                        'url' => array('controller' => 'technicians', 'action' => 'update_tech_comment')
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
                                                                    echo $this->Form->input('tech_mac', array(
                                                                        'type' => 'text',
                                                                        'class' => 'form-control required',
                                                                        'title' => 'Write mac information of customer',
                                                                        'placeholder' => 'Write customer mac info',
                                                                        'value' => $results['ins']['tech_mac']
                                                                            )
                                                                    );
                                                                    ?>
                                                                </div>
                                                            </div>
                                                        </div><br>

                                                        <div class="form-group">
                                                            <div class="form-group">
                                                                <div class="col-md-12">
                                                                    <?php
                                                                    echo $this->Form->input('content', array(
                                                                        'type' => 'textarea',
                                                                        'class' => 'form-control required',
                                                                        'title' => 'Update comment of customer',
                                                                        'placeholder' => 'Write Update comment of customer',
                                                                        'value' => $customer['tech_comments']
                                                                            )
                                                                    );
                                                                    ?>
                                                                </div>
                                                            </div>
                                                        </div><br>

                                                        <div class="form-group">
                                                            <div class="form-group">
                                                                <div class="col-md-12">
                                                                    <?php
                                                                    echo $this->Form->input('tech_payment', array(
                                                                        'type' => 'text',
                                                                        'class' => 'form-control required',
                                                                        'title' => 'Write payment information of customer',
                                                                        'placeholder' => 'Write payment info',
                                                                        'value' => $results['ins']['tech_payment']
                                                                            )
                                                                    );
                                                                    ?>
                                                                </div>
                                                            </div>
                                                        </div><br>                                                            
                                                    </div><br>

                                                    <div class="row">
                                                        <div class="col-md-4" style="text-align: right;">                                                                   
                                                            <?php
                                                            echo $this->Form->button(
                                                                    'Update Information', array('class' => 'btn green', 'type' => 'submit')
                                                            );
                                                            ?>
                                                        </div>
                                                    </div>
                                                    <?php echo $this->Form->end(); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END fast view of a product -->
                                    <td>
                                        <?php if (!empty($results['ins']['instruction_tech'])): ?>
                                            <?php echo $results['ins']['instruction_tech']; ?>
                                        <?php endif; ?>
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
<!-- END CONTENT -->

