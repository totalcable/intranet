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
            Recieved Order List <small>Collect cash for this order.</small>
        </h3>

        <!-- END PAGE HEADER-->
        <!-- BEGIN PAGE CONTENT-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-heart"></i>Recieved Order
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
                                    <th> Order ID </th>
                                    <th>Product Info</th>
                                    <th>Name</th>
                                    <th>Mobile</th>
                                    <th>City</th>
                                    <th>Location</th>           
                                    <th>Detail Address</th>           
                                    <th>Received Time</th>
                                    <th>Confirmed by</th>
                                    <th>Action </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($alldata as $k => $single):
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
                                    #<?php echo $order['id'];?>
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
                                                        <?php echo $product['name'].' By '.$product['writer'];; ?>
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
                                                             Grant Total : <?php  $grantTotal = $grantTotal + $sc; echo $grantTotal; ?> </a>

                                            </div>  
                                        </td>
                                        <td><?php echo $customer['name']; ?></td>
                                        <td><?php echo $customer['mobile'] . '<br/>' . $customer['alt_mobile']; ?></td>
                                        <td><?php echo $single['city']['name']; ?></td>
                                        <td><?php echo $single['location']['name']; ?></td>
                                        <td><?php echo $customer['detail_addr']; ?></td>
                                        <td><?php echo $order['modified']; ?></td>
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
                                        <td>
                                            <a 
                                               onclick="if (confirm('Are you sure that you received cash for this order?')) {
                                                           return true;
                                                       }
                                                       return false;"

                                               href="<?php
                                               echo Router::url(array('controller' => 'orders', 'action' => 'sell', $order['id'].'#'.$grantTotal)
                                               );
                                               ?>" class="tip"><span class="fa fa-dollar" title="Sold & Cashed"></span></a>

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
