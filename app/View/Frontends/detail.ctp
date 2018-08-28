<style type="text/css">

    .price-availability-block .pi-price {
        float: left;
        font-family: 'PT Sans Narrow', sans-serif;
    }
    .price-availability-block .pi-price strong {
        color: #e84d1c;
        font-size: 35px;
        font-weight: normal;
    }

    .price-availability-block .pi-price em {
        font-style: normal;
        color: #bbb;
        font-size: 17px;
    }
    .price-availability-block .pi-price em span {
        font-size: 23px;
        text-decoration: line-through;
    }
</style>

<!-- BEGIN CONTENT -->
<div class="col-md-9 col-sm-7">
    <div class="product-page">
        <?php echo $this->Session->flash(); ?>
        <div class="row">
            <div class="col-md-6 col-sm-6">
                <div class="temp-img" id="temp-p-img<?php echo $product['Product']['id']; ?>"></div>
                <div class="hide">
                    <img id="p-img<?php echo $product['Product']['id']; ?>" src="<?php echo $this->webroot . 'productImages/small/' . $product['Psetting']['thum_img'] ?>" alt="<?php echo $product['Product']['name'] . ' By ' . $product['Product']['writer']; ?>" >
                </div>
                <div class="product-main-image">
                    <img  src="<?php echo $this->webroot . 'productImages/thum/' . $product['Psetting']['thum_img'] ?>" alt="<?php echo $product['Product']['name'] . ' By ' . $product['Product']['writer']; ?>" data-BigImgsrc="<?php echo $this->webroot . 'productImages/thum/' . $product['Psetting']['thum_img'] ?>">
                </div> 

            </div>
            <div class="col-md-6 col-sm-6">
                <h1><?php echo $product['Product']['name'] . ' By ' . $product['Product']['writer'] ?></h1>
                <div class="price-availability-block clearfix">
                    <div class="pi-price">
                        <strong> <?php
                            $sellingPrice = $product['Psetting']['sppp'] - $product['Psetting']['sppp'] * $product['Psetting']['discount'] / 100;
                            echo ceil($sellingPrice);
                            ?> <span>TK</span></strong>
                        <em><span><?php echo $product['Psetting']['sppp']; ?></span>TK</em>
                    </div>

                    <div class="availability">
                        Availability: <strong>In Stock</strong>
                    </div>
                </div>
                <!-- <div class="description">
                
                </div>
                <div class="product-page-options">
                    
                            <a href="#book-index" class="btn purple  fancybox-fast-view pull-right">সূচীপত্র</a>
                </div> -->


                <div id="book-index" style="display: none; width: 80%;">
                    <div class="product-page product-pop-up">
                        <?php echo $product['Psetting']['index']; ?>
                    </div>     
                </div>
                <div class="product-page-cart">

                    <div class="product-quantity">
                        <input  id='q<?php echo $product['Product']['id']; ?>' type="text" value="1" min="1"  name="product-quantity" class="form-control quantity-input input-sm">
                    </div>

                    <div id="price-<?php echo $product['Product']['id']; ?>" class="hide"> <?php
                        $discount = $product['Psetting']['sppp'] * $product['Psetting']['discount'] / 100;
                        $total = $product['Psetting']['sppp'] - $discount;
                        echo ceil($total);
                        ?>
                    </div>
                    <input type="text" class="hide" id="sppp<?php echo $product['Product']['id']; ?>" value="<?php echo $total; ?>" />
                    <input type="text" class="hide" id="sc" value="<?php echo $sc; ?>"/>



                    <a href="#" class="btn btn-primary add2cart  add-to-busket" id="img<?php echo $product['Product']['id']; ?>" >Add To bag</a>
                </div>
                <div class="review">
                    <div class="rateit" data-rateit-value="<?php echo get_average_review($reviews); ?>" data-rateit-ispreset="true" data-rateit-readonly="true"></div>
                    <a href="#Reviews"><?php echo count($reviews); ?> reviews</a>
                </div>

                <?php show_footer_component('social', $footer); ?>

            </div>

            <div class="product-page-content">
                <ul id="myTab" class="nav nav-tabs">
                    <li><a href="#Description" data-toggle="tab">Description</a></li>
                    <li><a href="#Index" data-toggle="tab">Index</a></li>
                    <li class="active"><a href="#Reviews" data-toggle="tab">Reviews (<?php echo count($reviews); ?>)</a></li>
                </ul>
                <div id="myTabContent" class="tab-content">
                    <div class="tab-pane fade" id="Description">
                        <?php echo $product['Psetting']['desc']; ?>
                    </div>
                    <div class="tab-pane fade" id="Index">
                        <?php echo $product['Psetting']['index']; ?>
                    </div>
                    <div class="tab-pane fade in active" id="Reviews">
                        <?php if (count($reviews) == 0) { ?>
                            <p>There are no reviews for this product.</p>
                            <?php
                        } else {
                            foreach ($reviews as $review):
                                $timestamp = strtotime($review['Review']['created']);
                                $Date = date("d F Y h:i:s A", $timestamp);
                                ?>
                                <div class="review-item clearfix">
                                    <div class="review-item-submitted">
                                        <strong><?php echo $review['Review']['name']; ?></strong>
                                        <em><?php echo $Date; ?></em>
                          <div class="rateit" data-rateit-value="<?php echo $review['Review']['rating'];?>" data-rateit-ispreset="true" data-rateit-readonly="true"></div>
                                    </div>                                              
                                    <div class="review-item-content">
                                        <p><?php echo $review['Review']['content']; ?></p>
                                    </div>
                                </div>
                            <?php endforeach;
                            ?>
                        <?php }
                        ?>

                        <!-- BEGIN FORM-->
                        <?php
                        echo $this->Form->create('Review', array(
                            'inputDefaults' => array(
                                'label' => false,
                                'div' => false
                            ),
                            'id' => 'form_sample_3',
                            'class' => 'form-horizontal',
                            'novalidate' => 'novalidate',
                            'url' => array('controller' => 'reviews', 'action' => 'add',$product['Product']['id'])
                                )
                        );
                        ?>

                        <h2>Write a review</h2>
                        <div class="alert alert-danger display-hide">
                            <button class="close" data-close="alert"></button>
                            You have some form errors. Please check below.
                        </div>

                        <?php
                        echo $this->Form->input('id', array('id' => 'reviewId', 'type' => 'hidden', 'value' => 0));
                        ?>
                        <div class="form-group">
                            <label for="name">Email <span class="require">*</span></label>
                            <?php
                            echo $this->Form->input(
                                    'email', array(
                                'class' => 'form-control required reviewEmail',
                                'placeholder' => 'Type your Email here..'
                                    )
                            );
                            ?>
                        </div>
                        <div class="form-group">
                            <label for="email">Name</label>
                            <?php
                            echo $this->Form->input(
                                    'name', array(
                                'class' => 'form-control required',
                                'placeholder' => 'Type your Name here..'
                                    )
                            );
                            ?>
                        </div>
                        <div class="form-group">
                            <label for="content">Review (Optional)</label>
                            <?php
                            echo $this->Form->input(
                                    'content', array(
                                'class' => 'form-control  ',
                                'type' => 'textarea',
                                'rows' => 8,
                                'placeholder' => 'Type your valuable review here..'
                                    )
                            );
                            ?>
                        </div>
                        <div class="form-group">
                            <label for="rating">Rating</label>
                            <?php
                            echo $this->Form->input(
                                    'rating', array(
                                'class' => 'form-control required ',
                                'type' => 'range',
                                'value' => 5,
                                'step' => 0.25,
                                'id' => 'backing5'
                                    )
                            );
                            ?>
                            <div class="rateit" data-rateit-backingfld="#backing5" data-rateit-resetable="false"  data-rateit-ispreset="true" data-rateit-min="0" data-rateit-max="5">
                            </div>
                        </div>
                        <div class="padding-top-20">                  
                            <?php
                            echo $this->Form->button(
                                    'SEND', array('class' => 'btn btn-primary', 'type' => 'submit')
                            );
                            ?>
                        </div>
                        <?php echo $this->Form->end(); ?>
                        <!-- END FORM--> 


                    </div>
                </div>
            </div>

            <div class="sticker sticker-sale"></div>
        </div>
    </div>
</div>
<!-- END CONTENT -->

<!-- BEGIN SIMILAR PRODUCTS -->
<div class="row margin-bottom-40">
    <div class="col-md-10 col-sm-10">
        <h2>Similar Books</h2>
        <div class="row product-list">
            <?php
            $reseller_key = null;

            if (count($this->params->params['pass']) > 1) {
                $reseller_key = $this->params->params['pass'][1];
            }
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

                        <h3><a href="<?php echo $details_link; ?>" id ="p-info<?php echo $product['Product']['id']; ?>"><?php echo $product['Product']['name']; ?> -By <?php echo $product['Product']['writer']; ?> </a></h3>
                        <h3 style="color:green; font-weight:bolder;"> product code #<?php echo $product['Product']['id']; ?></h3>
                        <div class="pi-price">
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

                        <a href="#" class="btn btn-default add2cart  add-to-busket" id="img<?php echo $product['Product']['id']; ?>" >Add To bag</a>
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
    </div>
</div>
<!-- END SIMILAR PRODUCTS -->

<div class="busket">
    <div class="busket-head"> <span class="info hide-in-mobile">Service Charge : </span> <span class="sc hide-in-mobile">0 TK</span> 
        <span class="pull-right"> <span class="info ">Total: </span> <span  class="price">0</span> TK</span>
    </div>

    <button data-toggle="modal" href="#orderForm" id="buybtn" class="btn btn-primary pull-right display-hide"> BUY </button>

</div>