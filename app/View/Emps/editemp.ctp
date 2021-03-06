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
//                    'url' => array('controller' => 'emps', 'action' => 'update_emp')
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
                        <?php
                        echo $this->Form->input(
                                'id', array(
                            'value' => $emp['id'],
                            'type' => 'hidden'
                                )
                        );
                        ?>

                        <div class="row">
                            <label class="control-label col-md-2">Name<span class="required">
                                </span>
                            </label>
                            <div class="col-md-4">
                                <?php
                                echo $this->Form->input(
                                        'name', array(
                                    'class' => 'form-control ',
                                    'value' => $emp['name'],
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
                                    'value' => $emp['father_name'],
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
                                    'value' => $emp['mother_name'],
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
                                if ($emp['dob'] != '') {
                                    echo $this->Form->input(
                                            'dob', array(
                                        'class' => 'form-control ',
                                        'type' => 'text',
                                        'value' => $emp['dob']
                                            )
                                    );
                                } else {
                                    $emp_date = date("Y-m-d");
                                    echo $this->Form->input(
                                            'dob', array(
                                        'class' => 'form-control ',
                                        'type' => 'text',
                                        'value' => $emp_date
                                            )
                                    );
                                }
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
                                    'value' => $emp['present_address'],
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
                                    'value' => $emp['permanent_address'],
                                    'type' => 'text'
                                        )
                                );
                                ?>
                            </div>   

                        </div>

                        <div class="row"><br>
                            <label class="control-label col-md-2">City<span class="required">
                                </span>
                            </label>
                            <div class="col-md-4">
                                <?php
                                echo $this->Form->input('city_id', array(
                                    'type' => 'select',
                                    'options' => $cities,
                                    'empty' => 'Select City',
                                    'value' => $emp['city_id'],
                                    'class' => 'form-control select2me'
                                        )
                                );
                                ?>
                            </div>
                            <label class="control-label col-md-2">Zip code <span class="required">
                                </span>
                            </label>
                            <div class="col-md-4">
                                <?php
                                echo $this->Form->input(
                                        'zip_code', array(
                                    'class' => 'form-control ',
                                    'value' => $emp['zip_code'],
                                    'type' => 'text'
                                        )
                                );
                                ?>
                            </div>   

                        </div>
                        <div class="row"><br>
                            <label class="control-label col-md-2">Cell Phone<span class="required">
                                </span>
                            </label>
                            <div class="col-md-4">
                                <?php
                                echo $this->Form->input(
                                        'cell_no', array(
                                    'class' => 'form-control ',
                                    'value' => $emp['cell_no'],
                                    'type' => 'text'
                                        )
                                );
                                ?>
                            </div>
                            <label class="control-label col-md-2">Alternate Phone <span class="required">
                                </span>
                            </label>
                            <div class="col-md-4">
                                <?php
                                echo $this->Form->input(
                                        'alternate_phone', array(
                                    'class' => 'form-control ',
                                    'value' => $emp['alternate_phone'],
                                    'type' => 'text'
                                        )
                                );
                                ?>
                            </div>
                        </div>
                        <div class="row"><br> 
                            <label class="control-label col-md-2">Email<span class="required">
                                </span>
                            </label>
                            <div class="col-md-4">
                                <?php
                                echo $this->Form->input(
                                        'email', array(
                                    'class' => 'form-control ',
                                    'value' => $emp['email'],
                                    'type' => 'text'
                                        )
                                );
                                ?>

                            </div>
                            <label class="control-label col-md-2">National ID<span class="required">
                                </span>
                            </label>
                            <div class="col-md-4">
                                <?php
                                echo $this->Form->input(
                                        'nid', array(
                                    'class' => 'form-control ',
                                    'value' => $emp['nid'],
                                    'type' => 'text'
                                        )
                                );
                                ?>
                            </div>

                        </div>
                        <div class="row"><br>
                            <label class="control-label col-md-2">Marital Status<span class="required">
                                </span>
                            </label>
                            <div class="col-md-4">
                                <?php
                                echo $this->Form->input('marital_status', array(
                                    'type' => 'select',
                                    'options' => array('Single' => 'Single', 'Married' => 'Married', 'Mivorced' => 'Divorced'),
                                    'empty' => 'Select Marital Status',
                                    'class' => 'span12 uniform nostyle select1 form-control',
                                    'value' => $emp['marital_status'],
                                        )
                                );
                                ?>
                            </div>  
                            <label class="control-label col-md-2">Blood group<span class="required">
                                </span>
                            </label>
                            <div class="col-md-4">
                                <?php
                                echo $this->Form->input('b_group', array(
                                    'type' => 'select',
                                    'value' => $emp['b_group'],
                                    'options' => array(
                                        'A+' => 'A+',
                                        'A-' => 'A-',
                                        'B+' => 'B+',
                                        'B-' => 'B-',
                                        'AB+' => 'AB+',
                                        'AB-' => 'AB-',
                                        'O-' => 'O-',
                                        'O+' => 'O+'
                                    ),
                                    'class' => 'form-control '
                                        )
                                );
                                ?>
                            </div>
                        </div> 
                    </div><br>

                  
                    <h4 style="text-decoration: underline; text-align:  center; color: teal;"><b>Job Information</b></h4><br>
                    <div class="form-group">

                        <div class="row"><br> 
                            <label class="control-label col-md-2">Employee ID<span class="required">
                                </span>
                            </label>
                            <div class="col-md-4">
                                <?php
                                echo $this->Form->input(
                                        'staff_id', array(
                                    'class' => 'form-control ',
                                    'style' => 'color: tomato; background-color:whitesmoke;',
                                    'value' => $emp['staff_id'],
//                                'disabled' => 'disabled',
                                    'type' => 'text'
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
                                    'value' => $emp['designation_id'],
                                    'class' => 'form-control select2me',
                                        )
                                );
                                ?>
                            </div>

                        </div>

                        <div class="row"><br>                        
                            <label class="control-label col-md-2">Work Location<span class="required">
                                </span>
                            </label>
                            <div class="col-md-4">
                                <?php
                                echo $this->Form->input('work_location', array(
                                    'type' => 'select',
                                    'options' => array('TBN24' => 'TBN24', 'Total IT Solution' => 'Total IT Solution'),
                                    //'default' => $selected['package'],
                                    'empty' => 'Select Work Location',
                                    'value' => $emp['work_location'],
                                    'class' => 'span12 uniform nostyle select1 form-control',
                                        )
                                );
                                ?>
                            </div>

                            <label class="control-label col-md-2">Department<span class="required">
                                </span>
                            </label>
                            <div class="col-md-4">
                                <?php
                                echo $this->Form->input('department_id', array(
                                    'type' => 'select',
                                    'options' => $departments,
                                    'empty' => 'Select Department',
                                    'value' => $emp['department_id'],
                                    'class' => 'form-control select2me'
                                        )
                                );
                                ?>
                            </div>
                        </div>


                    </div>

                    <div class="row">   <br>
                        <label class="control-label col-md-2">Date of joining<span class="required">
                            </span>
                        </label>
                        <div class="col-md-4">
                            <?php
                            echo $this->Form->input(
                                    'date_of_join', array(
                                'class' => 'form-control ',
                                'value' => $emp['date_of_join'],
                                'type' => 'text'
                                    )
                            );
                            ?>
                        </div>

                        <label class="control-label col-md-2">Payment Mode<span class="required">
                            </span>
                        </label>
                        <div class="col-md-4">

                            <?php
                            echo $this->Form->input('payment_mode', array(
                                'type' => 'select',
                                'options' => array('Cheque' => 'Cheque', 'Bank Transfer' => 'Bank Transfer'),
                                'empty' => 'Select Pay Mode',
                                'value' => $emp['payment_mode'],
                                'class' => 'span12 uniform nostyle select1 form-control'
                                    )
                            );
                            ?>
                        </div>                      
                    </div>

                    <div class="row"><br>
                        <label class="control-label col-md-2">Cheque No<span class="required">
                            </span>
                        </label>
                        <div class="col-md-4">
                            <?php
                            echo $this->Form->input(
                                    'cheque_no', array(
                                'class' => 'form-control ',
                                'value' => $emp['cheque_no'],
                                'type' => 'text'
                                    )
                            );
                            ?>
                        </div> 
                        <label class="control-label col-md-2">Account No<span class="required">
                            </span>
                        </label>
                        <div class="col-md-4">
                            <?php
                            echo $this->Form->input(
                                    'ac_no', array(
                                'class' => 'form-control ',
                                'value' => $emp['ac_no'],
                                'type' => 'text'
                                    )
                            );
                            ?>
                        </div> 

                    </div>

                    <div class="row"><br> 
                        <label class="control-label col-md-7">Compensation & benefit <span class="required">
                                ***</span>
                        </label>

                    </div> 
                 

                    <h4 style="text-decoration: underline; text-align:  center; color: teal;"><b>Emergency / Reference Contact Information</b> </h4><br>

                    <div class="row">
                        <label class="control-label col-md-1">Full Name <span class="required">
                            </span>
                        </label>
                        <div class="col-md-4">
                            <?php
                            echo $this->Form->input(
                                    'ref_name', array(
                                'class' => 'form-control ',
                                'value' => $emp['ref_name'],
                                'type' => 'text'
                                    )
                            );
                            ?>
                        </div>

                        <label class="control-label col-md-1">Address<span class="required">
                            </span>
                        </label>
                        <div class="col-md-4">
                            <?php
                            echo $this->Form->input(
                                    'ref_address', array(
                                'class' => 'form-control ',
                                'value' => $emp['ref_address'],
                                'type' => 'text'
                                    )
                            );
                            ?>
                        </div>
                    </div><br>


                    <div class="row">
                        <label class="control-label col-md-1">City <span class="required">
                            </span>
                        </label>
                        <div class="col-md-4">
                            <?php
                            echo $this->Form->input('ref_city_id', array(
                                'type' => 'select',
                                'options' => $cities,
                                'empty' => 'Select City',
                                'value' => $emp['ref_city_id'],
                                'class' => 'form-control select2me'
                                    )
                            );
                            ?>
                        </div>
                        <label class="control-label col-md-1">Zip code <span class="required">
                            </span>
                        </label>
                        <div class="col-md-3">
                            <?php
                            echo $this->Form->input(
                                    'ref_zip_code', array(
                                'class' => 'form-control ',
                                'value' => $emp['ref_zip_code'],
                                'type' => 'text'
                                    )
                            );
                            ?>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <label class="control-label col-md-1">Primary phone <span class="required">
                            </span>
                        </label>
                        <div class="col-md-2">
                            <?php
                            echo $this->Form->input(
                                    'ref_cell', array(
                                'class' => 'form-control ',
                                'value' => $emp['ref_cell'],
                                'type' => 'text'
                                    )
                            );
                            ?>
                        </div>
                        <label class="control-label col-md-3">Alternate phone <span class="required">
                            </span>
                        </label>
                        <div class="col-md-3">
                            <?php
                            echo $this->Form->input(
                                    'ref_alternate_phone', array(
                                'class' => 'form-control ',
                                'value' => $emp['ref_alternate_phone'],
                                'type' => 'text'
                                    )
                            );
                            ?>
                        </div>
                    </div>
                    <br>

                    <div class="row">
                        <label class="control-label col-md-1">Relationship <span class="required">
                            </span>
                        </label>
                        <div class="col-md-4">
                            <?php
                            echo $this->Form->input(
                                    'ref_relationship', array(
                                'class' => 'form-control ',
                                'value' => $emp['ref_relationship'],
                                'type' => 'text'
                                    )
                            );
                            ?>
                        </div>
                    </div>
                </div><br><br>

                <div class="form-actions">
                    <div class="row">
                        <div class="col-md-offset-6 col-md-4">
                            <?php
                            echo $this->Form->button(
                                    'Update', array('class' => 'btn green', 'type' => 'submit')
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

