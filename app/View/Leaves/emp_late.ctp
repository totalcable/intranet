
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
<!--                            <b>Total Late : </b> <b ><a target="_blank" href="<?php echo Router::url(array('controller' => 'leaves', 'action' => 'emp_late')) ?>" title="Click here for detail information" style="font-weight: normal; color: blue;"><?php echo $total_late; ?></a></b>&nbsp;
                            <b>Total Absent : </b> <b ><a target="_blank" href="<?php echo Router::url(array('controller' => 'leaves', 'action' => 'leaveofroaster')) ?>" title="Click here for detail information" style="font-weight: normal; color: blueviolet;"><?php echo $total_absent; ?></a></b>
                                       -->
                            <i class="fa fa-user"></i>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <?php echo $this->Session->flash(); ?> 
                        <table class="table table-striped table-hover table-bordered" id="sample_editable_1">
                            <thead>
                                <tr>
                                    <th>Emp Information</th>                                    
                                    <th>Date </th>
                                    <th>Late</th>
                                  
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($late as $single):
//                                    $data = $single['leaves'];
//                                    $des = $single['designations'];
//                                    $dep = $single['departments'];
//                                    $emp = $single['emps'];
                                    $la = $single['roaster_details'];
                                    $us = $single['users'];
//                                    $id = $emp['id'];
                                    ?>
                                    <tr >                                    
                                        <td>
                                            <b>Name :</b>  <?php echo $us['name']; ?><br>
                                            <b>Emp ID : </b><b title="Emp Id" style="color:orange;"><?php echo $la['emp_id']; ?></b>
                                           
                                        </td>
                                        <td><?php echo $la['date']; ?></td>
                                        <td>
                                            
                                            <a target="_blank" href="<?php echo Router::url(array('controller' => 'leaves', 'action' => 'emp_late')) ?>" title="Click here for more information" style="font-weight: normal; color: blue;"><?php echo $single[0]['total_late']; ?></a>
                                        
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

