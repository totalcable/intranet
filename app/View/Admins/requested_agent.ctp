
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
            Manage Requested Agent
        </h3>

        <!-- END PAGE HEADER-->
        <!-- BEGIN PAGE CONTENT-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet box green">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-user"></i>List of All Request
                        </div>

                        <div class="tools">
                            <a href="<?php echo Router::url(array('controller' => 'admins', 'action' => 'create')) ?>" title="Add new admin" class="fa fa-plus">
                            </a>
                        </div>
                    </div>
                    <div class="portlet-body">

                        <?php echo $this->Session->flash(); ?> 

                        <table class="table table-striped table-hover table-bordered" id="sample_editable_1">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Date</th>
                                    <th>In Time</th>                                
                                    <th>Out Time</th>                                
                                   
                                    <th>Group </th>
                                    <!--<th>Status</th>-->
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($request_list as $single):
                                    //pr($single); exit;
                                    $agent = $single['users'];
                                    $role = $single['roles'];
                                    $id = $agent['id'];
                                    ?>
                                    <tr >
                                        <td><?php echo $agent['name']; ?></td>
                                        <td><?php echo $agent['last_duty_date']; ?></td>
                                        <td><?php echo $agent['last_in_time']; ?></td>
                                        <td>
                                            <?php if ($agent['last_out_time'] != '00:00:00') { ?>
                                                <?php echo $agent['last_out_time']; ?>
                                            <?php } else { ?>
                                                <b style="color: violet; font-weight: none;"><?php echo $agent['last_out_time']; ?></b> 
                                            <?php } ?>
                                        </td>
<!--                                        <td>
               
                                            <b style="color:red; font-weight: none;" title="This is late time !!!"> <?php echo $agent['late_time'].' '.'Minutes'; ?></b>
                                        </td>-->
                                        <td><?php echo $role['name']; ?></td>
                                        <!--<td><?php // echo $agent['status']; ?></td>-->
                                        <td>   
                                            <div class="controls center text-center"> 
                                                <?php
                                                //  $s_time  = "09:52"; //fix time
                                               $out = '12:00'; //static time                                               
                                                //$out = date("h:i"); //present time 
                                               // pr($out); exit;
                                                $time_diff = strtotime($s_time) - strtotime($out);
                                                $m_time = $time_diff / 60;
                                                //pr($m_time); 
                                                if ($m_time <= 0) {
                                                    // Out time approve
                                                    ?>                                                
                                                    <a onclick="if (confirm( &quot; Are you sure to approve this Admin? &quot; )) {return true; } return false;"
                                                        href="<?php echo Router::url(array('controller' => 'admins', 'action' => 'requested_approve', $id)) ?>" title="Approve">
                                                        <span class="fa fa-check"></span>
                                                    </a>                          
                                                    &nbsp;&nbsp;  

                                                <?php } elseif ($log_status == 'request') { // In time approve ?>
                                                    <a onclick="if (confirm( &quot; Are you sure to approve this Admin? &quot; )) {return true; } return false;"
                                                        href="<?php echo Router::url(array('controller' => 'admins', 'action' => 'requested_approve', $id)) ?>" title="Approve">
                                                        <span class="fa fa-check"></span>
                                                    </a>
                                                <?php } ?>
                                                <!--                                                <a 
                                                                                                    onclick="if (confirm(&quot; Are you sure to delete this Admin? &quot;)) { return true; } return false;"
                                                                                                    href="<?php echo Router::url(array('controller' => 'admins', 'action' => 'requested_delete', $id)) ?>" title="Remove">
                                                                                                    <span class="fa fa-minus"></span>
                                                                                                </a>                          -->
                                                &nbsp;&nbsp;                                                
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

