
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
        <h3 class="page-title"><br>
            Set Employee Leave
        </h3>

        <!-- END PAGE HEADER-->
        <!-- BEGIN PAGE CONTENT-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet box green">
                    <div class="portlet-title">
                        <div class="caption">
                            <b>Total Late : </b> <b ><a target="_blank" href="<?php echo Router::url(array('controller' => 'leaves', 'action' => 'emp_late')) ?>" title="Click here for detail information" style="font-weight: normal; color: blue;"><?php echo $total_late; ?></a></b>&nbsp;
                            <b>Total Absent : </b> <b ><a target="_blank" href="<?php echo Router::url(array('controller' => 'leaves', 'action' => 'leaveofroaster')) ?>" title="Click here for detail information" style="font-weight: normal; color: blueviolet;"><?php echo $total_absent; ?></a></b>
                                       
                            <i class="fa fa-user"></i>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <?php echo $this->Session->flash(); ?> 
                        <table class="table table-striped table-hover table-bordered" id="sample_editable_1">
                            <thead>
                                <tr>
                                    <th>Emp Information</th>                                    
                                    <th>Sick Leave </th>
                                    <th>Casual Leave</th>
                                    <th>Earn Leave</th>
                                    <th>Remaining Leave</th>
                                    <!--<th>No of Absent</th>-->
                                    <!--<th>No of Late</th>-->
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($emps as $single):
//                                    $data = $single['leaves'];
                                    $des = $single['designations'];
                                    $dep = $single['departments'];
                                    $emp = $single['emps'];
                                    $us = $single['users'];
                                    $id = $emp['id'];
                                    ?>
                                    <tr >                                    
                                        <td>
                                            <b>Name :</b>  <?php echo $us['name']; ?> <b title="Emp Id" style="color:orange;">(<?php echo $emp['user_id']; ?>)</b>
                                            <br> <b>Designation :</b>  <?php echo $des['name']; ?>
                                            <br><b>Department :</b> <?php echo $dep['name']; ?>
                                        </td>
                                        <td><?php echo $emp['sick']; ?></td>
                                        <td><?php echo $emp['casual']; ?></td>                                     
                                        <td><?php echo $emp['earn_leave']; ?></td>                                     

                                        <td><?php echo $emp['r_leave']; ?></td>
                                        <!--<td><?php // echo 'No of Absent'; ?></td>-->
                                        <!--<td><?php // echo 'No of Late'; ?></td>-->
                                        <td>   
                                            <div class="controls center text-center">
<!--                                                <a target="_blank"  title="edit" href="<?php // echo Router::url(array('controller' => 'admins', 'action' => 'edit_leave', $id)) ?>" >
                                                    <span class="fa fa-pencil"></span></a>-->

                                                <a href="#" title="Leave"> <span id="<?php echo $emp['id']; ?>" class="fa fa-edit fa-lg forward_ticket"></span></a>
                                                <div id="forward_dialog<?php echo $emp['id']; ?>" class="portlet-body form" style="display: none;">
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
                                                        //'url' => array('controller' => 'admins', 'action' => 'edit_leave',$id)
                                                            )
                                                    );
                                                    ?>

                                                    <?php
                                                    echo $this->Form->input(
                                                            'id', array(
                                                        'type' => 'hidden',
                                                        'value' => $emp['id'],
                                                    ));
                                                    ?>

                                                    <div class="form-body">
                                                        <div class="alert alert-danger display-hide">
                                                            <button class="close" data-close="alert"></button>
                                                            You have some form errors. Please check below.
                                                        </div>
                                                        <?php echo $this->Session->flash(); ?>
                                                        <div class="form-group">
                                                            <div class="form-group">
                                                                <div class="col-md-12">
                                                                    <?php
                                                                    echo $this->Form->input(
                                                                            'sick', array(
                                                                        'class' => 'form-control required',
                                                                        'type' => 'text',
                                                                        'placeholder' => 'Sick Leave',
                                                                        'Value' => $emp['sick']
                                                                            )
                                                                    );
                                                                    ?>
                                                                </div>
                                                            </div>
                                                        </div>                                                          
                                                        <div class="form-group">
                                                            <div class="form-group">
                                                                <div class="col-md-12">
                                                                    <?php
                                                                    echo $this->Form->input(
                                                                            'casual', array(
                                                                        'class' => 'form-control required',
                                                                        'type' => 'text',
                                                                        'placeholder' => 'Casual Leave',
                                                                        'Value' => $emp['casual']
                                                                            )
                                                                    );
                                                                    ?>
                                                                </div>
                                                            </div>
                                                        </div>                                                          

                                                        <div class="form-group">
                                                            <div class="form-group">
                                                                <div class="col-md-12">
                                                                    <?php
                                                                    echo $this->Form->input(
                                                                            'earn_leave', array(
                                                                        'class' => 'form-control required',
                                                                        'type' => 'text',
                                                                        'placeholder' => 'Earn Leave',
                                                                        'Value' => $emp['earn_leave']
                                                                            )
                                                                    );
                                                                    ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-actions">
                                                        <div class="row">
                                                            <div class="col-md-offset-4 col-md-2">
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
                                            </div>
                                        </td>
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

