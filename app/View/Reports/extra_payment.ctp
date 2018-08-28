
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
            Extra Payment<small>You can edit, delete or block</small>
        </h3>

        <!-- END PAGE HEADER-->
        <!-- BEGIN PAGE CONTENT-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet box green">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-user"></i> Extra Payment
                        </div>

                        <!--                        <div class="tools">
                                                    <a href="javascript:;" class="reload">
                                                    </a>
                                                </div>-->
                    </div>
                    <div class="portlet-body">

                        <?php echo $this->Session->flash(); ?> 

                        <table class="table table-striped table-hover table-bordered" id="sample_editable_1">

                            <thead>
                                <tr>
                                    <th>Customer Information</th>
                                    <th>Description</th>                                   
                                    <th>Payment process</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($data as $i => $single):
//                                    pr($single); exit;
                                    $name = $single['PackageCustomer']['first_name'] . ' ' . $single['PackageCustomer']['middle_name'] . ' ' . $single['PackageCustomer']['last_name'];
                                    $address = $single['PackageCustomer']['house_no'] . ' ' . $single['PackageCustomer']['street'] . ' ' . $single['PackageCustomer']['apartment'] . ' ' . $single['PackageCustomer']['city'] . ' ' . $single['PackageCustomer']['state'] . ' ' . $single['PackageCustomer']['zip'];
                                    ?>
                                    <tr >
                                        <td>Name :<?php echo $name; ?><br>
                                            Address : <?php echo $address; ?><br>

                                            Home :<?php echo $single['PackageCustomer']['home']; ?><br>
                                            Cell :<?php echo $single['PackageCustomer']['cell']; ?>
                                        </td>
                                        <td>
                                            <?php echo $single['Transaction']['description_tran']; ?>
                                            Product Type : <?php echo $single['Transaction']['product_type']; ?><br>
                                            Quantity : <?php echo $single['Transaction']['quantity']; ?><br>
                                            Rate : <?php echo $single['Transaction']['rate']; ?><br>
                                            Price : <?php echo $single['Transaction']['price']; ?><br>
                                            Discount : <?php echo $single['Transaction']['discount']; ?><br>
                                            Promotion : <?php echo $single['Transaction']['promotion']; ?><br>
                                            Credit : <?php echo $single['Transaction']['credit']; ?><br>
                                            Adjustment : <?php echo $single['Transaction']['adjustment']; ?><br>
                                            Note : <?php echo $single['Transaction']['note']; ?>
                                        </td>

                                        <td>   
                                            <div class="controls center text-center">
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
                                                                        <label><input class="pmode" type="radio" value="check" name="pmode">CHECK</label>
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
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>

                                                            </td>
                                                            <td>
                                                                <div id="option_card">
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
                                                                        'url' => array('controller' => 'Extrapayments', 'action' => 'individual_transaction_by_card')
                                                                            )
                                                                    );
                                                                    ?>
                                                                    <?php
                                                                    echo $this->Form->input(
                                                                            'id', array(
                                                                        'type' => 'hidden',
                                                                        'value' => $single['Transaction']['id']
                                                                    ));
                                                                    ?>
                                                                    <?php
                                                                    echo $this->Form->input(
                                                                            'cid', array(
                                                                        'type' => 'hidden',
                                                                        'value' => $single['PackageCustomer']['id']
                                                                    ));
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
                                                                        <?php
                                                                        $fname = '';
                                                                        $lname = '';
                                                                        $card_no = '';
                                                                        $exp_date = '';
                                                                        $cvv_code = '';
                                                                        $zip_code = '';
                                                                        $address = '';
                                                                        $paid_amount = '';
                                                                        $yyyy = '';
                                                                        $mm = '';

                                                                        if (count($card_info[$i])) {
                                                                            $fname = $card_info[$i]['fname'];
                                                                            $lname = $card_info[$i]['lname'];
                                                                            $card_no = $card_info[$i]['card_no'];
                                                                            $date = explode('/', $card_info[$i]['exp_date']);
                                                                            if (count($date)) {
                                                                                $yyyy = date('Y');
                                                                                $yy = substr($yyyy, 0, 2);
                                                                                if(isset($date[1]))
                                                                                $yyyy = $yy . '' . $date[1];
                                                                                $mm = $date[0];
                                                                            }

                                                                            $address = $card_info[$i]['address'];
                                                                            $paid_amount = $card_info[$i]['paid_amount'];
                                                                        }
                                                                        ?>
                                                                        <div class="col-md-3 signupfont">
                                                                            Name: 
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <?php
                                                                            echo $this->Form->input(
                                                                                    'fname', array(
                                                                                'type' => 'text',
                                                                                'class' => 'form-control input-sm required',
                                                                                'placeholder' => 'first name',
                                                                                'id' => 'firstname',
                                                                                'value' => $fname
                                                                            ));
                                                                            ?>
                                                                        </div>
                                                                        <div class="col-md-5">
                                                                            <?php
                                                                            echo $this->Form->input(
                                                                                    'lname', array(
                                                                                'type' => 'text',
                                                                                'class' => 'form-control input-sm required',
                                                                                'placeholder' => 'last name',
                                                                                'id' => 'lastname',
                                                                                'value' => $lname
                                                                            ));
                                                                            ?>
                                                                        </div>
                                                                    </div>

                                                                    </br>

                                                                    <div class="row">
                                                                        <div class="col-md-3 signupfont" style="padding-right: 0px;">
                                                                            Card no: 
                                                                        </div>
                                                                        <div class="col-md-9">
                                                                            <?php
                                                                            echo $this->Form->input(
                                                                                    'card_no', array(
                                                                                'type' => 'text',
                                                                                'value' => '',
                                                                                'class' => 'form-control input-sm required',
                                                                                'id' => 'card_number',
                                                                                'value' => $card_no
                                                                            ));
                                                                            ?>
                                                                        </div>
                                                                    </div>

                                                                    &nbsp;                                                        

                                                                    <div class="row">
                                                                        <div class="col-md-3 signupfont">
                                                                            Exp. Date:
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <?php
                                                                            echo $this->Form->input('exp_date.year', array(
                                                                                'type' => 'select',
                                                                                'options' => $ym['year'],
                                                                                'empty' => 'Select Year',
                                                                                'class' => 'span12 uniform nostyle select1 required',
                                                                                'div' => array('class' => 'span12 '),
                                                                                'id' => 'showyear',
                                                                                'default' => $yyyy
                                                                                    )
                                                                            );
                                                                            ?>
                                                                        </div>
                                                                        <div class="col-md-5">
                                                                            <?php
                                                                            echo $this->Form->input('exp_date.month', array(
                                                                                'type' => 'select',
                                                                                'options' => $ym['month'],
                                                                                'empty' => 'Select Month',
                                                                                'class' => 'span12 uniform nostyle select1 required',
                                                                                'div' => array('class' => 'span12 '),
                                                                                'id' => 'showmonth',
                                                                                'default' => $mm
                                                                                    )
                                                                            );
                                                                            ?>
                                                                        </div>
                                                                    </div>

                                                                    &nbsp;
                                                                    <div class="row">
                                                                        <div class="col-md-3 signupfont">
                                                                            CVV Code: 
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <?php
                                                                            echo $this->Form->input(
                                                                                    'cvv_code', array(
                                                                                'type' => 'text',
                                                                                'class' => 'form-control input-sm required',
                                                                                'id' => 'cvv_code',
                                                                                'value' => $cvv_code
                                                                            ));
                                                                            ?>
                                                                        </div>
                                                                    </div>
                                                                    &nbsp;
                                                                    <div class="row">
                                                                        <div class="col-md-3 signupfont">
                                                                            Address on Card: 
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <?php
                                                                            echo $this->Form->input(
                                                                                    'zip_code', array(
                                                                                'type' => 'text',
                                                                                'class' => 'form-control input-sm required',
                                                                                'placeholder' => 'zip code',
                                                                                'id' => 'zip_code',
                                                                                'value' => $zip_code
                                                                            ));
                                                                            ?>
                                                                        </div>

                                                                        <div class="col-md-5">
                                                                            <?php
                                                                            echo $this->Form->input(
                                                                                    'address', array(
                                                                                'type' => 'text',
                                                                                'value' => '',
                                                                                'class' => 'form-control input-sm',
                                                                                'placeholder' => 'detail(optional)',
                                                                                'id' => 'addressdetail',
                                                                                'value' => $address
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
                                                                    &nbsp;
                                                                    <div class="row">
                                                                        <div class="col-md-3 signupfont">
                                                                            Charged Amount: 
                                                                        </div>
                                                                        <div class="col-md-9">
                                                                            <?php
                                                                            echo $this->Form->input(
                                                                                    'paid_amount', array(
                                                                                'type' => 'text',
                                                                                'class' => 'form-control input-sm required',
                                                                                'value' => $paid_amount
                                                                            ));
                                                                            ?>
                                                                        </div>
                                                                    </div>
                                                                    <?php
                                                                    echo $this->Form->input(
                                                                            'cid', array(
                                                                        'type' => 'hidden',
                                                                        'value' => $single['PackageCustomer']['id']
                                                                    ));
                                                                    ?>
                                                                    &nbsp;
                                                                    <div class="row">
                                                                        <div class="col-lg-8 col-md-offset-4 padding-left-0 padding-top-20"> 

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
                                                                        'url' => array('controller' => 'Extrapayments', 'action' => 'individual_transaction_by_check')
                                                                            )
                                                                    );
                                                                    ?>
                                                                    <?php
                                                                    echo $this->Form->input(
                                                                            'id', array(
                                                                        'type' => 'hidden',
                                                                        'value' => $data[0]['Transaction']['id']
                                                                    ));
                                                                    ?>

                                                                    <?php
                                                                    echo $this->Form->input(
                                                                            'id', array(
                                                                        'type' => 'hidden',
                                                                        'value' => $single['Transaction']['id']
                                                                    ));
                                                                    ?>


                                                                    <!--                                                                    $data[0]['Transaction']['id']-->
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
                                                                                    'paid_amount', array(
                                                                                'type' => 'text',
                                                                                'class' => 'form-control input-sm required',
                                                                                'value' => '',
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
                                                                        'url' => array('controller' => 'Extrapayments', 'action' => 'individual_transaction_by_morder')
                                                                            )
                                                                    );
                                                                    ?>

                                                                    <?php
                                                                    echo $this->Form->input(
                                                                            'id', array(
                                                                        'type' => 'hidden',
                                                                        'value' => $data[0]['Transaction']['id']
                                                                    ));
                                                                    ?>

                                                                    <?php
                                                                    echo $this->Form->input(
                                                                            'id', array(
                                                                        'type' => 'hidden',
                                                                        'value' => $single['Transaction']['id']
                                                                    ));
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
                                                                                    'paid_amount', array(
                                                                                'type' => 'text',
                                                                                'class' => 'form-control input-sm required',
                                                                                'value' => '',
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
                                                                        'url' => array('controller' => 'Extrapayments', 'action' => 'individual_transaction_by_online_bil')
                                                                            )
                                                                    );
                                                                    ?>

                                                                    <?php
                                                                    echo $this->Form->input(
                                                                            'id', array(
                                                                        'type' => 'hidden',
                                                                        'value' => $data[0]['Transaction']['id']
                                                                    ));
                                                                    ?>

                                                                    <?php
                                                                    echo $this->Form->input(
                                                                            'id', array(
                                                                        'type' => 'hidden',
                                                                        'value' => $single['Transaction']['id']
                                                                    ));
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
                                                                                    'paid_amount', array(
                                                                                'type' => 'text',
                                                                                'class' => 'form-control input-sm required',
                                                                                'value' => '',
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
                                                                        'url' => array('controller' => 'Extrapayments', 'action' => 'individual_transaction_by_cash')
                                                                            )
                                                                    );
                                                                    ?>

                                                                    <?php
                                                                    echo $this->Form->input(
                                                                            'id', array(
                                                                        'type' => 'hidden',
                                                                        'value' => $data[0]['Transaction']['id']
                                                                    ));
                                                                    ?>

                                                                    <?php
                                                                    echo $this->Form->input(
                                                                            'id', array(
                                                                        'type' => 'hidden',
                                                                        'value' => $single['Transaction']['id']
                                                                    ));
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
                                                                            Charged Amount: 
                                                                        </div>
                                                                        <div class="col-md-9">
                                                                            <?php
                                                                            echo $this->Form->input(
                                                                                    'paid_amount', array(
                                                                                'type' => 'text',
                                                                                'class' => 'form-control input-sm required',
                                                                                'value' => ''
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
                                                                                'class' => 'form-control input-sm required',
                                                                                'value' => '',
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
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
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

