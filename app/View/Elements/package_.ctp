<div class="page-content-wrapper" style="margin: 0px; padding: 0px;">
    <div class="">
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
                    <div class="alert alert-info clearfix" style="color: #000; font-size: 14px;"> 

                    </div>  
                    <table class="table table-striped table-hover table-bordered" id="sample_editable_1">
                        <ul class="pagination" >
                            <?php
                            for ($i = 1; $i <= $data['total_page']; $i++):
                                $active = '';
                                if (isset($this->params['pass'][0]) && $this->params['pass'][0] == $i) {
                                    $active = 'active';
                                }
                                ?>
                                <li class="paginate_button <?php echo $active; ?>" aria-controls="sample_editable_1" tabindex="<?php echo $i; ?>">
                                    <a href="<?php echo Router::url(array('controller' => 'reports', 'action' => 'all', $action, $i, $data['start'], $data['end'], $data['pay_mode'])) ?>"><?php echo $i; ?></a>
                                </li>
                            <?php endfor; ?>
                        </ul>
                        <thead>
                            <tr>
                                <th>Customer Detail</th>
                                <th>Package info</th>
                                <th>Payment Detail</th>
                            </tr>
                        </thead>
                        <tbody>                                     
                            <?php
                            pr($data['package_customers']);
                            exit;
                            foreach ($package_info as $single):

                                $pc = $single['pc'];
                                $stbs = count($pc['stbs']);
//                              $stbs = json_decode($pc['mac']);+
                                $boxes = $stbs;
                                $customer_address = $pc['house_no'] . ' ' . $pc['street'] . ' ' .
                                        $pc['apartment'] . ' ' . $pc['city'] . ' ' . $pc['state'] . ' '
                                        . $pc['zip'];
                                ?>

                                <tr >
                                    <td>
                                        <ul>
                                            <li><strong>Name:</strong>  
                                                <a href="<?php
                                                echo Router::url(array('controller' => 'customers',
                                                    'action' => 'edit', $pc['id']))
                                                ?>" 
                                                   target="_blank">
                                                       <?php
                                                       echo $pc['first_name'] . ' ' . $pc['middle_name'] . ' ' . $pc['last_name'];
                                                       ?>
                                                </a><br>
                                            </li> 
                                            <li><strong> Cell: </strong>  <?php echo $pc['cell']; ?> </li> 
                                            <li><strong> Mac: </strong> 
                                                <ul>
                                                    <?php if (is_array($stbs)) foreach ($stbs as $stb): ?>
                                                            <li> <?php echo $stb; ?></li>
                                                        <?php endforeach; ?>
                                                </ul>
                                            </li> 
                                        </ul>
                                    </td>
                                    <td>
                                        <ul>
                                            <?php if ($single['pc']['psetting_id']) { ?>
                                                <li><strong>Package Name :</strong> <?php echo $single['ps']['name']; ?></li>
                                            <?php } elseif (!empty($single['pc']['custom_package_id'])) { ?>
                                                <li><strong>Package Name :</strong> <?php echo $single['cp']['duration'] . ' Months, Custom package'; ?></li></br>
                                                <li><strong>Charge :</strong> <?php echo $single['cp']['charge'] . '$'; ?></li>
                                            <?php } else { ?>
                                                <?php echo 'Package not set !'; ?>
                                            <?php } ?> 
                                        </ul>
                                    </td>
                                    <td>                                                    
                                        <?php echo date('m-d-Y', strtotime($pc['date'])); ?>
                                    </td>
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
</div>  