<style type="text/css">
    .alert {
        padding: 6px;
        margin-bottom: 5px;
        border: 1px solid transparent;
        border-radius: 4px;
        text-align: center;
    }
    .signupfont{
        font-size: 14px !important; 
    }

</style>
<div class="page-content-wrapper">
    <div class="page-content">

        <!--customer info to get billing address START-->
        <div class="portlet box green ">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-list-ul"></i>Customer Information
                    <strong style="color: #191818;;">ACCT NO. <?php echo $customer_info['PackageCustomer']['c_acc_no']; ?></strong>
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
                </div>
                <div class="tools">
                    <a href="<?php echo Router::url(array('controller' => 'admins', 'action' => 'servicemanage')) ?>" class="btnPrev"  style="color:  #E02222;">Back
                    </a>
                </div>
                <div class="tools">
                    <?php $created = date("Y-m-d", strtotime($customer_info['PackageCustomer']['created'])); ?>
                    <strong style="color: #191818;">Since. <?php echo $created; ?></strong>
                    <?php ?>
                </div>
            </div>
            <div class="portlet-body">
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
                <?php
                echo $this->Form->input(
                        'package_customer_id', array(
                    'type' => 'hidden',
                    'value' => $this->params['pass'][1]
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
                            Phone (Home):  
                        </div>
                        <div class="col-md-2">
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
                        <div class="col-md-2">
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

                        <div class="col-md-1 signupfont">
                            E-Mail/Fax
                        </div>
                        <div class="col-md-2">
                            <div class="input-list style-4 clearfix">
                                <div>
                                    <?php
                                    echo $this->Form->input(
                                            'email', array(
                                        'class' => '',
                                        'id' => 'email',
                                        'placeholder' => 'Email'
                                            )
                                    );
                                    ?>
                                </div>                            
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="input-list style-4 clearfix">
                                <div>
                                    <?php
                                    echo $this->Form->input(
                                            'fax', array(
                                        'class' => '',
                                        'id' => 'fax',
                                        'placeholder' => 'Fax'
                                            )
                                    );
                                    ?> 
                                </div>                            
                            </div>
                        </div>                                
                    </div>
                </div>                     
                <?php echo $this->Form->end(); ?> 
            </div>
        </div>

        <!--customer info to get billing address END-->

        <div class="portlet box  " style="background-color: green; border: green solid 2px;">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-list-ul"></i>Payment process
                </div>

                <div class="tools">
                    <a  class="reload toggle" data-id="paymentprocess">
                    </a>
                </div>
            </div>



            <div class="portlet-body">
                <div class="row " id="paymentprocess">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover table-bordered">
                                <thead>
                                    <tr>
                                        <th class="tablehead">
                                            PAYMENT METHOD
                                        </th>
                                        <th>
                                        </th>
                                        <th class="tablehead">
                                            CARD/CHECK INFORMATION
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="signupfont" style="min-width: 200px;">
                                            <div class="form-group" style="margin-left: 0px;">
                                                <div class="">
                                                    <label><input class="pmode" checked="checked" type="radio" value="card" name="pmode">CARD (DEBIT/CREDIT)</label>
                                                </div>
                                                <br>
                                                <div class="">
                                                    <label><input class="pmode" type="radio" value="check" name="pmode">CHEQUE</label>
                                                </div>
                                                <br>
                                                <div class="">
                                                    <label><input class="pmode" type="radio" value="money order" name="pmode">MONEY ORDER</label>
                                                </div>
                                                <br>
                                                <div class="">
                                                    <label><input class="pmode" type="radio" value="online bill" name="pmode">ONLINE BILL</label>
                                                </div>
                                                <br>
                                                <div class="">
                                                    <label><input class="pmode" type="radio" value="cash" name="pmode">CASH</label>
                                                </div> <br>
                                                <div class="">
                                                    <label><input class="pmode" type="radio" value="paid invoice" name="pmode">Paid Invoice</label>
                                                </div>

                                            </div>
                                        </td>
                                        <td>

                                        </td>
                                        <td>
                                            <div id="option_card">

                                                <?php
                                                //   pr($latestcardInfo);
                                                //   exit;

                                                echo $this->Form->create('Transaction', array(
                                                    'inputDefaults' => array(
                                                        'label' => false,
                                                        'div' => false
                                                    ),
                                                    'id' => 'form-validate',
                                                    'class' => 'form-horizontal',
                                                    'novalidate' => 'novalidate',
                                                    'enctype' => 'multipart/form-data',
                                                    'url' => array('controller' => 'payments', 'action' => 'request_process')
                                                        )
                                                );
                                                ?>
                                                <?php
                                                echo $this->Form->input(
                                                        'id', array(
                                                    'type' => 'hidden',
                                                    'value' => $this->params['pass'][0]
                                                        )
                                                );
                                                ?> 
                                                <?php
                                                echo $this->Form->input(
                                                        'package_customer_id', array(
                                                    'type' => 'hidden',
                                                    'value' => $this->params['pass'][1]
                                                        )
                                                );
                                                ?> 


                                                <?php
                                                echo $this->Form->input(
                                                        'pay_mode', array(
                                                    'type' => 'hidden',
                                                    'value' => 'card'
                                                ));
                                                ?>
                                                <br>
                                                <div class="col-md-2 signupfont">
                                                    Card Number
                                                </div>
                                                <div class="row">                                                    
                                                    <div class="col-md-3">
                                                        <?php
                                                        echo $this->Form->input(
                                                                'card_no', array(
                                                            'type' => 'text',
                                                            'class' => 'form-control input-sm ',
                                                            'id' => 'card_number',
                                                            'Placeholder' => 'Card Number',
                                                        ));
                                                        ?>
                                                    </div>

                                                    <div class="col-md-2 signupfont">
                                                        Expiration Date:
                                                    </div>
                                                    <div class="col-md-2">
                                                        <?php
                                                        echo $this->Form->input('exp_date.year', array(
                                                            'type' => 'select',
                                                            'options' => $ym['year'],
                                                            'empty' => 'Select Year',
                                                            'class' => 'span12 uniform nostyle select1 ',
                                                            'div' => array('class' => 'span12 '),
                                                            'id' => 'showyear',
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
                                                            'id' => 'showmonth',
                                                                )
                                                        );
                                                        ?>
                                                    </div>  
                                                </div>
                                                <br>
                                                <div class="row">
                                                    <div class="col-md-2 signupfont">
                                                        Invoice#

                                                    </div>
                                                    <div class="col-md-3" style="border: 1px solid; padding: 4px;">
                                                        <?php echo $this->params['pass'][0]; ?>
                                                    </div>
                                                    <div class="col-md-1 signupfont">
                                                        &nbsp; Amount
                                                    </div>
                                                    <div class="col-md-2">
                                                        <?php
                                                        echo $this->Form->input(
                                                                'payable_amount', array(
                                                            'type' => 'text',
                                                            'class' => 'form-control input-sm ',
                                                            'placeholder' => 'Amount'
                                                        ));
                                                        ?>
                                                    </div>

                                                    <div class="col-md-1 signupfont">
                                                        Description
                                                    </div>
                                                    <div class="col-md-3">
                                                        <?php
                                                        echo $this->Form->input(
                                                                'description', array(
                                                            'type' => 'text',
                                                            'class' => 'form-control input-sm ',
                                                        ));
                                                        ?>
                                                    </div>      
                                                </div>
                                                <br>
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <?php
                                                        echo $this->Form->input(
                                                                'fname', array(
                                                            'type' => 'text',
                                                            'class' => 'form-control input-sm ',
                                                            'placeholder' => 'first name',
                                                            'id' => 'firstname',
                                                            'placeholder' => 'First name'
                                                        ));
                                                        ?>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <?php
                                                        echo $this->Form->input(
                                                                'lname', array(
                                                            'type' => 'text',
                                                            'class' => 'form-control input-sm ',
                                                            'placeholder' => 'last name',
                                                            'id' => 'lastname',
                                                            'placeholder' => 'Last name'
                                                        ));
                                                        ?>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <?php
                                                        echo $this->Form->input(
                                                                'city', array(
                                                            'type' => 'text',
                                                            'id' => 'cityname',
                                                            'class' => 'form-control input-sm ',
                                                            'placeholder' => 'City'
                                                        ));
                                                        ?>
                                                    </div>


                                                    <div class="col-md-3">
                                                        <?php
                                                        echo $this->Form->input(
                                                                'state', array(
                                                            'type' => 'text',
                                                            'id' => 'statename',
                                                            'class' => 'form-control input-sm ',
                                                            'placeholder' => 'State/Province'
                                                        ));
                                                        ?>
                                                    </div>


                                                </div>
                                                <br>                                                
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <?php
                                                        echo $this->Form->input(
                                                                'zip_code', array(
                                                            'type' => 'text',
                                                            'id' => 'zip_code',
                                                            'class' => 'form-control input-sm ',
                                                            'placeholder' => 'Zipe Code'
                                                        ));
                                                        ?>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <?php
                                                        echo $this->Form->input(
                                                                'phone', array(
                                                            'type' => 'text',
                                                            'id' => 'phoneno',
                                                            'class' => 'form-control input-sm ',
                                                            'placeholder' => 'Phone'
                                                        ));
                                                        ?>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <?php
                                                        echo $this->Form->input(
                                                                'cvv_code', array(
                                                            'type' => 'password',
                                                            'class' => 'form-control input-sm required',
                                                            'id' => 'cvv_code',
                                                            'placeholder' => 'CVV Code',
                                                            'autocomplete' => 'off'
                                                        ));
                                                        ?>
                                                    </div>                                                    
                                                </div>


                                                &nbsp;
                                                <div class="row">
                                                    <div class="col-md-10 col-md-offset-3">
                                                        <input type="checkbox" id="autofillAddrCheck"  /> <span class="signupfont">SAME AS BILLING ADDRESS </span>
                                                    </div>
                                                </div>

                                                <div class="row">                                              
                                                    <div class="col-lg-6  padding-left-0 padding-top-20 pull-right"> 

                                                        <?php
                                                        echo $this->Form->button(
                                                                'Submit Payment', array(
                                                            'class' => 'btn btn-primary submitbtn blue-dark',
                                                            'type' => 'submit',
                                                            'id' => ''
                                                        ));
                                                        ?>

                                                    </div>
                                                </div>
                                                <?php echo $this->Form->end(); ?>
                                            </div>
                                            &nbsp;
                                            <div id="option_check" class="display-none">
                                                <?php
                                                echo $this->Form->create('Transaction', array(
                                                    'inputDefaults' => array(
                                                        'label' => false,
                                                        'div' => false
                                                    ),
                                                    'id' => 'form-validate',
                                                    'class' => 'form-horizontal',
                                                    'novalidate' => 'novalidate',
                                                    'enctype' => 'multipart/form-data',
                                                    'url' => array('controller' => 'payments', 'action' => 'individual_transaction_by_check')
                                                        )
                                                );
                                                ?>

                                                <?php
                                                echo $this->Form->input(
                                                        'id', array(
                                                    'type' => 'hidden',
                                                    'value' => $this->params['pass'][0]
                                                        )
                                                );
                                                ?> 
                                                <?php
                                                echo $this->Form->input(
                                                        'package_customer_id', array(
                                                    'type' => 'hidden',
                                                    'value' => $this->params['pass'][1]
                                                        )
                                                );
                                                ?> 

                                                <?php
                                                echo $this->Form->input(
                                                        'pay_mode', array(
                                                    'type' => 'hidden',
                                                    'value' => 'check'
                                                ));
                                                ?>
                                                <br>

                                                <div class="row">
                                                    <div class="col-md-3 signupfont">
                                                        Invoice#
                                                    </div>
                                                    <div class="col-md-3" style="border: 1px solid; padding: 4px;">
                                                        <?php echo $this->params['pass'][0]; ?>
                                                    </div>
                                                </div>
                                                <br>

                                                <div class="row">
                                                    <div class="col-md-3 signupfont">
                                                        Attachment: 
                                                    </div>
                                                    <div class="col-md-9">
                                                        <?php
                                                        echo $this->Form->input(
                                                                'check_image', array(
                                                            'type' => 'file',
                                                            'class' => 'form-control input-sm ',
                                                            'value' => ''
                                                        ));
                                                        ?>
                                                    </div>
                                                </div>
                                                &nbsp;
                                                <div class="row">
                                                    <div class="col-md-3 signupfont">
                                                        Charged Amount: 
                                                    </div>
                                                    <div class="col-md-9">
                                                        <?php
                                                        echo $this->Form->input(
                                                                'payable_amount', array(
                                                            'type' => 'text',
                                                            'class' => 'form-control input-sm required',
                                                        ));
                                                        ?>
                                                    </div>
                                                </div>
                                                &nbsp;
                                                <div class="row">
                                                    <div class="col-md-3 signupfont">
                                                        Check Info: 
                                                    </div>
                                                    <div class="col-md-9">
                                                        <?php
                                                        echo $this->Form->input(
                                                                'check_info', array(
                                                            'type' => 'text',
                                                            'class' => 'form-control input-sm required',
                                                            'placeholder' => 'Check No, Bank Name',
                                                            'value' => '',
                                                        ));
                                                        ?>
                                                    </div>
                                                </div>
                                                &nbsp;
                                                <div class="row">
                                                    <div class="col-md-3 signupfont">
                                                        Payment date:
                                                    </div>
                                                    <div class="col-md-9">
                                                        <?php
                                                        echo $this->Form->input(
                                                                'created_check', array(
                                                            'type' => 'text',
                                                            'class' => 'datepicker form-control required',
                                                        ));
                                                        ?>
                                                    </div>
                                                </div>
                                                &nbsp;
                                                <div class="row">
                                                    <div class="col-lg-8 col-md-offset-4 padding-left-0 padding-top-20"> 

                                                        <?php
                                                        echo $this->Form->button(
                                                                'Submit Payment', array(
                                                            'class' => 'btn btn-primary submitbtn green',
                                                            'type' => 'submit',
                                                            'id' => ''
                                                        ));
                                                        ?>

                                                    </div>
                                                </div>

                                                <?php echo $this->Form->end(); ?>
                                            </div>
                                            &nbsp;
                                            <div id="option_moneyorder" class="display-none">
                                                <?php
                                                echo $this->Form->create('Transaction', array(
                                                    'inputDefaults' => array(
                                                        'label' => false,
                                                        'div' => false
                                                    ),
                                                    'id' => 'form-validate',
                                                    'class' => 'form-horizontal',
                                                    'novalidate' => 'novalidate',
                                                    'enctype' => 'multipart/form-data',
                                                    'url' => array('controller' => 'payments', 'action' => 'individual_transaction_by_morder')
                                                        )
                                                );
                                                ?>
                                                <?php
                                                echo $this->Form->input(
                                                        'id', array(
                                                    'type' => 'hidden',
                                                    'value' => $this->params['pass'][0]
                                                        )
                                                );
                                                ?> 
                                                <?php
                                                echo $this->Form->input(
                                                        'package_customer_id', array(
                                                    'type' => 'hidden',
                                                    'value' => $this->params['pass'][1]
                                                        )
                                                );
                                                ?> 

                                                <?php
                                                echo $this->Form->input(
                                                        'pay_mode', array(
                                                    'type' => 'hidden',
                                                    'value' => 'money order'
                                                ));
                                                ?>
                                                <br>
                                                <div class="row">
                                                    <div class="col-md-3 signupfont">
                                                        Invoice#
                                                    </div>
                                                    <div class="col-md-3" style="border: 1px solid; padding: 4px;">
                                                        <?php echo $this->params['pass'][0]; ?>
                                                    </div>
                                                </div>


                                                <br>
                                                <div class="row">
                                                    <div class="col-md-3 signupfont">
                                                        Attachment: 
                                                    </div>
                                                    <div class="col-md-9">
                                                        <?php
                                                        echo $this->Form->input(
                                                                'check_image', array(
                                                            'type' => 'file',
                                                            'class' => 'form-control input-sm ',
                                                            'value' => ''
                                                        ));
                                                        ?>
                                                    </div>
                                                </div>
                                                &nbsp;

                                                <div class="row">
                                                    <div class="col-md-3 signupfont">
                                                        Charged Amount: 
                                                    </div>
                                                    <div class="col-md-9">
                                                        <?php
                                                        echo $this->Form->input(
                                                                'payable_amount', array(
                                                            'type' => 'text',
                                                            'class' => 'form-control input-sm '
                                                        ));
                                                        ?>
                                                    </div>
                                                </div>
                                                &nbsp;

                                                <div class="row">
                                                    <div class="col-md-3 signupfont">
                                                        Check Info: 
                                                    </div>
                                                    <div class="col-md-9">
                                                        <?php
                                                        echo $this->Form->input(
                                                                'check_info', array(
                                                            'type' => 'text',
                                                            'class' => 'form-control input-sm ',
                                                            'placeholder' => 'Check No, Bank Name',
                                                            'value' => '',
                                                        ));
                                                        ?>
                                                    </div>
                                                </div>
                                                &nbsp;
                                                <div class="row">
                                                    <div class="col-md-3 signupfont">
                                                        Payment date:
                                                    </div>
                                                    <div class="col-md-9">
                                                        <?php
                                                        echo $this->Form->input(
                                                                'created_morder', array(
                                                            'type' => 'text',
                                                            'class' => 'datepicker form-control ',
                                                        ));
                                                        ?>
                                                    </div>
                                                </div>
                                                &nbsp;
                                                <div class="row">
                                                    <div class="col-lg-8 col-md-offset-4 padding-left-0 padding-top-20"> 

                                                        <?php
                                                        echo $this->Form->button(
                                                                'Submit Payment', array(
                                                            'class' => 'btn btn-primary submitbtn green',
                                                            'type' => 'submit',
                                                            'id' => ''
                                                        ));
                                                        ?>

                                                    </div>
                                                </div>
                                                <?php echo $this->Form->end(); ?>
                                            </div>
                                            &nbsp;
                                            <div id="option_onlinebill" class="display-none">
                                                <?php
                                                echo $this->Form->create('Transaction', array(
                                                    'inputDefaults' => array(
                                                        'label' => false,
                                                        'div' => false
                                                    ),
                                                    'id' => 'form-validate',
                                                    'class' => 'form-horizontal',
                                                    'novalidate' => 'novalidate',
                                                    'enctype' => 'multipart/form-data',
                                                    'url' => array('controller' => 'payments', 'action' => 'individual_transaction_by_online_bil')
                                                        )
                                                );
                                                ?>

                                                <?php
                                                echo $this->Form->input(
                                                        'id', array(
                                                    'type' => 'hidden',
                                                    'value' => $this->params['pass'][0]
                                                        )
                                                );
                                                ?> 
                                                <?php
                                                echo $this->Form->input(
                                                        'package_customer_id', array(
                                                    'type' => 'hidden',
                                                    'value' => $this->params['pass'][1]
                                                        )
                                                );
                                                ?> 

                                                <?php
                                                echo $this->Form->input(
                                                        'pay_mode', array(
                                                    'type' => 'hidden',
                                                    'value' => 'online bill'
                                                ));
                                                ?>
                                                <br>
                                                <div class="row">
                                                    <div class="col-md-3 signupfont">
                                                        Invoice#
                                                    </div>
                                                    <div class="col-md-3" style="border: 1px solid; padding: 4px;">
                                                        <?php echo $this->params['pass'][0]; ?>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="row">
                                                    <div class="col-md-3 signupfont">
                                                        Attachment: 
                                                    </div>
                                                    <div class="col-md-9">
                                                        <?php
                                                        echo $this->Form->input(
                                                                'check_image', array(
                                                            'type' => 'file',
                                                            'class' => 'form-control input-sm ',
                                                            'value' => ''
                                                        ));
                                                        ?>
                                                    </div>
                                                </div>
                                                &nbsp;
                                                <div class="row">
                                                    <div class="col-md-3 signupfont">
                                                        Charged Amount: 
                                                    </div>
                                                    <div class="col-md-9">
                                                        <?php
                                                        echo $this->Form->input(
                                                                'payable_amount', array(
                                                            'type' => 'text',
                                                            'class' => 'form-control input-sm ',
                                                        ));
                                                        ?>
                                                    </div>
                                                </div>
                                                &nbsp;
                                                <div class="row">
                                                    <div class="col-md-3 signupfont">
                                                        Check Info: 
                                                    </div>
                                                    <div class="col-md-9">
                                                        <?php
                                                        echo $this->Form->input(
                                                                'check_info', array(
                                                            'type' => 'text',
                                                            'class' => 'form-control input-sm ',
                                                            'placeholder' => 'Check No, Bank Name',
                                                            'value' => '',
                                                        ));
                                                        ?>
                                                    </div>
                                                </div>
                                                &nbsp;
                                                <div class="row">
                                                    <div class="col-md-3 signupfont">
                                                        Payment date:
                                                    </div>
                                                    <div class="col-md-9">
                                                        <?php
                                                        echo $this->Form->input(
                                                                'created_onlinebill', array(
                                                            'type' => 'text',
                                                            'class' => 'datepicker form-control ',
                                                        ));
                                                        ?>
                                                    </div>
                                                </div>
                                                &nbsp;
                                                <div class="row">
                                                    <div class="col-lg-8 col-md-offset-4 padding-left-0 padding-top-20"> 
                                                        <?php
                                                        echo $this->Form->button(
                                                                'Submit Payment', array(
                                                            'class' => 'btn btn-primary submitbtn green',
                                                            'type' => 'submit',
                                                            'id' => ''
                                                        ));
                                                        ?>

                                                    </div>
                                                </div>

                                                <?php echo $this->Form->end(); ?>
                                            </div>
                                            &nbsp;
                                            <div id="option_cash" class="display-none">
                                                <?php
                                                echo $this->Form->create('Transaction', array(
                                                    'inputDefaults' => array(
                                                        'label' => false,
                                                        'div' => false
                                                    ),
                                                    'id' => 'form-validate',
                                                    'class' => 'form-horizontal',
                                                    'novalidate' => 'novalidate',
                                                    'enctype' => 'multipart/form-data',
                                                    'url' => array('controller' => 'payments', 'action' => 'individual_transaction_by_cash')
                                                        )
                                                );
                                                ?>

                                                <?php
                                                echo $this->Form->input(
                                                        'id', array(
                                                    'type' => 'hidden',
                                                    'value' => $this->params['pass'][0]
                                                        )
                                                );
                                                ?> 
                                                <?php
                                                echo $this->Form->input(
                                                        'package_customer_id', array(
                                                    'type' => 'hidden',
                                                    'value' => $this->params['pass'][1]
                                                        )
                                                );
                                                ?> 

                                                <?php
                                                echo $this->Form->input(
                                                        'pay_mode', array(
                                                    'type' => 'hidden',
                                                    'value' => 'cash'
                                                ));
                                                ?>
                                                <br>
                                                <div class="row">
                                                    <div class="col-md-3 signupfont">
                                                        Invoice#
                                                    </div>
                                                    <div class="col-md-3" style="border: 1px solid; padding: 4px;">
                                                        <?php echo $this->params['pass'][0]; ?>
                                                    </div>
                                                </div> 
                                                <br>
                                                <div class="row">
                                                    <div class="col-md-3 signupfont">
                                                        Charged Amount: 
                                                    </div>
                                                    <div class="col-md-9">
                                                        <?php
                                                        echo $this->Form->input(
                                                                'payable_amount', array(
                                                            'type' => 'text',
                                                            'class' => 'form-control input-sm '
                                                        ));
                                                        ?>
                                                    </div>
                                                </div>
                                                &nbsp;
                                                <div class="row">
                                                    <div class="col-md-3 signupfont">
                                                        Received by: 
                                                    </div>
                                                    <div class="col-md-9">
                                                        <?php
                                                        echo $this->Form->input(
                                                                'cash_by', array(
                                                            'type' => 'text',
                                                            'class' => 'form-control input-sm ',
                                                            'value' => '',
                                                        ));
                                                        ?>
                                                    </div>
                                                </div>
                                                &nbsp;
                                                <div class="row">
                                                    <div class="col-md-3 signupfont">
                                                        Payment date:
                                                    </div>
                                                    <div class="col-md-9">
                                                        <?php
                                                        echo $this->Form->input(
                                                                'created_cash', array(
                                                            'type' => 'text',
                                                            'class' => 'datepicker form-control ',
                                                        ));
                                                        ?>
                                                    </div>
                                                </div>
                                                &nbsp;
                                                <div class="row">
                                                    <div class="col-lg-8 col-md-offset-4 padding-left-0 padding-top-20"> 
                                                        <?php
                                                        echo $this->Form->button(
                                                                'Submit Payment', array(
                                                            'class' => 'btn btn-primary submitbtn green',
                                                            'type' => 'submit',
                                                            'id' => ''
                                                        ));
                                                        ?>

                                                    </div>
                                                </div>


                                                <?php echo $this->Form->end(); ?>
                                            </div>

                                            &nbsp;
                                            <div id="option_paidinvoice" class="display-none">
                                                <?php
                                                echo $this->Form->create('Transaction', array(
                                                    'inputDefaults' => array(
                                                        'label' => false,
                                                        'div' => false
                                                    ),
                                                    'id' => 'form-validate',
                                                    'class' => 'form-horizontal',
                                                    'novalidate' => 'novalidate',
                                                    'enctype' => 'multipart/form-data',
                                                    'url' => array('controller' => 'payments', 'action' => 'paidInvoice')
                                                        )
                                                );
                                                ?>

                                                <?php
                                                echo $this->Form->input(
                                                        'id', array(
                                                    'type' => 'hidden',
                                                    'value' => $this->params['pass'][0]
                                                        )
                                                );
                                                ?> 
                                                <?php
                                                echo $this->Form->input(
                                                        'package_customer_id', array(
                                                    'type' => 'hidden',
                                                    'value' => $this->params['pass'][1]
                                                        )
                                                );
                                                ?> 
                                                <?php
                                                echo $this->Form->input(
                                                        'pay_mode', array(
                                                    'type' => 'hidden',
                                                    'value' => 'card'
                                                ));
                                                ?>
                                                <br>
                                                <div class="row">
                                                    <div class="col-md-3 signupfont">
                                                        Invoice#
                                                    </div>
                                                    <div class="col-md-3" style="border: 1px solid; padding: 4px;">
                                                        <?php echo $this->params['pass'][0]; ?>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="row">
                                                    <div class="col-md-3 signupfont">
                                                        Card No: 
                                                    </div>
                                                    <div class="col-md-9">
                                                        <?php
                                                        echo $this->Form->input(
                                                                'card_no', array(
                                                            'type' => 'text',
                                                            'class' => 'form-control input-sm ',
                                                        ));
                                                        ?>
                                                    </div>
                                                </div>
                                                &nbsp;
                                                <div class="row">
                                                    <div class="col-md-3 signupfont">
                                                        Transaction ID: 
                                                    </div>
                                                    <div class="col-md-9">
                                                        <?php
                                                        echo $this->Form->input(
                                                                'trx_id', array(
                                                            'type' => 'text',
                                                            'class' => 'form-control input-sm ',
                                                        ));
                                                        ?>
                                                    </div>
                                                </div>
                                                &nbsp;
                                                <div class="row">
                                                    <div class="col-md-3 signupfont">
                                                        Charged Amount: 
                                                    </div>
                                                    <div class="col-md-9">
                                                        <?php
                                                        echo $this->Form->input(
                                                                'payable_amount', array(
                                                            'type' => 'text',
                                                            'class' => 'form-control input-sm ',
                                                        ));
                                                        ?>
                                                    </div>
                                                </div>
                                                &nbsp;
                                                <div class="row">
                                                    <div class="col-md-3 signupfont">
                                                        Payment date:
                                                    </div>
                                                    <div class="col-md-9">
                                                        <?php
                                                        echo $this->Form->input(
                                                                'created', array(
                                                            'type' => 'text',
                                                            'class' => 'datepicker form-control ',
                                                        ));
                                                        ?>
                                                    </div>
                                                </div>
                                                &nbsp;
                                                <div class="row">
                                                    <div class="col-lg-8 col-md-offset-4 padding-left-0 padding-top-20"> 
                                                        <?php
                                                        echo $this->Form->button(
                                                                'Submit', array(
                                                            'class' => 'btn btn-primary submitbtn green',
                                                            'type' => 'submit',
                                                        ));
                                                        ?>

                                                    </div>
                                                </div>
                                                <?php echo $this->Form->end(); ?>
                                            </div>
                                        </td>
                                    </tr>
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

