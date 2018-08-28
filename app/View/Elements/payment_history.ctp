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
                        <p class="pull-left"> 
                            Total Amount Collected<b>: $<?php echo $data['totalamount']; ?></b>&nbsp;
                            Manually Collected<b>: $<?php echo $data['totalmanual']; ?></b>&nbsp;
                            Auto Recurring Collected<b>: $<?php echo $data['totalautore']; ?></b>&nbsp;
                            1Month Subscription<b>: <?php echo $data['sql1monthp']; ?></b>&nbsp;
                            3Months Subscription<b>: <?php echo $data['total3monthp']; ?></b>&nbsp;
                            6Months Subscription<b>: <?php echo $data['total6monthp']; ?></b>&nbsp;
                            12Months Subscription<b>: <?php echo $data['total12monthp']; ?>                                    
                        </p>                                       
                        <p class="pull-right"> Total Subscription<b>: <?php echo $data['total']; ?></b></p><br>


                        <span id="box" class="hide"><?php // echo $boxes;     ?></span>
                        <?php // endforeach; ?>

                        <p class="pull-right"> Total Boxes<b>: <?php echo $data['totalbox']; ?> </b></p>
                        <!--<p class="pull-right"> Total Boxes<b>: <span class="showthis" data-box="box"></span> </b></p>-->
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
                                    <a href="<?php echo Router::url(array('controller' => 'reports', 'action' => 'all',$action, $i, $data['start'], $data['end'], $data['pay_mode'])) ?>"><?php echo $i; ?></a>
                                </li>
                            <?php endfor; ?>
                        </ul>
                        <thead>
                            <tr>
                                <th>Customer Detail</th>
                                <th>Package info</th>
                                <th>Payment Detail</th>
                                <th>Payment Amount</th>
                                <th>Payment Time</th>
                            </tr>
                        </thead>
                        <tbody>                                     
                            <?php
                            $total = 0;
                            $boxes = 0;
                            foreach ($data['transactions'] as $single):
                                $tr = $single['tr'];
//                                            $total += $tr['paid_amount'];

                                $pc = $single['pc'];
                                $stbs = count($pc['stbs']);
//                                            $stbs = json_decode($pc['mac']);+
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
                                        <ul>
                                            <li><strong>Pay Mode :</strong> <?php echo $tr['pay_mode']; ?></li>
                                            <?php if (!empty($tr['check_info'])): ?>
                                                <li><strong>Check No :</strong> <?php echo $tr['check_info']; ?></li>
                                            <?php endif; ?>
                                            <?php if (!empty($tr['check_image'])): ?>
                                                <li>                                                                
                                                    Check Image: <img src="<?php echo $this->webroot . 'check_images' . '/' . $tr['check_image']; ?>"  width="50px" height="50px" />
                                                </li>        
                                            <?php endif; ?>
                                            <?php if (!empty($tr['cash_by'])): ?>
                                                <li><strong>Received by:</strong> <?php echo $tr['cash_by']; ?></li>        
                                            <?php endif; ?>

                                            <?php if ($tr['pay_mode'] == 'card'): ?>
                                                <li><strong>Transaction ID :</strong> <?php echo $tr['trx_id']; ?></li>
                                            <?php endif; ?>
                                        </ul>
                                    </td>

                                    <td><h4> $<?php echo $tr['payable_amount']; ?> </h4></td>
                                    <td>                                                    
                                        <?php echo date('m-d-Y', strtotime($tr['created'])); ?>
                                    </td>
                                </tr>
                                <?php
                            endforeach;
                            ?>   

                        </tbody>
                    </table>
                    <!--<h2 style="text-align: center;" > Grant Total: $<?php echo $total; ?></h2>-->
                </div>


            </div>
        </div>
    </div>
</div>  