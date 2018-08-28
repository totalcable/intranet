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
            Open Event list <small>Take action with the following event</small>
        </h3>

        <!-- END PAGE HEADER-->
        <!-- BEGIN PAGE CONTENT-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-wrench"></i>Open Event list
                        </div>

                        <div class="tools">
                            <a href="javascript:;" class="reload">
                            </a>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <?php echo $this->Session->flash(); ?>
                        <table class="table table-striped table-hover table-bordered" id="sample_editable_1">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Place</th>
                                    <th>Opening Date</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($events as $single):

                                    $event = $single['Event'];
                                    ?>
                                    <tr >
                                        <td><?php echo $event['name']; ?></td>
                                        <td><?php echo $event['place']; ?></td>
                                        <td><?php echo $event['open']; ?></td>
                                        <td><?php echo $event['status']; ?></td>

                                        <td>   
                                            <div class="controls center">
                                                <a  target="_blank" title="edit" href="<?php echo Router::url(array('controller' => 'events', 'action' => 'edit', $event['id'])) ?>" >
                                                    <span class="fa fa-pencil"></span></a>
                                                &nbsp;&nbsp;
                                                <a 
                                                    onclick="if (confirm('Are you sure to delete this Event?')) {
                                                                    return true;
                                                                }
                                                                return false;"
                                                    href="<?php echo Router::url(array('controller' => 'events', 'action' => 'delete', $event['id'])) ?>" title="delete">
                                                    <span class="fa fa-minus-square"></span>
                                                </a>                          
                                                &nbsp;&nbsp;
                                               
                                                <a 
                                                    onclick="if (confirm('Are you sure to reopen this Event ?')) {
                                                                        return true;
                                                                    }
                                                                    return false;"

                                                    href="<?php echo Router::url(array('controller' => 'events', 'action' => 'reopen', $event['id'])) ?>" title="reopen">
                                                    <span class="fa  fa-circle-o-notch"></span>
                                                </a>
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

