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
            All Event list <small>Take action with the following event</small>
        </h3>

        <!-- END PAGE HEADER-->
        <!-- BEGIN PAGE CONTENT-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-wrench"></i>All Event list
                        </div>
                        <?php echo $this->Session->flash(); ?>
                        <div class="tools">
                            <a href="javascript:;" class="reload">
                            </a>
                        </div>
                    </div>
                    <div class="portlet-body">



                        <table class="table table-striped table-hover table-bordered" id="sample_editable_1">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Place</th>
                                    <th>Opening</th>
                                    <th>Close</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($agents as $single):

                                    $agent = $single['Admin'];
                                    ?>
                                    <tr >
                                        <td><?php echo $agent['name']; ?></td>
                                        <td><?php echo $agent['email']; ?></td>
                                        <td><?php echo $agent['mobile']; ?></td>
                                        <td><?php echo $agent['area']; ?></td>
                                        <td><?php echo $single['Role']['name']; ?></td>
                                        <td><?php echo $agent['status']; ?></td>
                                        <td><?php echo $agent['comment']; ?></td>

                                        <td>   
                                            <div class="controls center">
                                                <a  target="_blank" title="edit" href="<?php echo Router::url(array('controller' => 'admins', 'action' => 'edit_admin', $agent['id'])) ?>" >
                                                    <span class="fa fa-pencil"></span></a>
                                                &nbsp;&nbsp;
                                                <a 
                                                   onclick="if (confirm(&quot; Are you sure to delete this Admin? &quot; )) { return true; } return false;"
                                                   href="<?php echo Router::url(array('controller' => 'admins', 'action' => 'delete', $agent['id']))?>" title="delete">
                                                    <span class="fa fa-minus-square"></span>
                                                </a>                          
                                            &nbsp;&nbsp;
                                             <?php if ($agent['status'] != 'blocked'): ?>

                                                    <a 
                                                       onclick="if(confirm(&quot; Are you sure to block this Admin? &quot;)) { return true; } return false;"

                                                       href="<?php echo Router::url(array('controller' => 'admins', 'action' => 'block', $agent['id']))?>" title="block">
                                                        <span class="fa  fa-ban"></span>
                                                    </a>
                                                <?php endif; ?>

    <?php if ($agent['status'] != 'active'): ?>
                                                    <a aria-describedby="qtip-8" data-hasqtip="true" title="" oldtitle="Remove task" 
                                                       onclick="if (confirm(&quot; Are you sure to active this Admin? &quot; )) { return true; } return false;"

                                                       href="<?php echo Router::url(array('controller' => 'admins', 'action' => 'active', $agent['id'])
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

