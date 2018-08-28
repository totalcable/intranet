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
            Next Recurring Customers list <small></small>
        </h3>
        <!-- BEGIN PAGE CONTENT-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet box green">
                    <div class="portlet-title">
                        <div class="caption">
                            <h3 title="Total next recuring :-)">Total customers : ( <b style="color:yellow;"><?php echo $total_cus['total']; ?></b> ) </h3>
                        </div>
                        <div class="tools">
<!--                            <a href="" class="fa fa-check">
                            </a>-->
                        </div>
                    </div>
                    <div class="portlet-body">
                        <?php echo $this->Session->flash(); ?> 
                        <table class="table table-striped table-hover table-bordered" id="sample_editable_1">
                            <thead>
                                <tr>
                                    <th>
                                        SL.
                                    </th> 
                                    <th>
                                        Customer detail
                                    </th>
                                    <th>
                                        Next recurring details
                                    </th>
                                    <th>
                                        Comment
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($allData as $customers):
                                    $customer = $customers['package_customers'];
                                    $date = date('Y-m-d', strtotime($customer['next_r_date']));
                                    $days_ago = date('Y-m-d', strtotime('-15 days', strtotime($date)));                                    
                                    
                                    $customer_address = $customer['house_no'] . ' ' . $customer['street'] . ' ' .
                                            $customer['apartment'] . ' ' . $customer['city'] . ' ' . $customer['state'] . ' '
                                            . $customer['zip'];
                                    ?>
                                    <tr>
                                        <td class="hidden-480">
                                            <?php echo $customer['id']; ?>                            
                                        </td>
                                        <td>
                                            <b>Name: </b> <a href="<?php
                                            echo Router::url(array('controller' => 'customers',
                                                'action' => 'edit', $customer['id']))
                                            ?>" 
                                                target="_blank">
                                                    <?php
                                                    echo $customer['first_name'] . " " .
                                                    $customer['middle_name'] . " " .
                                                    $customer['last_name'];
                                                    ?>
                                            </a><br>
                                            <?php if (!empty($customer['cell'])): ?>
                                                <b>Cell:</b>  <?php echo $customer['cell'] ?> &nbsp;&nbsp;
                                            <?php endif; ?><br>
                                            <?php if (!empty($customer['home'])): ?>
                                                <b> Phone: </b><?php echo $customer['home'] ?>
                                            <?php endif; ?> <br>
                                            <b> Address: </b> <?php echo $customer_address; ?> 
                                        </td>
                                        <td>
                                            <ul>
                                                <?php if ($customer['next_recurring'] == 'yes'): ?>
                                                    <b>Next recurring :</b> <?php echo $customer['next_recurring']; ?> <br>
                                                    <b>Next recurring duration :</b>   <?php echo $customer['next_r_duration']; ?>  <br>
                                                    <b>Next billing date :</b> <?php echo $customer['next_r_date']; ?> <br>
                                                    <b>Invoice create date :</b> <?php echo $days_ago; ?> <br>
                                                    <b>Next billing amount :</b> <?php echo $customer['next_r_payable_amount']; ?> 
                                                <?php endif ?>
                                            </ul>
                                        </td>
                                        <td>
                                            <ul>
                                                <?php if (!empty($customer['next_r_comment'])): ?>
                                                    <?php echo $customer['next_r_comment'] ?> 
                                                <?php endif ?>
                                            </ul>
                                        </td>                                       
                                    </tr>
                                <?php endforeach; ?> 
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



