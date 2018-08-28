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
            Run scripts(Be Carful Before Run)
        </h3>
        <!-- END PAGE HEADER-->
        <?php
        $btn = '';
        $execute_date = '1/20/2018';
        $to_date = date('m/d/Y');
//         pr($execute_date.' '.$to_date); exit;
        if ($execute_date != $to_date) {
            $btn = "disable";
        }
//       pr($btn); exit;
        ?>
        <!-- BEGIN PAGE CONTENT-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet box green">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-user"></i>List of all development related scripts
                        </div>

                        <div class="tools">
                            <a href="#" title="" class="fa fa-recycle">
                            </a>
                        </div>
                    </div>
                    <div class="portlet-body">

                        <?php echo $this->Session->flash(); ?> 

                        <hr>
                        <h2>Package customer mac status field update </h2>
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
                                return false;" disabled ="<?php echo $btn ?>"  type="submit" style="background-color: red;">Hold</button> 


                        <?php echo $this->Form->end(); ?>&nbsp;

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
                                return false;" disabled ="<?php echo $btn ?>"  type="submit" style="background-color: red;">Canceled</button>     

                        <?php echo $this->Form->end(); ?>

                        &nbsp;

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
                                return false;" disabled ="<?php echo $btn ?>"  type="submit" style="background-color: red;">Active</button>     

                        <?php echo $this->Form->end(); ?>
                        <hr>
                        <h2>Data Transfer status history to mac history</h2>
                        &nbsp;

                        <?php
                        echo $this->Form->create('PackageCustomer', array(
                            'inputDefaults' => array(
                                'label' => false,
                                'div' => false
                            ),
                            'id' => 'form_sample_3',
                            'class' => 'form-horizontal',
                            'novalidate' => 'novalidate',
                            'url' => array('controller' => 'admins', 'action' => 'data_transfer')
                                )
                        );
                        ?>
                        <button class="btn red-sunglo" onclick="if (confirm('Are you sure to transfer status_history to mac_history?')) {
                                    return true;
                                }
                                return false;" disabled ="<?php echo $btn ?>"  type="submit" style="background-color: red;">Status_history to mac_history?</button>     

                        <?php echo $this->Form->end(); ?>
                        <hr>
                        <h2>Data Transfer ID Wise</h2>
                        &nbsp;

                        <?php
                        echo $this->Form->create('PackageCustomer', array(
                            'inputDefaults' => array(
                                'label' => false,
                                'div' => false
                            ),
                            'id' => 'form_sample_3',
                            'class' => 'form-horizontal',
                            'novalidate' => 'novalidate',
                            'url' => array('controller' => 'admins', 'action' => 'data_transfer_id_wise')
                                )
                        );
                        ?>

                        <div class="form-group">
                            <label class="control-label col-md-3">Insert ID:<span class="required">
                                    * </span>
                            </label>
                            <div class="col-md-4">
                                <?php
                                echo $this->Form->input(
                                        'id', array(
                                    'class' => 'form-control required',
                                    'type' => 'text'
                                        )
                                );
                                ?>
                            </div>
                        </div>

                        <button class="btn red-sunglo" disabled onclick="if (confirm('Are you sure to transfer data back to pc ?')) {
                                    return true;
                                }
                                return false;" type="submit" style="background-color: red;">Id wise data transfer?</button>     

                        <?php echo $this->Form->end(); ?>


                        &nbsp;
                        <h2>Data Transfer status history to mac history</h2>
                        &nbsp;
                        <?php
                        echo $this->Form->create('Roaster', array(
                            'inputDefaults' => array(
                                'label' => false,
                                'div' => false
                            ),
                            'id' => 'form_sample_3',
                            'class' => 'form-horizontal',
                            'novalidate' => 'novalidate',
                            'url' => array('controller' => 'roasters', 'action' => 'autosetroaster')
                                )
                        );
                        ?>
                        <button class="btn red-sunglo" onclick="if (confirm('Are you sure to set auto roaster?')) {
                                    return true;
                                }
                                return false;"   type="submit" style="background-color: red;">Roaster set</button>     

                        <?php echo $this->Form->end(); ?>
                        <hr>

                    </div>
                </div>
                <!-- END EXAMPLE TABLE PORTLET-->
            </div>
        </div>
        <!-- END PAGE CONTENT -->
    </div>
</div>
<!-- END CONTENT -->
