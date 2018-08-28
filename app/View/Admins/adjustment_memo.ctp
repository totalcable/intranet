
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
            Manage Adjustment Memo<small> You can edit, delete or Approve</small>
        </h3>

        <!-- END PAGE HEADER-->
        <!-- BEGIN PAGE CONTENT-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet box green">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-user"></i>List of All Memo
                        </div>


                    </div>
                    <div class="portlet-body">

                        <?php echo $this->Session->flash(); ?> 

                        <table class="table table-striped table-hover table-bordered" id="sample_editable_1">

                            <thead>
                                <tr>
                                    <th>Customer Detail</th>
                                    <th>Note</th>
                                    <th>Adjustment Amount</th>
                                    <th>Adjustment Type</th>
                                    <th>Created Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $type = array('credit' => 'Credit', 'sdadjustment' => 'SD Adjustment', 'sdrefund' => 'SD Refund', 'refferalbonus' => 'Refferal Bonus');
                                foreach ($data as $single):
                                    $pc = $single['package_customers'];
                                    $t = $single['transactions'];
//                                    pr($t['status']); exit;
                                    $customer_address = $pc['house_no'] . ' ' . $pc['street'] . ' ' .
                                            $pc['apartment'] . ' ' . $pc['city'] . ' ' . $pc['state'] . ' '
                                            . $pc['zip'];
                                    ?>
                                    <tr >
                                        <td>
                                            <b>Name:</b>  <a target="_blank" href="<?php echo Router::url(array('controller' => 'customers', 'action' => 'edit', $pc['id'])) ?>">
                                                <?php echo $pc['first_name'] . ' ' . $pc['middle_name'] . ' ' . $pc['last_name']; ?>
                                            </a>
                                            <br>
                                            <b>Address:</b> <?php echo $customer_address; ?>
                                            <br>
                                            <b>Phone:</b> <?php echo $pc['cell']; ?> &nbsp;&nbsp;&nbsp; <?php echo $pc['home']; ?>
                                        </td>
                                        
                                        <td><?php echo $t['note']; ?></td>

                                        <td> $<?php echo $t['payable_amount']; ?></td>
                                        <td>
                                            <?php $status = strtolower($t['status']);
                                          echo ucfirst($status);?>
                                        </td>
                                        <td><?php echo $t['next_payment']; ?></td>

                                        <td>   
                                            <div class="controls center text-center">
                                                <a  target="_blank" title="edit" href="<?php echo Router::url(array('controller' => 'payments', 'action' => 'adjustmentMemoEdit', $t['id'])) ?>" >
                                                    <span class="fa fa-pencil"></span></a>
                                                &nbsp;&nbsp;
                                                <a 
                                                    onclick="if (confirm('Are you sure to delete this Memo?')) {
                                                                return true;
                                                            }
                                                            return false;"
                                                    href="<?php echo Router::url(array('controller' => 'admins', 'action' => 'deleteMemo', $t['id'])) ?>" title="delete">
                                                    <span class="fa fa-minus-square"></span>
                                                </a>                          
                                                &nbsp;&nbsp;
                                                <a 
                                                    onclick="if (confirm('Are you sure to approve this Memo?')) {
                                                                return true;
                                                            }
                                                            return false;"
                                                    href="<?php echo Router::url(array('controller' => 'admins', 'action' => 'approveMemo', $t['id'])) ?>" title="approve">
                                                    <span class="fa fa-check"></span>
                                                </a>  
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

