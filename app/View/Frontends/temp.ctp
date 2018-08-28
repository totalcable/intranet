<div id="content" class="clearfix" style="margin-left: 0px; padding-top: 5px;">
    <div class="contentwrapper"><!--Content wrapper-->
         <!--Build page from here: Usual with <div class="row-fluid"></div> --> 
         
        <div class="row-fluid"> 
            <div class="span12">
                <input type="text" class="hide" id="scharge" value='<?php echo $service_charge; ?>' />
                <input type="text" class="hide" id="z-scharge" value='<?php echo $zero_service_charge; ?>' />
                <?php echo $this->Session->flash(); ?>
                <div style="margin-bottom: 5px;">                          
                    <?php
                    foreach ($products as $count => $product):
                        $count++;
                        if (($count % 2) != 0):
                            ?>
                            <div class="row-fluid"> 
                                <div class="span12">
                                    <?php
                                endif;
                                ?>
                                <div class="span6">
                                    <div class="box">

                                        <div class="content" style="display: block;">
                                            <div class="row-fluid">
                                                <div class="span6 product-img">
                                                    <div class="temp-img" id="temp-p-img<?php echo $product['Product']['id']; ?>"></div>
                                                    <a href="#myModal"  data-toggle="modal"> <img src="<?php echo $this->webroot . 'productImages/thum/' . $product['Psetting']['thum_img'] ?>" alt="<?php echo $product['Product']['name'] . ' By ' . $product['Product']['writer']; ?>" class="img-polaroid marginR5" ></a><br/>

                                                    <div class="hide">
                                                        <img id="p-img<?php echo $product['Product']['id']; ?>" src="<?php echo $this->webroot . 'productImages/small/' . $product['Psetting']['thum_img'] ?>" alt="<?php echo $product['Product']['name'] . ' By ' . $product['Product']['writer']; ?>" >
                                                    </div>
                                                </div>
                                                <div class="span6">  
                                                    <div class="alert alert-success book-info-wrapper">
                                                        <div class="book-info" id="product-info<?php echo $product['Product']['id']; ?>">
                                                            <span class="book-name"><?php echo $product['Product']['name']; ?> </span> <br/>
                                                            -By <span class="writer-name"><?php echo $product['Product']['writer']; ?> </span>
                                                        </div>
                                                        <p><span class="label title">Price</span><span class="label label-inverse"><?php echo $product['Psetting']['sppp']; ?>TK</span><p/>
                                                        <p><span class="label title">Discount</span> <span class="label label-inverse"><?php echo $product['Psetting']['discount']; ?>%</span><p/>
                                                        <p> <span class="label title">Service Charge</span> <span class="label label-inverse"><?php echo $product['Psetting']['service_charge']; ?> TK</span><p/>
                                                        <p><span class="label title">Total</span><span class="label label-inverse"><?php
                                                                $discount = $product['Psetting']['sppp'] * $product['Psetting']['discount'] / 100;
                                                                $total = $product['Psetting']['sppp'] - $discount + $product['Psetting']['service_charge'];
                                                                echo ceil($total);
                                                                ?> TK</span>
                                                        </p>
                                                        <input type="text" class="hide" id="sppp<?php echo $product['Product']['id']; ?>" value="<?php echo $total-$product['Psetting']['service_charge']; ?>" />
                                                        <input type="text" class="hide" id="sc" value="<?php echo $product['Psetting']['service_charge']; ?>"/>
                                                        <p><span class="label label-important">How many ?</span> <span> <input class="spinner1" id='q<?php echo $product['Product']['id']; ?>' name="value" value="1" min="1"/></span>
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="row-fluid"> 
                                                    <div class="span5">
                                                        <button class="viewbtn btn btn-info" href="#detailModal<?php echo $product['Product']['id']; ?>" data-toggle="modal"><span class=" icon16 icomoon-icon-eye-3"></span>Vew Details</button>
                                                    </div>
                                                    <div class="span2">
                                                        <span class="label label-success hide" id="added<?php echo $product['Product']['id']; ?>"><span class="icomoon-icon-checkmark-2"></span></span>
                                                    </div>
                                                    <div class="span5">

                                                        <button class="btn btn-primary add-to-busket" id="img<?php echo $product['Product']['id']; ?>"><span class="icon16  icomoon-icon-basket white"></span>Add to Bag</button> 
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- End .box -->
                                    </div> <!-- End .box -->
                                </div><!-- End .span4 -->

                <div id="detailModal<?php echo $product['Product']['id']; ?>" class="modal hide fade" style="display: none; ">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span class="icon12 minia-icon-close"></span></button>
                        
                    </div>
                    <div class="modal-body">
                    <?php echo $product['Psetting']['desc'];?>
                    </div>
                      <div class="modal-footer">
                        <a href="#" class="btn btn-danger" data-dismiss="modal">Close</a>
                    </div>
                    </div>


                                <?php if (($count % 2) == 0):
                                    ?>
                                </div><!-- End .span12-->
                            </div> <!-- End .row-fluid-->
                            <?php
                        endif;
                        ?>

                    <?php endforeach; ?>
                </div>


                <div id="OrderModal" class="modal hide fade" style="display: none; ">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span class="icon12 minia-icon-close"></span></button>
                        <h3>Order Form</h3>
                    </div>
                    <div class="modal-body">
                        <div class="paddingT15 paddingB15">    
                            <div class="row-fluid">

                                <div class="span12">

                                    <div class="box">

                                        <div class="title">

                                            <h4>
                                                <span>Fill up the following information and Hit Order button</span>
                                            </h4>



                                        </div>
                                        <div class="content">
                                            <?php
                                            echo $this->Form->create('Order', array(
                                                'inputDefaults' => array(
                                                    'label' => false,
                                                    'div' => false
                                                ),
                                                'id' => 'form-validate',
                                                'class' => 'form-horizontal',
                                                'novalidate' => 'novalidate'
                                                    )
                                            );
                                            ?>


                                            <?php echo $this->Form->input('product_id', array('type' => 'text', 'id' => 'ID')); ?>
                                            <?php echo $this->Form->input('pieces', array('type' => 'text', 'id' => 'quantity')); ?>
                                            <div class="form-row row-fluid">
                                                <div class="span12">
                                                    <div class="row-fluid">
                                                        <label class="form-label span3" for="required">Name</label>

                                                        <?php
                                                        echo $this->Form->input(
                                                                'name', array(
                                                            'class' => 'span9 text required'
                                                                )
                                                        );
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-row row-fluid">
                                                <div class="span12">
                                                    <div class="row-fluid">
                                                        <label class="form-label span3" for="required">Email</label>
                                                        <?php
                                                        echo $this->Form->input(
                                                                'email', array(
                                                            'class' => 'span9 text required'
                                                                )
                                                        );
                                                        ?>
                                                    </div>
                                                </div>
                                            </div> 
                                            <div class="form-row row-fluid">
                                                <div class="span12">
                                                    <div class="row-fluid">
                                                        <label class="form-label span3" for="mobile">Mobile</label>
                                                        <?php
                                                        echo $this->Form->input(
                                                                'mobile', array(
                                                            'class' => 'span9 text required',
                                                                )
                                                        );
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-row row-fluid">
                                                <div class="span12">
                                                    <div class="row-fluid">
                                                        <label class="form-label span3" for="alt_mobile">Alternative Mobile</label>
                                                        <?php
                                                        echo $this->Form->input(
                                                                'alt_mobile', array(
                                                            'class' => 'span9',
                                                            'type' => 'text'
                                                                )
                                                        );
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-row row-fluid">
                                                <div class="span12">
                                                    <div class="row-fluid">
                                                        <label class="form-label span3" for="checkboxes">City</label>
                                                        <div class="span9 controls sel">
                                                            <?php
                                                            echo $this->Form->input('city_id', array(
                                                                'type' => 'select',
                                                                'options' => $cities,
                                                                'empty' => '',
                                                                'class' => 'span12 uniform nostyle select1 pclass required',
                                                                'div' => array('class' => 'span12 required')
                                                                    )
                                                            );
                                                            ?>
                                                        </div> 
                                                    </div>
                                                </div> 
                                            </div>  

                                            <div class="form-row row-fluid">
                                                <div class="span12">
                                                    <div class="row-fluid">
                                                        <label class="form-label span3" for="checkboxes">Location</label>
                                                        <div class="span9 controls sel">
                                                            <?php
                                                            echo $this->Form->input('location_id', array(
                                                                'type' => 'select',
                                                                'options' => $locations,
                                                                'empty' => '',
                                                                'class' => 'span12 uniform nostyle  cclass select1 required',
                                                                'id' => 'cid',
                                                                'style' => 'width:100%;',
                                                                'div' => array('class' => 'span12 required')
                                                                    )
                                                            );
                                                            ?>
                                                        </div> 
                                                    </div>
                                                </div> 
                                            </div>
                                        </div>

                                    </div><!-- End .box -->

                                </div><!-- End .span12 -->

                            </div><!-- End .row-fluid -->  
                        </div>

                    </div>
                    <div class="modal-footer">
                        <a href="#" class="btn" data-dismiss="modal">Close</a>

                        <?php
                        echo $this->Form->button(
                                'Order', array('class' => 'btn btn-primary', 'type' => 'submit')
                        );
                        ?>
                        <?php echo $this->Form->end(); ?>
                    </div>
                </div>

                <div id="added_items_container">

                    <div class="busket "> 

                        <p id="msg"></p>
                        <p id="showPrice"></p>
                        <button id="buybtn" class="btn btn-success hide" href="#OrderModal" data-toggle="modal"  name='id' 
                                class="tip"><span class="icon16  icomoon-icon-checkmark-2"></span>Buy</button>  

                    </div>
                </div>

            </div><!-- End contentwrapper -->
        </div><!-- End #content -->