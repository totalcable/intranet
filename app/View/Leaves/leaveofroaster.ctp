
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
                            Roaster Information
                        </div>
                        <div class="tools">
                        </div>
                    </div>
                    <div class="portlet-body">
                        <?php echo $this->Session->flash(); ?> 
                        <table class="table table-striped table-hover table-bordered" id="sample_editable_1">
                            <thead>
                                <tr> 
                                    <th>Emp Information</th>
                                    <th>Date</th>                                    
                                    <th>Shift Name</th>      
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($data_e as $single):
                                    $data = $single['roaster_details'];
                                    $user = $single['users'];
                                    $id = $data['id'];
                                    ?>
                                    <tr>
                                        <td>                                           
                                            <?php echo $user['name']; ?> <b title="Emp Id" style="color:tomato;">(<?php echo $data['emp_id']; ?>)</b>
                                        </td>
                                        <td><?php echo $data['date']; ?></td>  
                                        <td>
                                            <?php
                                            $a = substr($data['shift_name_time'], 0, 1);
                                            if ($a == 'M') {
                                                $c = 'green';
                                                $v = 'Morning - (05:30AM - 01:00PM)';
                                            } elseif ($a == 'A') {
                                                $c = 'orange';
                                                $v = 'Afternoon - (01:00PM - 09:00PM)';
                                            } elseif ($a == 'N') {
                                                $c = 'blue';
                                                $v = 'Night - (09:00PM - 03:00AM)';
                                            }
                                            ?>
                                            <b style= "color:<?php echo $c; ?>">  <?php echo $v; ?></b>
                                        </td>
                                        <td><b title="Emp Id" style="font-size: 12px; color:#000; font-weight: normal;"><?php echo ucfirst($data['attend_status']); ?>
                                        </td></b>

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

