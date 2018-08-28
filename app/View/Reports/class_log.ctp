
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
            Class wise log information 
        </h3>
        <!-- END PAGE HEADER-->
        <!-- BEGIN PAGE CONTENT-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet box green">
                    <div class="portlet-title">
                        <div class="caption">
                              Total logs : ( <b style="color: black;"><?php echo $total_class;?></b> )
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
                                foreach ($data as $single):
                                    $result = $single['logs'];
                                    $users = $single['users'];
                                    $roles = $single['roles'];
                                    ?>
                                    <tr >
                                        <td><?php echo $result['id']; ?></td>                                          
                                        <td><?php echo $users['name']; ?> </td> 
                                        <td><?php echo $roles['name']; ?></td>  
                                        <td>
                                            <b>Class Name:</b> <b style="color: green; " title="Your searching key word was (class wise data)"><?php echo $result['class_name']; ?></b><br>
                                            <b>Function Name:</b> <?php echo $result['function_name']; ?><br>
                                            <?php if ($result['insert_id']): ?>
                                            <b>Inserted ID:</b> <b style="color: purple;"><?php echo $result['insert_id']; ?></b>
                                            <?php endif; ?>
                                        </td>  
                                        <td>                                            
                                            <b>PC IP:</b> <?php echo $result['ip']; ?><br>
                                            <b>PC Name:</b>  <?php echo $result['pc_name']; ?><br>
                                            <b>Date:</b> <?php echo $result['insert_date']; ?>
                                        </td>                                       
                                        <td><?php echo $result['created']; ?></td>                                       
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

