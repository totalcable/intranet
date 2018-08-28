<div class="page-content-wrapper" style="margin: 0px; padding: 0px;">                
    <!-- BEGIN PAGE CONTENT-->
    <div class="invoice"  id="printableArea">

        <div class="row">
            <div class="col-xs-6">                    
            </div>
            <div class="col-xs-4">
            </div>
            <div class="col-xs-2 invoice-payment">
                <div style="text-align: left;">

                </div>
            </div>
        </div>
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
                <table class="table table-striped table-hover table-bordered" id="sample_editable_1">
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
                            ?>
                            <tr>
                                <td>                                                    
                                    <?php echo $info['package_customers']['id']; ?>                                                
                                </td>
                                <td> <a href="<?php echo Router::url(array('controller' => 'customers', 'action' => 'edit', $info['package_customers']['id'])) ?>" target="_blank"><?php echo $info['package_customers']['middle_name'] . " " . $info['package_customers']['last_name']; ?></a> </td>
                                <td>
                                    <?php if (!empty($info['package_customers']['address'])): ?>
                                        <?php echo $info['package_customers']['address']; ?>
                                    <?php endif; ?>
                                </td>
                                <td><?php echo $info['package_customers']['mac']; ?></td>
                                <td><?php echo $info['package_customers']['cell']; ?></td>
                                <td>
                                    <?php
                                    if (!empty($info['package_customers']['psetting_id'])) {
                                        echo $info['psettings']['name'];
                                    } elseif (!empty($info['package_customers']['custom_package_id'])) {
                                        echo $info['custom_packages']['duration'] . ' Months, Custom package ' . $info['custom_packages']['charge'] . '$';
                                    } else {
                                        echo 'Package not set !';
                                    }
                                    ?>
                                </td>
                                <td>
                                    $<?php
                                    $paid = 0;
                                    if (!empty($info['transactions']['id'])) {
                                        $paid = getPaid($info['transactions']['id']);
                                    }

                                    echo $info['transactions']['payable_amount'] - $paid;
                                    ?> USD
                                </td>
                                <td><?php echo date('m-d-Y', strtotime($info['package_customers']['modified'])); ?></td>                                              

                                <td><?php // echo date('m-d-Y', strtotime($info['package_customers']['created']));   ?></td>                                                
                            </tr>
                        <?php endforeach; ?>                           
                    </tbody>
                </table>
            </div>


        </div>
    </div>

</div>    