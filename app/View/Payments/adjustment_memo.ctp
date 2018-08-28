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
            <div  class="col-md-12 col-sm-12">
                    <div class="portlet box blue-hoki">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-list-ul"></i>Adjustment Memo
                            </div>
                          
                        </div>
                        <div class="portlet-body">
                            <?php echo $this->Session->flash(); ?>
                            <div class="row" > 
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
                                    'url' => array('controller' => 'payments', 'action' => 'adjustmentMemo')
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
                                                    'refferalbonus' => 'Refferal Bonus'
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
                                                        'Submit', array('class' => 'btn', 'type' => 'submit')
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
        </div>
        <!-- END PAGE CONTENT -->
    </div>
</div>
<!-- END CONTENT -->

