<!-- BEGIN PRE-FOOTER -->
<div class="pre-footer">
    <div class="container">
        <div class="row">
            <!-- BEGIN BOTTOM ABOUT BLOCK -->

            <div class="col-md-4 col-sm-6 pre-footer-col">

                <?php show_footer_component('about', $footer); ?>

            </div>
            <!-- END BOTTOM ABOUT BLOCK -->
            <div class="col-md-4 col-sm-6">

                <?php show_footer_component('social', $footer); ?>
                <!--                  <br/>
                                  <br/>
                                    <h2>Newsletter</h2>
                                    <form action="#">
                                        <div class="input-group">
                                            <input type="text" placeholder="youremail@mail.com" class="form-control">
                                            <span class="input-group-btn">
                                                <button class="btn btn-primary" type="submit">Subscribe</button>
                                            </span>
                                        </div>
                                    </form>-->
            </div>


            <!-- BEGIN BOTTOM CONTACTS -->
            <div class="col-md-3 col-sm-6 pre-footer-col">
                <?php show_footer_component('contact', $footer); ?>

            </div>
            <!-- END BOTTOM CONTACTS -->
        </div>
    </div>
</div>
<!-- END PRE-FOOTER -->


<!-- BEGIN FOOTER -->
<div class="footer">
    <div class="container">
        <div class="row">
            <!-- BEGIN COPYRIGHT -->
            <div class="col-md-5 col-sm-6 padding-top-10">
                <?php echo date('Y'); ?> © <?php show_footer_component('copyright', $footer); ?>
            </div>
            <!-- END COPYRIGHT -->
            <!-- BEGIN PAYMENTS -->
            <!-- <div class="col-md-5 col-sm-6">
                <ul class="list-unstyled list-inline pull-right">
                    <li><img src="../../assets/frontend/layout/img/payments/western-union.jpg" alt="We accept Western Union" title="We accept Western Union"></li>
                    <li><img src="../../assets/frontend/layout/img/payments/american-express.jpg" alt="We accept American Express" title="We accept American Express"></li>
                    <li><img src="../../assets/frontend/layout/img/payments/MasterCard.jpg" alt="We accept MasterCard" title="We accept MasterCard"></li>
                    <li><img src="../../assets/frontend/layout/img/payments/PayPal.jpg" alt="We accept PayPal" title="We accept PayPal"></li>
                    <li><img src="../../assets/frontend/layout/img/payments/visa.jpg" alt="We accept Visa" title="We accept Visa"></li>
                </ul>
            </div> -->
            <!-- END PAYMENTS -->
        </div>
    </div>
</div>
<!-- END FOOTER -->

<!-- BEGIN fast view of a product -->



<!--Start My js-->

<?php
echo $this->Html->script(
        array(
            'resellerProfile',
            'move',
            'orderManagement',
            'feedback',
            'ajaxLoad'
        )
);
?>

<!--End My js-->



<div id="orderForm" class="modal fade" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Fill up the following information and Hit <em>Order</em> button </h4>
                <?php echo get_emergency_help(); ?>
                <div id="info-container">

                </div>
            </div>
            <div class="modal-body">
                <div class="scroller" style="height:300px" data-always-visible="1" data-rail-visible1="1">
                    <div class="col-md-12">
                        <div class="portlet-body form">
                            <?php
                            echo $this->Form->create('Customer', array(
                                'inputDefaults' => array(
                                    'label' => false,
                                    'div' => false
                                ),
                                'id' => 'form_sample_3',
                                'class' => 'form-horizontal customerregForm donotSubmitbyjqyery',
                                'novalidate' => 'novalidate',
                                'type' => 'file'
                                    )
                            );
                            ?>

                            <?php echo $this->Form->input('id', array('id' => 'customer_id', 'value' => 0)); ?>

                            <div class="form-body">

                                <div class="form-group">
                                    <label class="control-label col-md-3">Email
                                    </label>
                                    <div class="col-md-9">
                                        <div class="input-icon right">
                                            <i class="fa"></i>
                                            <?php
                                            echo $this->Form->input(
                                                    'email', array(
                                                'class' => 'form-control required'
                                                    )
                                            );
                                            ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3">Name
                                    </label>
                                    <div class="col-md-9">
                                        <div class="input-icon right">
                                            <i class="fa"></i>

                                            <?php
                                            echo $this->Form->input(
                                                    'name', array(
                                                'class' => 'form-control required'
                                                    )
                                            );
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <?php echo $this->Form->input('product_id', array('type' => 'text', 'id' => 'ID')); ?>
                                <?php echo $this->Form->input('pieces', array('type' => 'text', 'id' => 'quantity')); ?>

                                <div class="form-group">
                                    <label class="control-label col-md-3">Mobile
                                    </label>
                                    <div class="col-md-9">
                                        <div class="input-icon right">
                                            <i class="fa"></i>
                                            <?php
                                            echo $this->Form->input(
                                                    'mobile', array(
                                                'class' => 'form-control required'
                                                    )
                                            );
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">Alternative Mobile
                                    </label>
                                    <div class="col-md-9">
                                        <div class="input-icon right">
                                            <i class="fa"></i>
                                            <?php
                                            echo $this->Form->input(
                                                    'alt_mobile', array(
                                                'class' => 'form-control'
                                                    )
                                            );
                                            ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3">City
                                    </label>
                                    <div class="col-md-9">
                                        <?php
                                        echo $this->Form->input('city_id', array(
                                            'type' => 'select',
                                            'options' => $cities,
                                            'empty' => 'Select City',
                                            'class' => 'form-control select2me required pclass',
                                                )
                                        );
                                        ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">Locations
                                    </label>
                                    <div class="col-md-9">
                                        <?php
                                        echo $this->Form->input('location_id', array(
                                            'type' => 'select',
                                            'options' => $locations,
                                            'id' => 'cid',
                                            'empty' => 'Select Location',
                                            'class' => 'form-control select2me required cclass',
                                                )
                                        );
                                        ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3">Detail Address
                                    </label>
                                    <div class="col-md-9">
                                        <div class="input-icon right">
                                            <i class="fa"></i>
                                            <?php
                                            echo $this->Form->input(
                                                    'detail_addr', array(
                                                'type' => 'textarea',
                                                'placeholder' => 'Type your shipping Address. For example: House Number: 51/3, Road Number: #03, Dhanmondi, Dhaka',
                                                'class' => 'form-control required'
                                                    )
                                            );
                                            ?>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn default">Close</button>
                <?php
                echo $this->Form->button(
                        'Order', array('class' => 'btn green', 'id' => 'customerRegBtn', 'type' => 'submit')
                );
                ?>
                <?php echo $this->Form->end(); ?>
            </div>
        </div>
    </div>
</div>


</body>
</html>