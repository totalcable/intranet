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
                            <i class="fa fa-plus "></i>

                            <?php if (!empty(($customers['PackageCustomer']))): ?>
                                <?php $mac = $customers['PackageCustomer']; ?>
                            <?php endif; ?>

                            <?php
                            $current_isp_speed = '';
                            $current_service_provider = '';
                            if (!empty($customers['PackageCustomer']['current_isp_speed'])):
                                ?>
                                <?php $current_isp_speed = $customers['PackageCustomer']['current_isp_speed']; ?>
                            <?php endif; ?>

                            <?php if (!empty($customers['PackageCustomer']['current_service_provider'])): ?>
                                <?php $current_service_provider = $customers['PackageCustomer']['current_service_provider']; ?>
                            <?php endif; ?>

                            <span><?php echo show_mac($mac) . ' ' . $current_isp_speed . ' ' . $current_service_provider; ?></span>
                        </div>
                        <div class="tools">
                            <a href="javascript:;" class="reload">
                            </a>
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <!-- BEGIN FORM-->
                        <?php
                        echo $this->Form->create('Ticket', array(
                            'inputDefaults' => array(
                                'label' => false,
                                'div' => false
                            ),
                            'id' => 'form_sample_3',
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
                                <label class="control-label col-md-3">Select Issue<span class="required">
                                        * </span>
                                </label>
                                <div class="form-group">

                                    <div class="col-md-4">
                                        <?php
                                        echo $this->Form->input('issue_id', array(
                                            'type' => 'select',
                                            'options' => $issues,
                                            'empty' => 'Select Issue',
                                            'class' => 'form-control select2me required  issueChange',
                                                )
                                        );
                                        ?>
                                    </div>
                                </div>
                            </div>
                            
                            
                            
                            
                            
                            
                            <div class="form-group display-hide" id="equepment">
                                <label class="control-label col-md-1">SD:<span class="">
                                    </span>
                                </label>
                                <div class="col-md-2">
                                    <?php
                                    echo $this->Form->input(
                                            'deposit', array(
                                        'class' => 'form-control  partial',
                                        'type' => 'number'
                                            )
                                    );
                                    ?>
                                </div>
                                <label class="control-label col-md-1">MB:<span class="">
                                    </span>
                                </label>
                                <div class="col-md-2">
                                    <?php
                                    echo $this->Form->input(
                                            'monthly_bill', array(
                                        'class' => 'form-control  partial ',
                                        'type' => 'number'
                                            )
                                    );
                                    ?>
                                </div>


                                <label class="control-label col-md-1">Equipment:<span class="">
                                    </span>
                                </label>
                                <div class="col-md-2">
                                    <?php
                                    echo $this->Form->input(
                                            'others', array(
                                        'class' => 'form-control  partial',
                                        'type' => 'number'
                                            )
                                    );
                                    ?>
                                </div>
                                <label class="control-label col-md-1">Total:<span class="">
                                    </span>
                                </label>
                                <div class="col-md-2">
                                    <?php
                                    echo $this->Form->input(
                                            'total', array(
                                        'class' => 'form-control input-sm total',
                                        'type' => 'number',
                                        'readonly' => 'readonly'
                                            )
                                    );
                                    ?>
                                </div>
                            </div>
                            <div class="form-group display-hide" id="check_mac">
                                <label class="control-label col-md-3">
                                </label>
                                <div class="col-md-8">
                                    <div class="checkbox-list">
                                        <?php echo generate_mac($customers['PackageCustomer']); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group display-hide" id="hold">
                                <label class="control-label col-md-3">Hold Date<span class="">
                                        * </span>
                                </label>
                                <div class="form-group">
                                    <div class="col-md-4">
                                        <?php
                                        echo $this->Form->input('hold_date', array(
                                            'type' => 'text',
                                            'class' => 'datepicker form-control'
                                                )
                                        );
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group display-hide" id="canceldate">
                                <label class="control-label col-md-3">Cancel Date<span class="">
                                        * </span>
                                </label>
                                <div class="form-group">
                                    <div class="col-md-4">
                                        <?php
                                        echo $this->Form->input('cancelled_date', array(
                                            'type' => 'text',
                                            'class' => 'datepicker form-control'
                                                )
                                        );
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group display-hide" id="pickup_date">
                                <label class="control-label col-md-3">Expected Pickup Date<span class="">
                                        * </span>
                                </label>
                                <div class="form-group">
                                    <div class="col-md-4">
                                        <?php
                                        echo $this->Form->input('pickup_date', array(
                                            'type' => 'text',
                                            'class' => 'datepicker form-control '
                                                )
                                        );
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group display-hide" id="unhold">
                                <label class="control-label col-md-3">Unhold Date<span class="">
                                        * </span>
                                </label>
                                <div class="form-group">

                                    <div class="col-md-4">
                                        <?php
                                        echo $this->Form->input('unhold_date', array(
                                            'type' => 'text',
                                            'class' => 'datepicker form-control'
                                                )
                                        );
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group display-hide"id="reconnect">
                                <label class="control-label col-md-3">Reconnect Date<span class="">
                                        * </span>
                                </label>
                                <div class="form-group">

                                    <div class="col-md-4">
                                        <?php
                                        echo $this->Form->input('reconnect_date', array(
                                            'type' => 'text',
                                            'class' => 'datepicker form-control'
                                                )
                                        );
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group display-hide" id="new_addr" >
                                <label class="control-label col-md-3">New Address
                                </label>
                                <div class="form-group">
                                    <div class="col-md-4">
                                        <?php
                                        echo $this->Form->input('new_addr', array(
                                            'type' => 'textarea',
                                            'class' => 'form-control ',
                                            'placeholder' => 'Type new adrress here...'
                                                )
                                        );
                                        ?>
                                    </div>
                                </div>
                            </div>
                            

                            <div id="shipmentshow_hide" style="display: none" class="alert alert-success">
                                <div class="form-group">
                                    <label class="control-label col-md-2">Select Equipment to be sent<span class="">
                                        </span>
                                    </label>
                                    <div class="col-md-2">
                                        <?php
                                        echo $this->Form->input('shipment_equipment', array(
                                            'type' => 'select',
                                            'options' => array(
                                                'ONLY OLD BOX' => 'ONLY OLD BOX',
                                                'OLD BOX WITH ALL EQUIPMENT' => 'OLD BOX WITH ALL EQUIPMENT',
                                                'ONLY NEW BOX 254' => 'ONLY NEW BOX 254',
                                                'ONLY NEW BOX 250' => 'ONLY NEW BOX 250',
                                                'NEW BOX 254 WITH ALL EQUIPMENT' => 'NEW BOX 254 WITH ALL EQUIPMENT',
                                                'NEW BOX 250 WITH ALL EQUIPMENT' => 'NEW BOX 250 WITH ALL EQUIPMENT',
                                                'OLD REMOTE' => 'OLD REMOTE',
                                                'NEW REMOTE' => 'NEW REMOTE',
                                                'ROUTER' => 'ROUTER',
                                                'DONGLE' => 'DONGLE',
                                                'WIRE' => 'WIRE',
                                                'ONLY HDMI' => 'ONLY HDMI',
                                                'ONLY AVI' => 'ONLY AVI',
                                                'ADAPTER' => 'ADAPTER',
                                                'OTHER' => 'OTHER'
                                            ),
                                            'empty' => 'Select Equipment',
                                            'class' => ' form-control input-medium',
                                            'id' => 'shipment_equipment_list'
                                                )
                                        );
                                        ?>
                                    </div>

                                    <div class="display-hide" id="other_shipment_equipment">
                                        <label class="control-label col-md-2">Type Equipment Here<span class="">
                                            </span>
                                        </label>
                                        <div class="col-md-2">
                                            <?php
                                            echo $this->Form->input(
                                                    'shipment_equipment_other', array(
                                                'class' => 'form-control ',
                                                'type' => 'text'
                                                    )
                                            );
                                            ?>
                                        </div>

                                    </div>
                                    <label class="control-label col-md-2">Number of equipment<span class="">
                                        </span>
                                    </label>
                                    <div class="col-md-2">
                                        <?php
                                        echo $this->Form->input('remote_no', array(
                                            'type' => 'select',
                                            'options' => array('1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5', '6' => '6', '7' => '7',
                                                '9' => '9', '10' => '10', '11' => '11', '12' => '12', '13' => '13', '14' => '14', '15' => '15'),
                                            'empty' => 'Select here',
                                            'class' => 'form-control select2me  priority_input',
                                                )
                                        );
                                        ?>
                                    </div>

                                    <label class="control-label col-md-2">Additional Note<span class="">
                                        </span>
                                    </label>
                                    <div class="col-md-2">
                                        <?php
                                        echo $this->Form->input(
                                                'shipment_note', array(
                                            'class' => 'form-control ',
                                            'type' => 'textarea'
                                                )
                                        );
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group assign_single">
                                <label class="control-label col-md-3">Assign to (Individual)
                                </label>
                                <div class="form-group">

                                    <div class="col-md-4">
                                        <?php
                                        echo $this->Form->input('user_id', array(
                                            'type' => 'select',
                                            'options' => $users,
                                            'empty' => 'Select user',
                                            'class' => 'form-control select2me',
                                                )
                                        );
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group assign_group">
                                <label class="control-label col-md-3">Assign to (Department)
                                </label>
                                <div class="form-group">

                                    <div class="col-md-4">
                                        <?php
                                        echo $this->Form->input('role_id', array(
                                            'type' => 'select',
                                            'options' => $roles,
                                            'empty' => 'Select Department or Role',
                                            'class' => 'form-control select2me',
                                                )
                                        );
                                        ?>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-group" id="action" >
                                <label class="control-label col-md-3">Select Action 
                                </label>
                                <div class="form-group">
                                    <div class="col-md-4">
                                        <?php
                                        echo $this->Form->input('action_type', array(
                                            'type' => 'select',
                                            'options' => array(
                                                'ready ' => 'Troubleshoot Tech',
                                                'shipment' => 'Troubleshoot shipment',
                                                'solved ' => "It's Solved"
                                            ),
                                            'empty' => 'Select Action',
                                            'class' => 'form-control select2me ',
                                            'id' => 'action_type'
                                                )
                                        );
                                        ?>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-group priority">
                                <label class="control-label col-md-3">Select Priority<span class="required">
                                        * </span>
                                </label>
                                <div class="form-group">

                                    <div class="col-md-4">
                                        <?php
                                        echo $this->Form->input('priority', array(
                                            'type' => 'select',
                                            'options' => array('low' => 'Low', 'medium' => 'Medium', 'high' => 'High'),
                                            'empty' => 'Select Priority',
                                            'class' => 'form-control select2me required priority_input',
                                                )
                                        );
                                        ?>
                                    </div>
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="control-label col-md-3">Ticket Details 
                                </label>
                                <div class="col-md-9">
                                    <?php
                                    echo $this->Form->input(
                                            'content', array(
                                        'class' => 'form-control required ckeditor',
                                        'data-error-container' => '#editor2_error',
                                        'rows' => 6,
                                        'type' => 'textarea',
                                        'id' => 'desc'
                                            )
                                    );
                                    ?>


                                </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-6 col-md-4">
                                    <?php
                                    echo $this->Form->button(
                                            'Create', array('class' => 'btn green', 'type' => 'submit')
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
    </div>
</div>
<!-- END CONTENT -->

