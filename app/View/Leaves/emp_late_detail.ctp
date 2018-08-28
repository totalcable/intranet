
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
        <h3 class="page-title"><br>
         Employee late information
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
                    </div>
                    <div class="portlet-body">
                        <?php echo $this->Session->flash(); ?> 
                        <table class="table table-striped table-hover table-bordered" id="sample_editable_1">
                            <thead>
                                <tr>
                                    <th>Emp Information</th>                                    
                                    <th>Shift</th>                                    
                                    <th>Date</th>                                    
                                    <th>In Time</th>                                    
                                    <th>Late Time</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($late as $single):
                                    $la = $single['roaster_details'];
                                    $us = $single['users'];
                                    ?>
                                    <tr >                                    
                                        <td>
                                            <b>Name :</b>  <?php echo $us['name']; ?><br>
                                            <b>Emp ID : </b><b title="Emp Id" style="color:orange;"><?php echo $la['emp_id']; ?></b>
                                        </td>
                                        <td><?php echo $la['shift_name_time']; ?></td>
                                        <td><?php echo $la['date']; ?></td>
                                        <td><?php echo $la['in_time']; ?></td>
                                        <td><?php echo $la['late_time']; ?></td>
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

