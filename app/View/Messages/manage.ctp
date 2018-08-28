
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
            Manage Messages <small>You can edit, delete or block</small>
        </h3>        
        <!-- END PAGE HEADER-->
        <!-- BEGIN PAGE CONTENT-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet box green">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-user"></i>List of all Message
                        </div>                        
                        <div class="tools">
                            <a href="<?php echo Router::url(array('controller' => 'messages', 'action' => 'add')) ?>" title="Add new message" class="fa fa-plus">
                            </a>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <?php echo $this->Session->flash(); ?> 
                        <table class="table table-striped table-hover table-bordered" id="sample_editable_1">                            
                            <thead>
                                <tr>
                                    <th>Announcements Date</th>
                                    <th>Announcements</th>
                                    <th>Assign Individual</th>
                                    <th>Assign Department</th>
                                    <th>Status </th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($data as $result):
                                    ?>
                                    <tr >
                                        <td>
                                        <?php echo date('m-d-Y h:i:sa', strtotime($result['m']['created'])); ?>
                                        </td>
                                        <td><?php echo $result['m']['message']; ?></td>
                                        <td><?php echo $result['u']['individual']; ?></td>
                                        <td><?php echo $result['r']['department']; ?></td>
                                        <td><?php echo $result['m']['status']; ?></td>                                      
                                        <td>   
                                            <div class="controls center text-center">
                                                <a  title="edit" href="<?php echo Router::url(array('controller' => 'messages', 'action' => 'edit', $result['m']['id'])) ?>" >
                                                    <span class="fa fa-pencil"></span></a>                                                                         
                                                &nbsp;&nbsp;
                                                <?php if ($result['m']['status'] != 'close'): ?>

                                                    <a 
                                                        onclick="if (confirm(&quot; Are you sure to close this Admin?&quot; )) { return true; } return false;"
                                                        href="<?php echo Router::url(array('controller' => 'messages', 'action' => 'close', $result['m']['id'])) ?>" title="Close">
                                                        <span class="fa  fa-ban"></span>
                                                    </a>
                                                <?php endif; ?>

                                                <?php if ($result['m']['status'] != 'open'): ?>
                                                    <a aria-describedby="qtip-8" data-hasqtip="true" title="Open" oldtitle="Remove task" 
                                                       onclick="if (confirm(&quot; Are you sure to open this Admin?&quot; )) { return true; } return false;"
                                                       href="<?php
                                                       echo Router::url(array('controller' => 'messages', 'action' => 'open', $result['m']['id'])
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

