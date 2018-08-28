
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
            View all log information 
        </h3>
        <!-- END PAGE HEADER-->
        <!-- BEGIN PAGE CONTENT-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet box green">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-user"></i>
                        </div>
                        <div class="tools">
                            
                        </div>
                    </div>
                    <div class="portlet-body">
                        <?php echo $this->Session->flash(); ?> 
                        <table class="table table-striped table-hover table-bordered" id="sample_editable_1">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>User Name</th>
                                    <th>Role Name </th>
                                    <th>Browse Info</th>
                                    <th>Others</th>
                                    <th>Date & Time</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                foreach ($logs as $single):
                                    $result = $single['logs'];
                                    $users = $single['users'];
                                    $roles = $single['roles'];
                                    ?>
                                    <tr >
                                        <td><?php echo $result['id']; ?></td>                                          
                                        <td>
                                            <a target="_blank" href="<?php echo Router::url(array('controller' => 'reports', 'action' => 'user_log', $users['id'])) ?>" title="User wise log information :-)">
                                                <?php echo $users['name']; ?>
                                            </a>
                                        </td> 

                                        <td>
                                            <a target="_blank" href="<?php echo Router::url(array('controller' => 'reports', 'action' => 'role_log', $roles['id'])) ?>" title="Role wise log information :-)">
                                                <?php echo $roles['name']; ?>
                                            </a>
                                        </td>  
                                        <td>
                                            <b>Class Name:</b>                                                
                                            <a target="_blank" href="<?php echo Router::url(array('controller' => 'reports', 'action' => 'class_log', $result['class_name'])) ?>" title="Class wise log information :-)">
                                                 <?php echo $result['class_name']; ?>
                                            </a>
                                            <br>
                                            <b>Function Name:</b>                                                 
                                            <a target="_blank" href="<?php echo Router::url(array('controller' => 'reports', 'action' => 'function_log', $result['function_name'])) ?>" title="Function wise log information :-)">
                                                 <?php echo $result['function_name']; ?>
                                            </a>
                                            
                                            <br>
                                            <?php if ($result['insert_id']): ?>
                                                <b>Inserted ID:</b> <b style="color: purple;"><?php echo $result['insert_id']; ?></b>
                                            <?php endif; ?>
                                        </td>  
                                        <td>
                                           <b>PC IP:</b><a target="_blank" href="<?php echo Router::url(array('controller' => 'reports', 'action' => 'ip_log', $result['ip'])) ?>" title="IP wise log information :-)">
                                                  <?php echo $result['ip']; ?>
                                            </a> <br>
                                          
                                          <b>PC Name:</b><a target="_blank" href="<?php echo Router::url(array('controller' => 'reports', 'action' => 'pc_name_log', $result['pc_name'])) ?>" title="PC name wise log information :-)">
                                                  <?php echo $result['pc_name']; ?>
                                            </a> <br>
                                          
                                          <b>Date:</b><a target="_blank" href="<?php echo Router::url(array('controller' => 'reports', 'action' => 'date_log', $result['insert_date'])) ?>" title="Date wise log information :-)">
                                                  <?php
                                                  $date=$result['insert_date'];
                                                  $date_i= date("d-m-Y", strtotime($date));
                                                  echo $date_i; ?>
                                              
                                            </a>
                                          
                                        </td>                                       
                                        <td><?php 
                                        $date= $result['created'];
                                                  $date_c= date("d-m-Y H:i:s A", strtotime($date));                                        
                                        echo $date_c; ?></td>                                       
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

