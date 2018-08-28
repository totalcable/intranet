
<style type="text/css">
    .alert {
        padding: 6px;
        margin-bottom: 5px;
        border: 1px solid transparent;
        border-radius: 4px;
        text-align: center;
    }
    .txtArea { width:300px; }
    .signupfont{
        font-size: 14px !important; 
    }
    .fancybox-inner{
        width:844px !important;
    }
    .fancybox-wrap {
        width: 860px !important;
    }
</style>
<?php
$btn = '';
if (strtolower($status) == 'inactive' || strtolower($status) == 'hold') {
//    $btn = "disabled";
}
?>
<div class="page-content-wrapper">
    <!-- BEGIN PAGE CONTENT-->
    <div class="page-content">
        <div  class="col-md-12 col-sm-12">
            <h3 class="page-title">
                Complete the transactions <small>(individually)</small>
            </h3>
            <?php echo $this->Session->flash(); ?>
            <!-- END EXAMPLE TABLE PORTLET-->
            <div class="col-md-12">
                <div class="portlet box green">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-list-ul"></i>Customer Information
                            <strong style="color: #191818;;">ACCT NO. <?php echo $c_acc_no; ?></strong>
                            <?php
                            $created = date("Y-m-d", strtotime($customer_info['PackageCustomer']['created']));
                            $curr_date = date('Y-m-d');
                            $diff = abs(strtotime($curr_date) - strtotime($created));
                            $years = floor($diff / (365 * 60 * 60 * 24));
                            $status = '';
                            $color = '';
                            if ($years > 1 && $years < 3) {
                                $status = "Gold Customer";
                                $color = 'gold;';
                            } else if ($years >= 3) {
                                $status = "Platinum Customer";
                                $color = '#E5E4E2;';
                            }
                            ?>
                            <strong style="color: <?php $color; ?>">
                                <?php echo $status; ?>
                            </strong>
                            Balance : $<strong class="due-amount">
                            </strong>
                            </strong>&nbsp; <b style=" color: gold;">
                                <?php
                                if (!empty($customer_info['PackageCustomer']['mac_status'])) {
                                    echo $customer_info['PackageCustomer']['mac_status'];
                                }
                                ?>

                            </b></strong>
                        </div>
                        <div class="tools">
                            <a  class="reload toggle" data-id="customer_information">
                            </a>
                        </div>
                        <div class="tools">
                            <a href="<?php echo Router::url(array('controller' => 'customers', 'action' => 'search')) ?>" class="btnPrev"  style="color:  #E02222;">Back &nbsp;
                            </a>
                        </div>
                        <div class="tools">
                            <?php $created = date("Y-m-d", strtotime($customer_info['PackageCustomer']['created'])); ?>
                            <strong style="color: #191818;">Since. <?php echo $created; ?></strong>
                            <?php ?>
                        </div>
                    </div>
                    <div class="portlet-body" id="customer_information">
                        <?php echo $this->Session->flash() ?>
                        <?php
                        echo $this->Form->create('PackageCustomer', array(
                            'inputDefaults' => array(
                                'label' => false,
                                'div' => false
                            ),
                            'id' => 'form-validate',
                            'class' => 'form-horizontal',
                            'novalidate' => 'novalidate',
                            'enctype' => 'multipart/form-data'
                                )
                        );
                        ?>
                        <br>
                        <div class="row">
                            <div class="col-md-12 ">
                                <div class="col-md-2 signupfont">
                                    Name: First:
                                </div>
                                <div class="col-md-2">
                                    <div class="input-list style-4 clearfix">
                                        <div>
                                            <?php
                                            echo $this->Form->input(
                                                    'first_name', array(
                                                'class' => '',
                                                'id' => 'first'
                                                    )
                                            );
                                            ?> 
                                        </div>                            
                                    </div>
                                </div>
                                <div class="col-md-1 signupfont">
                                    Middle:
                                </div>
                                <div class="col-md-3">
                                    <div class="input-list style-4 clearfix">
                                        <div>
                                            <?php
                                            echo $this->Form->input(
                                                    'middle_name', array(
                                                'class' => ''
                                                    )
                                            );
                                            ?> 
                                        </div>                            
                                    </div>
                                </div>
                                <div class="col-md-1 signupfont">
                                    Last: 
                                </div>
                                <div class="col-md-3">
                                    <div class="input-list style-4 clearfix">
                                        <div>
                                            <?php
                                            echo $this->Form->input(
                                                    'last_name', array(
                                                'class' => '',
                                                'id' => 'last'
                                                    )
                                            );
                                            ?> 
                                        </div>                            
                                    </div>
                                </div>
                            </div>
                        </div>
                        &nbsp;
                        <div class="row">
                            <div class="col-md-12 ">
                                <div class="col-md-2 signupfont">
                                    House Number
                                </div>
                                <div class="col-md-2">
                                    <div class="input-list style-4 clearfix">
                                        <div>
                                            <?php
                                            echo $this->Form->input(
                                                    'house_no', array(
                                                'class' => 'form-control ',
                                                'type' => 'text'
                                                    )
                                            );
                                            ?>
                                        </div>                            
                                    </div>
                                </div>
                                <div class="col-md-1 signupfont">
                                    Street:
                                </div>
                                <div class="col-md-3">
                                    <div class="input-list style-4 clearfix">
                                        <div>
                                            <?php
                                            echo $this->Form->input(
                                                    'street', array(
                                                'class' => '',
                                                'id' => 'street'
                                                    )
                                            );
                                            ?> 
                                        </div>                            
                                    </div>
                                </div>
                                <div class="col-md-1 signupfont">
                                    Apartment: 
                                </div>
                                <div class="col-md-3">
                                    <div class="input-list style-4 clearfix">
                                        <div>
                                            <?php
                                            echo $this->Form->input(
                                                    'apartment', array(
                                                'class' => '',
                                                'id' => 'apartment'
                                                    )
                                            );
                                            ?> 
                                        </div>                            
                                    </div>
                                </div>
                            </div>
                        </div>
                        &nbsp;
                        <div class="row">
                            <div class="col-md-12 ">
                                <div class="col-md-2 signupfont">
                                    City:
                                </div>
                                <div class="col-md-2">
                                    <div class="input-list style-4 clearfix">
                                        <div>
                                            <?php
                                            echo $this->Form->input(
                                                    'city', array(
                                                'class' => '',
                                                'id' => 'city'
                                                    )
                                            );
                                            ?> 
                                        </div>                            
                                    </div>
                                </div>
                                <div class="col-md-1 signupfont">
                                    State:
                                </div>
                                <div class="col-md-3">
                                    <div class="input-list style-4 clearfix">
                                        <div>
                                            <?php
                                            echo $this->Form->input(
                                                    'state', array(
                                                'class' => '',
                                                'id' => 'state'
                                                    )
                                            );
                                            ?> 
                                        </div>                            
                                    </div>
                                </div>
                                <div class="col-md-1 signupfont">
                                    Zip: 
                                </div>
                                <div class="col-md-3">
                                    <div class="input-list style-4 clearfix">
                                        <div>
                                            <?php
                                            echo $this->Form->input(
                                                    'zip', array(
                                                'class' => '',
                                                'id' => 'zip'
                                                    )
                                            );
                                            ?>  
                                        </div>                            
                                    </div>
                                </div>
                            </div>
                        </div>
                        &nbsp;
                        <div class="row">
                            <div class="col-md-12 ">

                                <div class="col-md-2 signupfont">
                                    Phone: Home:  
                                </div>
                                <div class="col-md-4">
                                    <div class="input-list style-4 clearfix">
                                        <div>
                                            <?php
                                            echo $this->Form->input(
                                                    'home', array(
                                                'class' => '',
                                                    )
                                            );
                                            ?> 
                                        </div>                            
                                    </div>
                                </div>
                                <div class="col-md-1 signupfont">
                                    Cell:

                                </div>
                                <div class="col-md-5">
                                    <div class="input-list style-4 clearfix">
                                        <div>
                                            <?php
                                            echo $this->Form->input(
                                                    'cell', array(
                                                'class' => ''
                                                    )
                                            );
                                            ?>
                                        </div>                            
                                    </div>
                                </div>                        
                            </div>
                        </div>
                        &nbsp;
                        <div class="row">
                            <div class="col-md-12 ">
                                <div class="col-md-2 signupfont">
                                    E-Mail
                                </div>
                                <div class="col-md-4">
                                    <div class="input-list style-4 clearfix">
                                        <div>
                                            <?php
                                            echo $this->Form->input(
                                                    'email', array(
                                                'class' => '',
                                                'id' => 'email'
                                                    )
                                            );
                                            ?>
                                        </div>                            
                                    </div>
                                </div>
                                <div class="col-md-1 signupfont">
                                    Fax: 
                                </div>
                                <div class="col-md-5">
                                    <div class="input-list style-4 clearfix">
                                        <div>
                                            <?php
                                            echo $this->Form->input(
                                                    'fax', array(
                                                'class' => '',
                                                'id' => 'fax',
                                                'placeholder' => 'Optional'
                                                    )
                                            );
                                            ?> 
                                        </div>                            
                                    </div>
                                </div>
                            </div>
                        </div>
                        &nbsp;
                        <div class="row" >
                            <div class="col-md-12 ">
                                <!--For custom package input box starts -->
                                <div id="custompackage"  style="<?php
                                if ($checkMark == FALSE) {
                                    echo 'display: none;';
                                } else {
                                    echo '';
                                }
                                ?>">
                                    <div class="col-md-2">
                                        <?php
                                        $arrCategory = array("1" => "1 Month", "3" => "3 Month", "6" => "6 Month", "12" => "1 Year");
                                        echo $this->Form->input(
                                                'duration', array(
                                            'class' => 'form-control',
                                            'id' => 'selctMonth',
                                            'default' => $custom_package_duration,
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
                                            'value' => $custom_package_charge,
                                            'placeholder' => 'Amount'
                                                )
                                        );
                                        ?> 
                                    </div>
                                </div>
                                <!--For custom package input box Ends -->
                                <div id="regularpackage" style="<?php
                                $class = '';
                                if ($checkMark == TRUE) {
                                    echo 'display: none;';
                                } else {
                                    echo '';
                                    $class = '';
                                }
                                ?>">
                                    <div class="col-md-2 signupfont">
                                        Select package:
                                    </div>
                                    <div class="col-md-2">
                                        <?php
                                        echo $this->Form->input('psetting_id', array(
                                            'type' => 'select',
                                            'options' => $packageList,
                                            //'default' => $selected['package'],
                                            'empty' => 'Select Package Type',
                                            'id' => 'psettingId',
                                            'class' => 'span12 uniform nostyle select1 packageChange ' . $class,
                                            'div' => array('class' => 'span12')
                                                )
                                        );
                                        ?>
                                    </div>  
                                </div>
                                <div class="col-md-2">
                                    <label>
                                        <div class="" style="display: inline-block;"><span class=""><input id="customcheckbox" name="data[PackageCustomer][CustomPackage]"  type="checkbox" <?php
                                                if ($checkMark == TRUE) {
                                                    echo 'checked';
                                                } else {
                                                    echo '';
                                                }
                                                ?>></span></div> Custom Package </label>
                                </div>
                                <!--                                <div class="col-md-2 signupfont">
                                                                    Add New STBs:
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="input-list style-4 clearfix">
                                                                        <div>
                                <?php
                                echo $this->Form->input('stbs', array(
                                    'type' => 'select',
                                    'options' => array('1' => 1, '2' => 2, '3' => 3, '4' => 4, '5' => 5, '6' => 6, '7' => 7, '8' => 8, '9' => 9, '10' => 10, '11' => 11, '12' => 12),
                                    //'default' => $selected['package'],
                                    'empty' => 'Select Stbs',
                                    'class' => 'span12 uniform nostyle select1',
                                    'name' => 'stb'
                                        //'id'=>'stbn',
                                        )
                                );
                                ?>
                                                                        </div>                            
                                                                    </div>
                                                                </div>-->
                            </div>
                        </div>
                        &nbsp; 
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

                        &nbsp; 
                        <div class="row">
                            <?php
                            if (is_array($macstb['mac'])):
                                foreach ($macstb['mac'] as $index => $mac):
                                    $system = $macstb['system'][$index];
                                    ?>
                                    <div class="col-md-12">
                                        <div class="col-md-2 signupfont ">Mac no:</div>
                                        <div class="col-md-4">
                                            <div class="input-list style-4 clearfix">
                                                <div>

                                                    <?php
                                                    echo $this->Form->input(
                                                            'mac.', array(
                                                        'class' => '',
                                                        'placeholder' => 'Optional',
                                                        'readonly' => 'readonly',
                                                        'value' => $mac
                                                            )
                                                    );
                                                    ?> 
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <?php
                                endforeach;
                            endif;
                            ?>
                        </div>
                        &nbsp;
                        <div class="" id="addmac">
                        </div>
                        <div class="row">
                            <div class="col-md-12 ">
                                <?php
                                if ($ref_cell != 0) { ?>
                                    <div class="col-md-2 signupfont">
                                        Referred by:
                                    </div>
                                    <div class="col-md-3">
                                        <div class="input-list style-4 clearfix">
                                            <div>
                                                <?php
                                                echo $this->Form->input(
                                                        'referred_name', array(
                                                    'value' => $ref_name,
                                                    'title' => 'Cell no: ' . $ref_cell,
                                                    'disabled' => 'disabled'
                                                        )
                                                );
                                                ?>

                                            </div>                            
                                        </div>
                                    </div>

                                    <div class="col-md-1 signupfont">
                                        Bonus:
                                    </div>
                                    <div class="col-md-2">
                                        <div class="input-list style-4 clearfix">
                                            <div>
                                                <?php
                                                echo $this->Form->input(
                                                        'bonus', array(
                                                    'class' => '',
                                                    'value' => $bonus,
                                                    'disabled' => 'disabled'
                                                        )
                                                );
                                                ?>
                                            </div>                            
                                        </div>
                                    </div>
                                <?php } else { ?>
                                    <div class="col-md-2 signupfont">
                                        Referred by:
                                    </div>
                                    <div class="col-md-3">
                                        <div class="input-list style-4 clearfix">
                                            <div>
                                                <?php
                                                echo $this->Form->input(
                                                        'referred_name', array(
                                                    'placeholder' => 'Please set referral name',
                                                    'title' => 'Please set referral information',
                                                    'disabled' => 'disabled'
                                                        )
                                                );
                                                ?>

                                            </div>                            
                                        </div>
                                    </div>

                                    <div class="col-md-1 signupfont">
                                        Bonus:
                                    </div>
                                    <div class="col-md-2">
                                        <div class="input-list style-4 clearfix">
                                            <div>
                                                <?php
                                                echo $this->Form->input(
                                                'bonus', array(
                                                'class' => '',
                                                'placeholder' => 'Set referral bonus',
                                                    'title' => 'Please set referral information',
                                                'disabled' => 'disabled'
                                                )
                                                );
                                                ?>
                                            </div>                            
                                        </div>
                                    </div>

                                <?php } ?>

                                <div class="col-md-1 signupfont">
                                    Phone: 
                                </div>
                                <div class="col-md-3">
                                    <div class="input-list style-4 clearfix">
                                        <div>
                                            <?php
                                            echo $this->Form->input(
                                                    'referred_phone', array(
                                                'class' => '',
                                                'id' => 'phone'
                                                    )
                                            );
                                            ?> 
                                        </div>                            
                                    </div>
                                </div>                        
                            </div>
                        </div>
                        &nbsp;
                        <div class="row">
                            <div class="col-md-12 ">
                                <div class="col-md-2 signupfont">
                                    Account No.
                                </div>
                                <div class="col-md-4">
                                    <div class="input-list style-4 clearfix">
                                        <div>
                                            <?php
                                            echo $this->Form->input(
                                                    'c_acc_no', array(
                                                'class' => '',
                                                    )
                                            );
                                            ?>

                                        </div>                            
                                    </div>
                                </div>                             

                                <div class="col-md-1 signupfont">
                                    Comment
                                </div>
                                <div class="col-md-5">
                                    <div class="input-list style-4 clearfix">
                                        <div>
                                            <?php
                                            echo $this->Form->input(
                                                    'comments', array(
                                                'class' => 'form-control',
                                                'type' => 'textarea',
                                                'rows' => '5',
                                                    )
                                            );
                                            ?>

                                        </div>                            
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div  class="col-lg-8 col-md-offset-4 padding-left-0 padding-top-20"> 
                                <?php
                                echo $this->Form->button(
                                        'Update Customer Information', array(
                                    'class' => 'btn btn-primary submitbtn green',
                                    'type' => 'submit',
                                    'id' => '',
                                    'disabled' => $btn
                                ));
                                ?>
                            </div>
                        </div>
                        <?php echo $this->Form->end(); ?> 

                    </div>
                </div>            
            </div>            
            <!--End-->
            <!--status update start-->    
            <div class="col-md-12">
                <div class="portlet box red-soft">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-user"></i>Customer Status Update 
                        </div> 
                        <div class="tools">
                            <a  class="reload toggle" data-id="status_update1" ></a>
                        </div>
                    </div>
                    <div class="portlet-body" id="status_update1" style="display: none;">  
                        <?php echo $this->Session->flash(); //pr($users); ?>
                        <?php
                        echo $this->Form->create('SaveMac', array(
                            'inputDefaults' => array(
                                'label' => false,
                                'div' => false,
                                'id' => false
                            ),
                            'enctype' => 'multipart/form-data',
                            'url' => array('controller' => 'customers', 'action' => 'save_mac', $this->params['pass'][0])
                                )
                        );
                        ?>
                        <br>

                        &nbsp; 
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-2 signupfont  text-center">Mac no:</div>
                                    <div class="col-md-2">
                                        <div class="input-list style-4 clearfix">
                                            <div>
                                                <?php
                                                echo $this->Form->input(
                                                        'mac..', array(
                                                    'class' => 'required',
                                                    'placeholder' => '',
                                                        )
                                                );
                                                ?> 
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2 signupfont">System:</div>
                                    <div class="col-md-2">
                                        <div class="input-list style-4 clearfix">
                                            <div>
                                                <?php
                                                echo $this->Form->input('system..', array(
                                                    'type' => 'select',
                                                    'options' => array('CMS1' => 'CMS1', 'CMS2' => 'CMS2', 'CMS3' => 'CMS3', 'PORTAL' => 'PORTAL', 'PORTAL1' => 'PORTAL1'),
                                                    'empty' => 'Select System',
                                                    'class' => 'form-control select2me '
                                                        )
                                                );
                                                ?>
                                            </div>
                                        </div>
                                    </div> 

                                    <div class="col-md-2 signupfont">Status Update</div>
                                    <div class="col-md-2">
                                        <div class="input-list style-4 clearfix">
                                            <div>
                                                <?php
                                                echo $this->Form->input('status..', array(
                                                    'type' => 'select',
                                                    'options' => array(
                                                        'active' => 'Active',
                                                        'hold' => 'Hold',
                                                        'canceled' => 'Canceled'
                                                    ),
                                                    'empty' => 'Select Status',
                                                    'class' => 'form-control select2me ',
                                                        )
                                                );
                                                ?>
                                            </div>                            
                                        </div>
                                    </div>
                                </div>

                                &nbsp; 
                                <div class="row">                                  
                                    <div class="col-md-2 signupfont status-date text-center">
                                        Date
                                    </div>
                                    <div class="col-md-2">
                                        <div class="input-list style-4 clearfix">
                                            <div>
                                                <?php
                                                echo $this->Form->input(
                                                        'date..', array(
                                                    'type' => 'text',
                                                    'class' => 'datepicker form-control ',
                                                        )
                                                );
                                                ?> 
                                            </div>                            
                                        </div>
                                    </div> 

                                    <div class="col-md-2 signupfont status-date text-center">
                                        BY
                                    </div>

                                    <div class="col-md-2">
                                        <?php
                                        echo $this->Form->input('user_id..', array(
                                            'type' => 'select',
                                            'options' => $users,
                                            'empty' => 'Select User',
                                            'class' => 'form-control select2me ',
                                                )
                                        );
                                        ?>
                                    </div>
                                </div>

                            </div>                              
                        </div>
                        &nbsp;
                        <div class="row margin-top-20">
                            <div class="col-lg-8 col-md-offset-4 padding-left-0 padding-top-20"> 
                                <button class="btn btn-primary submitbtn red-soft" type="submit" id="">Save mac information</button>                                    </div>
                        </div>

                        <?php echo $this->Form->end(); ?>

                        <?php if (!empty($allStatus)) { ?>
                            <hr style="color: #ccc;">
                            <?php if ($customer_info['PackageCustomer']['mac_status'] != '') { ?>
                                <div class="portlet-body" >  
                                    <?php echo $this->Session->flash(); //pr($users);  ?>
                                    <?php
                                    echo $this->Form->create('UpdateCustomer', array(
                                        'inputDefaults' => array(
                                            'label' => false,
                                            'div' => false,
                                            'id' => false
                                        ),
                                        'enctype' => 'multipart/form-data',
                                        'url' => array('controller' => 'customers', 'action' => 'update_status', $this->params['pass'][0])
                                            )
                                    );
                                    ?>
                                    <br>
                                    <?php
                                    echo $this->Form->input(
                                            'id', array(
                                        'type' => 'hidden',
                                        'value' => $allStatus['id'],
                                    ));
                                    unset($allStatus['id']);
                                    unset($allStatus['package_customer_id']);
                                    foreach ($allStatus as $status):
                                        ?>
                                        <div class="row">  
                                            <div class="col-md-12 signupfont text-center">
                                                <?php
                                                echo $this->Form->input(
                                                        'mac.', array(
                                                    'class' => 'form-control readonly',
                                                    'type' => 'text',
                                                    'value' => $status['mac'],
//                                            'readonly' => 'readonly',
                                                    'style' => 'text-align:center; letter-spacing:2px; color: green;'
                                                        )
                                                );
                                                ?>
                                            </div>
                                        </div>
                                        <div class="row margin-top-10 margin-bottom-10">

                                            <div class="col-md-1 signupfont text-center">
                                                Status
                                            </div>
                                            <div class="col-md-2">
                                                <div class="input-list style-2 clearfix">
                                                    <div>
                                                        <?php
                                                        echo $this->Form->input('status.', array(
                                                            'type' => 'select',
                                                            'options' => array(
                                                                'active' => 'Active',
                                                                'hold' => 'Hold',
                                                                'canceled' => 'Canceled'
                                                            ),
                                                            'empty' => 'Select Status',
                                                            'default' => $status['status'],
                                                            'class' => 'form-control span12 uniform nostyle select1 ',
                                                                )
                                                        );
                                                        ?>
                                                    </div>                            
                                                </div>
                                            </div>

                                            <div class="col-md-1 signupfont status-date text-center">
                                                Date
                                            </div>
                                            <div class="col-md-2">
                                                <div class="input-list style-4 clearfix">
                                                    <div>
                                                        <?php
                                                        echo $this->Form->input(
                                                                'date.', array(
                                                            'type' => 'text',
                                                            'class' => 'datepicker form-control ',
                                                            'value' => $status['date']
                                                                )
                                                        );
                                                        ?> 
                                                    </div>                            
                                                </div>

                                            </div> 

                                            <div class="col-md-1 signupfont status-date text-center">
                                                BY
                                            </div>

                                            <div class="col-md-2">
                                                <?php
                                                echo $this->Form->input('user_id.', array(
                                                    'type' => 'select',
                                                    'options' => $users,
                                                    'empty' => 'Select User',
                                                    'default' => $status['user_id'],
                                                    'class' => 'form-control select2me ',
                                                        )
                                                );
                                                ?>
                                            </div>

                                            <div class="col-md-1 signupfont status-date text-center">
                                                System
                                            </div>

                                            <div class="col-md-2">
                                                <?php
                                                echo $this->Form->input('system.', array(
                                                    'type' => 'select',
                                                    'options' => array('CMS1' => 'CMS1', 'CMS2' => 'CMS2', 'CMS3' => 'CMS3', 'PORTAL' => 'PORTAL', 'PORTAL1' => 'PORTAL1'),
                                                    'default' => $status['system'],
                                                    'empty' => 'Select System',
                                                    'class' => 'form-control span12 uniform nostyle select1'
                                                        )
                                                );
                                                ?>
                                            </div>
                                        </div>
                                    <?php endforeach;
                                    ?>
                                    <div class="row margin-top-20">
                                        <div class="col-lg-8 col-md-offset-4 padding-left-0 padding-top-20"> 
                                            <?php
                                            echo $this->Form->button(
                                                    'Update Mac Information', array(
                                                'class' => 'btn btn-primary submitbtn red-soft',
                                                'disabled' => $btn,
                                                'type' => 'submit')
                                            );
                                            ?>
                                        </div>
                                    </div>                            
                                </div>
                                <?php echo $this->Form->end(); ?>  
                            <?php } ?>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <!--status update end--> 

            <!-- -------------Set package exp date start--------------------------->     
            <div class="col-md-12">
                <div class="portlet box blue-steel">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-list-ul"></i>Package Expire Date Update
                        </div>
                        <div class="tools">
                            <a  class="reload toggle" data-id="package_exp"></a>
                        </div>
                    </div>
                    <div class="portlet-body" id="package_exp" style="display: none;">  
                        <?php echo $this->Session->flash() ?>
                        <?php
                        echo $this->Form->create('PackageCustomer', array(
                            'inputDefaults' => array(
                                'label' => false,
                                'div' => false
                            ),
                            'id' => 'form-validate',
                            'class' => 'form-horizontal',
                            'novalidate' => 'novalidate',
                            'enctype' => 'multipart/form-data',
                            'url' => array('controller' => 'customers', 'action' => 'package_expdate_update')
                                )
                        );
                        ?>
                        <br>
                        <div class="row">                                     
                            <?php
                            echo $this->Form->input(
                                    'package_customer_id', array(
                                'type' => 'hidden',
                                'value' => $this->params['pass'][0],
                            ));
                            ?>
                            <br>
                            <div class="col-md-2 signupfont">
                                Package Expire Date:
                            </div>
                            <div class="col-md-2">
                                <div class="input-list style-4 clearfix">
                                    <?php
                                    echo $this->Form->input(
                                            'package_exp_date', array(
                                        'class' => 'datepicker form-control ',
                                        'type' => 'text',
                                            )
                                    );
                                    ?>
                                </div>
                            </div>                         
                            &nbsp;
                            &nbsp;
                            <div class="row margin-top-20">
                                <div class="col-lg-8 col-md-offset-4 padding-left-0 padding-top-20"> 
                                    <button <?php echo $btn ?> class="btn btn-primary submitbtn grey-cascade" type="submit" id="">Update Date</button>                                    </div>
                            </div>
                        </div>
                    </div>
                    <?php echo $this->Form->end(); ?>
                </div>
            </div>
            <!-- -------------Set package exp date end--------------------------->  

            <!-- -------------Begin Next Payment--------------------------->   

            <div class="col-md-12">

                <div class="portlet box grey-cascade">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-list-ul"></i>  
                            <?php if ($customer_info['PackageCustomer']['next_r_payable_amount'] != 0) { ?>
                                <a style="color: yellow;" title="Click & update :-) Date: <?php echo $customer_info['PackageCustomer']['next_r_date'] ?>, Amount: <?php echo $customer_info['PackageCustomer']['next_r_payable_amount'] ?>  " href="#product-pop-up<?php echo $customer_info['PackageCustomer']['id']; ?>" class="fancybox-fast-view" style="overflow: -webkit-paged-x;">
                                    Next Payment
                                </a>
                            <?php } else { ?>
                                <a style="color: #990000;" title="Click & set next recurring :-)" href="#product-pop-up<?php echo $customer_info['PackageCustomer']['id']; ?>" class="fancybox-fast-view" style="overflow: -webkit-paged-x;">
                                    Next Payment
                                </a>
                            <?php } ?>
                        </div>
                        <div class="tools">
                            <a  class="reload toggle" data-id="next_payment"></a>
                        </div>
                    </div>
                    <div class="portlet-body" id="next_payment" style="display: none;">  
                        <?php echo $this->Session->flash() ?>
                        <?php
                        echo $this->Form->create('NextTransaction', array(
                            'inputDefaults' => array(
                                'label' => false,
                                'div' => false
                            ),
                            'id' => 'form-validate',
                            'class' => 'form-horizontal',
                            'novalidate' => 'novalidate',
                            'enctype' => 'multipart/form-data',
                            'url' => array('controller' => 'customers', 'action' => 'update_payment')
                                )
                        );
                        ?>
                        <br>
                        <div class="row">                                     
                            <?php
                            echo $this->Form->input(
                                    'package_customer_id', array(
                                'type' => 'hidden',
                                'value' => $this->params['pass'][0],
                            ));
                            ?>

                            <br>
                            <div class="col-md-2 signupfont">
                                Invoice Date:
                            </div>
                            <div class="col-md-2">
                                <div class="input-list style-4 clearfix">
                                    <?php
                                    echo $this->Form->input(
                                            'exp_date', array(
                                        'class' => 'datepicker form-control ',
                                        'type' => 'text',
                                            )
                                    );
                                    ?>
                                </div>
                            </div>
                            <div class="col-md-2 signupfont">
                                Payment amount:
                            </div>
                            <div class="col-md-2">
                                <div class="input-list style-4 clearfix">
                                    <?php
                                    echo $this->Form->input(
                                            'payable_amount', array(
                                        'type' => 'text',
                                        'class' => 'form-control',
                                    ));
                                    ?>
                                </div>
                            </div>
                            <div class="col-md-2 signupfont">
                                Discount:
                            </div>
                            <div class="col-md-2">
                                <div class="input-list style-4 clearfix">
                                    <?php
                                    echo $this->Form->input(
                                            'discount', array(
                                        'type' => 'number',
                                        'class' => 'form-control',
                                    ));
                                    ?>
                                </div>
                            </div>
                            <br>
                            <br>
                            <div class="col-md-2 signupfont">
                                Comment
                            </div>


                            <div class="col-md-10">
                                <?php
                                echo $this->Form->input(
                                        'note', array(
                                    'class' => 'form-control ckeditor',
                                    'data-error-container' => '#editor2_error',
                                    'rows' => 6,
                                    'type' => 'textarea',
                                    'id' => 'note'
                                        )
                                );
                                ?>

                            </div>
                            <br>
                            <!--===================Next Recurring=====start================-->
                            <br><br><br>
                            <?php if ($customer_info['PackageCustomer']['next_r_payable_amount'] != 0) { ?>
                                <div  class="col-md-12">
                                    <table class="table table-striped table-hover table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Next recurring</th>
                                                <th>Next recurring duration</th>
                                                <th>Next recurring date</th>
                                                <th>Next recurring payable Amount</th>
                                                <th>Next recurring comment</th>                                                   
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr >
                                                <td>
                                                    <a title="Click here for edit data" href="#product-pop-up<?php echo $customer_info['PackageCustomer']['id']; ?>" class="fancybox-fast-view" style="overflow: -webkit-paged-x;">
                                                        <?php if (!empty($customer_info['PackageCustomer']['next_recurring'])) { ?>
                                                            <?php echo $customer_info['PackageCustomer']['next_recurring']; ?>
                                                        <?php } else { ?>
                                                            <?php echo 'There is no data' ?>
                                                        <?php } ?>
                                                    </a></td>
                                                <td><?php echo $customer_info['PackageCustomer']['next_r_duration']; ?></td>
                                                <td><?php
                                                    if ($customer_info['PackageCustomer']['next_r_payable_amount'] != 0) {
                                                        echo date('m-d-Y', strtotime($customer_info['PackageCustomer']['next_r_date']));
                                                    }
                                                    ?></td>
                                                <td><?php echo $customer_info['PackageCustomer']['next_r_payable_amount']; ?></td>
                                                <td><?php echo $customer_info['PackageCustomer']['next_r_comment']; ?></td>
                                            </tr>                                                 
                                        </tbody>
                                    </table>
                                </div>                      

                                <hr>
                            <?php } ?>
                            <!--===================Next Recurring=====end================-->
                            &nbsp;
                            &nbsp;
                            <div class="row margin-top-20">
                                <div class="col-lg-8 col-md-offset-4 padding-left-0 padding-top-20"> 
                                    <button <?php echo $btn ?> class="btn btn-primary submitbtn grey-cascade" type="submit" id="">Generate Invoice</button>                                    </div>
                            </div>
                        </div>
                    </div>
                    <?php echo $this->Form->end(); ?>
                </div>
            </div>

            <div id="product-pop-up<?php echo $customer_info['PackageCustomer']['id']; ?>" style="overflow: -webkit-paged-x;display: none; height: 415px; width: 850px;">
                <h2>Next recurring</h2>
                <!--Next Auto Payment start-->  
                <div class="col-md-12">
                    <div class="portlet box ">                                      
                        <div class="portlet-body">  
                            <?php echo $this->Session->flash() ?>
                            <?php
                            echo $this->Form->create('NextRTransaction', array(
                                'inputDefaults' => array(
                                    'label' => false,
                                    'div' => false
                                ),
                                'id' => 'form-validate',
                                'class' => 'form-horizontal',
                                'novalidate' => 'novalidate',
                                'enctype' => 'multipart/form-data',
                                'url' => array('controller' => 'customers', 'action' => 'update_next_recurring')
                                    )
                            );
                            ?>
                            <?php
                            echo $this->Form->input('package_customer_id', array(
                                'type' => 'hidden',
                                'value' => $this->params['pass'][0],
                                    )
                            );
                            ?>
                            <br>
                            <div class="col-md-12" > 
                                <div class="row">  
                                    <div class="col-md-2 signupfont">
                                        Next Recurring
                                    </div>
                                    <div class="col-md-3">
                                        <?php
                                        echo $this->Form->input('next_recurring', array(
                                            'type' => 'select',
                                            'options' => array(
                                                'empty' => 'Select Option',
                                                'yes' => 'Yes',
                                                'no' => 'No',
                                            ),
                                            'value' => $customer_info['PackageCustomer']['next_recurring'],
                                            'class' => 'form-control nextrecurringChange  required')
                                        );
                                        ?>
                                    </div>
                                </div>

                            </div><br><br>
                            <div class="col-md-12 margin-bottom-25 display-hide" id="nextrecurring" > 

                                <!--<div class="col-md-12 margin-bottom-25" >--> 
                                <div class="row">                                    
                                    <div class="col-md-2 signupfont">
                                        &nbsp;Repeat
                                    </div>
                                    <div class="col-md-3">
                                        <?php
                                        echo $this->Form->input(
                                                'next_r_duration', array('type' => 'select',
                                            'options' => array_combine(range(1, 15), range(1, 15)),
                                            'empty' => 'Select Month ',
                                            'value' => $customer_info['PackageCustomer']['next_r_duration'],
                                            'class' => 'span12 form-control select1 required',
                                            'div' => array('class' => 'span12 ')
                                                )
                                        );
                                        ?>
                                        <span class="pull-right"> Month(s)</span>
                                    </div>                                 
                                    <div class="col-md-1 signupfont">
                                        Date
                                    </div>
                                    <div class="col-md-6">                                                        
                                        <?php
                                        echo $this->Form->input(
                                                'next_r_date', array('type' => 'select',
                                            'class' => 'datepicker form-control required',
                                            'title' => 'Payment Date',
                                            'value' => $customer_info['PackageCustomer']['next_r_date'],
                                            'type' => 'text'
                                                )
                                        );
                                        ?>
                                    </div>


                                </div>
                                <div class="row">  
                                    <div class="col-md-2 signupfont" style="padding-right: 0px;">
                                        &nbsp;Amount
                                    </div>
                                    <div class="col-md-2">                                                         
                                        <?php
                                        echo $this->Form->input(
                                                'next_r_payable_amount', array(
                                            'class' => 'form-control required',
                                            'value' => $customer_info['PackageCustomer']['next_r_payable_amount'],
                                            'type' => 'text'
                                                )
                                        );
                                        ?>                                                                                    
                                    </div>
                                    <div class="col-md-2 signupfont">
                                        Comment
                                    </div>
                                    <div class="col-md-6">
                                        <?php
                                        echo $this->Form->input(
                                                'next_r_comment', array(
                                            'type' => 'textarea',
                                            'rows' => '5',
                                            'value' => $customer_info['PackageCustomer']['next_r_comment'],
                                            'class' => 'form-control input-sm required',
                                        ));
                                        ?>
                                    </div>
                                    <br>                                                   
                                </div> 
                            </div>
                            <div class="row">
                                <div class="col-lg-8 col-md-offset-4 padding-left-0 padding-top-20"> 
                                    <?php
                                    echo $this->Form->button(
                                            'Set next recurring', array(
                                        'class' => 'btn btn-primary submitbtn green',
                                        'type' => 'submit',
                                        'id' => '',
                                        'disabled' => $btn
                                    ));
                                    ?>
                                </div>
                            </div> 
                            <?php echo $this->Form->end(); ?>
                        </div>   
                    </div>
                </div>
            </div>
            <!--Next Payment end-->  



            <!-- -------------Update Card Info--------------------------->    
            <div class="col-md-12">

                <div class="portlet box green-meadow">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-list-ul"></i>Update Card 
                        </div>
                        <div class="tools">
                            <a  class="reload toggle" data-id="update_card"></a>
                        </div>
                    </div>
                    <div class="portlet-body" id="update_card" style="display: none;">  
                        <div >
                            <?php
                            echo $this->Form->create('Transaction', array(
                                'inputDefaults' => array(
                                    'label' => false,
                                    'div' => false
                                ),
                                'id' => 'form-validate',
                                'class' => 'form-horizontal',
                                'novalidate' => 'novalidate',
                                'url' => array('controller' => 'customers', 'action' => 'updatecardinfo')
                                    )
                            );
                            ?>
                            <?php
                            echo $this->Form->input('id');
                            ?>
                            <?php
                            echo $this->Form->input(
                                    'package_customer_id', array(
                                'type' => 'hidden',
                                'value' => $this->params['pass'][0]
                            ));
                            ?>
                            <div class="row">
                                <div class="col-md-1 signupfont" style="padding-right: 0px;">
                                    Card Number : 
                                </div>
                                <div class="col-md-3">
                                    <?php
                                    echo $this->Form->input(
                                            'card_no', array(
                                        'type' => 'text',
                                        'class' => 'form-control input-sm ',
                                            // 'id' => 'card_number',
                                    ));
                                    ?>
                                </div>


                                <div class="col-md-1 signupfont">
                                    Expiration :
                                </div>
                                <div class="col-md-1">
                                    <?php
                                    echo $this->Form->input('exp_date.year', array(
                                        'type' => 'select',
                                        'options' => $ym['year'],
                                        'empty' => 'Select Year',
                                        'class' => 'span12 uniform nostyle select1 ',
                                        'div' => array('class' => 'span12 '),
                                            // 'id' => 'showyear',
                                            )
                                    );
                                    ?>
                                </div>
                                <div class="col-md-2">
                                    <?php
                                    echo $this->Form->input('exp_date.month', array(
                                        'type' => 'select',
                                        'options' => $ym['month'],
                                        'empty' => 'Select Month',
                                        'class' => 'span12 uniform nostyle select1 ',
                                        'div' => array('class' => 'span12 '),
                                            // 'id' => 'showmonth',
                                            )
                                    );
                                    ?>
                                </div>

                                <div class="col-md-1 signupfont">
                                    CVV : 
                                </div>
                                <div class="col-md-3">
                                    <?php
                                    echo $this->Form->input(
                                            'cvv_code', array(
                                        'type' => 'password',
                                        'class' => 'form-control input-sm ',
                                            //  'id' => 'cvv_code',
                                    ));
                                    ?>
                                </div>                                
                            </div>

                            <hr style="color: #333;">

                            <div class="row">
                                <div class="col-md-4 signupfont">
                                    <input type="checkbox" id="autofillAddrCheck"  /> <span class="signupfont">SAME AS BILLING ADDRESS </span>
                                </div>
                                <div class="col-md-2 signupfont">
                                    First Name: 
                                </div>
                                <div class="col-md-2">
                                    <?php
                                    echo $this->Form->input(
                                            'fname', array(
                                        'type' => 'text',
                                        'class' => 'form-control input-sm ',
                                        'placeholder' => 'first name',
                                        'id' => 'firstname',
                                    ));
                                    ?>
                                </div>
                                <div class="col-md-2 signupfont">
                                    Last Name: 
                                </div>
                                <div class=" col-md-2">
                                    <?php
                                    echo $this->Form->input(
                                            'lname', array(
                                        'type' => 'text',
                                        'class' => 'form-control input-sm ',
                                        'placeholder' => 'last name',
                                        'id' => 'lastname',
                                    ));
                                    ?>
                                </div>

                            </div>
                            <br>

                            <div class="row">
                                <div class="col-md-2 signupfont" style="padding-right: 0px;">
                                    Company 
                                </div>
                                <div class="col-md-2">
                                    <?php
                                    echo $this->Form->input(
                                            'company', array(
                                        'type' => 'text',
                                        'class' => 'form-control input-sm ',
                                        'id' => 'card_number',
                                    ));
                                    ?>
                                </div>

                                <div class="col-md-2 signupfont" style="padding-right: 0px;">
                                    Address
                                </div>
                                <div class="col-md-2">
                                    <?php
                                    echo $this->Form->input(
                                            'address', array(
                                        'type' => 'text',
                                        'class' => 'form-control input-sm ',
                                    ));
                                    ?>
                                </div>

                                <div class="col-md-1 signupfont" style="padding-right: 0px;">
                                    City
                                </div>
                                <div class="col-md-3">
                                    <?php
                                    echo $this->Form->input(
                                            'city', array(
                                        'type' => 'text',
                                        'id' => 'cityname',
                                        'class' => 'form-control input-sm ',
                                    ));
                                    ?>
                                </div>                                    
                            </div>

                            </br>
                            <div class="row">
                                <div class="col-md-2 signupfont" style="padding-right: 0px;">
                                    State/Province
                                </div>
                                <div class="col-md-2">
                                    <?php
                                    echo $this->Form->input(
                                            'state', array(
                                        'type' => 'text',
                                        'id' => 'statename',
                                        'class' => 'form-control input-sm ',
                                    ));
                                    ?>
                                </div>
                                <div class="col-md-2 signupfont" style="padding-right: 0px;">
                                    Zipe Code
                                </div>
                                <div class="col-md-2">
                                    <?php
                                    echo $this->Form->input(
                                            'zip_code', array(
                                        'type' => 'text',
                                        'id' => 'zip_code',
                                        'class' => 'form-control input-sm ',
                                    ));
                                    ?>
                                </div>

                                <div class="col-md-1 signupfont" style="padding-right: 0px;">
                                    Country
                                </div>
                                <div class="col-md-3">
                                    <?php
                                    echo $this->Form->input(
                                            'country', array(
                                        'type' => 'text',
                                        'class' => 'form-control input-sm ',
                                    ));
                                    ?>
                                </div>                                    
                            </div>

                            </br>
                            <div class="row">                                    
                                <div class="col-md-2 signupfont" style="padding-right: 0px;">
                                    Phone
                                </div>
                                <div class="col-md-2">
                                    <?php
                                    echo $this->Form->input(
                                            'phone', array(
                                        'type' => 'text',
                                        'id' => 'phoneno',
                                        'class' => 'form-control input-sm ',
                                    ));
                                    ?>
                                </div>

                                <div class="col-md-2 signupfont" style="padding-right: 0px;">
                                    Email
                                </div>
                                <div class="col-md-2">
                                    <?php
                                    echo $this->Form->input(
                                            'email', array(
                                        'type' => 'text',
                                        'id' => 'emailadd',
                                        'class' => 'form-control input-sm ',
                                    ));
                                    ?>
                                </div>

                                <div class="col-md-1 signupfont" style="padding-right: 0px;">
                                    Fax
                                </div>
                                <div class="col-md-3">
                                    <?php
                                    echo $this->Form->input(
                                            'fax', array(
                                        'type' => 'text',
                                        'id' => 'faxno',
                                        'class' => 'form-control input-sm ',
                                    ));
                                    ?>
                                </div>

                            </div>

                            </br>

                        </div>  
                        &nbsp;
                        <div class="row">
                            <div class="col-lg-6  padding-left-0 padding-top-20 pull-right"> 
                                <?php
                                echo $this->Form->button(
                                        'Update Card', array(
                                    'class' => 'btn btn-primary submitbtn green-meadow',
                                    'type' => 'submit',
                                    'id' => '',
                                    'disabled' => $btn
                                ));
                                ?>
                            </div>
                        </div>
                        <?php echo $this->Form->end(); ?>
                    </div>
                </div>
            </div>




            <div class="col-md-12">
                <div class="portlet box purple-sharp">
                    <div class="portlet-title" >
                        <div class="caption">
                            <i class="fa fa-user"></i>Auto Recurring
                        </div> 
                        <div class="tools">
                            <a  class="reload toggle" data-id="auto_recurring"></a>
                        </div>
                    </div>
                    <div class="portlet-body"  id="auto_recurring" style="display: none;">  
                        <?php echo $this->Session->flash() ?>
                        <?php
                        echo $this->Form->create('AutoTransaction', array(
                            'inputDefaults' => array(
                                'label' => false,
                                'div' => false
                            ),
                            'id' => 'form-validate',
                            'class' => 'form-horizontal',
                            'novalidate' => 'novalidate',
                            'enctype' => 'multipart/form-data',
                            'url' => array('controller' => 'customers', 'action' => 'update_auto_recurring')
                                )
                        );
                        ?>

                        <?php
                        echo $this->Form->input('package_customer_id', array(
                            'type' => 'hidden',
                            'value' => $this->params['pass'][0],
                                )
                        );
                        ?>
                        <br>
                        <div class="row">                                     
                            &nbsp;
                            <div class="col-md-12 margin-bottom-25" >

                                <div class="row">  
                                    <div class="col-md-2 signupfont">
                                        Recurring
                                    </div>
                                    <div class="col-md-4">
                                        <div class="input-list style-2 clearfix">
                                            <div>
                                                <?php
                                                echo $this->Form->input('auto_r', array(
                                                    'type' => 'select',
                                                    'options' => array(
                                                        'empty' => 'Select Option',
                                                        'yes' => 'Yes',
                                                        'no' => 'No',
                                                    ),
                                                    'class' => 'form-control recurringChange required')
                                                );
                                                ?>
                                            </div>                            
                                        </div>
                                    </div>

                                </div><br>

                            </div>
                            &nbsp;

                            <div class="col-md-12 margin-bottom-25 display-hide" id="recurring" >
                                <div class="row">   
                                    <div class="col-md-2 signupfont">
                                        &nbsp;  Repeat at Every
                                    </div>
                                    <div class="col-md-2">
                                        <div>
                                            <?php
                                            echo $this->Form->input(
                                                    'r_duration', array('type' => 'select',
                                                'options' => array_combine(range(1, 12), range(1, 12)),
                                                'empty' => 'Select Month ',
                                                'class' => 'span12 form-control select1 required',
                                                'div' => array('class' => 'span12 ')
                                                    )
                                            );
                                            ?>
                                        </div>  
                                        <span class="pull-right"> Month(s)</span>
                                    </div>                                    

                                    <div class="col-md-2 signupfont">
                                        Payment Date
                                    </div>
                                    <div class="col-md-2">
                                        <div>
                                            <?php
                                            echo $this->Form->input(
                                                    'recurring_date', array('type' => 'select',
                                                'options' => array_combine(range(1, 31), range(1, 31)),
                                                'empty' => 'Select Date ',
                                                'class' => 'span12 form-control select1 required',
                                                'div' => array('class' => 'span12 ')
                                                    )
                                            );
                                            ?>
                                        </div>                           
                                    </div>
                                    <div class="col-md-2 signupfont">
                                        Recurring Start From
                                    </div>
                                    <div class="col-md-2">
                                        <div class="input-list style-4 clearfix">
                                            <?php
                                            echo $this->Form->input(
                                                    'r_form', array(
                                                'class' => 'datepicker form-control required',
                                                'type' => 'text',
                                                    )
                                            );
                                            ?>
                                        </div>
                                    </div>
                                </div> 
                                <br>

                                <div class="row"> 

                                    <div class="col-md-2 signupfont" style="padding-right: 0px;">
                                        Charge Amount
                                    </div>
                                    <div class="col-md-2">
                                        <div>
                                            <?php
                                            echo $this->Form->input(
                                                    'payable_amount', array(
                                                'class' => 'form-control required',
                                                'type' => 'text'
                                                    )
                                            );
                                            ?>
                                        </div>                           
                                    </div>                                    

                                    <div class="col-md-2 signupfont">
                                        Card Number: 
                                    </div>
                                    <div class="col-md-2">
                                        <?php
                                        echo $this->Form->input(
                                                'card_check_no', array(
                                            'type' => 'text',
                                            'class' => 'form-control input-sm required',
                                        ));
                                        ?>
                                    </div>

                                    <div class="col-md-1 signupfont">
                                        Expire On:
                                    </div>
                                    <div class="col-md-1">
                                        <?php
                                        echo $this->Form->input('exp_date.year', array(
                                            'type' => 'select',
                                            'options' => $ym['year'],
                                            'empty' => 'Select Year',
                                            'class' => 'span12 uniform nostyle select1 required',
                                            'div' => array('class' => 'span12 '),
                                                )
                                        );
                                        ?>
                                    </div>

                                    <div class="col-md-1">
                                        <?php
                                        echo $this->Form->input('exp_date.month', array(
                                            'type' => 'select',
                                            'options' => $ym['month'],
                                            'empty' => 'Select Month',
                                            'class' => 'span12 uniform nostyle select1 required',
                                            'div' => array('class' => 'span12 ')
                                                )
                                        );
                                        ?>
                                    </div>
                                </div>
                                <br>

                                <div class="row">
                                    <div class="col-md-2">
                                        Name on Card: 
                                    </div>
                                    <div class="col-md-4">
                                        <?php
                                        echo $this->Form->input(
                                                'cfirst_name', array(
                                            'type' => 'text',
                                            'class' => 'form-control input-sm required',
                                            'placeholder' => 'first name'
                                        ));
                                        ?>
                                    </div>
                                    <div class="col-md-5">
                                        <?php
                                        echo $this->Form->input(
                                                'clast_name', array(
                                            'type' => 'text',
                                            'class' => 'form-control input-sm required',
                                            'placeholder' => 'last name'
                                        ));
                                        ?>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-2 ">
                                        CVV Code: 
                                    </div>
                                    <div class="col-md-4">
                                        <?php
                                        echo $this->Form->input(
                                                'cvv_code', array(
                                            'type' => 'password',
                                            'class' => 'form-control input-sm required'
                                        ));
                                        ?>
                                    </div>



                                    <div class="col-md-2 ">
                                        Zip Code on Card: 
                                    </div>
                                    <div class="col-md-4">
                                        <?php
                                        echo $this->Form->input(
                                                'czip', array(
                                            'type' => 'text',
                                            'class' => 'form-control input-sm required'
                                        ));
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-8 col-md-offset-4 padding-left-0 padding-top-20"> 
                                    <?php
                                    echo $this->Form->button(
                                            'Update', array(
                                        'class' => 'btn btn-primary submitbtn green',
                                        'type' => 'submit',
                                        'id' => '',
                                        'disabled' => $btn
                                    ));
                                    ?>
                                </div>
                            </div>

                            <?php echo $this->Form->end(); ?>
                        </div>
                        <!--status update end-->    
                    </div>   
                </div>

                <!--Invoice start-->

                <div class="portlet box grey-cascade">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-list-ul"></i>Open Invoice 
                        </div>
                        <div class="tools">
                            <a  class="reload toggle" data-id="open_invoice">
                            </a>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="row" id="open_invoice" style="display: none;">
                            <div  class="col-md-12 col-sm-12">
                                <table class="table table-striped table-hover table-bordered" id="sample_editable_1">
                                    <thead>
                                        <tr> 
                                            <th class="hidden-480">
                                                Name
                                            </th>
                                            <th class="hidden-480">
                                                Address
                                            </th>
                                            <th class="hidden-480">
                                                Mac
                                            </th>
                                            <th class="hidden-480">
                                                Cell
                                            </th>
                                            <th>
                                                Package
                                            </th>
                                            <th class="hidden-480">
                                                Payable Amount
                                            </th>
                                            <th class="hidden-480">
                                                Paid Amount
                                            </th>
                                            <th class="hidden-480">
                                                Due
                                            </th>
                                            <th class="hidden-480">
                                                Payment Date
                                            </th>
                                            <th class="hidden-480">
                                                Additional Note
                                            </th>
                                            <th class="hidden-480">
                                                Action
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($invoices as $info):
                                            $date = $info['transactions']['next_payment'];

                                            $customer_address = $info['package_customers']['house_no'] . ' ' . $info['package_customers']['street'] . ' ' .
                                                    $info['package_customers']['apartment'] . ' ' . $info['package_customers']['city'] . ' ' . $info['package_customers']['state'] . ' '
                                                    . $info['package_customers']['zip'];
                                            ?>
                                            <tr>
                                                <td> <a href="<?php echo Router::url(array('controller' => 'customers', 'action' => 'edit', $info['package_customers']['id'])) ?>" target="_blank"><?php echo $info['package_customers']['middle_name'] . " " . $info['package_customers']['last_name']; ?></a> </td>
                                                <td><?php echo $customer_address; ?></td>
                                                <td><?php echo $info['package_customers']['mac']; ?></td>
                                                <td><?php echo $info['package_customers']['cell']; ?></td>
                                                <td>
                                                    <?php
                                                    if ($info['package_customers']['custom_package_id'] == null || empty($info['package_customers']['custom_package_id'])) {
                                                        if (count($info['psettings']) == 0) {
                                                            echo 'No package was selected with this customer';
                                                        } else {
                                                            echo $info['psettings']['name'];
                                                        }
                                                    } else {
                                                        echo $info['custom_packages']['duration'] . ' Months, Custom package ' . $info['custom_packages']['charge'] . '$';
                                                    }
                                                    ?>
                                                </td>
                                                <td>$<?php echo $info['transactions']['payable_amount']; ?></td>
                                                <td>$<?php echo getPaid($info['transactions']['id']); ?></td>
                                                <td>$<?php echo $info['transactions']['payable_amount'] - getPaid($info['transactions']['id']); ?></td>
                                                <td><?php echo date('m-d-Y', strtotime($date)); ?></td>

                                                <td><?php echo $info['transactions']['note']; ?></td>
                                                <td> 
                                                    <?php if (($user == 'sadmin') || ($user == 'supervisor') || ($user == 'developer')): ?>
                                                        <a  target="_blank" title="Edit" href="<?php echo Router::url(array('controller' => 'transactions', 'action' => 'edit', $info['package_customers']['id'], $info['transactions']['id'])) ?>" >
                                                            <span class="fa fa-pencil"></span>
                                                        </a>
                                                    <?php endif; ?>

                                                    &nbsp;&nbsp;
                                                    <a  target="_blank" title="Take Payment" href="<?php echo Router::url(array('controller' => 'payments', 'action' => 'process', $info['transactions']['id'], $info['package_customers']['id'])) ?>" >
                                                        <span class="fa fa-dollar"></span>
                                                    </a>

                                                    &nbsp;&nbsp;
                                                    <a href="#invoice-pop-up<?php echo $info['transactions']['id']; ?>" class="btn btn-default fancybox-fast-view"> <span class="fa fa-file"></span>
                                                    </a>

                                                    &nbsp;
                                                    <a 
                                                        onclick="if (confirm('Are you sure to Void this Transaction?')) {
                                                                        return true;
                                                                    }
                                                                    return false;"

                                                        href="<?php echo Router::url(array('controller' => 'transactions', 'action' => 'void', $info['transactions']['id'])) ?>" title="Void">
                                                        <span class="fa  fa-ban"></span>
                                                    </a>
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


                <!--     Begin Additional Invoice    -->

                <div class="portlet box lightseagreen" style="background-color:#daae2b; border: #daae2b solid 2px;">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-list-ul"></i>Additional Invoice 
                        </div>

                        <div class="tools">
                            <a  class="reload toggle"data-id="updatepayinfo">
                            </a>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="row" id="updatepayinfo" style="display: none;"> 
                            <div class="col-md-12">
                                <?php
                                echo $this->Form->create('Transaction', array(
                                    'inputDefaults' => array(
                                        'label' => false,
                                        'div' => false
                                    ),
                                    'class' => 'form-horizontal',
                                    'novalidate' => 'novalidate',
                                    'url' => array('controller' => 'transactions', 'action' => 'extrainvoice')
                                        )
                                );
                                ?>

                                <?php
                                echo $this->Form->input('package_customer_id', array(
                                    'type' => 'hidden',
                                    'value' => $this->params['pass'][0],
                                        )
                                );
                                ?>
                                <?php
                                echo $this->Form->input('status', array(
                                    'type' => 'hidden',
                                    'value' => 'open',
                                        )
                                );
                                ?>
                                <?php
                                echo $this->Form->input('type', array(
                                    'type' => 'hidden',
                                    'value' => 'extra',
                                        )
                                );
                                ?>
                                <div class="form-body">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label col-md-1">Description:<span class="">
                                                </span>
                                            </label>
                                            <div class="col-md-3">
                                                <?php
                                                echo $this->Form->input(
                                                        'note', array(
                                                    'type' => 'text',
                                                    'class' => 'form-control ',
                                                ));
                                                ?>
                                            </div>

                                            <label class="control-label col-md-1">Quantity:<span class="">
                                                </span>
                                            </label>
                                            <div class="col-md-3">
                                                <?php
                                                echo $this->Form->input(
                                                        'quantity', array(
                                                    'type' => 'text',
                                                    'class' => 'form-control ',
                                                    'id' => 'quantity'
                                                ));
                                                ?>
                                            </div>
                                            <label class="control-label col-md-1">Rate:<span class="">
                                                </span>
                                            </label>
                                            <div class="col-md-3">
                                                <?php
                                                echo $this->Form->input(
                                                        'rate', array(
                                                    'type' => 'text',
                                                    'class' => 'form-control ',
                                                    'id' => 'rate'
                                                ));
                                                ?>
                                            </div>




                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-1">Discount:<span class="">
                                                </span>
                                            </label>
                                            <div class="col-md-3">
                                                <?php
                                                echo $this->Form->input(
                                                        'discount', array(
                                                    'type' => 'text',
                                                    'class' => 'form-control ',
                                                    'id' => 'discount'
                                                ));
                                                ?>
                                            </div>

                                            <label class="control-label col-md-1">Price:<span class="">
                                                </span>
                                            </label>
                                            <div class="col-md-3">
                                                <?php
                                                echo $this->Form->input(
                                                        'payable_amount', array(
                                                    'type' => 'text',
                                                    'class' => 'form-control ',
                                                    'id' => 'price'
                                                ));
                                                ?>
                                            </div> 

                                            <label class="control-label col-md-1">Payment date:<span class="">
                                                </span>
                                            </label>
                                            <div class="col-md-3">
                                                <?php
                                                echo $this->Form->input(
                                                        'next_payment', array(
                                                    'type' => 'text',
                                                    'class' => 'datepicker form-control ',
                                                ));
                                                ?>
                                            </div>                                         

                                        </div>
                                    </div>
                                    <div class="form-actions">
                                        <div class="row">
                                            <div class="col-md-offset-6 col-md-4">
                                                <?php
                                                echo $this->Form->button(
                                                        'Generate', array('class' => 'btn red-sunglo', 'type' => 'submit',
                                                    'disabled' => $btn, 'style' => "background-color: #daae2b;",)
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
                </div>
                <!--End update next payment date-->

            </div>
            <!-------------------------------------START REFUND---------------------->
            <?php if (($user == 'sadmin') || ($user == 'supervisor') || ($user == 'developer')): ?>
                <div  class="col-md-12 col-sm-12">
                    <div class="portlet box red-sunglo">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-list-ul"></i>Refund
                            </div>
                            <div class="tools">
                                <a  class="reload toggle" data-id="refund">
                                </a>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div class="row" id="refund" style="display: none;"> 
                                <?php
                                echo $this->Form->create('Transaction', array(
                                    'inputDefaults' => array(
                                        'label' => false,
                                        'div' => false
                                    ),
                                    'id' => 'form_sample_3',
                                    'class' => 'form-horizontal',
                                    'novalidate' => 'novalidate',
                                    //'enctype' => 'multipart/form-data',
                                    'url' => array('controller' => 'transactions', 'action' => 'refundTransaction')
                                        )
                                );
                                ?>

                                <?php
                                echo $this->Form->input(
                                        'pay_mode', array(
                                    'type' => 'hidden',
                                    'value' => 'refund'
                                ));
                                ?>
                                <div class="form-body">
                                    <?php
                                    echo $this->Form->input(
                                            'cid', array(
                                        'type' => 'hidden',
                                        'value' => $this->params['pass'][0]
                                    ));
                                    ?>                                   

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="control-label col-md-2">Transaction Number<span class="">
                                                </span>
                                            </label>
                                            <div class="col-md-4">
                                                <?php
                                                echo $this->Form->input(
                                                        'trx_no', array(
                                                    'class' => 'form-control ',
                                                    'type' => 'text'
                                                        )
                                                );
                                                ?>
                                            </div>
                                            <label class="control-label col-md-3">Card Number(Last 4 digit)<span class="">
                                                </span>
                                            </label>
                                            <div class="col-md-3">
                                                <?php
                                                echo $this->Form->input(
                                                        'card_no', array(
                                                    'class' => 'form-control ',
                                                    'type' => 'text'
                                                        )
                                                );
                                                ?>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-2">Card Exp Date</label>
                                            <div class="col-md-2">
                                                <?php
                                                echo $this->Form->input('exp_date.year', array(
                                                    'type' => 'select',
                                                    'options' => $ym['year'],
                                                    'empty' => 'Select Year',
                                                    'class' => 'span12 form-control uniform nostyle select1 ',
                                                    'id' => 'year'
                                                        )
                                                );
                                                ?>
                                            </div>
                                            <div class="col-md-2">
                                                <?php
                                                echo $this->Form->input('exp_date.month', array(
                                                    'type' => 'select',
                                                    'options' => $ym['month'],
                                                    'empty' => 'Select Month',
                                                    'class' => 'span12 form-control uniform nostyle select1 ',
                                                    'id' => 'month'
                                                        )
                                                );
                                                ?>
                                            </div>

                                            <label class="control-label col-md-3">Refund Amount<span class="">
                                                </span>
                                            </label>
                                            <div class="col-md-3">
                                                <?php
                                                echo $this->Form->input(
                                                        'refund_amount', array(
                                                    'class' => 'form-control ',
                                                    'type' => 'text'
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
                                                        'Confirm', array('class' => 'btn red-sunglo',
                                                    'disabled' => $btn, 'type' => 'submit')
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
                </div>

            <?php endif; ?>

            <!-------------------------------------END REFUND---------------------->

            <!------------------------------------- Start Adjustment Memo---------------------->
            <?php if (($user == 'sadmin') || ($user == 'supervisor') || ($user == 'developer')): ?>
                <div  class="col-md-12 col-sm-12">
                    <div class="portlet box blue-hoki">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-list-ul"></i>Adjustment Memo
                            </div>
                            <div class="tools">
                                <a  class="reload toggle" data-id="adjustment">
                                </a>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div class="row" id="adjustment" style="display: none;"> 
                                <?php
                                echo $this->Form->create('Transaction', array(
                                    'inputDefaults' => array(
                                        'label' => false,
                                        'div' => false
                                    ),
                                    'id' => 'form_sample_3',
                                    'class' => 'form-horizontal',
                                    'novalidate' => 'novalidate',
                                    'type' => 'file',
                                    'url' => array('controller' => 'customers', 'action' => 'adjustmentMemo')
                                        )
                                );
                                ?>

                                <div class="form-body">
                                    <?php
                                    echo $this->Form->input(
                                            'package_customer_id', array(
                                        'type' => 'hidden',
                                        'value' => $this->params['pass'][0]
                                    ));
                                    ?>                                 
                                    <div class="row">
                                        <label class="control-label col-md-2">Adjustment<span class="">
                                            </span>
                                        </label>
                                        <div class="col-md-2">
                                            <?php
                                            echo $this->Form->input('status', array(
                                                'type' => 'select',
                                                'empty' => 'Select Type',
                                                'options' => array(
                                                    'credit' => 'Credit',
                                                    'sdadjustment' => 'SD Adjustment',
                                                    'sdrefund' => 'SD Refund',
                                                    'referralbonus' => 'Referral Bonus'
                                                ),
                                                'class' => 'adjusmentChange')
                                            );
                                            ?>
                                        </div>
                                        <label class="control-label col-md-1">Date<span class="">
                                            </span>
                                        </label>
                                        <div class="col-md-2">
                                            <?php
                                            echo $this->Form->input(
                                                    'next_payment', array(
                                                'type' => 'text',
                                                'id' => 'next_payment1',
                                                'class' => 'datepicker form-control'
                                            ));
                                            ?>
                                        </div>
                                        <div id="amount">
                                            <label class="control-label col-md-1">Amount<span class="">
                                                </span>
                                            </label>
                                            <div class="col-md-2">
                                                <?php
                                                echo $this->Form->input(
                                                        'payable_amount', array(
                                                    'class' => 'form-control',
                                                    'type' => 'text',
                                                    'value' => ''
                                                        )
                                                );
                                                ?>
                                            </div>
                                        </div>
                                    </div>

                                    <br>

                                    <div class="row">
                                        <div class=" display-hide" id="attachment" >
                                            <label class="control-label col-md-2">PDF Attachment<span class="">
                                                </span>
                                            </label>
                                            <div class="col-md-3">
                                                <?php
                                                echo $this->Form->input(
                                                        'attachment', array(
                                                    'type' => 'file',
                                                    'id' => 'required',
                                                    'class' => ' span9 text'
                                                        )
                                                );
                                                ?>
                                            </div>
                                        </div>
                                        <div class=" display-hide" id="referralbonus" >                                           
                                            <label class="control-label col-md-2">Referred By<span class="">
                                                </span>
                                            </label>
                                            <div class="col-md-2">
                                                <?php
                                                echo $this->Form->input(
                                                        'phone', array(
                                                    'class' => 'form-control ',
                                                    'type' => 'text',
                                                    'placeholder' => 'Contact no',
                                                    'value' => ''
                                                        )
                                                );
                                                ?>
                                            </div>                                           
                                        </div>

                                        <label class="control-label col-md-1">Note<span class="">
                                            </span>
                                        </label> 
                                        <div class="col-md-3">
                                            <?php
                                            echo $this->Form->input(
                                                    'note', array(
                                                'class' => 'form-control ',
                                                'type' => 'textarea'
                                                    )
                                            );
                                            ?>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="form-actions">
                                        <div class="row">
                                            <div class="col-md-offset-6 col-md-4">
                                                <?php
                                                echo $this->Form->button(
                                                        'Submit', array('class' => 'btn',
                                                    'disabled' => $btn, 'type' => 'submit')
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
                </div>

            <?php endif; ?>

            <!-------------------------------------END REFUND---------------------->

            <!--     Begin previous invoice attachment    -->
            <div  class="col-md-12 col-sm-12">
                <div class="portlet box lightseagreen" style="background-color:#8BC34A; border: #8BC34A solid 2px;">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-list-ul"></i>Previous invoice attachment
                        </div>

                        <div class="tools">
                            <a  class="reload toggle"data-id="previousinvoiceattachment">
                            </a>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="row" id="previousinvoiceattachment" style="display: none;"> 
                            <div class="col-md-6">
                                <?php
                                echo $this->Form->create('Attachment', array(
                                    'inputDefaults' => array(
                                        'label' => false,
                                        'div' => false
                                    ),
                                    'class' => 'form-horizontal',
                                    'novalidate' => 'novalidate',
                                    'type' => 'file',
                                    'url' => array('controller' => 'customers', 'action' => 'extrainvoice')
                                        )
                                );
                                ?>

                                <?php
                                echo $this->Form->input('package_customer_id', array(
                                    'type' => 'hidden',
                                    'value' => $this->params['pass'][0],
                                        )
                                );
                                ?>


                                <div class="form-body">
                                    <div class="form-group">
                                        <label class="control-label col-md-3">Choose PDF file
                                        </label>
                                        <div class="col-md-4">
                                            <?php
                                            echo $this->Form->input(
                                                    'name', array(
                                                'type' => 'file',
                                                'id' => 'required',
                                                'class' => 'span9 text'
                                                    )
                                            );
                                            ?>
                                        </div>
                                    </div>
                                    <div class="form-actions">
                                        <div class="row">
                                            <div class="col-md-offset-6 col-md-4">
                                                <?php
                                                echo $this->Form->button(
                                                        'Submit', array('class' => 'btn red-sunglo',
                                                    'disabled' => $btn, 'type' => 'submit', 'style' => "background-color: #8BC34A;",)
                                                );
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    <?php echo $this->Form->end(); ?>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <ul>
                                    <?php foreach ($attachments as $no => $attachment): ?>
                                        <li><a href="<?php echo $this->webroot . 'attachment/' . $attachment['Attachment']['name']; ?>" target="_blank">QB Statement<?php echo $no + 1; ?></a> </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--End previous invoice attachment-->


            <!-------------payment history start----------------->
            <div  class="col-md-12 col-sm-12">

                <div>
                    <div class="portlet box " style="background-color: tomato; border: tomato solid 2px;">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-list-ul"></i>Statement
                            </div>
                            <div class="tools">
                                <a  class="reload toggle" data-id="transaction" ></a>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <?php if (count($statements)) { ?>
                                <div class="row" id="transaction" style="display: none;">
                                    <div  class="col-md-12 col-sm-12">
                                        <div  class="col-md-9 col-sm-9">
                                        </div>  
                                        <div  class="col-md-3 col-sm-3">
                                            <table cellpadding="0" cellspacing="0" border="0" class="responsive dynamicTable display table table-bordered" width="100%" >
                                                <thead>
                                                <div style="text-align: right; font: bold ; font-size: 19px; margin-right: 2px;">Statement</div>
                                                <tr >  
                                                    <th>Date</th>
                                                    <th>Statement #</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                    <tr class="odd gradeX">
                                                        <td> <?php
                                                            echo date('m-d-Y');
                                                            $customer = $customer_info['PackageCustomer'];
                                                            ?></td>  
                                                        <td>#<?php echo $this->request->params['pass'][0]; ?></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <div  class="col-md-12 col-sm-12">
                                        <div  class="col-md-3 col-sm-3">
                                            <table cellpadding="0" cellspacing="0" border="0" class="responsive dynamicTable display table table-bordered" width="100%" >
                                                <thead>
                                                    <tr >  
                                                        <th>To</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $single = $statements;
                                                    $customer_address = $customer['house_no'] . ' ' . $customer['street'] . ' ' .
                                                            $customer['apartment'] . ' ' . $customer['city'] . ' ' . $customer['state'] . ' '
                                                            . $customer['zip'];
                                                    ?>
                                                    <tr class="odd gradeX">
                                                        <td>                                            
                                                            <?php
                                                            echo $customer['first_name'] . " " .
                                                            $customer['middle_name'] . " " .
                                                            $customer['last_name'];
                                                            ?>
                                                            <br>
                                                            <?php if (!empty($customer['cell'])): ?>
                                                                <b>Cell:</b>  <a href="tel:<?php echo $customer['cell'] ?>"><?php echo $customer['cell']; ?></a> &nbsp;&nbsp;
                                                            <?php endif; ?><br>
                                                            <?php if (!empty($customer['home'])): ?>
                                                                <b> Phone: </b> <a href="tel:<?php echo $customer['home']; ?>"><?php echo $customer['home']; ?></a>
                                                            <?php endif; ?> <br>
                                                            <b> Address: </b> <?php echo $customer_address; ?> 
                                                        </td>
                                                    </tr>                                           
                                                </tbody>
                                            </table>
                                        </div>
                                        <div  class="col-md-9 col-sm-9">                                   
                                        </div>
                                    </div>
                                    <div  class="col-md-12 col-sm-12">
                                        <div  class="col-md-9 col-sm-9">
                                        </div>  
                                        <div  class="col-md-3 col-sm-3">
                                            <table cellpadding="0" cellspacing="0" border="0" class="responsive dynamicTable display table table-bordered" width="100%" >
                                                <thead>
                                                    <tr >  
                                                        <th>Amount Due</th>
                                                        <th>Enclosed</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr class="odd gradeX">
                                                        <td class="due-amount"></td>                                                
                                                        <td></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <table cellpadding="0" cellspacing="0" border="0" class="responsive dynamicTable display table table-bordered" width="100%" >
                                        <thead>
                                            <tr >  
                                                <th>Invoice</th>
                                                <th>Payment info</th>
                                                <th>Additional Note</th>
                                                <th>Amount</th>
                                                <th>Balance</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $balance = array();
                                            foreach ($statements as $single):

                                                $bill = $single['bill'];
//                                            pr($bill); exit;
                                                $payments = $single['payment'];

                                                $amount = $bill['payable_amount'];
                                                if ($bill['status'] == 'approved') {
                                                    $amount = (-1) * $bill['payable_amount'];
                                                }
                                                $balance[] = $amount;
                                                // $prevIndex = -1;
                                                $payment_date = $bill['next_payment'];

                                                $payment_time = strtotime($payment_date);
                                                $currenttime = strtotime(date('Y-m-d'));
                                                $next7days = strtotime("+7 day");
                                                $time_remaining = $next7days - $payment_time;
                                                $diff = 7 * 24 * 60 * 60;
//                                                echo $next7days;
//                                                echo ':'.$payment_time.'<br>'.$diff;
//                                                echo '<hr>';

                                                if (count($balance) > 1) {
                                                    $prevIndex = count($balance) - 2;
                                                    $balance[] = $balance[$prevIndex] + $balance[$prevIndex + 1];
                                                }
                                                ?>
                                                <tr class="odd gradeX">
                                                    <td>
                                                        <a href="#invoice-pop-up<?php echo $bill['id']; ?>" class="btn btn-default fancybox-fast-view"> <?php echo empty($bill['invoice']) ? $bill['id'] : $bill['invoice']; ?></a><br>
                                                    </td>
                                                    <td>
                                            <li>
                                                Payable Amount : <?php echo $bill['payable_amount']; ?> 
                                            </li>
                                            <li>
                                                Invoice Date : 
                                                <?php echo date('m-d-Y', strtotime($bill['next_payment'])); ?>
                                                <a  target="_blank" title="Edit" href="<?php echo Router::url(array('controller' => 'transactions', 'action' => 'edit', $this->request->params['pass'][0], $bill['id'])) ?>" >
                                                    <span class="fa fa-pencil " target ="_blank"></span>
                                                </a>
                                            </li>
                                            </td>
                                            <td><?php echo $bill['note']; ?></td>
                                            <td>
                                                <?php
                                                echo $amount; // + $bill['discount'];
                                                ?>
                                            </td>
                                            <td>
                                                <?php echo end($balance); ?>
                                            </td>
                                            </tr>

                                            <?php
                                            foreach ($payments as $payment):
                                                //  pr($payment['tr']['discount']); //exit;
                                                $amount = -1 * $payment['tr']['payable_amount'];
                                                $balance[] = $amount;
                                                $prevIndex = count($balance) - 2;
                                                $balance[] = $balance[$prevIndex] + $balance[$prevIndex + 1];
                                                ?>
                                                <tr class="odd gradeX">
                                                    <td> 

                                                        <a href="#invoice-pop-up<?php echo $payment['tr']['id']; ?>" class="btn btn-default fancybox-fast-view"> <?php echo empty($payment['tr']['invoice']) ? $payment['tr']['id'] : $payment['tr']['invoice']; ?></a><br>
                                                    </td>

                                                    <td>
                                                        <ul>
                                                            <?php if ($payment['tr']['pay_mode'] == 'card'): ?>

                                                                <li>Pay Mode : <?php echo $payment['tr']['pay_mode']; ?></li> 
                                                                <li>Status : <?php echo $payment['tr']['status']; ?></li>
                                                                <?php if ($payment['tr']['status'] == 'error'): ?>
                                                                    <ul>
                                                                        <li>Error Message : <?php echo $payment['tr']['error_msg']; ?></li> 
                                                                    </ul>
                                                                <?php endif;
                                                                ?>
                                                                <li>Transaction No : <?php echo $payment['tr']['trx_id']; ?></li> 
                                                                <li>Card No : <?php echo substr($payment['tr']['card_no'], -4); ?></li>  
                                                                <li>Zip Code : <?php echo $payment['tr']['zip_code']; ?></li>  

                                                                <li>Expire Date : <?php echo $payment['tr']['exp_date']; ?></li>

                                                            <?php elseif ($payment['tr']['pay_mode'] == 'cash'): ?>
                                                                <li>Pay Mode : <?php echo $payment['tr']['pay_mode']; ?></li> 
                                                                <li> Cash By : <?php echo $payment['tr']['cash_by']; ?> </li>
                                                                <a  target="_blank" title="Edit"  href="<?php echo Router::url(array('controller' => 'transactions', 'action' => 'edit', $this->request->params['pass'][0], $payment['tr']['id'])) ?>" >
                                                                    <span class="fa fa-pencil" target ="_blank"></span>
                                                                </a>
                                                            <?php elseif ($payment['tr']['pay_mode'] == 'refund'): ?>
                                                                <li>Pay Mode : <?php echo $payment['tr']['pay_mode']; ?></li>
                                                                <li>Check Info : <?php echo $payment['tr']['check_info']; ?></li>
                                                                <ul> <li>Amount : <?php echo $payment['tr']['paid_amount']; ?></li>
                                                                    <li>Refund Date : <?php echo date('m-d-Y', strtotime($payment['tr']['created'])); ?></li>
                                                                </ul>
                                                                <a  target="_blank" title="Edit"  href="<?php echo Router::url(array('controller' => 'transactions', 'action' => 'edit', $this->request->params['pass'][0], $payment['tr']['id'])) ?>" >
                                                                    <span class="fa fa-pencil" target ="_blank"></span>
                                                                </a>
                                                            <?php else: ?>
                                                                <li>Pay Mode : <?php echo $payment['tr']['pay_mode']; ?></li> 
                                                                <li>Check Info : <?php echo $payment['tr']['check_info']; ?></li>
                                                                <?php if (!empty($payment['tr']['check_image'])): ?>
                                                                    <img src="<?php echo $this->webroot . 'check_images' . '/' . $payment['tr']['check_image']; ?>"  width="50px" height="50px" />
                                                                <?php endif; ?>
                                                                <a  target="_blank" title="Edit"  href="<?php echo Router::url(array('controller' => 'transactions', 'action' => 'edit', $this->request->params['pass'][0], $payment['tr']['id'])) ?>" >
                                                                    <span class="fa fa-pencil" target ="_blank"></span>
                                                                </a>
                                                            <?php endif; ?> 

                                                            <li> Payment Date: <?php echo date('m-d-Y', strtotime($payment['tr']['created'])); ?> </li>
                                                            <a  target="_blank" title="Edit" href="<?php echo Router::url(array('controller' => 'transactions', 'action' => 'edit', $this->request->params['pass'][0], $payment['tr']['id'])) ?>" >
                                                                <span class="fa fa-pencil " target ="_blank"></span>
                                                            </a>

                                                            <li> Payment of : #<?php echo $payment['tr']['transaction_id']; ?> </li>
                                                        </ul>

                                                    </td>
                                                    <td><?php echo $payment['tr']['note']; ?></td>

                                                    <td>
                                                        <?php
                                                        echo $amount;
                                                        ?>
                                                    </td>
                                                    <td><?php echo end($balance); ?></td>
                                                </tr>

                                            <?php endforeach; ?>
                                            <?php
                                        endforeach;
                                        $due = end($balance);
                                        echo '<span class="due-amount-2 hide">' . $due . '</span>';
                                        ?>
                                        </tbody>
                                    </table>
                                </div>
                                <?php
                            } else {
                                ?>
                                <h2> No transaction found for this customer!</h2>
                            <?php }
                            ?>
                        </div>
                    </div>
                    <section class="modal4invoice">
                        <?php
                        foreach ($statements as $single):
                            $bill = $single['bill'];
                            $date = $bill['next_payment'];

                            $payments = $single['payment'];
                            $package = $single['package'];
                            ?>
                            <div id="invoice-pop-up<?php echo $bill['id']; ?>" style="display: none; width: 800px;">
                                <div class="product-page product-pop-up" style="margin-left: 0px !important;">
                                    <div class="page-content-wrapper"> <a href="<?php
                                        echo Router::url(array('controller' => 'customers', 'action' => 'send', $bill['id'])
                                        )
                                        ?>">Send mail</a>

                                        <div class="page-content_invo">     
                                            <div>
                                                <div class="page-bar">
                                                    <ul class="page-breadcrumb">
                                                        <li>   </li>
                                                        <li>   </li>
                                                        <li>   </li>
                                                    </ul>
                                                    <script></script>
                                                </div>
                                                <div  class="printableArea">   
                                                    <?php
                                                    $customer_address_one = $customer['house_no'] . ' ' . $customer['street'] . ' ' .
                                                            $customer['apartment'];
                                                    $customer_address_two = $customer['city'] . ' ' . $customer['state'] . ' '
                                                            . $customer['zip'];
                                                    ?>                
                                                    <div style="page-break-before:always" >&nbsp;</div> 
                                                    <div class="row">
                                                        <div class="col-xs-4">                              
                                                            <ul class="list-unstyled" style=" text-align: left; color: #555; margin-left: 1px;">
                                                                <img  style=" height: 70px; margin-top: 31px;"src="<?php echo $this->webroot; ?>assets/frontend/layout/img/totalcable.jpg">                                                  
                                                                <div style="margin-left: 17px;">P.O BOX 170,E.MEADOW <br>NY 11554</div>
                                                            </ul>
                                                        </div>
                                                        <div class="col-xs-3">                               
                                                            <ul class="list-unstyled">                                   
                                                            </ul>
                                                        </div>
                                                        <div class="col-xs-5 invoice-payment">                             

                                                        </div>
                                                    </div>                  
                                                    <hr style="display: block; border-style: inset; border-color:  darkmagenta;">
                                                    <div class="row invoice-logo">
                                                        <div class="row" style="margin-top: 0;">                          
                                                            <div class="col-xs-7">                              

                                                                <table style=" margin-left: 105px; border: #555 solid 1px; min-width: 275px;">
                                                                    <th style=" border: #555 solid 1px; padding-left: 2px;">
                                                                        <b style=" color: #000;">Bill To</b>
                                                                    </th>
                                                                    <tr>
                                                                        <td style="padding-left: 5px; min-height: 115px; line-height: 15px;">
                                                                            <?php // if (!empty($single['0']['name'])):                     ?>
                                                                            <?php echo $customer['first_name'] . ' ' . $customer['middle_name'] . ' ' . $customer['last_name']; ?>
                                                                            <br>
                                                                            <?php echo $customer_address_one; ?><br>
                                                                            <?php echo $customer_address_two; ?>
                                                                        </td>
                                                                    </tr>
                                                                </table>                               
                                                            </div>                            
                                                            <div class="col-xs-5 invoice-payment"> 
                                                                <ul class="list-unstyled" style=" text-align: right; color: #000; margin-right: 17px;">
                                                                    <table  cellpadding="0" cellspacing="0" border="0" class="responsive dynamicTable display table table-bordered" width="100%">
                                                                        <b>Invoice</b>
                                                                        <tr>
                                                                            <th style="text-align: center !important;">Date</th>
                                                                            <th style="text-align: center !important;">Invoice #</th>

                                                                        </tr>
                                                                        <tr>
                                                                            <td style="text-align: center !important;"><?php echo date('m-d-Y', strtotime($date)); ?> </td>
                                                                            <td style="text-align: center !important;"><?php echo $bill['id']; ?></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <th style="text-align: center !important;">Terms</th>
                                                                            <th style="text-align: center !important;">Due Date</th>
                                                                        </tr>
                                                                        <tr>
                                                                            <td style="text-align: center !important;"> Next 7 Days</td>
                                                                            <td style="text-align: center !important;"><?php
                                                                                $timestamp = strtotime("+7 days", strtotime($date));
                                                                                echo date('m-d-Y', $timestamp);
                                                                                ?></td>

                                                                        </tr>
                                                                    </table>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <hr  style="border-color: white;">
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
                                                    <div class="row"style=" margin-top: 9px;">
                                                        <div class="col-xs-12 ">
                                                            <table class="table table-striped table-hover margin-top-20" style=" margin-top: 60px; border:  #555 solid 1px;">
                                                                <thead  style="border-bottom: #555 solid 3px;">
                                                                    <tr style="height: 101px; border:  #555 solid 1px;">
                                                                        <th class="hidden-480" style=" color: #333 !important; padding: 0px 0px 39px 19px;">
                                                                            Activity
                                                                        </th>
                                                                        <th class="hidden-480"  style=" color: #333 !important; text-align: center; padding-bottom: 39px;">
                                                                            STB QUANTITY
                                                                        </th>

                                                                        <th class="hidden-480" style=" color: #333 !important; text-align: center; padding-bottom: 39px;">
                                                                            Amount
                                                                        </th>

                                                                        <th class="hidden-480"  style=" padding-bottom: 39px; text-align: center; font-size: 15px;  color: #000 !important; width: 101px;">
                                                                            Status
                                                                        </th>   

                                                                    </tr>
                                                                </thead>
                                                                <tbody>                                   
                                                                    <tr style="height: 101px;">

                                                                        <td style=" color: #333 !important; padding: 43px 0px 0px 19px ;">
                                                                            <ul>
                                                                                <li><?php echo $package; ?> </li>
                                                                                <?php if (!empty($bill['note'])) { ?>
                                                                                    <li><?php echo $bill['note']; ?></li> 
                                                                                <?php } ?>
                                                                            </ul>                                                                          
                                                                        </td> 
                                                                        <td style=" color: #333 !important; text-align: center;  padding: 43px 0px 0px 9px ;">
                                                                            <?php
                                                                            $stbs = json_decode($customer['mac']);
                                                                            echo count($stbs);
                                                                            ?>
                                                                        </td>


                                                                        <td style=" color: #333 !important; text-align: center; padding: 43px 0px 0px 9px ;">
                                                                            <?php echo $bill['payable_amount']; ?>
                                                                        </td>

                                                                        <td  style=" padding: 43px 0px 0px 9px ; text-align: center; font-size: 19px; font-weight: bold; color: #000 !important; width: 151px;">
                                                                            <?php echo $bill['status']; ?> 
                                                                        </td>                                          
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                            <br>
                                                            <div class="row " style=" margin-top: 44px;">
                                                                <div class="col-xs-3">                    
                                                                </div>
                                                                <div class="col-xs-3">
                                                                </div>
                                                                <div class="col-xs-6 invoice-payment">
                                                                    <div class="col-xs-6">  
                                                                        <b style=" color: #000;">Total Payable Amount</b>
                                                                    </div>
                                                                    <div class="col-xs-6" style="text-align: right;">
                                                                        $<?php echo $bill['payable_amount']; ?>     
                                                                    </div>
                                                                    <hr style="border-color: #990000 !important; ">
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-xs-3">                    
                                                                </div>
                                                                <div class="col-xs-3">
                                                                </div>
                                                                <div class="col-xs-6 invoice-payment">
                                                                    <div class="col-xs-6">  
                                                                        <b style=" color: #000;">Total Amount Due </b>
                                                                    </div>
                                                                    <div class="col-xs-6" style="text-align: right;">
                                                                        $<?php echo $bill['payable_amount'] - getPaid($bill['id']); ?>     
                                                                    </div>
                                                                    <hr style="border-color: #990000 !important; ">
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-xs-3">                    
                                                                </div>
                                                                <div class="col-xs-3">
                                                                </div>
                                                                <div class="col-xs-6 invoice-payment">
                                                                    <div class="col-xs-6">  
                                                                        <b style=" color: #000;">Current Balance</b>
                                                                    </div>
                                                                    <div class="col-xs-6" style="text-align: right;">
                                                                        $<strong class="due-amount"></strong>     
                                                                    </div>
                                                                    <hr style="border-color: #990000 !important; ">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row" style="margin-top: 10px;">
                                                        <div class="col-xs-4">                              
                                                            <h6>Please write <b style="font-weight: normal !important; color:red !important;">INVOICE NUMBER</b> on check</h6>
                                                        </div>
                                                        <div class="col-xs-4">                               

                                                        </div>

                                                        <div class="col-xs-4">                             
                                                            <h6>Make check payable to <b style="font-weight: normal !important; color:red !important;">TOTAL CABLE BD</b></h6>
                                                        </div>
                                                    </div> 


                                                    <div class="row" style="background-color:  yellowgreen !important; border-top:  red solid 1px;">
                                                        <div class="col-xs-4" style="text-align: center;">                              
                                                            <h5 style=" color: white !important;"> e-mail: info@totalcablebd.com</h5>
                                                        </div>
                                                        <div class="col-xs-4">                               

                                                        </div>
                                                        <div class="col-xs-4" style="text-align: center;">                             
                                                            <h5 style=" color: white !important;">Web: totalcablebd.com</h5>
                                                        </div>
                                                    </div>                

                                                </div>
                                            </div>          
                                        </div> 
                                    </div>
                                </div>
                            </div>

                            <?php
                            foreach ($payments as $single):
                                $payment = $single['tr'];
                                ?>
                                <div id="invoice-pop-up<?php echo $payment['id']; ?>" style="display: none; width: 800px;">

                                    <div class="product-page product-pop-up" style="margin-left: 0px !important;">
                                        <div class="page-content-wrapper">

                                            <div class="page-content_invo">     
                                                <div>    

                                                    <div class="page-bar">
                                                        <ul class="page-breadcrumb">
                                                            <li>   </li>
                                                            <li>   </li>
                                                            <li>   </li>
                                                        </ul>
                                                        <script></script>

                                                    </div>

                                                    <div  class="printableArea">   
                                                        <?php
                                                        $customer_address_one = $customer['house_no'] . ' ' . $customer['street'] . ' ' .
                                                                $customer['apartment'];
                                                        $customer_address_two = $customer['city'] . ' ' . $customer['state'] . ' '
                                                                . $customer['zip'];
                                                        ?>                
                                                        <div style="page-break-before:always" >&nbsp;</div> 
                                                        <div class="row">
                                                            <div class="col-xs-4">                              
                                                                <ul class="list-unstyled" style=" text-align: left; color: #555; margin-left: 1px;">
                                                                    <img style=" height: 70px; margin-top: 31px;"src="<?php echo $this->webroot; ?>assets/frontend/layout/img/totalcable.jpg">                                                  
                                                                    <div style="margin-left: 17px;">P.O BOX 170,E.MEADOW<br> NY 11554</div>
                                                                </ul>
                                                            </div>
                                                            <div class="col-xs-3">                               
                                                                <ul class="list-unstyled">                                   
                                                                </ul>
                                                            </div>
                                                            <div class="col-xs-5 invoice-payment">                             

                                                            </div>
                                                        </div>                  
                                                        <hr style="display: block; border-style: inset; border-color:  darkmagenta;">
                                                        <div class="row invoice-logo">
                                                            <div class="row" style="margin-top: 0;">                          
                                                                <div class="col-xs-7">                              

                                                                    <table style=" margin-left: 105px; border: #555 solid 1px; min-width: 275px;">
                                                                        <th style=" border: #555 solid 1px; padding-left: 2px;">
                                                                            <b style=" color: #000;">Bill To</b>
                                                                        </th>
                                                                        <tr>
                                                                            <td style="padding-left: 5px; min-height: 115px; line-height: 15px;">
                                                                                <?php // if (!empty($single['0']['name'])):                              ?>

                                                                                <?php echo $customer['first_name'] . ' ' . $customer['middle_name'] . ' ' . $customer['last_name']; ?>



                                                                                <br>
                                                                                <?php echo $customer_address_one; ?><br>

                                                                                <?php echo $customer_address_two; ?>


                                                                            </td>
                                                                        </tr>
                                                                    </table>                               
                                                                </div>                            
                                                                <div class="col-xs-5 invoice-payment">                             
                                                                    <ul class="list-unstyled" style=" text-align: right; color: #000; margin-right: 17px;">

                                                                        <table  cellpadding="0" cellspacing="0" border="0" class="responsive dynamicTable display table table-bordered" width="100%">
                                                                            <b>Invoice</b>
                                                                            <tr>
                                                                                <th style="text-align: center !important;">Payment Date</th>
                                                                                <th style="text-align: center !important;">Invoice #</th>

                                                                            </tr>
                                                                            <tr>
                                                                                <td style="text-align: center !important;"><?php echo $payment['created']; ?></td>
                                                                                <td style="text-align: center !important;"><?php echo $payment['id']; ?></td>
                                                                            </tr>


                                                                        </table>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <hr  style="border-color: white;">
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
                                                        <div class="row"style=" margin-top: 9px;">
                                                            <div class="col-xs-12 ">
                                                                <table class="table table-striped table-hover margin-top-20" style=" margin-top: 60px; border:  #555 solid 1px;">
                                                                    <thead  style="border-bottom: #555 solid 3px;">
                                                                        <tr style="height: 101px; border:  #555 solid 1px;">
                                                                            <th class="hidden-480" style=" color: #333 !important; padding: 0px 0px 39px 19px;">
                                                                                Activity
                                                                            </th>
                                                                            <th class="hidden-480"  style=" color: #333 !important; text-align: center; padding-bottom: 39px;">
                                                                                STB QUANTITY
                                                                            </th>

                                                                            <th class="hidden-480" style=" color: #333 !important; text-align: center; padding-bottom: 39px;">

                                                                                Amount
                                                                            </th>

                                                                            <th class="hidden-480"  style=" padding-bottom: 39px; text-align: center; font-size: 15px;  color: #000 !important; width: 101px;">
                                                                                Status
                                                                            </th>  
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>                                   
                                                                        <tr style="height: 101px;">
                                                                            <td style=" color: #333 !important; padding: 43px 0px 0px 19px ;">
                                                                                <ul>
                                                                                    <li><?php echo $package; ?> </li>
                                                                                    <?php if (!empty($payment['note'])) { ?>
                                                                                        <li><?php echo $payment['note']; ?></li> 
                                                                                    <?php } ?>

                                                                                </ul>
                                                                            </td> 

                                                                            <td style=" color: #333 !important; text-align: center;  padding: 43px 0px 0px 9px ;">
                                                                                <?php
                                                                                $stbs = json_decode($customer['mac']);
                                                                                echo count($stbs);
                                                                                ?>
                                                                            </td>

                                                                            <td style=" color: #333 !important; text-align: center; padding: 43px 0px 0px 9px ;">
                                                                                <?php echo $payment['payable_amount']; ?>
                                                                            </td>

                                                                            <td  style=" padding: 43px 0px 0px 9px ; text-align: center; font-size: 19px; font-weight: bold; color: #000 !important; width: 151px;">
                                                                                <?php echo $payment['status']; ?> 

                                                                            </td>


                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                                <br>
                                                                <div class="row " style=" margin-top: 44px;">
                                                                    <div class="col-xs-3">                    
                                                                    </div>
                                                                    <div class="col-xs-3">
                                                                    </div>
                                                                    <div class="col-xs-6 invoice-payment">
                                                                        <div class="col-xs-6">  
                                                                            <b style=" color: #000;">Total Paid Amount</b>
                                                                        </div>
                                                                        <div class="col-xs-6" style="text-align: right;">
                                                                            $<?php echo getFullPayment($payment['transaction_id']); ?>     
                                                                        </div>
                                                                        <hr style="border-color: #990000 !important; ">
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-xs-3">                    
                                                                    </div>
                                                                    <div class="col-xs-3">
                                                                    </div>
                                                                    <div class="col-xs-6 invoice-payment">
                                                                        <div class="col-xs-6">  
                                                                            <b style=" color: #000;">Total Amount Due</b>
                                                                        </div>
                                                                        <div class="col-xs-6" style="text-align: right;">
                                                                            $<?php echo getFullPayment($payment['transaction_id']) - getPaid($payment['transaction_id']); ?>     
                                                                        </div>
                                                                        <hr style="border-color: #990000 !important; ">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row" style="margin-top: 10px;">
                                                            <div class="col-xs-4">                              
                                                                <h6>Please write <b style="font-weight: normal !important; color:red !important;">INVOICE NUMBER</b> on check</h6>
                                                            </div>
                                                            <div class="col-xs-4">                               

                                                            </div>

                                                            <div class="col-xs-4">                             
                                                                <h6>Make check payable to <b style="font-weight: normal !important; color:red !important;">TOTAL CABLE BD</b></h6>
                                                            </div>
                                                        </div> 


                                                        <div class="row" style="background-color:  yellowgreen !important; border-top:  red solid 1px;">
                                                            <div class="col-xs-4" style="text-align: center;">                              
                                                                <h5 style=" color: white !important;"> e-mail: info@totalcablebd.com</h5>
                                                            </div>
                                                            <div class="col-xs-4">                               

                                                            </div>
                                                            <div class="col-xs-4" style="text-align: center;">                             
                                                                <h5 style=" color: white !important;">Web: totalcablebd.com</h5>
                                                            </div>
                                                        </div>                

                                                    </div>
                                                </div>          
                                            </div> 
                                        </div>
                                    </div>
                                </div>


                            <?php endforeach; ?>


                        <?php endforeach; ?>
                    </section>
                    <div>
                        <!-------------payment history end----------------->

                        <!-------------ticket history start----------------->
                        <div class="portlet box" style="background-color:  steelblue; border: steelblue solid 2px;" id="printableArea">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="fa fa-list-ul"></i>Ticket History &nbsp;<a target="_blank" href="<?php echo Router::url(array('controller' => 'tickets', 'action' => 'create', $this->request->params['pass'][0])) ?>"  style=" font-weight: bold; color:orange;" title="Click here for generate a Ticket">Generate a ticket</a>
                                </div>
                                <div class="tools">
                                    <a  class="reload toggle" data-id="tickethistory">
                                    </a>
                                </div>
                            </div>
                            <div class="portlet-body">
                                <div class="row" id="tickethistory" style="display: none; ">
                                    <div  class="col-md-12 col-sm-12">
                                        <table class="table table-striped table-hover table-bordered" id="sample_editable_1">
                                            <thead>
                                                <tr>
                                                    <th> Id</th>
                                                    <th>Subject</th>
                                                    <th>Customer Info</th>
                                                    <th>Open Time</th>
                                                    <th>Detail</th>
                                                    <th>History</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                foreach ($data as $single):
                                                    $issue = end($single['history']);
                                                    $customer = end($single['history']);
                                                    $customer = $customer['pc'];
                                                    $ticket = $single['ticket'];
                                                    $lasthistory = $issue;
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $ticket['id']; ?></td>
                                                        <td><?php echo $issue['i']['name']; ?></td>
                                                        <td>
                                                            <ul>
                                                                <li> Name: <?php echo $customer['first_name'] . ' ' . $customer['middle_name'] . ' ' . $customer['last_name']; ?> </li> 
                                                                <li> Cell: <?php echo $customer['cell']; ?> </li> 
                                                            </ul>
                                                        </td>
                                                        <td><?php echo date('m-d-Y h:m:s', strtotime($ticket['created'])); ?></td>
                                                        <td>
                                                            <?php echo $ticket['content']; ?>
                                                            <br><strong>Ticket ID : </strong>#<?php echo $ticket['id']; ?>
                                                        </td>
                                                        <td>
                                                            <ol>
                                                                <?php
//                                                               $lasthistory = $single['history'][0]['tr'];

                                                                foreach ($single['history'] as $history):
                                                                    ?>
                                                                    <li>
                                                                        <?php if ($history['tr']['status'] != 'open') { ?>
                                                                            <strong><?php echo ucfirst($history['tr']['status']); ?> By:</strong>
                                                                        <?php } else {
                                                                            ?>
                                                                            <strong>Forwarded By:</strong>
                                                                            <?php
                                                                        }
                                                                        ?>
                                                                        <?php echo $history['fb']['name']; ?>
                                                                        <p><strong>Forwarded To:</strong><ul><li><?php echo $history['fi']['name']; ?> </li><li><?php echo $history['fd']['name']; ?> </li></ul>
                                                                        <strong>Time:</strong>
                                                                        <?php echo date('m-d-Y h:m:s', strtotime($history['tr']['created'])); ?>
                                                                        &nbsp;&nbsp;<strong>Status:</strong> <?php echo $history['tr']['status']; ?><br>
                                                                        <?php
                                                                        if (!empty($history['tr']['comment'])):
                                                                            echo '<strong>';
                                                                            echo 'Comment : ';
                                                                            echo '</strong>';
                                                                            echo $history['tr']['comment'];
                                                                        endif;
                                                                        ?> 
                                                                    </li>
                                                                    <br>
                                                                <?php endforeach; ?>
                                                            </ol>
                                                        </td>
                                                        <td>   
                                                            <div class="controls center text-center">
                                                                <?php if ($lasthistory['tr']['status'] == 'open') { ?>
                                                                    <a  href="#" title="Solved">
                                                                        <span id="<?php echo $ticket['id']; ?>" class="fa fa-check fa-lg solve_ticket"></span>
                                                                    </a>
                                                                    &nbsp;
                                                                    <a  href="#" title="Unresolved">
                                                                        <span id="<?php echo $ticket['id']; ?>" class="fa fa-times fa-lg unsolve_ticket"></span>
                                                                    </a>
                                                                    &nbsp;
                                                                    <a href="#" title="Forward">
                                                                        <span id="<?php echo $ticket['id']; ?>" class="fa fa-mail-forward fa-lg forward_ticket"></span>
                                                                    </a>
                                                                    &nbsp;
                                                                    <a href="#" title="Comment">
                                                                        <span id="<?php echo $ticket['id']; ?>" class="fa fa-comment fa-lg comment_ticket"></span>
                                                                    </a>
                                                                    <div id="forward_dialog<?php echo $ticket['id']; ?>" class="portlet-body form" style="display: none;">
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
                                                                            'url' => array('controller' => 'tickets', 'action' => 'forward')
                                                                        ));
                                                                        ?>
                                                                        <?php
                                                                        echo $this->Form->input('ticket_id', array(
                                                                            'type' => 'hidden',
                                                                            'value' => $ticket['id'],
                                                                                )
                                                                        );
                                                                        ?>
                                                                        <?php
                                                                        echo $this->Form->input('package_customer_id', array(
                                                                            'type' => 'hidden',
                                                                            'value' => $lasthistory['tr']['package_customer_id'],
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
                                                                                        echo $this->Form->input('user_id', array(
                                                                                            'type' => 'select',
                                                                                            'options' => $users,
                                                                                            'empty' => 'Select From Existing admins panel user',
                                                                                            'class' => 'form-control select2me',
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
                                                                            <div class="form-group">
                                                                                <div class="form-group">
                                                                                    <div class="col-md-12">
                                                                                        <?php
                                                                                        echo $this->Form->input('priority', array(
                                                                                            'type' => 'select',
                                                                                            'options' => array('low' => 'Low', 'medium' => 'Medium', 'high' => 'High'),
                                                                                            'empty' => 'Select Priority',
                                                                                            'class' => 'form-control select2me  pclass',
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
                                                                                        echo $this->Form->input('comment', array(
                                                                                            'type' => 'textarea',
                                                                                            'class' => 'form-control ',
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
                                                                                            'Forward', array('class' => 'btn green', 'type' => 'submit')
                                                                                    );
                                                                                    ?>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <?php echo $this->Form->end(); ?>
                                                                        <!-- END FORM-->
                                                                    </div>

                                                                    <div id="solve_dialog<?php echo $ticket['id']; ?>" class="portlet-body form" style="display: none;">

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
                                                                            'url' => array('controller' => 'tickets', 'action' => 'solve')
                                                                                )
                                                                        );
                                                                        ?>

                                                                        <?php
                                                                        echo $this->Form->input('ticket_id', array(
                                                                            'type' => 'hidden',
                                                                            'value' => $ticket['id'],
                                                                                )
                                                                        );
                                                                        ?>

                                                                        <?php
                                                                        echo $this->Form->input('id', array(
                                                                            'type' => 'hidden',
                                                                            'value' => $single['history'][0]['tr']['id'],
                                                                                )
                                                                        );
                                                                        ?>

                                                                        <?php
                                                                        echo $this->Form->input('user_id', array(
                                                                            'type' => 'hidden',
                                                                            'value' => $lasthistory['tr']['user_id'],
                                                                                )
                                                                        );
                                                                        ?>
                                                                        <?php
                                                                        echo $this->Form->input('role_id', array(
                                                                            'type' => 'hidden',
                                                                            'value' => $lasthistory['tr']['role_id'],
                                                                                )
                                                                        );
                                                                        ?>
                                                                        <?php
                                                                        echo $this->Form->input('issue_id', array(
                                                                            'type' => 'hidden',
                                                                            'value' => $lasthistory['tr']['issue_id'],
                                                                                )
                                                                        );
                                                                        ?>
                                                                        <?php
                                                                        echo $this->Form->input('package_customer_id', array(
                                                                            'type' => 'hidden',
                                                                            'value' => $lasthistory['tr']['package_customer_id'],
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
                                                                                            'class' => 'form-control  txtArea',
                                                                                            'placeholder' => 'Write your comments for Solved'
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
                                                                    <div id="unsolve_dialog<?php echo $ticket['id']; ?>" class="portlet-body form" style="display: none;">

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
                                                                            'url' => array('controller' => 'tickets', 'action' => 'unsolve')
                                                                                )
                                                                        );
                                                                        ?>

                                                                        <?php
                                                                        echo $this->Form->input('ticket_id', array(
                                                                            'type' => 'hidden',
                                                                            'value' => $ticket['id'],
                                                                                )
                                                                        );
                                                                        ?>
                                                                        <?php
                                                                        echo $this->Form->input('user_id', array(
                                                                            'type' => 'hidden',
                                                                            'value' => $lasthistory['tr']['user_id'],
                                                                                )
                                                                        );
                                                                        ?>
                                                                        <?php
                                                                        echo $this->Form->input('role_id', array(
                                                                            'type' => 'hidden',
                                                                            'value' => $lasthistory['tr']['role_id'],
                                                                                )
                                                                        );
                                                                        ?>
                                                                        <?php
                                                                        echo $this->Form->input('issue_id', array(
                                                                            'type' => 'hidden',
                                                                            'value' => $lasthistory['tr']['issue_id'],
                                                                                )
                                                                        );
                                                                        ?>
                                                                        <?php
                                                                        echo $this->Form->input('package_customer_id', array(
                                                                            'type' => 'hidden',
                                                                            'value' => $lasthistory['tr']['package_customer_id'],
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
                                                                                            'class' => 'form-control  txtArea',
                                                                                            'placeholder' => 'Write your comments for Unresolved '
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

                                                                    <div id="comment_dialog<?php echo $ticket['id']; ?>" class="portlet-body form" style="display: none;">

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
                                                                            'url' => array('controller' => 'tickets', 'action' => 'ticket_comment')
                                                                                )
                                                                        );
                                                                        ?>

                                                                        <?php
                                                                        echo $this->Form->input('ticket_id', array(
                                                                            'type' => 'hidden',
                                                                            'value' => $ticket['id'],
                                                                                )
                                                                        );
                                                                        ?>

                                                                        <?php
                                                                        echo $this->Form->input('user_id', array(
                                                                            'type' => 'hidden',
                                                                            'value' => $lasthistory['tr']['user_id'],
                                                                                )
                                                                        );
                                                                        ?>
                                                                        <?php
                                                                        echo $this->Form->input('role_id', array(
                                                                            'type' => 'hidden',
                                                                            'value' => $lasthistory['tr']['role_id'],
                                                                                )
                                                                        );
                                                                        ?>
                                                                        <?php
                                                                        echo $this->Form->input('issue_id', array(
                                                                            'type' => 'hidden',
                                                                            'value' => $lasthistory['tr']['issue_id'],
                                                                                )
                                                                        );
                                                                        ?>
                                                                        <?php
                                                                        echo $this->Form->input('package_customer_id', array(
                                                                            'type' => 'hidden',
                                                                            'value' => $lasthistory['tr']['package_customer_id'],
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
                                                                                            'class' => 'form-control  txtArea',
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
                                                                                            'Comments', array('class' => 'btn green ', 'type' => 'submit')
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
                                    <!--<div class="col-md-2"><a href="<?php echo Router::url(array('controller' => 'tickets', 'action' => 'create', $this->request->params['pass'][0])) ?>"  style=" font-weight: bold; color: #E02222;">Generate Ticket</a></div>-->
                                </div>
                            </div>
                        </div>               
                        <!-- END PAGE CONTENT -->
                    </div>
                </div>
                <!-- END CONTENT -->        
            </div>
            <?php if (($user == 'sadmin') || ($user == 'supervisor') || ($user == 'developer')): ?>
                <div class="col-md-offset-6 col-md-4">
                    <?php
                    echo $this->Form->create('PackageCustomer', array(
                        'inputDefaults' => array(
                            'label' => false,
                            'div' => false
                        ),
                        'id' => 'form_sample_3',
                        'class' => 'form-horizontal',
                        'novalidate' => 'novalidate',
                        'url' => array('controller' => 'customers', 'action' => 'delete')
                            )
                    );
                    ?>
                    <button class="btn red-sunglo" onclick="if (confirm('Are you sure to Delete this Customer?')) {
                                    return true;
                                }
                                return false;" <?php echo $btn; ?> type="submit" style="background-color: red;">Delete customer</button>     

                    <?php echo $this->Form->end(); ?>


                </div>
            <?php endif; ?>          

        </div>