
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

        </h3>
        <!-- END PAGE HEADER-->
        <!-- BEGIN PAGE CONTENT-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet box green">
                    <div class="portlet-title">
                        <div class="caption">
                            Insert employee attend Information
                        </div>

                        <div class="tools">
<!--                            <a href="<?php echo Router::url(array('controller' => 'admins', 'action' => 'create')) ?>" title="Add new admin" class="fa fa-plus">
                            </a>-->
                        </div>
                    </div>
                    <div class="portlet-body">
                        <?php echo $this->Session->flash(); ?> 
                        <?php
                        echo $this->Form->create('User', array(
                            'inputDefaults' => array(
                                'label' => false,
                                'div' => false
                            ),
                            'id' => 'form_sample_3',
                            'class' => 'form-horizontal',
                            'novalidate' => 'novalidate',
                            'url' => array('controller' => 'attendances', 'action' => 'emp_attend_byadmin')
                                )
                        );
                        ?>
                        <div class="form-body">
                            <div class="caption" style="text-align: center;">
                                <span style="color:red;"> <?php echo $this->Session->flash(); ?></span> 
                            </div>
                            <div class="alert alert-danger display-hide">
                                <button class="close" data-close="alert"></button>
                                You have some form errors. Please check below.
                            </div>

                            <div class="form-group">  
                                <br>
                                <label class="control-label col-md-3" for=" ">Select date:</label>
                                <div class="col-md-4">
                                    <?php
                                    echo $this->Form->input(
                                            'date', array(
                                        'id' => 'e1', /* e1 is past to current date, e2 is past to future date */
                                        'class' => 'span9 text',
//                                        'value' => $results['id'],
                                            )
                                    );
                                    ?>
                                </div>
                            </div>
                            <div class="form-group">  
                                <br>
                                <label class="control-label col-md-3" for=" ">Select employee:</label>
                                <div class="col-md-4">
                                    <?php
                                    echo $this->Form->input('new_user_id', array(
                                        'type' => 'select',
                                        'options' => $users,
                                        'empty' => 'Select Emp',
                                        'class' => 'form-control select2me',
                                            )
                                    );
                                    ?>
                                </div>
                            </div>

<!--                            <div class="form-group">  
                                <br>
                                <label class="control-label col-md-3" for=" ">Select Time:</label>
                                <div class="col-md-4">
                                    <?php
                                    echo $this->Form->input(
                                            'from', array(
                                        'type' => 'text',
                                        'class' => 'fa fa-clock-o form-control timepicker timepicker-default',
                                        'placeholder' => 'Select time range',
                                        'title' => 'Select time range'
                                            )
                                    );
                                    ?> 
                                </div>
                            </div>-->

                        </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-4 col-md-2">
                                    <?php
                                    echo $this->Form->button(
                                            'Save ', array('class' => 'btn green', 'type' => 'submit')
                                    );
                                    ?>
                                </div>
                            </div>
                        </div>
                        <?php echo $this->Form->end(); ?>
                    </div>
                </div>
                <!-- END EXAMPLE TABLE PORTLET-->
            </div>
        </div>
        <!-- END PAGE CONTENT -->
    </div>
</div>
<!-- END CONTENT -->

