
<style type="text/css">
    .alert {
        padding: 6px;
        margin-bottom: 5px;
        border: 1px solid transparent;
        border-radius: 4px;
        text-align: center;
    }
    ul.pagination {
        display: flex;
        justify-content: center;
    }
</style>

<div class="page-content-wrapper">
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <h3 class="page-title">
            My Payments <small></small>
        </h3>
        <!-- END PAGE HEADER-->
        <!-- BEGIN PAGE CONTENT-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet box green">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-user"></i>List of my payments
                        </div>                        
                        <div class="tools">

                        </div>
                    </div>
                    <div class="portlet-body">
                        <?php echo $this->Session->flash(); ?> 
                        <table class="table table-striped table-hover table-bordered" id="sample_editable_1">
                            <thead>
                                <tr>
                                    <th>Note</th>                                                                     
                                    <th>Payment</th>
                                    <th>Payment Date</th>
                                    <th>Status</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($payments as $single):
                                    ?>
                                    <tr >
                                        <td><?php echo $single['others_payments']['note']; ?></td>
                                        <td><?php echo $single['others_payments']['payamount']; ?></td>
                                        <td><?php echo date('m-d-Y', strtotime($single['others_payments']['payment_date'])); ?></td>                                        
                                        <td><?php echo $single['others_payments']['status']; ?></td>
                                    </tr>
                                    <?php
                                endforeach;
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- END PAGE CONTENT -->
    </div>
</div>
<!-- END CONTENT -->

