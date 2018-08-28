<style type="text/css">
    .alert {
        padding: 6px;
        margin-bottom: 5px;
        border: 1px solid transparent;
        border-radius: 4px;
        text-align: center;
    }

</style>
<?php
$btn = '';
if ($role4ref != 'sadmin') {
    $btn = "disabled";
}
?>

<div class="page-content-wrapper">
    <div class="page-content">
        <!-- BEGIN PAGE CONTENT-->
        <div class="row">
            <div class="col-md-12">
                <div class="portlet box green">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-plus"></i>Edit Customer
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
                            'id' => 'form_sample_3',
                            'class' => 'form-horizontal',
                            'novalidate' => 'novalidate'
                                )
                        );
                        ?>
                        <?php
                        echo $this->Form->input(
                                'id', array(
                            'value' => $this->params['pass'][0],
                            'type' => 'hidden'
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
                                <label class="control-label col-md-2">First Name<span class="required">
                                    </span>
                                </label>
                                <div class="col-md-2">
                                    <?php
                                    echo $this->Form->input(
                                            'first_name', array(
                                        'class' => 'form-control ',
                                        'type' => 'text'
                                            )
                                    );
                                    ?>
                                </div>
                                <label class="control-label col-md-2">Middle Name<span class="required">
                                    </span>
                                </label>
                                <div class="col-md-2">
                                    <?php
                                    echo $this->Form->input(
                                            'middle_name', array(
                                        'class' => 'form-control ',
                                        'type' => 'text'
                                            )
                                    );
                                    ?>
                                </div>
                                <label class="control-label col-md-2">Last Name<span class="required">
                                    </span>
                                </label>
                                <div class="col-md-2">
                                    <?php
                                    echo $this->Form->input(
                                            'last_name', array(
                                        'class' => 'form-control ',
                                        'type' => 'text'
                                            )
                                    );
                                    ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2">Address:<span class="required">
                                    </span>
                                </label>
                                <div class="col-md-2">
                                    <?php
                                    echo $this->Form->input(
                                            'house_no', array(
                                        'class' => 'form-control ',
                                        'type' => 'text'
                                            )
                                    );
                                    ?>
                                </div>
                                <label class="control-label col-md-2">Street:<span class="required">
                                    </span>
                                </label>
                                <div class="col-md-2">
                                    <?php
                                    echo $this->Form->input(
                                            'street', array(
                                        'class' => 'form-control ',
                                        'type' => 'text'
                                            )
                                    );
                                    ?>
                                </div>
                                <label class="control-label col-md-2">Apartment:<span class="required">
                                    </span>
                                </label>
                                <div class="col-md-2">
                                    <?php
                                    echo $this->Form->input(
                                            'apartment', array(
                                        'class' => 'form-control ',
                                        'type' => 'text'
                                            )
                                    );
                                    ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2">City:<span class="required">
                                    </span>
                                </label>
                                <div class="col-md-2">
                                    <?php
                                    echo $this->Form->input(
                                            'city', array(
                                        'class' => 'form-control ',
                                        'type' => 'text'
                                            )
                                    );
                                    ?>
                                </div>
                                <label class="control-label col-md-2">State:<span class="required">
                                    </span>
                                </label>
                                <div class="col-md-2">
                                    <?php
                                    echo $this->Form->input(
                                            'state', array(
                                        'class' => 'form-control ',
                                        'type' => 'text'
                                            )
                                    );
                                    ?>
                                </div>
                                <label class="control-label col-md-2">Zip:<span class="required">
                                    </span>
                                </label>
                                <div class="col-md-2">
                                    <?php
                                    echo $this->Form->input(
                                            'zip', array(
                                        'class' => 'form-control ',
                                        'type' => 'text'
                                            )
                                    );
                                    ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2">Phone: Home:<span class="required">
                                    </span>
                                </label>
                                <div class="col-md-2">
                                    <?php
                                    echo $this->Form->input(
                                            'home', array(
                                        'class' => 'form-control ',
                                        'type' => 'text'
                                            )
                                    );
                                    ?>
                                </div>
                                <label class="control-label col-md-2">Cell:<span class="required">
                                    </span>
                                </label>
                                <div class="col-md-2">
                                    <?php
                                    echo $this->Form->input(
                                            'cell', array(
                                        'class' => 'form-control ',
                                        'type' => 'text'
                                            )
                                    );
                                    ?>
                                </div>
                                <label class="control-label col-md-2">E-Mail<span class="required">
                                    </span>
                                </label>
                                <div class="col-md-2">
                                    <?php
                                    echo $this->Form->input(
                                            'email', array(
                                        'class' => 'form-control ',
                                        'type' => 'text',
                                        'placeholder' => 'Optional'
                                            )
                                    );
                                    ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-1">Fax<span class="required">
                                    </span>
                                </label>
                                <div class="col-md-2">
                                    <?php
                                    echo $this->Form->input(
                                            'fax', array(
                                        'class' => 'form-control ',
                                        'placeholder' => 'Fax',
                                        'type' => 'text'
                                            )
                                    );
                                    ?>
                                </div>

                                <label class="control-label col-md-1">Issue<span class="required">
                                    </span>
                                </label>
                                <div class="col-md-2">
                                    <?php
                                    echo $this->Form->input('issue_id', array(
                                        'type' => 'select',
                                        'options' => $issues,
                                        'empty' => 'Select Issue',
                                        'class' => 'form-control select2me   issueChange',
                                            )
                                    );
                                    ?>
                                </div>

                                <label class="control-label col-md-1">Package<span class="required">
                                    </span>
                                </label>
                                <div class="col-md-2">
                                    <?php
                                    echo $this->Form->input('psetting_id', array(
                                        'type' => 'select',
                                        'class' => 'form-control ',
                                        'options' => $packageList,
                                        'empty' => '--Select Package Type--',
                                        'id' => 'psettingId',
                                            )
                                    );
                                    ?>
                                </div>

                                <div id="custompackage" style="display: none;">
                                    <div class="col-md-2">
                                        <?php
                                        $arrCategory = array("1" => "1 Month", "3" => "3 Month", "6" => "6 Month", "12" => "1 Year");
                                        echo $this->Form->input(
                                                'duration', array(
                                            'class' => 'form-control',
                                            'id' => 'selctMonth',
                                            'options' => $arrCategory,
                                            'label' => false,
                                            'empty' => '--Select Month--',
                                                )
                                        );
                                        ?>
                                    </div>

                                    <div class="col-md-2">
                                        <?php
                                        echo $this->Form->input(
                                                'charge', array(
                                            'class' => 'form-control',
                                            'id' => 'inputAmount',
                                            'type' => 'number',
                                            'placeholder' => 'Amount'
                                                )
                                        );
                                        ?> 
                                    </div>

                                </div>
                                <label class="control-label col-md-2"> Custom Package<span class="required">
                                    </span>
                                </label>
                                <div class="col-md-1">
                                    <div class="checkbox-list">
                                        <label>
                                            <input type="checkbox"id="customcheckbox" > 
                                        </label>

                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                <div class="col-md-12 ">
                                    <div class="form-group display-hide " id="reward6">  
                                        <div class="col-md-2 signupfont">
                                            Promotional offer:
                                        </div>
                                        <div class="col-md-3">
                                            <div class="input-list style-4 clearfix">
                                                <div>

                                                    <?php
                                                    echo $this->Form->input('reward6', array(
                                                        'type' => 'select',
                                                        'options' => array(
                                                            '1 month free' => '1 Month Free',
                                                            '$40 calling card' => '$40 Calling Card',
                                                            '$20 cash reward' => '$20 Cash Reward'),
                                                        'empty' => '--Select one--',
                                                        'class' => 'form-control',
                                                        'id' => 'reward6'
                                                    ));
                                                    ?>

                                                </div>                            
                                            </div>
                                        </div> 
                                    </div> 
                                    <div class="form-group display-hide " id="reward12">  
                                        <div class="col-md-2 signupfont">
                                            Promotional offer:
                                        </div>
                                        <div class="col-md-3">
                                            <div class="input-list style-4 clearfix">
                                                <div>
                                                    <?php
                                                    echo $this->Form->input('reward12', array(
                                                        'type' => 'select',
                                                        'options' => array(
                                                            '3 month free' => '3 Month Free',
                                                            '$100 calling card' => '$100 Calling Card',
                                                            '$40 cash reward' => '$40 Cash Reward'),
                                                        'empty' => '--Select one--',
                                                        'class' => 'form-control',
                                                        'id' => 'reward12'
                                                    ));
                                                    ?>
                                                </div>
                                            </div> 
                                        </div>
                                    </div> 
                                </div>
                            </div> 
                            <?php if ($ref_cell_no != 0) { ?>
                                <div class="form-group">
                                    <label class="control-label col-md-2">Referred Cell:<span class="required">
                                        </span>
                                    </label>
                                    <div class="col-md-2">                                   
                                        <?php
                                        echo $this->Form->input('reffered_by', array(
                                            'type' => 'text',
                                            'class' => 'form-control',
                                            'value' => $ref_cell_no,
                                            'disabled' => $btn,
                                                )
                                        );
                                        ?>
                                    </div>

                <!--                                <label class="control-label col-md-2">Referred Name:<span class="required">
                                                    </span>
                                                </label>
                                                <div class="col-md-2">
                                    <?php
                                    echo $this->Form->input('referred_cell', array(
                                        'type' => 'text',
                                        'class' => 'form-control',
                                        'disabled' => $btn,
                                            )
                                    );
                                    ?>
                                                </div>-->

                                    <label class="control-label col-md-2">Bonus:<span class="required">
                                        </span>
                                    </label>
                                    <div class="col-md-2">
                                        <?php
                                        echo $this->Form->input(
                                                'bonus', array(
                                            'class' => 'form-control ',
                                            'value' => $bonus,
                                            'type' => 'text',
                                            'disabled' => $btn,
                                                )
                                        );
                                        ?>
                                    </div>                                
                                </div>
                            <?php } else { ?>
                                <div class="form-group">
                                    <label class="control-label col-md-2">Referred Cell:<span class="required">
                                        </span>
                                    </label>
                                    <div class="col-md-2">                                   
                                        <?php
                                        echo $this->Form->input('reffered_by', array(
                                            'type' => 'text',
                                            'class' => 'form-control',
                                            'placeholder' => 'Set referral cell',
                                            'disabled' => $btn,
                                                )
                                        );
                                        ?>
                                    </div>
                                    <label class="control-label col-md-2">Bonus:<span class="required">
                                        </span>
                                    </label>
                                    <div class="col-md-2">
                                        <?php
                                        echo $this->Form->input(
                                                'bonus', array(
                                            'class' => 'form-control ',
                                            'placeholder' => 'Set referral bonus',
                                            'type' => 'text',
                                            'disabled' => $btn,
                                                )
                                        );
                                        ?>
                                    </div>                                
                                </div>
                            <?php } ?>
                            <div class="form-group">

                                <label class="control-label col-md-2">Set Top Box<span class="required">
                                    </span>
                                </label>
                                <div class="col-md-2">
                                    <?php
                                    $arrCategory = array("1" => "1 box", "2" => "2 box", "3" => "3 box", "4" => "4 box");
                                    echo $this->Form->input(
                                            'equipment_top_box', array(
                                        'class' => 'form-control',
                                        'id' => 'selctMonth',
                                        'options' => $arrCategory,
                                        'label' => false,
                                        'empty' => '--Select Box Number--',
                                            )
                                    );
                                    ?>
                                </div>
                                <label class="control-label col-md-2">Current ISP and Speed<span class="required">
                                    </span>
                                </label>
                                <div class="col-md-2">
                                    <?php
                                    echo $this->Form->input(
                                            'current_isp_speed', array(
                                        'class' => 'form-control ',
                                        'placeholder' => 'ISP 5',
                                        'type' => 'text'
                                            )
                                    );
                                    ?>
                                </div>
                                <label class="control-label col-md-2">Service Provider<span class="required">
                                    </span>
                                </label>
                                <div class="col-md-2">
                                    <?php
                                    echo $this->Form->input(
                                            'current_service_provider', array(
                                        'class' => 'form-control ',
                                        'type' => 'text'
                                            )
                                    );
                                    ?>
                                </div>

                            </div>
                            <hr/>
                            <div class="form-group">
                                <label class="control-label col-md-1">Security Deposit:<span class="required">
                                    </span>
                                </label>
                                <div class="col-md-2">
                                    <?php
                                    echo $this->Form->input(
                                            'deposit', array(
                                        'class' => 'form-control',
                                        'type' => 'number'
                                            )
                                    );
                                    ?>
                                </div>
                                <label class="control-label col-md-1">Monthly Bill:<span class="required">
                                    </span>
                                </label>
                                <div class="col-md-2">
                                    <?php
                                    echo $this->Form->input(
                                            'monthly_bill', array(
                                        'class' => 'form-control',
                                        'type' => 'number'
                                            )
                                    );
                                    ?>
                                </div>


                                <label class="control-label col-md-1">Equipment:<span class="required">
                                    </span>
                                </label>
                                <div class="col-md-2">
                                    <?php
                                    echo $this->Form->input(
                                            'others', array(
                                        'class' => 'form-control',
                                        'type' => 'number'
                                            )
                                    );
                                    ?>
                                </div>
                                <label class="control-label col-md-1">Total:<span class="required">
                                    </span>
                                </label>
                                <div class="col-md-2">
                                    <?php
                                    echo $this->Form->input(
                                            'total', array(
                                        'class' => 'form-control',
                                        'type' => 'number'
//                                        'readonly' => 'readonly'
                                            )
                                    );
                                    ?>
                                </div>
                            </div>

                            <br>
                            <div class="form-group">
                                <label class="control-label col-md-2">Select Equipment to be sent<span class="required">
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
                                    <div class="col-md-2">
                                        <?php
                                        echo $this->Form->input(
                                                'shipment_equipment_other', array(
                                            'class' => 'form-control ',
                                            'placeholder' => 'Type Equipment',
                                            'type' => 'text'
                                                )
                                        );
                                        ?>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <?php
                                    echo $this->Form->input(
                                            'shipment_note', array(
                                        'class' => 'form-control ',
                                        'placeholder' => 'Type additional note here..',
                                        'type' => 'textarea'
                                            )
                                    );
                                    ?>
                                </div>
                                <label class="control-label col-md-2"><span class="required">
                                    </span>
                                </label>
                                <div class="col-md-3">
                                    <?php
                                    echo $this->Form->input(
                                            'attachment', array(
                                        'class' => 'form-control ',
                                        'type' => 'file'
                                            )
                                    );
                                    ?>
                                </div>

                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2 blink_me" style="color: red">Shipment <span class="required">
                                    </span>
                                </label>
                                <div class="col-md-2">
                                    <div class="checkbox-list">
                                        <label>
                                            <?php
                                            echo $this->Form->input(
                                                    'shipment', array(
                                                'type' => 'checkbox',
                                                'value' => '1',
                                                'id' => 'shipment',
                                                    )
                                            );
                                            ?>
                                        </label>

                                    </div>
                                </div>

                            </div>
                            <!--                            <div id="shipmentshow_hide" style="display: none">
                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">Driving lisence or Social Security<span class="required">
                                                                    </span>
                                                                </label>
                                                                <div class="col-md-2">
                            <?php
                            echo $this->Form->input(
                                    'driving_socialsecurity', array(
                                'class' => 'form-control ',
                                'type' => 'text'
                                    )
                            );
                            ?>
                                                                </div>
                            
                                                                <label class="control-label col-md-2">First name<span class="required">
                                                                    </span>
                                                                </label>
                                                                <div class="col-md-2">
                            <?php
                            echo $this->Form->input(
                                    'cfirst_name', array(
                                'class' => 'form-control ',
                                'type' => 'text'
                                    )
                            );
                            ?>
                                                                </div>
                                                                <label class="control-label col-md-2">Last name<span class="required">
                                                                    </span>
                                                                </label>
                                                                <div class="col-md-2">
                            <?php
                            echo $this->Form->input(
                                    'clast_name', array(
                                'class' => 'form-control ',
                                'type' => 'text'
                                    )
                            );
                            ?>
                                                                </div>
                                                            </div>
                            
                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">Customer Utility:<span class="required">
                                                                    </span>
                                                                </label>
                                                                <div class="col-md-2">
                                                                    <div class="radio-list">
                                                                        <label class="radio-inline">
                                                                            <input type="radio" name="data[PackageCustomer][customer_utility]" id="optionsRadios4" value="YES"> Yes </label>
                                                                        <label class="radio-inline">
                                                                            <input type="radio" name="data[PackageCustomer][customer_utility]" id="optionsRadios5" value="NO"> No</label>
                                                                    </div>
                                                                </div>
                                                                <label class="control-label col-md-2">Card no:<span class="required">
                                                                    </span>
                                                                </label>
                                                                <div class="col-md-2">
                            <?php
                            echo $this->Form->input(
                                    'card_check_no', array(
                                'class' => 'form-control ',
                                'type' => 'text'
                                    )
                            );
                            ?>
                                                                </div>
                                                                <label class="control-label col-md-2">CVV Code:<span class="required">
                                                                    </span>
                                                                </label>
                                                                <div class="col-md-2">
                            <?php
                            echo $this->Form->input(
                                    'cvv_code', array(
                                'class' => 'form-control ',
                                'type' => 'text'
                                    )
                            );
                            ?>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-2">Exp. Date:<span class="required">
                                                                    </span>
                                                                </label>
                                                                <div class="col-md-2">
                            <?php
                            echo $this->Form->input('exp_date.year', array(
                                'type' => 'select',
                                'options' => $ym['year'],
                                'empty' => 'Select Year',
                                'class' => ' form-control input-medium',
                                'div' => array('class' => 'span12 ')
                                    )
                            );
                            ?>
                                                                </div>
                                                                <label class="control-label col-md-2">Select month<span class="required">
                                                                    </span>
                                                                </label>
                                                                <div class="col-md-2">
                            <?php
                            echo $this->Form->input('exp_date.month', array(
                                'type' => 'select',
                                'options' => $ym['month'],
                                'empty' => 'Select Month',
                                'class' => 'form-control input-medium',
                                'div' => array('class' => 'span12 ')
                                    )
                            );
                            ?> 
                                                                </div>
                                                                <label class="control-label col-md-2">Address on Card:<span class="required">
                                                                    </span>
                                                                </label>
                                                                <div class="col-md-2">
                            <?php
                            echo $this->Form->input(
                                    'czip', array(
                                'class' => 'form-control ',
                                'type' => 'text',
                                'placeholder' => 'Zip & detail (optional)',
                                    )
                            );
                            ?>
                                                                </div>
                                                            </div>
                                                        </div>-->
                            <div id="shipmentshow_hide" style="display: none" class="alert alert-success">

                                <div class="form-group">
                                    <label class="control-label col-md-2">Driving lisence or Social Security<span class="required">
                                        </span>
                                    </label>
                                    <div class="col-md-2">
                                        <?php
                                        echo $this->Form->input(
                                                'driving_socialsecurity', array(
                                            'class' => 'form-control ',
                                            'type' => 'text'
                                                )
                                        );
                                        ?>
                                    </div>

                                    <label class="control-label col-md-2">First name<span class="required">
                                        </span>
                                    </label>
                                    <div class="col-md-2">
                                        <?php
                                        echo $this->Form->input(
                                                'cfirst_name', array(
                                            'class' => 'form-control ',
                                            'type' => 'text'
                                                )
                                        );
                                        ?>
                                    </div>
                                    <label class="control-label col-md-2">Last name<span class="required">
                                        </span>
                                    </label>
                                    <div class="col-md-2">
                                        <?php
                                        echo $this->Form->input(
                                                'clast_name', array(
                                            'class' => 'form-control ',
                                            'type' => 'text'
                                                )
                                        );
                                        ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2">Customer Utility:<span class="required">
                                        </span>
                                    </label>
                                    <div class="col-md-2">
                                        <div class="radio-list">
                                            <label class="radio-inline">
                                                <input type="radio" name="data[PackageCustomer][customer_utility]" id="optionsRadios4" value="YES"> Yes </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="data[PackageCustomer][customer_utility]" id="optionsRadios5" value="NO"> No</label>
                                        </div>
                                    </div>

                                    <label class="control-label col-md-2">Card no:<span class="required">
                                        </span>
                                    </label>
                                    <div class="col-md-2">
                                        <?php
                                        echo $this->Form->input(
                                                'card_check_no', array(
                                            'class' => 'form-control ',
                                            'type' => 'text'
                                                )
                                        );
                                        ?>
                                    </div>
                                    <label class="control-label col-md-2">CVV Code:<span class="required">
                                        </span>
                                    </label>
                                    <div class="col-md-2">
                                        <?php
                                        echo $this->Form->input(
                                                'cvv_code', array(
                                            'class' => 'form-control ',
                                            'type' => 'text'
                                                )
                                        );
                                        ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2">Exp. Date:<span class="required">
                                        </span>
                                    </label>
                                    <div class="col-md-2">
                                        <?php
                                        echo $this->Form->input('exp_date.year', array(
                                            'type' => 'select',
                                            'options' => $ym['year'],
                                            'empty' => 'Select Year',
                                            'class' => ' form-control input-medium',
                                            'div' => array('class' => 'span12 ')
                                                )
                                        );
                                        ?>
                                    </div>
                                    <label class="control-label col-md-2">Select month<span class="required">
                                        </span>
                                    </label>
                                    <div class="col-md-2">
                                        <?php
                                        echo $this->Form->input('exp_date.month', array(
                                            'type' => 'select',
                                            'options' => $ym['month'],
                                            'empty' => 'Select Month',
                                            'class' => 'form-control input-medium',
                                            'div' => array('class' => 'span12 ')
                                                )
                                        );
                                        ?> 
                                    </div>
                                    <label class="control-label col-md-2">Address on Card:<span class="required">
                                        </span>
                                    </label>
                                    <div class="col-md-2">
                                        <?php
                                        echo $this->Form->input(
                                                'czip', array(
                                            'class' => 'form-control ',
                                            'type' => 'text',
                                            'placeholder' => 'Zip & detail (optional)',
                                                )
                                        );
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2 blink_me" style="color: red">Follow up this Customer<span class="required">
                                    </span>
                                </label>
                                <div class="col-md-1">
                                    <div class="checkbox-list">
                                        <label>
                                            <?php
                                            echo $this->Form->input(
                                                    'follow_up', array(
                                                'type' => 'checkbox',
                                                'value' => '1 ',
                                                'id' => 'additioninfo',
                                                    )
                                            );
                                            ?>

                                        </label>

                                    </div>
                                </div>
                                <div id="Additional_info" style="display: none" >

                                    <label class="control-label col-md-1">Date<span class="required">
                                        </span>
                                    </label>
                                    <div class="col-md-2">
                                        <?php
                                        echo $this->Form->input(
                                                'follow_date', array(
                                            'type' => 'text',
                                            'class' => 'datepicker form-control '
                                                )
                                        );
                                        ?>

                                    </div>

                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-2 blink_me" style="color: red">Dealer<span class="required">
                                    </span>
                                </label>
                                <div class="col-md-1">
                                    <div class="checkbox-list">
                                        <label>
                                            <?php
                                            echo $this->Form->input(
                                                    'dealer', array(
                                                'type' => 'checkbox',
                                                'id' => 'dealer',
                                                    )
                                            );
                                            ?>

                                        </label>

                                    </div>
                                </div>
                                <div id="dshow" style="display: none" >
                                    <label class="control-label col-md-1">Name<span class="required">
                                        </span>
                                    </label>
                                    <div class="col-md-2">
                                        <?php
                                        echo $this->Form->input(
                                                'dealer', array(
                                            'class' => 'form-control ',
                                            'type' => 'text'
                                                )
                                        );
                                        ?>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-2">Comment<span class="required">
                                    </span>
                                </label>
                                <div class="col-md-9">
                                    <?php
                                    echo $this->Form->input(
                                            'comments', array(
                                        'class' => 'form-control',
                                        'type' => 'textarea',
                                        'value' => $lastComment['content'],
                                        'rows' => '3',
                                            )
                                    );
                                    ?>
                                </div>
                            </div>
                            <?php
                            echo $this->Form->input(
                                    'comment_id', array(
                                'type' => 'hidden',
                                'value' => $lastComment['id']
                                    )
                            );
                            ?>

                        </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-6 col-md-4">
                                    <?php
                                    echo $this->Form->button(
                                            'Update', array('class' => 'btn green', 'type' => 'submit')
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

