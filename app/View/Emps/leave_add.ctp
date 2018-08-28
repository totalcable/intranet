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


        <div class="">
            <div class="portlet-title">
                <div class="caption">
<!--                    <i class="fa fa-plus"></i>Add new employee information-->
                </div>
                <div class="tools">
                    <a href="javascript:;" class="reload">
                    </a>
                </div>
            </div>
            <div class="portlet-body form">
                <!-- BEGIN FORM-->
                <?php
                echo $this->Form->create('Leave', array(
                    'inputDefaults' => array(
                        'label' => false,
                        'div' => false
                    ),
                    'id' => 'form_sample_3',
                    'class' => 'form-horizontal',
                    'novalidate' => 'novalidate',
                    'enctype' => 'multipart/form-data',
                        )
                );
                ?>
                <div class="form-body">
                    <div class="alert alert-danger display-hide">
                        <button class="close" data-close="alert"></button>
                        You have some form errors. Please check below.
                    </div>
                    <?php echo $this->Session->flash(); ?>
                    <h2 style="text-align: center;color: green;">Edit & Update Employee Information</h2><br><br>
                    <div class="form-group">
                        <div class="row"><br>
                            <label class="control-label col-md-2">From Date<span class="required">
                                </span>
                            </label>
                            <div class="col-md-4">
                                <?php
                                echo $this->Form->input(
                                        'daterangeonly', array(
                                    'class' => 'span9 text e1' /* e1 is past to current date, e2 is past to future date */
                                        )
                                );
                                ?>
                            </div>
                            <label class="control-label col-md-2">To Date<span class="required">
                                </span>
                            </label>
                            <div class="col-md-4">
                                <?php
                                echo $this->Form->input(
                                        'daterangeonly', array(
                                    'class' => 'span9 text e1' /* e1 is past to current date, e2 is past to future date */
                                        )
                                );
                                ?>
                            </div>
                        </div>    
                        <div class="row"><br>

                            <label class="control-label col-md-2">Nature of Leave<span class="required">
                                </span>
                            </label>
                            <div class="col-md-4">
                                <?php
                                echo $this->Form->input('marital_status', array(
                                    'type' => 'select',
                                    'options' => array('c/l' => 'C/L', 'e/l' => 'E/L', 's/l' => 'SL'),
                                    'empty' => 'Select Marital Status',
                                    'class' => 'span12 uniform nostyle select1 form-control'
                                        )
                                );
                                ?>
                            </div>  
                            <label class="control-label col-md-2">Purpose <span class="required">
                                </span>
                            </label>
                            <div class="col-md-4">
                                <?php
                                echo $this->Form->input('b_group', array(
                                    'type' => 'select',
                                    'options' => array(
                                        'personal' => 'Personal',
                                        'family' => 'Family'
                                    ),
                                    'class' => 'form-control '
                                        )
                                );
                                ?>
                            </div>
                        </div> 
                    </div><br>
                </div><br><br>

                <div class="form-actions">
                    <div class="row">
                        <div class="col-md-offset-6 col-md-4">
                            <?php
                            echo $this->Form->button(
                                    'Save', array('class' => 'btn green', 'type' => 'submit')
                            );
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END PAGE CONTENT -->
        </div>
    </div>
    <!-- END CONTENT -->

