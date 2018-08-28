<div id="header" class="container_12">
    <a href="<?php echo Router::url(array('controller' => 'admins', 'action' => 'dashboard')) ?>"> Back to Dashboard</a>
</div>
<div id="content" class="container_12 clearfix">
    <div id="content-main" class="grid_10 "> 
        <?php
        foreach ($alldata as $single):
            
            $grantTotal = 0;
            $total_pieces = 0;
            $order = $single['orders'];
            $customer = $single['customers'];
            $order_products = $single['order_products'];
            $products = $single['products'];
            $psettings = $single['psettings'];

            foreach ($products as $key => $product):
                $discount = $psettings[$key]['sppp'] * $psettings[$key]['discount'] / 100;
                $total = ceil($psettings[$key]['sppp'] - $discount);
                $total *=$order_products[$key]['pieces'];
                //$total +=$psettings[$key]['service_charge'];
                $grantTotal +=$total ;
                
            endforeach;
            ?>
         <div class="customerAddr">
            <span> <strong style="font-size: 25px;"> To :</strong> </span>
            <div  style="margin-left:40px;">
                <span class="siteName"> <strong> Name :</strong> <?php echo $customer['name']; ?></span><br/>
                <span class="detail_addr"><strong>Address: </strong> <?php echo $single['location']['name'].', '.$single['city']['name']; ?> <br/>
                    <i><?php echo $customer['detail_addr']; ?></i>
                </span><br/>
                <span class="mobile">
                   <strong > Mobile : </strong><?php echo $customer['mobile'] ?></br>
                    <?php echo $customer['alt_mobile']; ?>
                </span> 

                </br>
                <span> <strong> ORDER ID: #<?php echo $order['id']; ?> </strong> </span> </br>
                
                <?php 
                     if($order['cashed']){
                        echo '<span class="paid"> Paid </span> ';
                     }
                     else{
                     $grantTotal = $grantTotal+ $sc;
                        echo '<span class="payAmount"> CONDITION : '.$grantTotal.' TK</span>';
                     }
                ?>                

            </div>
        </div>
        <hr>

        <?php endforeach; ?>

    </div>

    <div id="aside" class="grid_2 push_1">
    </div>
</div>