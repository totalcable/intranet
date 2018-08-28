
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
                            Your present month attendance information
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
                                    <th>Emp ID</th>
                                    <th>Date</th>
                                    <th>Shift Name</th>
                                    <th>In Time</th>                                
                                    <th>Out Time</th>                            
<!--                                    <th>Late </th>
                                    <th>Extra Time</th>-->
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($duty as $single):
                                   // pr($single); exit;
                                    $data = $single['roaster_details'];
                                   
                                    ?>
                                    <tr >
                                        <td><?php echo $data['emp_id']; ?></td>
                                        <td><?php echo $data['date']; ?></td>  
                                        <td><?php echo substr($data['shift_name_time'], 0,5); ?></td>
                                        <td><?php echo $data['in_time']; ?></td>
                                        <td><?php echo $data['out_time']; ?></td>
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

