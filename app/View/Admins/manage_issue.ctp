
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
            Manage Issue<small>You can add, edit </small>
        </h3>
        <!-- END PAGE HEADER-->
        <!-- BEGIN PAGE CONTENT-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet box green">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-user"></i>List of All Issue
                        </div>

                        <div class="tools">
                            <a href="<?php echo Router::url(array('controller' => 'admins', 'action' => 'addissue')) ?>" title="Add new Issue" class="fa fa-plus">
                            </a>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <?php echo $this->Session->flash(); ?> 
                        <table class="table table-striped table-hover table-bordered" id="sample_editable_1">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Created</th>                                   
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($issues as $single):
                                    $issues = $single['Issue'];
                                    ?>
                                    <tr >
                                        <td><?php echo $issues['id']; ?></td>
                                        <td><?php echo $issues['name']; ?></td>
                                        <td><?php echo $issues['created']; ?></td>
                                        <td>   
                                            <div class="controls center text-center">
                                                <a  title="edit" href="<?php echo Router::url(array('controller' => 'admins', 'action' => 'editissue', $issues['id'])) ?>" >
                                                    <span class="fa fa-pencil"></span></a>                                                                  
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

