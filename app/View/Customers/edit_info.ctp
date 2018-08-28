
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
               
            </h3>
            <?php echo $this->Session->flash(); ?>

            <!-- END EXAMPLE TABLE PORTLET-->
            <div class="col-md-12">
                <div class="portlet box green">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-list-ul"></i>Customer Information
                        </div>
                        <div class="tools">
                            <a  class="reload toggle" data-id="customer_information">
                            </a>
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
                                <div class="col-md-2 signupfont">
                                    Referred by:
                                </div>
                                <div class="col-md-3">
                                    <div class="input-list style-4 clearfix">
                                        <div>
                                            <?php
                                            echo $this->Form->input(
                                                    'referred_name', array(
                                                'class' => '',
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
                                                    )
                                            );
                                            ?>
                                        </div>                            
                                    </div>
                                </div>
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


        </div>