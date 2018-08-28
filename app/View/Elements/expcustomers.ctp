<div class="col-md-12">
    <!-- BEGIN EXAMPLE TABLE PORTLET-->
    <div class="portlet box green">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa ">Total Customers: <?php echo count($data); ?></i>
            </div>
            <div class="tools">
                <a href="javascript:;" class="reload">
                </a>
            </div>
        </div>
        <div class="portlet-body">
            <?php echo $this->Session->flash(); ?> 
            <div class="row">
                <div class="col-xs-12">
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

                    <table class="table table-striped table-hover">
                        <thead>
                            <tr> 
                                <th class="hidden-480">
                                    Account no.
                                </th>
                                <th class="hidden-480">
                                    Name
                                </th>
                                <th class="hidden-480">
                                    Address
                                </th>
                                <th class="hidden-480">
                                    Mac
                                </th>
                                <th class="hidden-480">
                                    Cell
                                </th>
                                <th>
                                    Package
                                </th>
                                <th class="hidden-480">
                                    Due
                                </th>
                                <th class="hidden-480">
                                    Exp Date
                                </th>
                            </tr>
                        </thead>
                        <tbody>                                    
                            <?php
                            foreach ($data as $info):
                                $customer_address = $info['package_customers']['house_no'] . ' ' . $info['package_customers']['street'] . ' ' .
                                        $info['package_customers']['apartment'] . ' ' . $info['package_customers']['city'] . ' ' . $info['package_customers']['state'] . ' '
                                        . $info['package_customers']['zip'];
                                ?>
                                <tr>
                                    <td><?php echo $info['package_customers']['id']; ?></td>
                                    <td> <a href="<?php echo Router::url(array('controller' => 'customers', 'action' => 'edit', $info['package_customers']['id'])) ?>" target="_blank"><?php echo $info['package_customers']['first_name'] . " " . $info['package_customers']['middle_name'] . " " . $info['package_customers']['last_name']; ?></a> </td>
                                    <td><?php echo $customer_address; ?></td>
                                    <td><?php echo $info['package_customers']['mac']; ?></td>
                                    <td><?php echo $info['package_customers']['cell']; ?></td>
                                    <td>
                                        <?php
                                        if (!empty($info['package_customers']['psetting_id'])) {
                                            echo $info['ps']['name'];
                                        } elseif (!empty($info['package_customers']['custom_package_id'])) {
                                            echo $info['cp']['duration'] . ' Months, Custom package ' . $info['cp']['charge'] . '$';
                                        } else {
                                            echo 'Package not set !';
                                        }
                                        ?>
                                    </td>
                                    <td>$<?php echo $info['package_customers']['payable_amount']; ?></td>                                               
                                    <td><?php echo date('m-d-Y', strtotime($info['package_customers']['package_exp_date'])); ?></td>
                                </tr>
                            <?php endforeach; ?>                           
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>