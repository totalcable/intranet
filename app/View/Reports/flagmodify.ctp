<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.js"></script>
<script>
    $(document).ready(function () {
        $('.nav-toggle').click(function () {
            //get collapse content selector
            var collapse_content_selector = $(this).attr('href');

            //make the collapse content to be shown or hide
            var toggle_switch = $(this);
            $(collapse_content_selector).toggle(function () {
                if ($(this).css('display') == 'none') {
                    //change the button label to be 'Show'
                    toggle_switch.html('Show');
                } else {
                    //change the button label to be 'Hide'
                    toggle_switch.html('Hide');
                }
            });
        });

    });
</script>


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
        <h3 class="page-title">
            Modify invoice flag <small></small>
        </h3>
        <!-- END PAGE HEADER-->
        <!-- BEGIN PAGE CONTENT-->
        <div class="row">
            <div class="col-xs-12">
                <div class="alert alert-info clearfix" style="color: #000; font-size: 14px;"> 
                    <p> Total Subscriber<b>: <?php echo $totalCustomer; ?></b> &nbsp; &nbsp;&nbsp;&nbsp;
                        Total Paid Amount<b>: $<?php echo $totalPayment; ?> </b> </p>
                </div>
                 <?php echo $this->Session->flash(); ?>
                <table class="table table-striped table-hover table-bordered" id="sample_editable_1">
                    <thead>
                        <tr>
                            <th>
                                ID
                            </th>
                            <th>
                                Customer Detail
                            </th>
                            <th>
                                Auto recurring informations
                            </th>
                            <th>
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($data as $results):
                            $customer = $results['pc'];
                            $customer_address = $customer['house_no'] . ' ' . $customer['street'] . ' ' .
                                    $customer['apartment'] . ' ' . $customer['city'] . ' ' . $customer['state'] . ' '
                                    . $customer['zip'];
                            $paymenttime = strtotime($results['pc']['r_form']);
                            $today = date('Y-m-d');
                            $currenttime = strtotime($today);
                            ?>
                            <tr>
                                <td><?php echo $customer['id']; ?> </td>
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

                                <td class="hidden-480">
                                    <button href=".collapse1<?php echo $customer['id']; ?>" class="nav-toggle">Show</button>
                                    <div class="collapse1<?php echo $customer['id']; ?>" style="display:none">
                                        <!--<li><b>Card No :</b>  <b><?php // echo $results['pc']['card_check_no']; ?> </b></li>--> 
                                        <li> <b>Auto Recurring :</b> <?php echo $results['pc']['auto_r']; ?> </li>                           
                                        <li> <b>Repeating interval :</b> <?php echo $results['pc']['r_duration']; ?> </li>                           
                                        <li> <b>Payment Date :</b> <?php echo $results['pc']['recurring_date']; ?> </li>                           
                                        <li> <b>Recurring From Date :</b><?php echo $results['pc']['r_form']; ?></li>                           
                                        <li> <b>Payable Amount :</b> <?php echo $results['pc']['payable_amount']; ?> </li>  
                                        <li> <b>Expire Date :</b> <?php echo $results['pc']['exp_date']; ?> </li>
                                        <li> <b>CVV Code :</b> <?php echo $results['pc']['cvv_code']; ?></li>                           
                                        <li> <b>Zip :</b> <?php echo $results['pc']['czip']; ?></li>
                                    </div>
                                </td>
                                
                                <td>                         
                            <a onclick="if (confirm( &quot; Are you sure to modify data this Admin? &quot; )) { return true; } return false;"
                           href="<?php echo Router::url(array('controller' => 'reports', 'action' => 'invoicecreated_modify', $results['pc']['id'])) ?>" title="Modify data">
                            <span class="fa  fa-check"></span>
                        </a>                           
                        </td>
                                
                            </tr>
                        <?php endforeach; ?>  
                    </tbody>
                </table>
            </div>
        </div>        
    </div>
</div>
<!-- END CONTENT -->
