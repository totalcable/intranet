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

    <!-- BEGIN PAGE HEADER-->
    <h3 class="page-title">
        Cancel Customers
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

                    <div class="tools">
                        <a href="javascript:;" class="reload">
                        </a>
                    </div>
                </div>
                <div class="portlet-body">
                    <?php echo $this->Session->flash(); ?> 
                    <ul class="pagination" >
                        <?php
                        //echo $issue.':'.$agent.':'.$status;
                        for ($i = 1; $i <= $total_page; $i++):
                            $active = '';
                            if (isset($this->params['pass'][0]) && $this->params['pass'][0] == $i) {
                                $active = 'active';
                            }
                            ?>
                            <li class="paginate_button <?php echo $active; ?>" aria-controls="sample_editable_1" tabindex="<?php echo $i; ?>">
                                <a href="<?php echo Router::url(array('controller' => 'reports', 'action' => 'all', $action, $i, $start, $end)) ?>"><?php echo $i; ?></a>
                            </li>
                        <?php endfor; ?>
                    </ul>

                    <table class="table table-striped table-hover table-bordered" id="sample_editable_1">
                        <thead>
                            <tr>
                                <th>
                                    ID
                                </th>
                                <th>
                                    Date
                                </th>
                                <th>
                                    Customer Detail
                                </th>

<!--                                <th>
                                    Package
                                </th>-->

                                <th>
                                    Status
                                </th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($data as $results):
                                pr($results); exit;
                                $package = $results;
                                $mac_his = $results['mh'];

                                $customer = $results['customers'];
                                //$comments = $results['comments'][0]['content'];
                                $customer_address = $customer['house_no'] . ' ' . $customer['street'] . ' ' .
                                        $customer['apartment'] . ' ' . $customer['city'] . ' ' . $customer['state'] . ' '
                                        . $customer['zip'];
                                ?>
                                <tr>
                                    <td class="hidden-480">
                                        <?php echo $customer['id']; ?>                                      
                                    </td>
                                    <td class="hidden-480">
                                        <?php echo date('m-d-Y', strtotime($mac_his['created'])); ?> <br>                                            

                                    </td>
                                    <td>
                                        <?php
                                        echo $customer['first_name'] . " " .
                                        $customer['middle_name'] . " " .
                                        $customer['last_name'];
                                        ?>
                                        <br>
                                        <b>ID:</b>                                                
                                        <a title="You can open edit customer page :-)" href="<?php
                                        echo Router::url(array('controller' => 'customers',
                                            'action' => 'edit', $customer['id']))
                                        ?>" 
                                           target="_blank" style="color: darkred;">
                                            <b><?php echo $customer['id']; ?></b>
                                        </a><br>

                                        <?php if (!empty($customer['cell'])): ?>
                                            <b>Cell:</b>  tel:<?php echo $customer['cell'] ?><?php echo $customer['cell']; ?> &nbsp;&nbsp;
                                        <?php endif; ?><br>
                                        <?php if (!empty($customer['home'])): ?>
                                            <b> Phone: </b> tel:<?php echo $customer['home'] ?><br><?php echo $customer['home']; ?>
                                        <?php endif; ?> <br>
                                        <b> Address: </b> <?php echo $customer_address; ?>  <br>
                                        <b>SD: </b>    <?php echo $customer['deposit']; ?> <br>
                                        <b>Monthly Bill:</b>   <?php echo $customer['monthly_bill']; ?> 
                                    </td>

    <!--                                    <td>
                                            <b>Package :</b>
                                    <?php if (!empty($package['name'])): ?>
                                        <?php echo $package['name'] ?><br>
                                                    <b>Duration:</b> <?php echo $package['duration']; ?><br>
                                                    <b>Amount:</b>  <?php echo $package['amount']; ?>
                                    <?php endif; ?><br>
                                            <strong>Equipment:</strong> <?php echo $customer['shipment_equipment']; ?>
                                            <br>
                                            <strong>Quantity:</strong> <?php echo $customer['remote_no']; ?>
                                            <br>
                                            <strong>Additional Note:</strong> <?php echo $customer['shipment_note']; ?>

                                            <br>
                                            <b>Status: </b><b style="color: orangered"><?php echo $customer['mac_status']; ?></b> 
                                        </td>-->

    <!--                                    <td>
                                            <ul>
                                    <?php if (!empty($comments['content'])): ?>
                                        <?php echo $comments['content'] ?> 
                                    <?php endif ?>
                                            </ul>
                                        </td>-->
                                    <td>
                                        <?php echo $customer['mac_status']; ?> <br>                                            

                                    </td>
                                </tr>
                            <?php endforeach; ?>  
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- END EXAMPLE TABLE PORTLET-->
        </div>
        <!-- END PAGE CONTENT -->
    </div>
</div>
<!-- END CONTENT -->
