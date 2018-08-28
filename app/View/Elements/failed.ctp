
<style>
    .ui-datepicker-multi-3 {
        display: table-row-group !important;
    }
</style>

<style type="text/css">
    .alert {
        padding: 6px;
        margin-bottom: 5px;
        border: 1px solid transparent;
        border-radius: 4px;
        text-align: center;
    }
    .txtArea { width:300px; }
    ul.pagination {
/*        display: flex;*/
        justify-content: center;
    }
</style> 
            <div class="page-content-wrapper" style="margin: 0px; padding: 0px;">
                <div class="">
                    <!-- BEGIN PAGE CONTENT-->
                    <div class="invoice" id="printableArea">
                        <hr>
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="alert alert-info clearfix" style="color: #000; font-size: 14px;"> 
                                    <p> Total Subscription<b>: <?php echo $data['totalCustomer']; ?></b> &nbsp; &nbsp;&nbsp;&nbsp;
                                        Total Payable Amount<b>: $<?php echo $data['totalPayment']; ?> </b></p>
                                </div> 
                                <ul class="pagination" >
                                    <?php
                                    for ($i = 1; $i <= $data['total_page']; $i++):
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
                                            <th class="sorting_desc">
                                                ID
                                            </th>

                                            <th>
                                                Customer Detail
                                            </th>
                                            <th>
                                                Package
                                            </th>

                                            <th>
                                                Payment Information
                                            </th>
                                            <th>
                                                Payment attempt at
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                  
                                        foreach ($data['data'] as $results):
                                            $customer = $results['pc'];
                                            $customer_address = $customer['house_no'] . ' ' . $customer['street'] . ' ' .
                                                    $customer['apartment'] . ' ' . $customer['city'] . ' ' . $customer['state'] . ' '
                                                    . $customer['zip'];
                                            ?>
                                            <tr>
                                                <td class="hidden-480">
                                                    <?php echo $results['t']['id']; ?>                            
                                                </td>
                                                <td class="hidden-480">
                                                    <a href="<?php
                                                    echo Router::url(array('controller' => 'customers',
                                                        'action' => 'edit', $results['pc']['id']))
                                                    ?>" 
                                                       target="_blank">
                                                           <?php echo $results['pc']['first_name'] . ' ' . $results['pc']['middle_name'] . ' ' . $results['pc']['last_name']; ?>
                                                    </a><br>
                                                    <?php echo $customer_address; ?> 
                                                </td>                                     
                                                <td>
                                                     <?php if (!empty($results['package_customers']['psetting_id'])): ?>
                                                        <li> <strong>Name:</strong> <?php echo $results['psettings']['name']; ?></li>
                                                        <li><strong>Duration:</strong> <?php echo $results['psettings']['duration']; ?></li>
                                                        <li><strong>Amount:</strong> <?php echo $results['psettings']['amount']; ?></li>
                                                    <?php elseif (!empty($results['custom_packages']['id'])): ?>
                                                        <li><strong>Name:</strong> <?php echo $results['custom_packages']['duration'] . ' Months, Custom package '; ?></li>
                                                        <li><strong>Amount:</strong> <?php echo $results['custom_packages']['charge'] . '$'; ?></li>
                                                    <?php else : ?>
                                                            <?php echo 'Package not set !'; ?>
                                                    <?php endif; ?>    
                                                </td>   
                                                <td class="hidden-480">
                                                    <?php echo $results['t']['content']; ?>                          
                                                </td>
                                                <td>
                                                    <?php echo $results['t']['created']; ?>                          
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>                            
    




