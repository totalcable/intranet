
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
            <!--Manage Admins <small>You can edit, delete or block</small>-->
        </h3>
        <!-- END PAGE HEADER-->
        <!-- BEGIN PAGE CONTENT-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet box green">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-user"></i>List of All Payments Settings
                        </div>
                    </div>
                    <div class="portlet-body">
                        <?php echo $this->Session->flash(); ?> 
                        <table class="table table-striped table-hover table-bordered" id="sample_editable_1">
                            <thead>
                                <tr>
                                    <th>Action</th>
                                    <th>Pay Amount</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($paymentsettings as $single):
                                    ?>
                                    <tr >
                                        <td><?php echo $single['PaymentSetting'] ['action']; ?></td>
                                        <td><?php echo $single['PaymentSetting'] ['payment']; ?></td>
                                        <td>   
                                            <div class="controls center text-center">
                                                <a  target="_blank" title="You can change payment by click." href="<?php echo Router::url(array('controller' => 'payments', 'action' => 'edit_settings', $single['PaymentSetting'] ['id'])) ?>" >
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

