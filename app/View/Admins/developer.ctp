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
        <!-- BEGIN PAGE CONTENT-->
        <div class="row">
            <div class="col-md-12">
                <div class="portlet box green">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-plus"></i>Add New Admin
                        </div>
                        <!--                        <div class="tools">
                                                    <a href="javascript:;" class="reload">
                                                    </a>
                                                </div>-->
                    </div>

                    &nbsp;
                    <?php if (($user == 'sadmin') || ($user == 'supervisor')): ?>
                        <div class="col-md-offset-6 col-md-4">
                            <?php
                            echo $this->Form->create('PackageCustomer', array(
                                'inputDefaults' => array(
                                    'label' => false,
                                    'div' => false
                                ),
                                'id' => 'form_sample_3',
                                'class' => 'form-horizontal',
                                'novalidate' => 'novalidate',
                                'url' => array('controller' => 'customers', 'action' => 'update_hold')
                                    )
                            );
                            ?>
                            <button class="btn red-sunglo" onclick="if (confirm('Are you sure to update pc mac_status?')) {
                                        return true;
                                    }
                                    return false;" <?php echo $btn; ?> type="submit" style="background-color: red;">Hold</button>     

                            <?php echo $this->Form->end(); ?>


                        </div>
                    <?php endif; ?>
                    &nbsp;
                    <?php if (($user == 'sadmin') || ($user == 'supervisor')): ?>
                        <div class="col-md-offset-6 col-md-4">
                            <?php
                            echo $this->Form->create('PackageCustomer', array(
                                'inputDefaults' => array(
                                    'label' => false,
                                    'div' => false
                                ),
                                'id' => 'form_sample_3',
                                'class' => 'form-horizontal',
                                'novalidate' => 'novalidate',
                                'url' => array('controller' => 'customers', 'action' => 'update_canceled')
                                    )
                            );
                            ?>
                            <button class="btn red-sunglo" onclick="if (confirm('Are you sure to update pc mac_status?')) {
                                        return true;
                                    }
                                    return false;" <?php echo $btn; ?> type="submit" style="background-color: red;">Canceled</button>     

                            <?php echo $this->Form->end(); ?>


                        </div>
                    <?php endif; ?>
                    &nbsp;
                    <?php if (($user == 'sadmin') || ($user == 'supervisor')): ?>
                        <div class="col-md-offset-6 col-md-4">
                            <?php
                            echo $this->Form->create('PackageCustomer', array(
                                'inputDefaults' => array(
                                    'label' => false,
                                    'div' => false
                                ),
                                'id' => 'form_sample_3',
                                'class' => 'form-horizontal',
                                'novalidate' => 'novalidate',
                                'url' => array('controller' => 'customers', 'action' => 'update_active')
                                    )
                            );
                            ?>
                            <button class="btn red-sunglo" onclick="if (confirm('Are you sure to update pc mac_status?')) {
                                        return true;
                                    }
                                    return false;" <?php echo $btn; ?> type="submit" style="background-color: red;">Active</button>     

                            <?php echo $this->Form->end(); ?>


                        </div>
                    <?php endif; ?>

                </div>
            </div>
        </div>
        <!-- END PAGE CONTENT -->
    </div>
</div>
<!-- END CONTENT -->

