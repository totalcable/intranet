<style type="text/css">
    .alert {
        padding: 6px;
        margin-bottom: 5px;
        border: 1px solid transparent;
        border-radius: 4px;
        text-align: center;
    }
    input.form-control.quantity {
        width: 80px;
        display: inline;
    }
    th,td{
        text-align: center;
    }
</style>
<div class="page-content-wrapper">
    <div class="page-content">
        <!-- BEGIN PAGE CONTENT-->
        <div class="row">
            <div class="col-md-12">
                <?php echo $this->Session->flash(); ?>
                <table class="table table-striped table-hover table-bordered" id="sample_editable_1">
                    <thead>
                        <tr>
                            <th>Product Info </th>
                            <th>Customer Info</th>
                            <th > Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $products = array();
                        if (count($datas) > 0) {
                            $order = $datas['orders'];
                            $customer = $datas['customers'];
                            $order_products = $datas['order_products'];
                            $product = $datas['products'];
                            $psettings = $datas['psettings'];
                            $products = $datas['products'];
                        }
                       //  pr($customer);
                        // exit;
                        foreach ($products as $index => $product):
                            ?>
                            <tr>
                                <?php
                                echo $this->Form->create('OrderProduct', array(
                                    'inputDefaults' => array(
                                        'label' => false,
                                        'div' => false,
                                        'id' => false
                                    ),
                                    'id' => 'form_sample_3',
                                    'class' => 'form-horizontal',
                                    'novalidate' => 'novalidate'
                                        )
                                );
                                ?>
                                <td>
                                    <img src="<?php echo $this->webroot . 'productImages/small/' . $psettings[$index]['small_img'] ?>" width="37" height="34">
                                    <span class="cart-content-count">x <?php
                                        echo $this->Form->input(
                                                'pieces', array(
                                            'class' => 'form-control quantity',
                                            'type' => 'number',
                                            'min' => 1,
                                            'value' => $order_products[$index]['pieces']
                                                )
                                        );
                                        ?>
                                    </span>

                                    <span>
                                        <?php echo $product['name'] . ' By ' . $product['writer']; ?>
                                    </span>
                                </td>
                                <?php
                                if ($index == 0):
                                    ?>
                                    <td>
                                     <?php
                                        echo $this->Form->input(
                                                'Customer.email', array(
                                            'class' => 'form-control required',
                                            'type' => 'text',
                                            'placeholder' => 'Type your Email',
                                            'value' => $customer['email']
                                                )
                                        );
                                        ?>
                                        <?php
                                        echo $this->Form->input(
                                                'Customer.name', array(
                                            'class' => 'form-control required',
                                            'type' => 'text',
                                            'placeholder' => 'Type your Name',
                                            'value' => $customer['name']
                                                )
                                        );
                                        ?>
                                        <?php
                                        echo $this->Form->input(
                                                'Customer.city', array(
                                            'class' => 'form-control required',
                                            'type' => 'text',
                                            'placeholder' => 'Type your City',
                                            'value' => $datas['city']['name']
                                                )
                                        );
                                        ?>
                                        <?php
                                        echo $this->Form->input(
                                                'Customer.location', array(
                                            'class' => 'form-control required',
                                            'type' => 'text',
                                            'placeholder' => 'Type your Location',
                                            'value' => $datas['location']['name']
                                                )
                                        );
                                        ?>
                                        <?php
                                        echo $this->Form->input(
                                                'Customer.detail_addr', array(
                                            'class' => 'form-control required',
                                            'type' => 'text',
                                            'placeholder' => 'Type your Detail Address',
                                            'value' => $customer['detail_addr']
                                                )
                                        );
                                        ?>

                                        <?php
                                        echo $this->Form->input(
                                                'Customer.mobile', array(
                                            'class' => 'form-control required',
                                            'type' => 'text',
                                            'placeholder' => 'Type your mobile number',
                                            'value' => $customer['mobile']
                                                )
                                        );
                                        ?>
                                        <?php
                                        echo $this->Form->input(
                                                'Customer.alt_mobile', array(
                                            'class' => 'form-control required',
                                            'type' => 'text',
                                            'placeholder' => 'Type Alternative Mobile Number',
                                            'value' => $customer['alt_mobile']
                                                )
                                        );
                                        ?>
                                    </td>

                                    <?php
                                else:
                                    ?>
                                    <td> <strong>Same as Above</strong>  </td>

                                <?php
                                endif;
                                ?>

                                <?php
                                echo $this->Form->input(
                                        'Customer.id', array(
                                    'type' => 'hidden',
                                    'value' => $customer['id']
                                        )
                                );
                                ?>
                                <?php
                                echo $this->Form->input(
                                        'OrderProduct.order_id', array(
                                    'type' => 'hidden',
                                    'value' => $datas['order_products'][$index]['order_id']
                                        )
                                );
                                ?>
                                <?php
                                echo $this->Form->input(
                                        'OrderProduct.id', array(
                                    'type' => 'hidden',
                                    'value' => $datas['order_products'][$index]['id']
                                        )
                                );
                                ?>
                                <td>  <div class="form-actions">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <?php
                                                echo $this->Form->input(
                                                        'Save Changes', array('class' => 'btn green', 'name' => 'changes', 'type' => 'submit')
                                                );
                                                ?>
                                            </div>
                                            <div class="col-md-6">
                                                <?php
                                                echo $this->Form->input(
                                                        'Delete', array('class' => 'btn btn-danger', 'name' => 'delete', 'type' => 'submit')
                                                );
                                                ?>
                                            </div>

                                        </div>
                                    </div>
                                    <?php echo $this->Form->end(); ?></td>
                            </tr>
                            
                           
                            
                            <?php
                        endforeach;
                        ?>
                         
                        
                    </tbody>
                </table>
               
                    <div class="portlet box green">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-plus"></i>Add More Product
                        </div>
                        <div class="tools">
                            <a href="javascript:;" class="reload">
                            </a>
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <!-- BEGIN FORM-->
                        <?php
                        echo $this->Form->create('OrderProduct', array(
                            'inputDefaults' => array(
                                'label' => false,
                                'div' => false,
                                'id' => false
                            ),
                            'class' => 'form-horizontal',
                            'novalidate' => 'novalidate',
                            'url' => array('controller' => 'orders', 'action' => 'addmore')
                                )
                        );
                        ?>
                        <div class="form-body">
                        
                        <?php    echo $this->Form->input('OrderProduct.order_id', array(
                                'type' => 'hidden',
                                'class' => 'form-control',
                                'value' => $order['id']
                                    )
                            );
                            ?>
                            <div class="form-group">
                                <label class="control-label col-md-3">Product Code <span class="required">
                                        * </span>
                                </label>
                                <div class="col-md-4">
                                    <?php
                                    echo $this->Form->input('OrderProduct.product_id', array(
                                        'type' => 'number',
                                        'class' => 'form-control',
                                        'placeholder' => 'Input product ID'
                                            )
                                    );
                                    ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3">Quantity
                                </label>
                                <div class="col-md-4">
                                    <?php
                           
                                    echo $this->Form->input('OrderProduct.pieces', array(
                                        'type' => 'number',
                                        'class' => 'form-control',
                                        'min' => 1,
                                        'placeholder' => 'Input Quantity'
                                            )
                                    );
                                    ?>
                                </div>
                            </div>

                        </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-7 col-md-4">
                                    <?php
                                    echo $this->Form->button(
                                            'Add', array('class' => 'btn green', 'type' => 'submit')
                                    );
                                    ?>
                                </div>
                            </div>
                        </div>
                        <?php echo $this->Form->end(); ?>
                        <!-- END FORM-->
                    </div>
                    <!-- END VALIDATION STATES-->
                </div>
                
            </div>
        </div>
        <!-- END PAGE CONTENT -->
    </div>
</div>
<!-- END CONTENT -->