       
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
            Complete the transactions <small>(individually)</small>
        </h3>

        <!-- END PAGE HEADER-->
        <!-- BEGIN PAGE CONTENT-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-list-ul"></i>List of transactions to be processed
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
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Card No</th>
                                    <th>Zip Code</th>
                                    <th>Amount</th>
                                    <th>Card Exp Date</th>
                                    <th>Package Exp Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                        foreach ($paidcustomers as $single):
                            $info = $single;
//                        pr($single); exit;
                            ?>
                            <tr class="odd gradeX">
                                <td><?php echo $info['fname']; ?></td>
                                <td><?php echo $info['lname']; ?></td>
                                <td><?php echo $info['card_no']; ?></td>
                                <td><?php echo $info['zip_code']; ?></td>
                                <td><?php echo $info['due']; ?></td>
                                <td><?php echo $info['exp_date']; ?></td>
                                <td>   
                                            <div class="controls center text-center">                                               
                                        <a onclick="if (confirm(&quot;Are you sure to complete this transaction?&quot)) { return true; } return false;" href="<?php echo Router::url(array('controller'=>'payments','action'=>'individual_transaction', $info['id'])
                                                )?>" class="tip"><span class="fa fa-download fa-lg" title="Make transaction for this customer"></span></a>
                                                
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
                