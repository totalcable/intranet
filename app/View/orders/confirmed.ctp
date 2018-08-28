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
            Confirmed Order List <small>Deliver the following order as early as possible</small>
        </h3>

        <!-- END PAGE HEADER-->
        <!-- BEGIN PAGE CONTENT-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-check"></i>Confirmed Order
                        </div>

                        <div class="tools">
                            <a href="javascript:;" class="reload">
                            </a>
                        </div>
                    </div>
                    <div class="portlet-body">

                        <?php echo $this->Session->flash(); ?>

                        <table class="table table-striped table-hover table-bordered" id="sample_editable_1">
                            <thead>
                                <tr>
                                    <th>Order ID </th>
                                    <th>Product Info</th>
                                    <th>Name</th>
                                    <th>Mobile</th>
                                    <th>City</th>
                                    <th>Location</th>           
                                    <th>Detail Address</th>           
                                    <th>Delivery Time</th>           
                                    <th>Time Remaining</th>
                                    <th>Comment</th> 
                                    <th>Contacted By</th>
                                    <th> Order From</th>
                                    <th>Action </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($alldata as $k => $single):
                                 $reseller = $single['resellers'];
                                    if(!empty($reseller['api_key']) || $reseller['api_key'] !=null){
                                      $refImg = $this->webroot.'reseller/'.$reseller['img'];
                                      $refInfo = $reseller['name'].' '.$reseller['email'];
                                    }
                                    else{
                                      $refImg = $this->webroot.'img/logo.png';
                                      $refInfo = 'Order from main site';
                                    }
                                    $grantTotal = 0;
                                    $total_pieces = 0;
                                    $order = $single['orders'];
                                    $customer = $single['customers'];
                                    $order_products = $single['order_products'];
                                    $products = $single['products'];
                                    $psettings = $single['psettings'];
                                    ?>

                                    <tr>

                                        <td>
                                            #<?php echo $order['id']; ?>
                                        </td>
                                        <td>
                                            <div style="text-align: center;">
                                                <button  class="product_toggle" id="p<?php echo$k + 1; ?>"><span class="fa fa-eye"></span></button>
                                            </div>
                                            <div class="top-cart-content-wrapper display-hide" id="info-p<?php echo$k + 1; ?>">

                                                 <?php foreach ($products as $key => $product): 

                                                 
                                                 ?>
                                                     

                                                 <li>
                                                    <a href="javascript:void(0)">
                                                        <img src="<?php echo $this->webroot . 'productImages/small/' . $psettings[$key]['small_img'] ?>" width="37" height="34"></a>
                                                        <span class="cart-content-count">x <?php
                                                                $total_pieces+=$order_products[$key]['pieces'];
                                                                echo $order_products[$key]['pieces'];
                                                                ?></span>
                                                        <span>
                                                        <?php echo $product['name'].' By '.$product['writer']; ?>
                                                        </span>
                                                        
                                                        <em style="color:red;"><?php
                                                                $discount = $psettings[$key]['sppp'] * $psettings[$key]['discount'] / 100;
                                                                $total =ceil($psettings[$key]['sppp'] - $discount);
                                                                $total *=$order_products[$key]['pieces'];
                                                                //$total +=$psettings[$key]['service_charge'];
                                                                $grantTotal +=$total;
                                                                echo $total;
                                                                ?> TK</em>
                                                    </li>
                           
                                                   
                                                    
                                                <?php endforeach; ?>
                                             
                                                            <div class="alert alert-info">
                                <strong>    Service Charge : <?php echo $sc; ?></strong> 
                            </div>

                                                <a href="#" class="btn purple pull-right" style="width:152px;">
                                                             Grant Total : <?php $totalWithSc = $grantTotal + $sc; echo $grantTotal + $sc; ?> </a>

                                            </div>  
                                        </td>
                                        <td><?php echo $customer['name']; ?></td>
                                        <td><?php echo $customer['mobile'] . '<br/>' . $customer['alt_mobile']; ?></td>
                                        <td><?php echo $single['city']['name']; ?></td>
                                        <td><?php echo $single['location']['name']; ?></td>
                                        <td><?php echo $customer['detail_addr']; ?></td>
                                        <td><?php echo $order['delivary_time']; ?></td>
                                        <td>
                                            <?php echo remainingTime($order['delivary_time']); ?>
                                        </td>
                                        <td><?php echo $order['comment']; ?></td>
                           
                                        <td>
                                            <div style="text-align:center;">
                                                <button class="action_toggle" id="action<?php echo$k + 1; ?>"><span class="fa fa-eye"></span></button> 
                                            </div> 
                                            <div class="content display-hide" id="info-action<?php echo$k + 1; ?>" >
                                                <?php foreach ($single['action'] as $key => $action): ?>

                                                    <div class="alert alert-info">
                                                        <?php
                                                        echo $action['Admin']['name'] . ' (' . $action['Admin']['mobile'] . ')';
                                                        ?>
                                                        <br/>
                                                        <strong><?php echo $action['ActionBy']['created']; ?></strong> 
                                                    </div>

                                                <?php endforeach; ?>
                                            </div>
                                        </td>
                                          <td><img height="50" width="50" style="border-radius:50px !important;" src="<?php echo $refImg; ?>" alt="<?php echo $refInfo;?>"  title="<?php echo $refInfo; ?>" /> </td>
                                        <td>
                                            <a 
                                                onclick="if (confirm('Are you sure to cancel this order?')) {
                                                                return true;
                                                            }
                                                            return false;"

                                                href="<?php
                                                echo Router::url(array('controller' => 'orders', 'action' => 'cancel', $order['id'])
                                                )
                                                ?>" class="tip"><span class="fa fa-ban" title="cancel"></span></a>

                                            &nbsp;
                                            <a 
                                                onclick="if (confirm('Are you sure that it is delivered?')) {
                                                                return true;
                                                            }
                                                            return false;"

                                                href="<?php
                                                echo Router::url(array('controller' => 'orders', 'action' => 'deliver', $order['id'])
                                                )
                                                ?>" class="tip"><span class="fa fa-plane" title="delivered"></span></a>
                                               &nbsp;
                                                <a  target="_blank" title="edit" href="<?php echo Router::url(array('controller' => 'orders', 'action' => 'edit', $order['id'])) ?>" >
                                                    <span class="fa fa-pencil"></span></a>
                                               &nbsp; 
                                             <?php if(!$order['cashed']){?>
                                             
                                              <a 
                                               onclick="if (confirm('Are you sure that you received cash for this order?')) {
                                                           return true;
                                                       }
                                                       return false;"

                                               href="<?php
                                               echo Router::url(array('controller' => 'orders', 'action' => 'pay', $order['id'].'#'.$totalWithSc)
                                               );
                                               ?>" class="tip"><span class="fa fa-dollar" title="Cashed"></span></a>
                                             
                                             <?php } 
                                               else{ ?>
                                                  
                                                 <a 
                                               onclick="if (confirm('Are you sure to undo payment for this order?')) {
                                                           return true;
                                                       }
                                                       return false;"

                                               href="<?php
                                               echo Router::url(array('controller' => 'orders', 'action' => 'unpay', $order['id'])
                                               );
                                               ?>" class="tip"><span class="fa fa-refresh" title="undo payment"></span></a>
                                               
                                               
                                               <?php
                                               }
                                             ?>   

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


