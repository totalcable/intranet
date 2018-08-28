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
        <div class="row">
            <div class="col-md-12">
                <div class="portlet box green">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-plus"></i>Auto Recurring
                        </div>
                        <div class="tools">
                            <a href="javascript:;" class="reload">
                            </a>
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <?php echo $this->Session->flash(); ?>
                        <br>
                        <?php if (!empty($pcs_exp_date[0]['package_customers']['id'])) { ?>
                        <!--<hr style=" border-style:  dotted; border-width: medium; background-color: red;">-->
                      
                        <div class="col-md-12" title=" Error area (Please modify data for error fixup... )" style="background-color: grey;">
                            <div class="col-md-1">
                                <?php foreach ($pcs_exp_date as $c): ?>                             
                                    <a style="color: white; font-weight: bold;" href="<?php
                                    echo Router::url(array('controller' => 'customers',
                                        'action' => 'edit', $c['package_customers']['id']))
                                    ?>" 
                                       target="_blank">
                                        <li title="Please reset card expair date, cusotmer ID <?php echo $c['package_customers']['first_name'] . ' ' . $c['package_customers']['middle_name'] . ' ' . $c['package_customers']['last_name'] . ' (Exp date : ' . $c['package_customers']['exp_date'] . ', Payable amount : $' . $c['package_customers']['payable_amount'] . ') '; ?>"><?php echo $c['package_customers']['id']; ?></li>      
                                    </a>
                                <?php endforeach; ?>
                            </div>
                        </div><br>
                        <hr style=" border-style:  dotted; border-width: medium; background-color: mediumslateblue;">
                          <?php } ?>
                        <!-- BEGIN FORM-->
                        <?php
                        echo $this->Form->create('Trans', array(
                            'inputDefaults' => array(
                                'label' => false,
                                'div' => false,
                                'id' => false
                            ),
                            'enctype' => 'multipart/form-data',
                            'url' => array('controller' => 'transactions', 'action' => 'processAutoRecurring')
                                )
                        );
                        ?>
                        <div class="form-actions">
                            <div class="form-group">
                                <label class="control-label col-md-3" title="Total autorecurring customers">Total autorecurring customers : ( <b style="color: tomato;"><?php echo $total; ?></b> )</label>
                                <div class="col-md-4">
                                    <?php if ($total != 0) { ?>
                                        <?php
                                        echo $this->Form->button(
                                                'First step', array('class' => 'btn green', 'type' => 'submit', 'title' => 'Click here for creating invoice')
                                        );
                                        ?>
                                    <?php } else { ?>
                                        <?php
                                        echo $this->Form->button(
                                                'First step', array('class' => 'btn green', 'type' => 'submit', 'title' => 'Click here for creating invoice', 'disabled' => true)
                                        );
                                        ?>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <?php echo $this->Form->end(); ?>
                        <!-- END FORM-->

                        <hr style=" border-style:  dotted; border-width: medium; background-color: violet;">


                        <div class="col-md-12">
                            <div class="col-md-1">
                                <?php foreach ($pcs_c as $c): ?>                             
                                    <a href="<?php
                                    echo Router::url(array('controller' => 'customers',
                                        'action' => 'edit', $c['transactions']['package_customer_id']))
                                    ?>" 
                                       target="_blank">
                                        <li title="That is cusotmer ID of <?php echo $c['package_customers']['first_name'] . ' ' . $c['package_customers']['middle_name'] . ' ' . $c['package_customers']['last_name'] . ' (Exp date : ' . $c['package_customers']['exp_date'] . ', Payable amount : $' . $c['transactions']['payable_amount'] . ') '; ?>"><?php echo $c['transactions']['package_customer_id']; ?></li>      
                                    </a>
                                <?php endforeach; ?>
                            </div>
                        </div><br>
                        <?php if (!empty($total_in)) { ?>
                            <hr style=" border-style:  dotted; border-width: medium; background-color: tomato;">
                        <?php } ?>
                        <!-- BEGIN FORM-->
                        <?php
                        echo $this->Form->create('Trans', array(
                            'inputDefaults' => array(
                                'label' => false,
                                'div' => false,
                                'id' => false
                            ),
                            'enctype' => 'multipart/form-data',
                            'url' => array('controller' => 'transactions', 'action' => 'auto_recurring_payment')
                                )
                        );
                        ?>
                        <div class="form-actions">
                            <div class="form-group"> 
                                <label class="control-label col-md-3" title="Total autorecurring invoice created">Total autorecurring invoice created : ( <b style="color: tomato;"><?php echo $total_in; ?></b> )</label>
                                <div class="col-md-4">
                                    <?php if ($total_in != 0) { ?>
                                        <?php
                                        echo $this->Form->button(
                                                'Second  step ', array('class' => 'btn green', 'type' => 'submit', 'title' => 'Click here for transaction')
                                        );
                                        ?>                                    
                                    <?php } else { ?>
                                        <?php
                                        echo $this->Form->button(
                                                'Second  step ', array('class' => 'btn green', 'type' => 'submit', 'title' => 'Click here for transaction', 'disabled' => true)
                                        );
                                        ?>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <?php echo $this->Form->end(); ?>
                        <!-- END FORM-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

