<style type="text/css">
    .alert {
        padding: 6px;
        margin-bottom: 5px;
        border: 1px solid transparent;
        border-radius: 4px;
        text-align: center;
    }
    .alert.alert-error {
        background: #A9B0B5;
        color: #EF5858;
        font-weight: normal;
    }

</style>
<div class="page-content-wrapper">
    <div class="page-content">
        <!-- BEGIN PAGE CONTENT-->
        <div class="content">


            <?php echo $this->Session->flash(); ?>

           <?php
            echo $this->Form->create('Customer', array(
                'inputDefaults' => array(
                    'label' => false,
                    'div' => false,
                ),
                
                'class' => 'form-horizontal',
                'novalidate' => 'novalidate',
                'id' =>'eventRegChecking'
                    )
            );
            
            ?>

            <div class="bubblingG " style="visibility:hidden;">
                <span id="bubblingG_1">
                </span>
                <span id="bubblingG_2">
                </span>
                <span id="bubblingG_3">
                </span>
            </div>

            <div class="form-group">
                <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
                <label class="control-label visible-ie8 visible-ie9">Email/Mobile Number</label>
                <div class="input-icon">
                    <i class="fa fa-user"></i>

                    <?php
                    echo $this->Form->input(
                            'input', array(
                        'class' => 'form-control placeholder-no-fix',
                        'type' => 'text',
                        'autocomplete' => 'off',
                        'placeholder' => 'Email/mobile number'
                            )
                    );
                    ?>
                </div>
            </div>
   

            <div class="form-actions">
                   <?php
                echo $this->Form->button(
                        'Check <i class="fa fa-refresh"></i>', array(
                    'class' => 'btn btn-primary pull-right',
                    'type' => 'submit',
                    'id' => 'checkEventRegBtn',
                    'escape' => false
                        )
                );
                ?> 

            </div>
            <?php echo $this->Form->end(); ?>
           <br/>
           <br/>
           <br/>
            <div id="eventRegForm" class="display-hide">
             
             <?php
            echo $this->Form->create('Customer', array(
                'inputDefaults' => array(
                    'label' => false,
                    'div' => false
                ),
                'id' => 'form_sample_3',
                'class' => 'form-horizontal',
                'novalidate' => 'novalidate',
                'url' => array('controller' => 'events', 'action' =>'register')
                    )
            );
            
            ?>

             
            
            <?php echo $this->Form->input('id', array('id'=>'customer_id','value' =>0 )); ?>

            <?php echo $this->Form->input('event_id', array('type'=>'hidden','value' => $lastEvent['Event']['id'])); ?>

            <?php echo $this->Form->input('status', array('type'=>'hidden','value' => 'checked')); ?>


           
            
            <div class="alert alert-danger display-hide">
                <button class="close" data-close="alert"></button>
                <span>
                    Fill up all required fields </span>
            </div>
            <div class="form-group">
                <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
                <label class="control-label visible-ie8 visible-ie9">Email</label>
                <div class="input-icon">
                    <i class="fa fa-user"></i>

                    <?php
                    echo $this->Form->input(
                            'email', array(
                        'class' => 'form-control placeholder-no-fix',
                        'type' => 'text',
                        'autocomplete' => 'off',
                        'placeholder' => 'Email'
                            )
                    );
                    ?>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label visible-ie8 visible-ie9">Name</label>
                <div class="input-icon">
                    <i class="fa fa-pencil"></i>

                    <?php
                    echo $this->Form->input(
                            'name', array(
                        'class' => 'form-control placeholder-no-fix required',
                        'type' => 'test',
                        'autocomplete' => 'off',
                        'placeholder' => 'Your Name'
                            )
                    );
                    ?>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label visible-ie8 visible-ie9">Mobile Number</label>
                <div class="input-icon">
                    <i class="fa fa-phone"></i>

                    <?php
                    echo $this->Form->input(
                            'mobile', array(
                        'class' => 'form-control placeholder-no-fix required',
                        'type' => 'test',
                        'autocomplete' => 'off',
                        'placeholder' => 'Your cell number'
                            )
                    );
                    ?>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label visible-ie8 visible-ie9">Alternative Mobile Number</label>
                <div class="input-icon">
                    <i class="fa fa-phone"></i>

                    <?php
                    echo $this->Form->input(
                            'alt_mobile', array(
                        'class' => 'form-control placeholder-no-fix',
                        'type' => 'test',
                        'autocomplete' => 'off',
                        'placeholder' => 'Your Alternative cell number'
                            )
                    );
                    ?>
                </div>
            </div>

            <div class="form-actions">
                <?php
                echo $this->Form->button(
                        'Register <i class="m-icon-swapright m-icon-white"></i>', array(
                    'class' => 'btn blue pull-right',
                    'type' => 'submit',
                    'escape' => false
                        )
                );
                ?> 

            </div>
            <?php echo $this->Form->end(); ?>            
            <!-- END REGISTRATION FORM -->
            </div>   
        </div>
        <!-- END PAGE CONTENT -->
    </div>
</div>
<!-- END CONTENT -->
