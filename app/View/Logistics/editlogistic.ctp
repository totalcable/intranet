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
                            <i class="fa fa-plus"></i>Update Logistic
                        </div>

                    </div>
                    <div class="portlet-body form">
                        <!-- BEGIN FORM-->
                        <?php
                        echo $this->Form->create('LogisticsMaintenance', array(
                            'inputDefaults' => array(
                                'label' => false,
                                'div' => false
                            ),
                            'id' => 'form_sample_3',
                            'class' => 'form-horizontal',
                            'novalidate' => 'novalidate'
                                )
                        );
                        ?><br>
                        <div class="form-body">
                            <div class="alert alert-danger display-hide">
                                <button class="close" data-close="alert"></button>
                                You have some form errors. Please check below.
                            </div>
                            <?php echo $this->Session->flash(); ?>
                            <br><br>
                            <div class="row">
                                <div class="col-md-12" > 
                                    <div class="row">  
                                        <div class="col-md-2 signupfont">
                                            Products Name:
                                        </div>
                                        <div class="col-md-3">
                                            <?php
                                            echo $this->Form->input('product_id', array(
                                                'type' => 'select',
//                                                'empty' => $prod,
                                                'empty' => $products,
                                                'value' => $products,
                                                'class' => 'form-control select2me required')
                                            );
                                            ?>
                                        </div>
                                    </div>

                                </div>  
                            </div>
                            <br>  
                            <div class="row">
                                <div class="col-md-2 signupfont">
                                    Requisition Date:
                                </div>
                                <div class="col-md-3">                                   
                                    <?php
                                    echo $this->Form->input(
                                            'requisition_date', array(
                                        'class' => 'datepicker form-control ',
                                        'type' => 'text',
                                            )
                                    );
                                    ?>                                    
                                </div>
                                <div class="col-md-1 signupfont">
                                    By:
                                </div>
                                <div class="col-md-3">                                   
                                    <?php
                                    echo $this->Form->input(
                                            'requisition_by', array(
                                        'class' => 'form-control ',
                                        'placeholder' => 'Requisition by',
                                        'type' => 'text',
                                            )
                                    );
                                    ?>                                  
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-2 ">
                                    Allocated time(Hours/days :
                                </div>
                                <div class="col-md-3"> 

                                    <?php
                                    echo $this->Form->input(
                                            'from_date', array(
                                        'class' => 'datepicker form-control ',
                                        'type' => 'text'
                                            )
                                    );
                                    ?> 
                                </div>
                                <div class="col-md-1"> 
                                    To
                                </div>
                                <div class="col-md-3"> 

                                    <?php
                                    echo $this->Form->input(
                                            'to_date', array(
                                        'class' => 'datepicker form-control ',
                                        'type' => 'text'
                                            )
                                    );
                                    ?>

                                </div>
                            </div>

                            <br>
                            <div class="row">
                                <div class="col-md-2 signupfont">
                                    Approved by:
                                </div>
                                <div class="col-md-2">                                    
                                    <?php
                                    echo $this->Form->input(
                                            'approved_by', array(
                                        'class' => 'form-control ',
                                        'type' => 'text',
                                            )
                                    );
                                    ?>

                                </div>                            
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-2 signupfont">
                                    Received in (condition):
                                </div>
                                <div class="col-md-2">                                   
                                    <?php
                                    echo $this->Form->input('received_condition', array(
                                        'type' => 'select',
                                        'options' => array(
                                            'empty' => 'Select Option',
                                            'good' => 'Good',
                                            'damaged' => 'Damaged',
                                            'repaired' => 'Repaired'
                                        ),
                                        'class' => 'form-control required')
                                    );
                                    ?>

                                </div>
                                <div class="col-md-1 signupfont">
                                    Date:
                                </div>
                                <div class="col-md-2">                                    
                                    <?php
                                    echo $this->Form->input(
                                            'received_date', array(
                                        'class' => 'datepicker form-control ',
                                        'type' => 'text'
                                            )
                                    );
                                    ?>

                                </div>
                            </div> <br>

                            <div class="row">
                                <div class="col-md-3 signupfont">
                                    Receiver of the product(Name):
                                </div>
                                <div class="col-md-3">                                                                           
                                    <?php
                                    echo $this->Form->input(
                                            'receiver_name', array(
                                        'class' => ' form-control ',
                                        'type' => 'text',
                                            )
                                    );
                                    ?>                                   
                                </div>
                                <div class="col-md-1 signupfont">
                                    Date:
                                </div>
                                <div class="col-md-2">                                   
                                    <?php
                                    echo $this->Form->input(
                                            'product_receive_date', array(
                                        'class' => 'datepicker form-control ',
                                        'type' => 'text',
                                            )
                                    );
                                    ?>                                   
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-4 signupfont">
                                    Product hand over/Delivered (Type of condition) :
                                </div>
                                <div class="col-md-2">                                   
                                    <?php
                                    echo $this->Form->input('hand_over_condition', array(
                                        'type' => 'select',
                                        'options' => array(
                                            'empty' => 'Select Option',
                                            'good' => 'Good',
                                            'damaged' => 'Damaged',
                                            'repaired' => 'Repaired'
                                        ),
                                        'class' => 'form-control required')
                                    );
                                    ?>
                                </div>

                                <div class="col-md-2 signupfont">
                                    Received by:
                                </div>
                                <div class="col-md-3">                                                                          
                                    <?php
                                    echo $this->Form->input(
                                            'hand_over_by', array(
                                        'class' => 'form-control ',
                                        'type' => 'text',
                                            )
                                    );
                                    ?>                                 
                                </div>
                            </div>
                        </div> <br><br><br>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-6 col-md-4">
                                    <?php
                                    echo $this->Form->button(
                                            'Update Inforamtion', array('class' => 'btn green', 'type' => 'submit')
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

