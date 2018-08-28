    
        
<style type="text/css">
    .alert {
        padding: 6px;
        margin-bottom: 5px;
        border: 1px solid transparent;
        border-radius: 4px;
        text-align: center;
    }
    .txtArea { width:300px; }

</style>

<div class="page-content-wrapper">
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <h3 class="page-title">
            Transaction History <small>Including transaction id, error message and authentication code</small>
        </h3>

        <!-- END PAGE HEADER-->
        <!-- BEGIN PAGE CONTENT-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-list-ul"></i>List of all transactions
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
                                    <th>Transactions Id</th>
                                    <th>Authentication Code</th>
                                    <th>Error Message</th>
                                    <th>Status</th>
                                    <th>Transaction Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                        foreach ($transactions as $single):
                            $info = $single['Transaction'];
                            ?>
                            <tr class="odd gradeX">
                                <td><?php echo $info['trx_id']; ?></td>
                                <td><?php echo $info['auth_code']; ?></td>
                                <td><?php echo $info['error_msg']; ?></td>
                                <td><?php echo $info['status']; ?></td>
                                <td><?php echo $info['created']; ?></td>
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
        