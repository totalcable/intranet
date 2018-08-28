<!-- BEGIN PAGE CONTENT-->

<div  class="col-md-12 col-sm-12">
    <h3 class="page-title">
        All Over Due Invoice
    </h3>
    <?php echo $this->Session->flash(); ?>
    <ul class="pagination" >
        <?php
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
    <table cellpadding="0" cellspacing="0" border="0" class="responsive dynamicTable display table table-bordered" width="100%" >
        <thead>
            <tr >  
                <th>Invoice</th>
                <th>Payment info</th>
                <th>Customer Details</th>
                <th> Auto recurring Detail</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($data['transactions'] as $single):
                $customer_address = $single['pc']['house_no'] . ' ' . $single['pc']['street'] . ' ' .
                        $single['pc']['apartment'] . ' ' . $single['pc']['city'] . ' ' . $single['pc']['state'] . ' '
                        . $single['pc']['zip'];
                ?>
                <tr class="odd gradeX">
                    <td> 
                        <?php echo $single['tr']['id']; ?>
                    </td>
                    <td>
                        <ul>
                            <?php if ($single['tr']['pay_mode'] == 'card'): ?>

                                <li>Pay Mode : <?php echo $single['tr']['pay_mode']; ?></li> 
                                <li>Status : <?php echo $single['tr']['status']; ?></li>
                                <?php if ($single['tr']['status'] == 'error'): ?>
                                    <ul>
                                        <li>Error Message : <?php echo $single['tr']['error_msg']; ?></li> 
                                    </ul>
                                <?php endif;
                                ?>
                                <li>Transaction No : <?php echo $single['tr']['trx_id']; ?></li> 
                                <li>Card No : <?php echo substr($single['tr']['card_no'], -4); ?></li>  
                                <li>Zip Code : <?php echo $single['tr']['zip_code']; ?></li>  
                                <li>Expire Date : <?php echo $single['tr']['exp_date']; ?></li>
                            <?php elseif ($single['tr']['pay_mode'] == 'cash'): ?>
                                <li>Pay Mode : <?php echo $single['tr']['pay_mode']; ?></li> 
                                <li> Cash By : <?php echo $single['tr']['cash_by']; ?> </li>
                                <a  target="_blank" title="Edit"  href="<?php echo Router::url(array('controller' => 'transactions', 'action' => 'edit', $single['tr']['id'])) ?>" >
                                    <span class="fa fa-pencil" target ="_blank"></span>
                                </a>
                            <?php elseif ($single['tr']['pay_mode'] == 'refund'): ?>
                                <li>Pay Mode : <?php echo $single['tr']['pay_mode']; ?></li>
                                <li>Check Info : <?php echo $single['tr']['check_info']; ?></li>
                                <ul> <li>Amount : <?php echo $single['tr']['paid_amount']; ?></li>
                                    <li>Refund Date : <?php echo date('m-d-Y', strtotime($single['tr']['created'])); ?></li>
                                </ul>
                                <a  target="_blank" title="Edit"  href="<?php echo Router::url(array('controller' => 'transactions', 'action' => 'edit', $single['tr']['id'])) ?>" >
                                    <span class="fa fa-pencil" target ="_blank"></span>
                                </a>
                            <?php else: ?>
                                <li>Pay Mode : <?php echo $single['tr']['pay_mode']; ?></li> 
                                <li>Check Info : <?php echo $single['tr']['check_info']; ?></li>
                                <?php if (!empty($single['tr']['check_image'])): ?>
                                    <img src="<?php echo $this->webroot . 'check_images' . '/' . $single['tr']['check_image']; ?>"  width="50px" height="50px" />
                                <?php endif; ?>
                                <a  target="_blank" title="Edit"  href="<?php echo Router::url(array('controller' => 'transactions', 'action' => 'edit', $single['tr']['id'])) ?>" >
                                    <span class="fa fa-pencil" target ="_blank"></span>
                                </a>
                            <?php endif; ?> 

                            <li> Payment Date: <?php echo date('m-d-Y', strtotime($single['tr']['created'])); ?> </li>
                            <li> Payment of : #<?php echo $single['tr']['transaction_id']; ?> </li>
                        </ul>
                    </td>
                    <td>
                        <ul>
                            <b>  Name :</b>  <a href="<?php
                            echo Router::url(array('controller' => 'customers',
                                'action' => 'edit_registration', $single['pc']['id']))
                            ?>" 
                                                target="_blank">
                                                    <?php
                                                    echo $single['pc']['first_name'] . " " .
                                                    $single['pc']['middle_name'] . " " .
                                                    $single['pc']['last_name'];
                                                    ?>
                            </a><br>
                            <b>  Address :  </b> <?php echo $customer_address; ?> <br>
                            <?php if (!empty($single['pc']['cell'])): ?>
                                <b> Cell :</b> <a href="tel:<?php echo $single['pc']['cell'] ?>"><?php echo $single['pc']['cell']; ?></a><br>
                            <?php endif; ?>
                            <?php if (!empty($single['pc']['home'])): ?>
                                <b>  Home :</b>  <a href="tel:<?php echo $single['pc']['home'] ?>"><?php echo $single['pc']['home']; ?></a>
                            <?php endif; ?> 
                        </ul>
                    </td>
                    <td class="hidden-480">
                        <?Php if ($single['pc']['auto_r'] == 'yes') { ?>
                <li> <b>Auto Recurring :</b> <?php echo $single['pc']['auto_r']; ?> </li>                           
                <li> <b>Repeating interval :</b> <?php echo $single['pc']['r_duration']; ?> </li>                           
                <li> <b>Payment Date :</b> <?php echo $single['pc']['recurring_date']; ?> </li>                           
                <li> <b>Recurring From Date :</b> <?php echo $single['pc']['r_form']; ?> </li>                           
                <li> <b>Payable Amount :</b> <?php echo $single['pc']['payable_amount']; ?> </li>                           
                <li> <b>Card No :</b> <?php echo $single['pc']['card_check_no']; ?> </li>                           
                <li> <b>Expire Date :</b> <?php echo $single['pc']['exp_date']; ?> </li>                           
                <li> <b>Name :</b> <?php echo $single['pc']['cfirst_name'] . ' ' . $single['pc']['clast_name']; ?> </li>                           
                <li> <b>CVV Code :</b> <?php echo $single['pc']['cvv_code']; ?></li>                           
                <li> <b>Zip :</b> <?php echo $single['pc']['czip']; ?></li>  
            <?Php } else { ?>
                <li> <b>Auto Recurring :</b> <?php echo 'NO'; ?> </li> 
            <?Php }
            ?>
            </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>


