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
                            <i class="fa fa-plus"></i>Edit Message Information
                        </div>
                        <div class="tools">
                            <a href="javascript:;" class="reload">
                            </a>
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <!-- BEGIN FORM-->
                      <?php
                        echo $this->Form->create('Message', array(
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
                        <div class="form-body">
                            <div class="alert alert-danger display-hide">
                                <button class="close" data-close="alert"></button>
                                You have some form errors. Please check below.
                            </div>
                            <?php echo $this->Session->flash(); ?>
                             
                            <div class="form-group">
                                <label class="control-label col-md-3">Assign to (individual) :
                                </label>
                                <div class="col-md-4">
                                      <?php
                                    echo $this->Form->input('assign_id', array(
                                        'type' => 'select',
                                        'options' => $users,
                                        'empty' => 'Select Category',
                                        'class' => 'form-control select2me required pclass',
                                            )
                                    );
                                    ?>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="control-label col-md-3">Assign to (Department) :
                                </label>
                                <div class="col-md-4">
                                   
                                     <?php
                                    echo $this->Form->input('role_id', array(
                                        'type' => 'select',
                                        'options' => $roles,
                                        'empty' => 'Select Category',
                                        'class' => 'form-control select2me required pclass',
                                            )
                                    );
                                    ?>
                                </div>
                            </div>                          
                            
                            <div class="form-group">
                                <label class="control-label col-md-3">Message :
                                </label>
                                <div class="col-md-9">
                                    <?php
                                    echo $this->Form->input(
                                            'message', array(
                                        'class' => 'form-control required ckeditor',
                                        'data-error-container' => '#editor2_error',
                                        'rows' => 6,
                                        'type' => 'textarea',
                                        'id' => 'desc'
                                            )
                                    );
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-7 col-md-4" style=" float: left; margin: 0px; padding: 0px; text-align: right;">
                                    <?php
                                    echo $this->Form->button(
                                            'Upadate', array('class' => 'btn green', 'type' => 'submit')
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

