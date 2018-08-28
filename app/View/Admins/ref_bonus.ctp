
<style type="text/css">
    .alert {
        padding: 6px;
        margin-bottom: 5px;
        border: 1px solid transparent;
        border-radius: 4px;
        text-align: center;
    }
    .center {        
        text-align: center;
    }
</style>

<div class="page-content-wrapper">
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <h3 class="page-title">
            Manage Referral Bonus <small>You can paid, canceled</small>
        </h3>
        <!-- BEGIN PAGE CONTENT-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet box green">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-user"></i>List of Referral Bonus
                        </div>

                        <div class="tools">
                            <a href="<?php // echo Router::url(array('controller' => 'admins', 'action' => 'create'))                             ?>" title="Add new admin" class="fa fa-plus">
                            </a>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <?php echo $this->Session->flash(); ?> 
                        <table class="table table-striped table-hover table-bordered" id="sample_editable_1">
                            <thead>
                                <tr>
                                    <th class="center">SL.</th>
                                    <th class="center">Installation Date</th>
                                    <th>Customer Details</th>
                                    <th>Ref By </th>
                                    <th class="center">Adjustment Date</th>
                                    <th class="center">Adjustment Amount</th>
                                    <th class="center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($ref as $single):
                                    $refs = $single['referrals'];
                                    $customer = $single['package_customers'];
                                    $date = $customer['installation_date'];
                                    $adj_date = date('m-d-Y', strtotime("+2 months", strtotime($date)));

                                    $present_date = date('m-d-Y');

                                    if ($adj_date != $present_date) {
                                        $btn = "disable";
                                    }
                                    $customer_address = $customer['house_no'] . ' ' . $customer['street'] . ' ' .
                                            $customer['apartment'] . ' ' . $customer['city'] . ' ' . $customer['state'] . ' ' . $customer['zip'];
                                    ?>
                                    <tr >
                                        <td class="center"><?php echo $refs['id']; ?></td>
                                        <td class="center">                                            
                                            <?php
                                            $d = '0000-00-00';
                                            if ($customer['installation_date'] != $d):
                                                ?>
                                                <?php echo $customer['installation_date']; ?>
                                            <?php endif; ?>

                                        </td>

                                        <!--validation in td with color-->
                                        <td <?php if ($customer['mac_status'] == 'Active') { ?>
                                                style="background-color: green;" title=" Active"            
                                            <?php } elseif ($customer['mac_status'] == 'Hold') { ?>
                                                style="background-color: orange;" title= "Hold"   
                                            <?php } elseif ($customer['mac_status'] == 'Canceled') { ?>
                                                style=" background-color: red;" title="Canceled"
                                            <?php } ?> >

                                            <b>Name:</b>   <a href="<?php echo Router::url(array('controller' => 'customers', 'action' => 'edit', $refs['referred_for'])) ?>" target="_blank">
                                                <?php
                                                echo $customer['first_name'] . " " . $customer['middle_name'] . " " . $customer['last_name'];
                                                ?> </a><br>

                                            <?php if (!empty($customer['id'])): ?>
                                                <b> ID: </b> <?php echo $customer['id'] ?> 
                                            <?php endif; ?> <br><br>

                                            <?php if (!empty($customer['cell'])): ?>
                                                <b>Cell:</b><?php echo $customer['cell'] ?>   &nbsp;&nbsp;
                                            <?php endif; ?><br>
                                            <b> Address: </b> <?php echo $customer_address; ?> 
                                        </td>
                                        <td>
                                            <?php echo $refs['ref_name']; ?><br>
                                            <?php if ($role4ref == 'sadmin') { ?>
                                                <a title="Click here for modify information :-)" href="#product-pop-up<?php echo $refs['id']; ?>" class="fancybox-fast-view" style="overflow: -webkit-paged-x;">
                                                    <?php echo $refs['ref_cell']; ?>  </a> <br>


                                                <a title="You can open this customer page :-)" href="<?php echo Router::url(array('controller' => 'customers', 'action' => 'edit', $refs['package_customer_id'])) ?>" target="_blank" style="color: orange;">
                                                    <?php echo $refs['package_customer_id']; ?> </a>

                                            <?php } else { ?>
                                                <?php echo $refs['ref_cell']; ?><br>
                                                <?php echo $refs['package_customer_id']; ?>
                                            <?php } ?>

                                            <!-- Excel sheet second pop up for ref bonus execute start -->
                                            <?php if (!empty($refs['id'])): ?>
                                                <div id="product-pop-up<?php echo $refs['id']; ?>" style="overflow: -webkit-paged-x;display: none; height: 385px; width: 700px;">
                                                    <div class="product-page product-pop-up">
                                                        <div class="row">
                                                            <div class="controls center text-center">                                              
                                                                <h3>Change reference information :-)?</h3><br>
                                                                <br><br>
                                                                <div class="form-body">
                                                                    <div class="alert alert-danger display-hide">
                                                                        <button class="close" data-close="alert"></button>
                                                                        You have some form errors. Please check below.
                                                                    </div>
                                                                    <?php echo $this->Session->flash(); ?>
                                                                    <div class="controls center text-center">
                                                                        <?php if (!empty($refs['id'])): ?>   
                                                                            <div id="paidDiv<?php echo $refs['id']; ?>" class="hideRest portlet-body form">

                                                                                <!-- BEGIN FORM-->
                                                                                <?php
                                                                                echo $this->Form->create('ReferralChange', array(
                                                                                    'inputDefaults' => array(
                                                                                        'label' => false,
                                                                                        'div' => false,
                                                                                        'id' => false
                                                                                    ),
                                                                                    'id' => 'form_sample_3',
                                                                                    'class' => 'form-horizontal',
                                                                                    'novalidate' => 'novalidate',
                                                                                    'url' => array('controller' => 'admins', 'action' => 'ref_modify')
                                                                                        )
                                                                                );
                                                                                ?>
                                                                                <?php
                                                                                echo $this->Form->input('package_customer_id', array(
                                                                                    'type' => 'hidden',
                                                                                    'value' => $refs['package_customer_id'],
                                                                                        )
                                                                                );
                                                                                ?>

                                                                                <?php
                                                                                echo $this->Form->input('id', array(
                                                                                    'type' => 'hidden',
                                                                                    'value' => $refs['id'],
                                                                                        )
                                                                                );
                                                                                ?>
                                                                                <div class="portlet-body form">
                                                                                    <div class="alert alert-danger display-hide">
                                                                                        <button class="close" data-close="alert"></button>
                                                                                        You have some form errors. Please check below.
                                                                                    </div>
                                                                                    <?php echo $this->Session->flash(); ?>
                                                                                    <div class="form-group">
                                                                                        <label class="control-label col-md-3">Reference cell no: </label>
                                                                                        <div class="col-md-4">
                                                                                            <?php
                                                                                            echo $this->Form->input('ref_cell', array(
                                                                                                'type' => 'text',
                                                                                                'class' => 'form-control required txtArea',
                                                                                                'placeholder' => 'will you change cell no?'
                                                                                                    )
                                                                                            );
                                                                                            ?>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-group">
                                                                                        <label class="control-label col-md-3">Bonus: </label>
                                                                                        <div class="col-md-4">
                                                                                            <?php
                                                                                            echo $this->Form->input('bonus', array(
                                                                                                'type' => 'text',
                                                                                                'class' => 'form-control required txtArea',
                                                                                                'placeholder' => 'will you change bonus?'
                                                                                                    )
                                                                                            );
                                                                                            ?>
                                                                                        </div>
                                                                                    </div>
                                                                                </div><br><br>
                                                                                <div class="form-actions">
                                                                                    <div class="row">
                                                                                        <?php
                                                                                        echo $this->Form->button(
                                                                                                'Update', array('class' => 'btn green', 'type' => 'submit')
                                                                                        );
                                                                                        ?>
                                                                                    </div>
                                                                                </div>
                                                                                <?php echo $this->Form->end(); ?>
                                                                                <!-- END FORM-->
                                                                            </div>
                                                                        <?php endif; ?>
                                                                    </div>                                                        
                                                                </div>
                                                                <?php echo $this->Form->end(); ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                            <!-- Excel sheet second pop up for ref bonus execute end -->
                                        </td>

                                        <td class="center">
                                            <?php
                                            $dd = '03-31-1970';
                                            $dd1 = '03-01-0000';
                                            if ($adj_date != $dd && $adj_date != $dd1):
                                                ?>
                                                <?php echo $adj_date; ?>
                                            <?php endif; ?>                                        
                                        </td>
                                        <td class="center">$<?php echo $refs['bonus']; ?></td>
                                        <td>   
                                            <div class="controls center text-center">
                                                <a 
                                                    onclick="if (confirm( &quot; Are you sure to cancel this Admin? &quot; )) { return true; } return false;"
                                                    href="<?php echo Router::url(array('controller' => 'admins', 'action' => 'ref_canceled', $refs['id'])) ?>" title="canceled">
                                                    <span class="fa fa-times"></span>
                                                </a> &nbsp;&nbsp; &nbsp;                        
                                                <?php if ($adj_date == $present_date) { ?>
                                                    <?php if ($customer['mac_status'] != 'Hold' && $customer['mac_status'] != 'Canceled') { ?>
                                                        <?php if ($refs['status'] != 'paid'): ?>
                                                            <a aria-describedby="qtip-8" data-hasqtip="true" title="" oldtitle="Paid referral" 
                                                               onclick="if (confirm( &quot; Are you sure to approved this Admin? &quot; )) { return true; } return false;"
                                                               href="<?php
                                                               echo Router::url(array('controller' => 'admins', 'action' => 'approveReferral', $refs['referred_for'], $refs['id'])
                                                               )
                                                               ?>"
                                                               class="tip"><span class="fa  fa-check"></span></a>
                                                            <?php endif; ?>
                                                        <?php } ?>
                                                    <?php } ?>
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
                <!-- END EXAMPLE TABLE PORTLET-->
            </div>
        </div>
        <!-- END PAGE CONTENT -->
    </div>
</div>
<!-- END CONTENT -->

