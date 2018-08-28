
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
                            <a href="" title="Add new" class="fa fa-plus">
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
                                    <th>Email</th>
                                    <th>Role </th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($request_list as $single):
//                                     pr($single); exit;
                                    $agent = $single['users'];
                                    $role = $single['roles'];
                                   $id = $agent['id'];
                                    ?>
                                    <tr >
                                        <td><?php echo $agent['name']; ?></td>
                                        <td><?php echo $agent['last_duty_date']; ?></td>
                                        <td><?php echo $agent['email']; ?></td>
                                        <td><?php echo $role['name']; ?></td>
                                        <td><?php echo $agent['status']; ?></td>
                                        <td>   
                                            <div class="controls center text-center">                                               
                                                <a 
                                                    onclick="if (confirm( &quot; Are you sure to approve this Admin? &quot; )) { return true; } return false;"
                                                    href="<?php echo Router::url(array('controller' => 'admins', 'action' => 'requested_approve', $id)) ?>" title="Approve">
                                                    <span class="fa fa-check"></span>
                                                </a>                          
                                                &nbsp;&nbsp;                                                
                                                <a 
                                                    onclick="if (confirm( &quot; Are you sure to delete this Admin?&quot; )) { return true; } return false;"
                                                    href="<?php echo Router::url(array('controller' => 'admins', 'action' => 'requested_delete', $id)) ?>" title="Remove">
                                                    <span class="fa fa-minus"></span>
                                                </a>                          
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

