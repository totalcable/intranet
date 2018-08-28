<style type="text/css">
    .alert {
        padding: 6px;
        margin-bottom: 5px;
        border: 1px solid transparent;
        border-radius: 4px;
        text-align: center;
    }
    .alert.alert-error {
        background: #A9B0B5;
        color: #EF5858;
        font-weight: normal;
    }

</style>
<div class="page-content-wrapper">
    <div class="page-content">
        <!-- BEGIN PAGE CONTENT-->
        <div class="content">

            <!-- BEGIN LOGIN FORM -->
            <?php
            echo $this->Form->create('Customer', array(
                'inputDefaults' => array(
                    'label' => false,
                    'div' => false
                ),
                'id' => 'form_sample_3',
                'class' => 'form-horizontal',
                'novalidate' => 'novalidate'
                    )
            );
            ?>


            <?php echo $this->Session->flash(); ?>

            <div class="workshop-info"> <?php $lastEvent = $lastEvent['Event']; ?>
                <h2> <?php echo $lastEvent['name']; ?> <h2/>
                    <strong>  Location : <i><?php echo $lastEvent['place']; ?></i> </strong> <br/>
                    <strong> Time : <?php echo $lastEvent['open']; ?> </strong><br/>
                    <span class="blinking">Register Now!</span>
            </div>
            <div class="alert alert-danger display-hide">
                <button class="close" data-close="alert"></button>
                <span>
                    Fill up all required fields </span>
            </div>
            <div class="form-group">
                <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
                <label class="control-label visible-ie8 visible-ie9">Email</label>
                <div class="input-icon">
                    <i class="fa fa-user"></i>

                    <?php
                    echo $this->Form->input(
                            'email', array(
                        'class' => 'form-control placeholder-no-fix',
                        'type' => 'text',
                        'autocomplete' => 'off',
                        'placeholder' => 'Email'
                            )
                    );
                    ?>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label visible-ie8 visible-ie9">Name</label>
                <div class="input-icon">
                    <i class="fa fa-user"></i>

                    <?php
                    echo $this->Form->input(
                            'name', array(
                        'class' => 'form-control placeholder-no-fix',
                        'type' => 'test',
                        'autocomplete' => 'off',
                        'placeholder' => 'Your Name'
                            )
                    );
                    ?>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label visible-ie8 visible-ie9">Mobile Number</label>
                <div class="input-icon">
                    <i class="fa fa-phone"></i>

                    <?php
                    echo $this->Form->input(
                            'mobile', array(
                        'class' => 'form-control placeholder-no-fix',
                        'type' => 'test',
                        'autocomplete' => 'off',
                        'placeholder' => 'Your cell number'
                            )
                    );
                    ?>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label visible-ie8 visible-ie9">Alternative Mobile Number</label>
                <div class="input-icon">
                    <i class="fa fa-phone"></i>

                    <?php
                    echo $this->Form->input(
                            'alt_mobile', array(
                        'class' => 'form-control placeholder-no-fix',
                        'type' => 'test',
                        'autocomplete' => 'off',
                        'placeholder' => 'Your Alternative cell number'
                            )
                    );
                    ?>
                </div>
            </div>

            <div class="form-actions">
                <?php
                echo $this->Form->button(
                        'Register <i class="m-icon-swapright m-icon-white"></i>', array(
                    'class' => 'btn blue pull-right',
                    'type' => 'submit',
                    'escape' => false
                        )
                );
                ?> 

            </div>


            <?php echo $this->Form->end(); ?>
            <!-- END LOGIN FORM -->



            <!-- END REGISTRATION FORM -->

        </div>
        <!-- END PAGE CONTENT -->
    </div>
</div>
<!-- END CONTENT -->






















<div class="col-md-12">
    <div class="portlet-body form">
        <?php
        echo $this->Form->create('Customer', array(
            'inputDefaults' => array(
                'label' => false,
                'div' => false
            ),
            'id' => 'form_sample_3',
            'class' => 'form-horizontal',
            'novalidate' => 'novalidate'
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



