
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
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet ">

                    <div class="portlet-body">
                        <div class="col-md-12" style=" line-height: 31px;">
                            <?php
                            foreach ($emps as $single):
                                $emp = $single['emps'];
                                $c = $single['c'];
                                $city = $single['cities'];
                                $designations = $single['designations'];
                                $departments = $single['departments'];
                                ?>
                                <div class="form-body"><br><br>
                                    <h3 style="text-align: center; color: white; background-color: gray;">Personal Information</h3><br><br>
                                    <div class="form-group">
                                        <div class="row">
                                            <label class="control-label col-md-2">Full Name : <span class="required">
                                                </span>
                                            </label>
                                            <div class="col-md-4">
                                                <?php echo $emp['name']; ?>
                                            </div>
                                            <label class="control-label col-md-2">Father's Name : <span class="required">
                                                </span>
                                            </label>
                                            <div class="col-md-4">
                                                <?php echo $emp['father_name']; ?>                                              
                                            </div>
                                        </div><br>
                                        <div class="row">
                                            <label class="control-label col-md-2">Mother's Name : <span class="required">
                                                </span>
                                            </label>
                                            <div class="col-md-4">
                                                <?php echo $emp['mother_name']; ?> 
                                            </div>

                                            <label class="control-label col-md-2">Date of Birth : <span class="required">
                                                </span>
                                            </label>
                                            <div class="col-md-4">
                                                <?php echo $emp['dob']; ?> 
                                            </div>
                                        </div>
                                        <div class="row"><br>
                                            <label class="control-label col-md-2">Present Address : <span class="required">
                                                </span>
                                            </label>
                                            <div class="col-md-4">
                                                <?php echo $emp['present_address']; ?> 
                                            </div>
                                            <label class="control-label col-md-2">Permanent Address : <span class="required">
                                                </span>
                                            </label>
                                            <div class="col-md-4">
                                                <?php echo $emp['permanent_address']; ?> 
                                            </div>   

                                        </div>

                                        <div class="row"><br>
                                            <label class="control-label col-md-2">City : <span class="required">
                                                </span>
                                            </label>
                                            <div class="col-md-4">
                                                <?php echo $city['name']; ?> 
                                            </div>
                                            <label class="control-label col-md-2">Zip code : <span class="required">
                                                </span>
                                            </label>
                                            <div class="col-md-4">
                                                <?php echo $emp['zip_code']; ?> 
                                            </div>   

                                        </div>
                                        <div class="row"><br>
                                            <label class="control-label col-md-2">Cell Phone : <span class="required">
                                                </span>
                                            </label>
                                            <div class="col-md-4">
                                                <?php echo $emp['cell_no']; ?>
                                            </div>
                                            <label class="control-label col-md-2">Alternate Phone : <span class="required">
                                                </span>
                                            </label>
                                            <div class="col-md-4">
                                                <?php echo $emp['alternate_phone']; ?>
                                            </div>
                                        </div>


                                        <div class="row"><br>
                                            <label class="control-label col-md-2">Email : <span class="required">
                                                </span>
                                            </label>
                                            <div class="col-md-4">
                                                <?php echo $emp['email']; ?>
                                            </div>
                                            <label class="control-label col-md-2">National ID : <span class="required">
                                                </span>
                                            </label>
                                            <div class="col-md-4">
                                                <?php echo $emp['nid']; ?>
                                            </div>

                                        </div>
                                        <div class="row"><br>
                                            <label class="control-label col-md-2">Marital Status : <span class="required">
                                                </span>
                                            </label>
                                            <div class="col-md-4">
                                                <?php echo $emp['marital_status']; ?>
                                            </div>  
                                            <label class="control-label col-md-2">Blood group : <span class="required">
                                                </span>
                                            </label>
                                            <div class="col-md-4">
                                                <?php echo $emp['b_group']; ?>
                                            </div>
                                        </div> 
                                    </div><br>


                                    <h3 style="text-align:  center;  color: white; background-color: gray;"><b>Job Information</b></h3><br>
                                    <div class="row"><br>
                                        <label class="control-label col-md-2">Employee ID : <span class="required">
                                            </span>
                                        </label>
                                        <div class="col-md-4">
                                            <b style="color: green;"> <?php echo $emp['staff_id']; ?></b>
                                        </div>

                                        <label class="control-label col-md-2">Designation : <span class="required">
                                            </span>
                                        </label>
                                        <div class="col-md-4">
                                            <?php echo $departments['name']; ?>
                                        </div>
                                    </div>    

                                    <div class="row"><br>
                                        <label class="control-label col-md-2">Work Location : <span class="required">
                                            </span>
                                        </label>
                                        <div class="col-md-4">
                                            <?php echo $emp['work_location']; ?>
                                        </div>

                                        <label class="control-label col-md-2">Department : <span class="required">
                                            </span>
                                        </label>
                                        <div class="col-md-4">
                                            <?php echo $designations['name']; ?>                                             
                                        </div>
                                    </div>   

                                    <div class="row"><br>
                                        <label class="control-label col-md-2">Date of joining : <span class="required">
                                            </span>
                                        </label>
                                        <div class="col-md-4">
                                            <?php echo $emp['date_of_join']; ?>
                                        </div>
                                        <label class="control-label col-md-2">Payment Mode : <span class="required">
                                            </span>
                                        </label>
                                        <div class="col-md-4">
                                            <?php echo $emp['payment_mode']; ?>
                                        </div> 
                                    </div>    

                                    <div class="row"><br>
                                        <label class="control-label col-md-2">Cheque No : <span class="required">
                                            </span>
                                        </label>
                                        <div class="col-md-4">
                                            <?php echo $emp['cheque_no']; ?>
                                        </div>
                                        <label class="control-label col-md-2">Account No : <span class="required">
                                            </span>
                                        </label>
                                        <div class="col-md-4">
                                            <?php echo $emp['ac_no']; ?>
                                        </div> 
                                    </div>    

                                    <h3 style="text-align:  center;  color: white; background-color: gray;"><b>Emergency / Reference Contact Information</b> </h3><br>
                                    <div class="row">
                                        <label class="control-label col-md-2">Full Name : <span class="required">
                                            </span>
                                        </label>
                                        <div class="col-md-4">
                                            <?php echo $emp['ref_name']; ?> 
                                        </div>
                                        <label class="control-label col-md-2">Address : <span class="required">
                                            </span>
                                        </label>
                                        <div class="col-md-4">
                                            <?php echo $emp['ref_address']; ?> 
                                        </div>
                                    </div><br>

                                    <div class="row">
                                        <label class="control-label col-md-2">City : <span class="required">
                                            </span>
                                        </label>
                                        <div class="col-md-4">
                                            <?php echo $c['name']; ?> 
                                        </div>
                                        <label class="control-label col-md-2">Zip code : <span class="required">
                                            </span>
                                        </label>
                                        <div class="col-md-4">
                                            <?php echo $emp['ref_zip_code']; ?>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <label class="control-label col-md-2">Primary phone : <span class="required">
                                            </span>
                                        </label>
                                        <div class="col-md-4">
                                            <?php echo $emp['ref_cell']; ?>
                                        </div>
                                        <label class="control-label col-md-2">Alternate phone : <span class="required">
                                            </span>
                                        </label>
                                        <div class="col-md-4">
                                            <?php echo $emp['ref_alternate_phone']; ?>
                                        </div>
                                    </div>
                                    <br>

                                    <div class="row">
                                        <label class="control-label col-md-2">Relationship : <span class="required">
                                            </span>
                                        </label>
                                        <div class="col-md-4">
                                            <?php echo $emp['ref_relationship']; ?>
                                        </div>
                                    </div>
                                </div><br><br>
                                <?php
                            endforeach;
                            ?>
                        </div>
                    </div>
                </div>
                <!-- END EXAMPLE TABLE PORTLET-->
            </div>
        </div>
        <!-- END PAGE CONTENT -->
    </div>
</div>
<!-- END CONTENT -->

