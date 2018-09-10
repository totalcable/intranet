
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
                <div class="portlet box green">
                    <div class="portlet-title">
                        <div class="caption">
                            Search attendance by date 
                        </div>
                        <!--                        <div class="tools">
                                                    <a href="javascript:;" class="reload">
                                                    </a>
                                                                                <a href="javascript:;" class="reload">
                                                                                </a>
                                                </div>-->
                    </div>

                    <div class="portlet-body form">
                        <!-- BEGIN FORM-->
                        <?php
                        echo $this->Form->create('RoasterDetail', array(
                            'inputDefaults' => array(
                                'label' => false,
                                'div' => false
                            ),
                            'id' => 'form-validate',
                            'class' => 'form-horizontal',
                            'novalidate' => 'novalidate'
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
                                            'daterange', array(
                                        'class' => 'span9 text e1' /* e1 is past to current date, e2 is past to future date */
                                            )
                                    );
                                    ?>
                                </div>
                            </div>

                        </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-4 col-md-5">
                                    <?php
                                    echo $this->Form->button(
                                            'Search', array('class' => 'btn btn-success', 'type' => 'submit')
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
        <!-- BEGIN PAGE CONTENT-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet box green">
                    <div class="portlet-title">
                        <div class="caption">
                            Attendance information
                            <!--<i class="fa fa-user"></i>List of All Request-->
                        </div>
                        <div class="tools">
<!--                            <a href="<?php echo Router::url(array('controller' => 'admins', 'action' => 'create')) ?>" title="Add new admin" class="fa fa-plus">
                            </a>-->
                        </div>
                    </div>
                    <div class="portlet-body">
                        <?php echo $this->Session->flash(); ?> 
                        <table class="table table-striped table-hover table-bordered" id="sample_editable_1">
                            <thead>
                                <tr>
                                    <th>Employee</th>
                                    <th>Date</th>
                                    <th>Shift Name</th>
                                    <th>In Time</th> 
                                    <th>Late </th>
                                    <th>Out Time</th>                            
                                    <th>Extra Time</th>                            
                                    <th>Total Duty</th>                            
     <!--                           <th>Extra Time</th>-->
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($duty as $single):
//                                    pr($single); exit;
                                    $data = $single['roaster_details'];
                                    $user = $single['users'];
                                    $id = $data['user_id'];
                                    ?>
                                    <tr >
                                        <td>
                                            <b>Name:</b> <?php echo $user['name']; ?><br><b>Emp Id: </b> (<a href="<?php echo Router::url(array('controller' => 'attendances', 'action' => 'attend_one', $id)) ?>"  target="_blank" title="Click here for individual information :-)">
                                                <?php // echo $data['user_id']; ?>
                                                    <b title="Emp Id" style="color:tomato;"><?php echo $data['user_id']; ?></b>
                                            </a>)
                                        </td>
                                        <td><?php echo $data['date']; ?></td>  
                                        <td><?php echo substr($data['shift_name_time'], 0, 7); ?></td>
                                        <td><?php echo $data['in_time']; ?></td>
                                        <td> <b  title="Late time &nbsp; :(" style="color: red;"><?php
                                                if ($data['late_time'] != '00:00:00') {
                                                    echo $data['late_time'];
                                                }
                                                ?></b> </td>
                                        <td><?php echo $data['out_time']; ?></td>
                                        <td><b  title="Extra time &nbsp; :)" style="color: green;"><?php
                                                if ($data['extra_time'] != '00:00:00') {
                                                    echo $data['extra_time'];
                                                }
                                                ?></b></td>
                                        <td><?php echo $data['total_duty']; ?></td>
                                        <td><?php echo $data['attend_status']; ?></td>
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

