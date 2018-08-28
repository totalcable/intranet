
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
            Manage Emps <small>You can edit</small>
        </h3>
        <!-- END PAGE HEADER-->
        <!-- BEGIN PAGE CONTENT-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet box green">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-user"></i>List of All Emps
                        </div>
                        <div class="tools">
                            <a href="<?php echo Router::url(array('controller' => 'emps', 'action' => 'leave_add')) ?>" title="Request for new leave" class="fa fa-plus">
                            </a>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <?php echo $this->Session->flash(); ?> 
                        <table class="table table-striped table-hover table-bordered" id="sample_editable_1">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Designation</th>
                                    <th>Department</th>
                                    <th>Email</th>
                                    <th>Cell No</th>                              
                                    <th>Relation</th>                                  
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($emps as $single):
                                    $emps = $single['emps'];
                                    $designations = $single['designations'];
                                    $departments = $single['departments'];
                                    ?>
                                    <tr >
                                        <td><?php echo $emps['id']; ?></td>
                                        <td>
                                            <a target="_blank" title="Click for update information :-)" href="<?php echo Router::url(array('controller' => 'emps', 'action' => 'editemp', $emps['id'])) ?>" >
                                                <?php echo $emps['staff_id']; ?></a>                                    
                                        </td>
                                        <td>
                                            <a target="_blank" title="Click & view this employee information :-)" href="<?php echo Router::url(array('controller' => 'emps', 'action' => 'individual_info', $emps['id'])) ?>" >
                                            <?php echo $emps['name']; ?>
                                            </a> 
                                        </td>
                                        <td><?php echo $emps['father_name']; ?></td>
                                        <td><?php echo $emps['mother_name']; ?></td>
                                        <td><?php echo $emps['dob']; ?></td>
                                        <td><?php echo $emps['present_address']; ?></td>
                                        <td><?php echo $emps['permanent_address']; ?></td>
                                        <td><?php echo $designations['name']; ?></td>
                                        <td><?php echo $departments['name']; ?></td>
                                        <td><?php echo $emps['email']; ?></td>
                                        <td><?php echo $emps['cell_no']; ?></td>
                                        <td><?php echo $emps['b_group']; ?></td>
                                        <td><?php echo $emps['ref_name']; ?></td>
                                        <td><?php echo $emps['ref_address']; ?></td>
                                        <td><?php echo $emps['ref_cell']; ?></td>
                                        <td><?php echo $emps['ref_relationship']; ?></td>
                                    </tr>
                                    <?php
                                endforeach;
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- END EXAMPLE TABLE PORTLET-->
            </div>
        </div>
        <!-- END PAGE CONTENT -->
    </div>
</div>
<!-- END CONTENT -->

