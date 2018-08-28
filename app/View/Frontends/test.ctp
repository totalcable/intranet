<!-- BEGIN CONTENT -->
<div class="col-md-9 col-sm-7">
    <div class="row list-view-sorting clearfix">
        <div class="col-md-2 col-sm-2 list-view">
            <a href="#"><i class="fa fa-th-large"></i></a>
            <a href="#"><i class="fa fa-th-list"></i></a>
        </div>
        <div class="col-md-10 col-sm-10">
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
            </div>
        </div>
    </div>


    <div class="col-md-12">
        <div class="portlet-body form">
            <?php
            echo $this->Form->create('Order', array(
                'inputDefaults' => array(
                    'label' => false,
                    'div' => false
                ),
                'id' => 'form_sample_3',
                'class' => 'form-horizontal',
                'novalidate' => 'novalidate',
                'type' => 'file'
                    )
            );
            ?>
            <div class="form-body">
                <div class="alert alert-danger display-hide">
                    <button class="close" data-close="alert"></button>
                    You have some form errors. Please check below.
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
                                'class' => 'form-control required'
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
                        //pr($cities); //exit;
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

            </div>
        </div>
        <?php
        echo $this->Form->button(
                'Order', array('class' => 'btn green', 'type' => 'submit')
        );
        ?>
        <?php echo $this->Form->end(); ?>
    </div>





