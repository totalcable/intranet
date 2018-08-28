
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
            Manage Admins <small>You can edit, delete or block</small>
        </h3>

        <!-- END PAGE HEADER-->
        <!-- BEGIN PAGE CONTENT-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet box green">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-user"></i>List of All Admins
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
                                    <!--<th>Picture</th>-->                                    
                                    <th>Email</th>
                                    <th>Role </th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($agents as $single):
                                    $agent = $single['User'];
//                                    pr($agent['picture']); exit;
                                    ?>
                                    <tr >
                                        <td><?php echo $agent['name']; ?></td>
    <!--                                        <td>
                                        <?php if (!empty($agent['picture'])): ?>
                                                    <img src="<?php // echo $this->webroot . 'pictures' . '/' . $agent['picture'];  ?>"  width="50px" height="50px" />
                                        <?php endif ?>
                                        </td>-->
                                        <td><?php echo $agent['email']; ?></td>
                                        <td><?php echo $single['Role']['name']; ?></td>
                                        <td><?php echo $agent['status']; ?></td>

                                        <td>   
                                            <div class="controls center text-center">
                                                <a  title="edit" href="<?php echo Router::url(array('controller' => 'admins', 'action' => 'edit_admin', $agent['id'])) ?>" >
                                                    <span class="fa fa-pencil"></span></a>
                                                &nbsp;&nbsp;
                                                <a 
                                                    onclick="if (confirm( &quot; Are you sure to delete this Admin? &quot; )) { return true; } return false;"
                                                    href="<?php echo Router::url(array('controller' => 'admins', 'action' => 'delete', $agent['id'])) ?>" title="delete">
                                                    <span class="fa fa-minus-square"></span>
                                                </a>                          
                                                &nbsp;&nbsp;
                                                <?php if ($agent['status'] != 'blocked'): ?>

                                                    <a onclick="if (confirm( &quot; Are you sure to block this Admin? &quot; )) { return true; } return false;"
                                                        href="<?php echo Router::url(array('controller' => 'admins', 'action' => 'block', $agent['id'])) ?>" title="block">
                                                        <span class="fa  fa-ban"></span>
                                                    </a>
                                                <?php endif; ?>

                                                <?php if ($agent['status'] != 'active'): ?>
                                                    <a aria-describedby="qtip-8" data-hasqtip="true" title="" oldtitle="Remove task" 
                                                       onclick="if (confirm( &quot; Are you sure to active this Admin? &quot; )) { return true; } return false;"
                                                       href="<?php
                                                       echo Router::url(array('controller' => 'admins', 'action' => 'active', $agent['id'])
                                                       )
                                                       ?>"
                                                       class="tip"><span class="fa  fa-check"></span></a>
                                                    <?php endif; ?>
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

