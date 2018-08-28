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
                echo $this->Form->create('Emp', array(
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
                    <h2 style="text-align: center;color: green;">Add New Employee Information</h2><br><br>
                    <div class="form-group">
                        <div class="row">
                            <label class="control-label col-md-2">Employee ID<span class="required">
                                </span>
                            </label>
                            <div class="col-md-4">
                                <?php
                                echo $this->Form->input(
                                        'staff_id', array(
                                    'class' => 'form-control ',
                                            
                                    'type' => 'text'
                                        )
                                );
                                ?>
                            </div>
                        </div><br>

                        <div class="row">
                            <label class="control-label col-md-2">Name<span class="required">
                                </span>
                            </label>
                            <div class="col-md-4">
                                <?php
                                echo $this->Form->input(
                                        'name', array(
                                    'class' => 'form-control ',
                                    'type' => 'text'
                                        )
                                );
                                ?>
                            </div>

                            <label class="control-label col-md-2">Father's Name<span class="required">
                                </span>
                            </label>
                            <div class="col-md-4">
                                <?php
                                echo $this->Form->input(
                                        'father_name', array(
                                    'class' => 'form-control ',
                                    'type' => 'text'
                                        )
                                );
                                ?>
                            </div>
                        </div><br>
                        <div class="row">
                            <label class="control-label col-md-2">Mother's Name<span class="required">
                                </span>
                            </label>
                            <div class="col-md-4">
                                <?php
                                echo $this->Form->input(
                                        'mother_name', array(
                                    'class' => 'form-control ',
                                    'type' => 'text'
                                        )
                                );
                                ?>
                            </div>

                            <label class="control-label col-md-2">Date of Birth<span class="required">
                                </span>
                            </label>
                            <div class="col-md-4">
                              <?php
                              $emp_date = date("Y-m-d");
                                echo $this->Form->input(
                                        'dob', array(
                                    'class' => 'form-control ',
                                    'type' => 'text',
                                    'value' => $emp_date
                                        )
                                );
                                ?>
                              
                            </div>
                        </div>
                        <div class="row"><br>
                            <label class="control-label col-md-2">Present Address<span class="required">
                                </span>
                            </label>
                            <div class="col-md-4">
                                <?php
                                echo $this->Form->input(
                                        'present_address', array(
                                    'class' => 'form-control ',
                                    'type' => 'text'
                                        )
                                );
                                ?>
                            </div>
                            <label class="control-label col-md-2">Permanent Address <span class="required">
                                </span>
                            </label>
                            <div class="col-md-4">
                                <?php
                                echo $this->Form->input(
                                        'permanent_address', array(
                                    'class' => 'form-control ',
                                    'type' => 'text'
                                        )
                                );
                                ?>
                            </div>   

                        </div><br> 


                        <div class="row">

                            <label class="control-label col-md-2">Department<span class="required">
                                </span>
                            </label>
                            <div class="col-md-4">
                                <?php
                                echo $this->Form->input('department_id', array(
                                    'type' => 'select',
                                    'options' => $departments,
                                    'empty' => 'Select Department',
                                    'class' => 'form-control select2me',
                                        )
                                );
                                ?>
                            </div>
                            <label class="control-label col-md-2">Designation<span class="required">
                                </span>
                            </label>
                            <div class="col-md-4">
                                <?php
                                echo $this->Form->input('designation_id', array(
                                    'type' => 'select',
                                    'options' => $designations,
                                    'empty' => 'Select Designation',
                                    'class' => 'form-control select2me',
                                        )
                                );
                                ?>
                            </div>

                        </div>
                        <br>
                        <div class="row">
                            <label class="control-label col-md-2">Email<span class="required">
                                </span>
                            </label>
                            <div class="col-md-4">
                                <?php
                                echo $this->Form->input(
                                        'email', array(
                                    'class' => 'form-control ',
                                    'type' => 'text'
                                        )
                                );
                                ?>
                            </div>


                            <label class="control-label col-md-2">Cell <span class="required">
                                </span>
                            </label>
                            <div class="col-md-2">
                                <?php
                                echo $this->Form->input(
                                        'cell_no', array(
                                    'class' => 'form-control ',
                                    'type' => 'text'
                                        )
                                );
                                ?>
                            </div>


                            <label class="control-label col-md-1">Bl group<span class="required">
                                </span>
                            </label>
                            <div class="col-md-1">
                                <?php
                                echo $this->Form->input('b_group', array(
                                    'type' => 'select',
                                    'options' => array(
                                        'a+' => 'A+',
                                        'a-' => 'A-',
                                        'b+' => 'B+',
                                        'b-' => 'B-',
                                        'ab+' => 'AB+',
                                        'ab-' => 'AB-',
                                        'O-' => 'O-',
                                        'O-' => 'O+'
                                    ),
                                    'class' => 'form-control '
                                        )
                                );
                                ?>
                            </div>
                        </div><br>
                    </div>
                    <hr>
                    <h3> Reference Contact Details</h3><br><br>
                    <div class="form-group">
                        <label class="control-label col-md-1">Name <span class="required">
                            </span>
                        </label>
                        <div class="col-md-2">
                            <?php
                            echo $this->Form->input(
                                    'ref_name', array(
                                'class' => 'form-control ',
                                'type' => 'text'
                                    )
                            );
                            ?>
                        </div>

                        <label class="control-label col-md-1">Address<span class="required">
                            </span>
                        </label>
                        <div class="col-md-2">
                            <?php
                            echo $this->Form->input(
                                    'ref_address', array(
                                'class' => 'form-control ',
                                'type' => 'text'
                                    )
                            );
                            ?>
                        </div>

                        <label class="control-label col-md-1">Cell <span class="required">
                            </span>
                        </label>
                        <div class="col-md-2">
                            <?php
                            echo $this->Form->input(
                                    'ref_cell', array(
                                'class' => 'form-control ',
                                'type' => 'text'
                                    )
                            );
                            ?>
                        </div>

                        <label class="control-label col-md-1">Relationship <span class="required">
                            </span>
                        </label>
                        <div class="col-md-2">
                            <?php
                            echo $this->Form->input(
                                    'ref_relationship', array(
                                'class' => 'form-control ',
                                'type' => 'text'
                                    )
                            );
                            ?>
                        </div>
                    </div><br><br><br>

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


            <!-- END PAGE CONTENT -->
        </div>
    </div>
    <!-- END CONTENT -->

