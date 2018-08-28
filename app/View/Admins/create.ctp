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
                            <i class="fa fa-plus"></i>Add New Admin
                        </div>
<!--                        <div class="tools">
                            <a href="javascript:;" class="reload">
                            </a>
                        </div>-->
                    </div>
                    <div class="portlet-body form">
                        <!-- BEGIN FORM-->
                        <?php
                        echo $this->Form->create('User', array(
                            'inputDefaults' => array(
                                'label' => false,
                                'div' => false
                            ),
                            'id' => 'form_sample_3',
                            'class' => 'form-horizontal',
                            'novalidate' => 'novalidate',
                            'enctype' => 'multipart/form-data'
                                )
                        );
                        ?>
                        <div class="form-body">
                            <div class="alert alert-danger display-hide">
                                <button class="close" data-close="alert"></button>
                                You have some form errors. Please check below.
                            </div>
                            <?php echo $this->Session->flash(); ?>


<!--                            <div class="form-group">
                                <label class="control-label col-md-3"> Date:</label>-->

<!--                            <div class="form-group">
                                <label class="control-label col-md-3">Disable Past Dates</label>

                                <div class="col-md-3">
                                    <input type="text" class="datepicker">
                                </div>
                            </div>-->

                            <div class="form-group">
                                <label class="control-label col-md-3">Name<span class="required">
                                        * </span>
                                </label>
                                <div class="col-md-4">
                                    <?php
                                    echo $this->Form->input(
                                            'name', array(
                                        'class' => 'form-control required',
                                        'type' => 'text'
                                            )
                                    );
                                    ?>
                                </div>
                            </div>
                             <div class="form-group">
                                <label class="control-label col-md-3">Role<span class="required">
                                        * </span>
                                </label>
                                <div class="col-md-4">

                                    <?php
                                    echo $this->Form->input('role_id', array(
                                        'type' => 'select',
                                        'options' => $roles,
                                        'empty' => '--Select Role--',
                                        'class' => 'form-control select2me required pclass',
                                            )
                                    );
                                    ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Picture
                                </label>
                                <div class="col-md-4">
                                    <?php
                                    echo $this->Form->input(
                                            'picture', array(
                                        'type' => 'file',
                                        'id' => 'required',
                                        'class' => 'span9 text'
                                            )
                                    );
                                    ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Email<span class="required">
                                        * </span>
                                </label>
                                <div class="col-md-4">
                                    <?php
                                    echo $this->Form->input(
                                            'email', array(
                                        'class' => 'form-control required',
                                        'type' => 'text'
                                            )
                                    );
                                    ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Password<span class="required">
                                        * </span>
                                </label>
                                <div class="col-md-4">
                                    <?php
                                    echo $this->Form->input(
                                            'password', array(
                                        'class' => 'form-control required',
                                        'type' => 'password'
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
                                            'Add', array('class' => 'btn green', 'type' => 'submit')
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

