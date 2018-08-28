<!-- BEGIN CONTENT -->
<div class="col-md-11 col-sm-11">
    <div class="row list-view-sorting clearfix">
        <div class="col-md-2 col-sm-2 list-view">
            <a href="#"><i class="fa fa-th-large"></i></a>
            <a href="#"><i class="fa fa-th-list"></i></a>
        </div>
<!--        <div class="col-md-9 col-sm-9">
            <div class="pull-right">
                <label class="control-label">Show:</label>
                <select class="form-control input-sm">
                    <option value="#?limit=24" selected="selected">24</option>
                    <option value="#?limit=25">25</option>
                    <option value="#?limit=50">50</option>
                    <option value="#?limit=75">75</option>
                    <option value="#?limit=100">100</option>
                </select>
            </div>
            <div class="pull-right">
                <label class="control-label">Sort&nbsp;By:</label>
                <select class="form-control input-sm">
                    <option value="#?sort=p.sort_order&amp;order=ASC" selected="selected">Default</option>
                    <option value="#?sort=pd.name&amp;order=ASC">Name (A - Z)</option>
                    <option value="#?sort=pd.name&amp;order=DESC">Name (Z - A)</option>
                    <option value="#?sort=p.price&amp;order=ASC">Price (Low &gt; High)</option>
                    <option value="#?sort=p.price&amp;order=DESC">Price (High &gt; Low)</option>
                    <option value="#?sort=rating&amp;order=DESC">Rating (Highest)</option>
                    <option value="#?sort=rating&amp;order=ASC">Rating (Lowest)</option>
                    <option value="#?sort=p.model&amp;order=ASC">Model (A - Z)</option>
                    <option value="#?sort=p.model&amp;order=DESC">Model (Z - A)</option>
                </select>
            </div>gr
        </div>-->
    </div>

    <input type="text" class="hide" id="scharge" value='<?php echo $service_charge; ?>' />
    <input type="text" class="hide" id="z-scharge" value='<?php echo $zero_service_charge; ?>' />
    <!-- BEGIN PRODUCT LIST -->
    <?php

     echo $this->Session->flash(); 
     $reseller_key = null;

    if(count($this->params->params['pass'])){
           $reseller_key = $this->params->params['pass'][0]; 
        } 


        ?>
    <div class="row product-list">
        <?php
        foreach ($products as $count => $product):

        $details_link = Router::url(array('controller' => '/', 'action' => 'detail', $product['Product']['id'], $reseller_key));
            ?>
            <div class="col-md-3 col-sm-4 col-xs-12" style="margin-left: -10px;">
                <div class="product-item">
                    <div class="temp-img" id="temp-p-img<?php echo $product['Product']['id']; ?>"></div>
                    <div class="hide">
                        <img id="p-img<?php echo $product['Product']['id']; ?>" src="<?php echo $this->webroot . 'productImages/small/' . $product['Psetting']['thum_img'] ?>" alt="<?php echo $product['Product']['name'] . ' By ' . $product['Product']['writer']; ?>" >
                    </div>
                    <div class="pi-img-wrapper">
                        <img src="<?php echo $this->webroot . 'productImages/thum/' . $product['Psetting']['thum_img'] ?>"  class="img-responsive" alt="<?php echo $product['Product']['name'] . ' By ' . $product['Product']['writer']; ?>" >
                        <div>

                            <a href="#book-index<?php echo $product['Product']['id']; ?>" class="btn btn-default fancybox-fast-view">সূচীপত্র</a>
                            <a href="#product-pop-up<?php echo $product['Product']['id']; ?>" class="btn btn-default fancybox-fast-view">Details</a>
                        </div>
                    </div>

                    <h3><a target="_blank" href="<?php echo $details_link;?>" id ="p-info<?php echo $product['Product']['id']; ?>"><?php echo $product['Product']['name']; ?> -By <?php echo $product['Product']['writer']; ?> </a></h3>
                    <h3 style="color:green; font-weight:bolder;"> product code #<?php echo $product['Product']['id']; ?></h3>
                    <div class="pi-price">
                    <span class="pricex"><?php echo $product['Psetting']['sppp']; ?> TK</span>
                        <?php
                        $discount = $product['Psetting']['sppp'] * $product['Psetting']['discount'] / 100;
                        $total = $product['Psetting']['sppp'] - $discount;
                        echo ceil($total);
                        ?>
                        TK</div>
                    <div id="price-<?php echo $product['Product']['id']; ?>" class="hide"> <?php
                        $total = $product['Psetting']['sppp'] - $discount;
                        echo ceil($total);
                        ?></div>
                    <input type="text" class="hide" id="sppp<?php echo $product['Product']['id']; ?>" value="<?php echo $total; ?>" />
                    <input type="text" class="hide" id="sc" value="<?php echo $sc; ?>"/>
                    <div class="product-quantity">
                        <input  id='q<?php echo $product['Product']['id']; ?>' type="text" value="1" min="1"  name="product-quantity" class="form-control quantity-input input-sm">
                    </div>

                    <a href="#" class="btn green add2cart  add-to-busket" id="img<?php echo $product['Product']['id']; ?>" >Add To bag</a>
                </div>
            </div>

            <div id="book-index<?php echo $product['Product']['id']; ?>" style="display: none; width: 100%;">
                <div class="product-page product-pop-up">
                    <?php echo $product['Psetting']['index']; ?>
                </div>     
            </div>

            <div id="product-pop-up<?php echo $product['Product']['id']; ?>" style="display: none; width: 100%;">
                <div class="product-page product-pop-up">
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-xs-3">
                            <div class="product-main-image">
                                <img src="<?php echo $this->webroot . 'productImages/thum/' . $product['Psetting']['thum_img'] ?>" alt="<?php echo $product['Product']['name'] . ' By ' . $product['Product']['writer']; ?>">
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-9">
                            <h1><?php echo $product['Product']['name']; ?> -By <?php echo $product['Product']['writer']; ?></h1>
                            <div class="price-availability-block clearfix">
                                <div class="price">
                                    <strong><?php echo ceil($total + $sc); ?><span>TK</span>
                                    </strong>
                                </div>
                                <div class="availability">
                                    Price : <strong><?php echo $product['Psetting']['sppp']; ?>TK</strong>
                                    Discount : <strong><?php echo $product['Psetting']['discount']; ?>%</strong>
                                    Service Charge : <strong> <?php echo $sc; ?> TK </strong>
                                </div>
                            </div>
                            <div class="description">
                                <?php echo $product['Psetting']['desc']; ?>
                            </div>

                        </div>

                        <div class="sticker sticker-sale"></div>
                    </div>
                </div>
            </div>

        <?php endforeach; ?>
    </div><!-- End .row product-list-->
    <!-- END PRODUCT LIST -->

</div>


<!-- END CONTENT -->
</div>
<!-- END SIDEBAR & CONTENT -->
</div>


</div>

<div class="busket">
<div class="busket-head"> <span class="info hide-in-mobile">Service Charge : </span> <span class="sc hide-in-mobile">0 TK</span> 
<span class="pull-right"> <span class="info ">Total: </span> <span  class="price">0</span> TK</span>
</div>

<button data-toggle="modal" href="#orderForm" id="buybtn" class="btn btn-primary pull-right display-hide">BUY</button>
    
</div>



