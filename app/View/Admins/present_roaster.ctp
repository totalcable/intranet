
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
                            Roaster Information
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
                                    <th>Date</th>
                                    <th>Emp ID</th>
                                    <th>Shift Name</th>      
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($duty as $single):
                                    $data = $single['roaster_details'];
                                    $user = $single['users'];
                                    $id = $data['id'];
                                    ?>
                                    <tr>
                                        <td><?php echo $data['date']; ?></td>  
                                        <td>                                           
                                            <?php echo $user['name']; ?> <b title="Emp Id" style="color:tomato;">(<?php echo $data['emp_id']; ?>)</b>
                                        </td>
                                        <td>
                                            <?php
                                            $a = substr($data['shift_name_time'], 0, 1);
                                            if ($a == 'M') {
                                                $c = 'green';
                                                $v = 'Morning';
                                            } elseif ($a == 'A') {
                                                $c = 'orange';
                                                $v = 'Afternoon';
                                            } elseif ($a == 'N') {
                                                $c = 'blue';
                                                $v = 'Night';
                                            }
                                            ?>
                                            <b style= "color:<?php echo $c; ?>">  <?php echo $v; ?></b>
                                        </td>
                                        <td><b title="Emp Id" style="font-size: 12px; color:#000; font-weight: normal;"><?php
                                                if ($data['attend_status'] == 'no') {
                                                    echo 'Pending Duty';
                                                }
                                                ?></td></b>
                                        <td> 
                                            <div class="controls center text-center">
                                                <a aria-describedby="qtip-8" data-hasqtip="true" title="Absent" 
                                                   onclick="if (confirm('Are you sure to absent this employee?')) {
                                                                   return true;
                                                               }
                                                               return false;" href="<?php echo Router::url(array('controller' => 'admins', 'action' => 'user_status_absent', $id)) ?>"class="tip"><span class="fa fa-check fa-lg"></span></a>
<!--                                                &nbsp; <a aria-describedby="qtip-8" data-hasqtip="true" title="Leave" 
                                                          onclick="if (confirm('Are you sure to leave this employee?')) {
                                                                          return true;
                                                                      }
                                                                      return false;" href="<?php echo Router::url(array('controller' => 'admins', 'action' => 'user_status_leave', $id, $a)) ?>"class="tip"><span class="fa fa-plane fa-lg"></span></a>-->

                                                &nbsp;
                                                <a href="#" title="Swap"> <span id="<?php echo $data['id']; ?>" class="fa fa-reddit fa-lg forward_ticket"></span></a>
                                                <div id="forward_dialog<?php echo $data['id']; ?>" class="portlet-body form" style="display: none;">
                                                    <!-- BEGIN FORM-->
                                                    <?php
                                                    echo $this->Form->create('RoasterDetail', array(
                                                        'inputDefaults' => array(
                                                            'label' => false,
                                                            'div' => false
                                                        ),
                                                        'id' => 'form_sample_3',
                                                        'class' => 'form-horizontal',
                                                        'novalidate' => 'novalidate',
                                                        'url' => array('controller' => 'roasters', 'action' => 'user_swap')
                                                            )
                                                    );
                                                    ?>
                                                    <?php
                                                    echo $this->Form->input('id', array(
                                                        'type' => 'hidden',
                                                        'value' => $id,
                                                            )
                                                    );
                                                    ?>

                                                    <?php
                                                    echo $this->Form->input('old_emp', array(
                                                        'type' => 'hidden',
                                                        'value' => $data['emp_id']
                                                            )
                                                    );
                                                    ?>
                                                    <?php
                                                    echo $this->Form->input('date', array(
                                                        'type' => 'hidden',
                                                        'value' => $data['date']
                                                            )
                                                    );
                                                    ?>
                                                    <?php
                                                    echo $this->Form->input('shift', array(
                                                        'type' => 'hidden',
                                                        'value' => $data['shift_name_time']
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
                                                            <div class="form-group">
                                                                <div class="col-md-12">
                                                                    <?php
                                                                    echo $this->Form->input('new_emp_id', array(
                                                                        'type' => 'select',
                                                                        'options' => $users,
                                                                        'empty' => 'Select Emp',
                                                                        'class' => 'form-control select2me',
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
                                                                    echo $this->Form->input('swap_type', array(
                                                                        'type' => 'select',
                                                                        'options' => array('request' => 'Request', 'not_request' => 'Not Request'),
                                                                        'empty' => 'Select Type',
                                                                        'class' => 'form-control select2me '
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
                                                                    echo $this->Form->input('comment_swap', array(
                                                                        'type' => 'textarea',
                                                                        'class' => 'form-control required',
                                                                        'placeholder' => 'Write your comments'
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
                                                                        'Make swap', array('class' => 'btn green', 'type' => 'submit')
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

