<style>
    .ui-datepicker-multi-3 {
        display: table-row-group !important;
    }
</style>

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
                            <i class="fa fa-plus"></i>Swap set
                        </div>
                        <div class="tools">
                            <a href="javascript:;" class="reload">
                            </a>
                            <!--                            <a href="javascript:;" class="reload">
                                                        </a>-->
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <!-- BEGIN FORM-->
                        <?php
                        echo $this->Form->create('SwapHistorie', array(
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
                        <div class="form-body">
                            <div class="alert alert-danger display-hide">
                                <button class="close" data-close="alert"></button>
                                You have some form errors. Please check below.
                            </div>
                            <?php echo $this->Session->flash(); ?>
                            <div class="form-group">                                
                                <label class="control-label col-md-3" for=" ">Select Date:</label>
                                <div class="col-md-4">
                                    <?php
                                    echo $this->Form->input(
                                            'date', array(
                                        'id' => 'e2', /* e1 is past to current date, e2 is past to future date */
                                        'class' => 'span9 text',
//                                        'value' => $results['id'],
                                            )
                                    );
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-5 col-md-4">
                                    <?php
                                    echo $this->Form->button(
                                            'Search', array('class' => 'btn btn-success', 'type' => 'submit')
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
        <?php if (!empty($datas)) { ?>

            <div style="text-align: center;">
                <br>
                <div class="controls center text-center">   
                    <?php
//                  pr($datas); exit;
                    if (!empty($datas)) {

                        $results = $datas;
                        $convert_date = strtotime($date_s);
                        $name_day = date('l', $convert_date);
                    }

                    ?>
                    <h3>You can easily modify <b style="color: orange;">SWAP</b> information here</h3>
                    <?php if (!empty($name_day)) { ?>
                        <h4 style="color: royalblue;" title="Day name is : 

                            <?php echo $name_day; ?> :-)">

                        <?php } ?>
                        <?php if (!empty($name_day)) { ?>
                            <?php echo $name_day; ?>
                        <?php } ?>



                    </h4>
                    <h5>Morning</h5>
                    <br><br>
                    <?php
                    echo $this->Form->create('SwapHistorie', array(
                        'inputDefaults' => array(
                            'label' => false,
                            'div' => false,
                            'id' => false
                        ),
                        'id' => 'form_sample_3',
                        'class' => 'form-horizontal',
                        'novalidate' => 'novalidate',
                        'url' => array('controller' => 'roasters', 'action' => 'setswapmorning')
                            )
                    );
                    ?>
                    <?php
                    echo $this->Form->input('id', array(
                        'type' => 'hidden',
                        'value' => $results['id'],
                            )
                    );
                    ?>
                    <?php
                    echo $this->Form->input('day_name', array(
                        'type' => 'hidden',
                        'value' => $name_day,
                            )
                    );
                    ?>

                    <?php
                    echo $this->Form->input('date', array(
                        'type' => 'hidden',
                        'value' => $date_s,
                            )
                    );
                    ?>
                    <?php
                    echo $this->Form->input('nishift_name_time3', array(
                        'type' => 'hidden',
                        'value' => $results['nishift_name_time3'],
                            )
                    );
                    ?>
                    <?php echo $this->Session->flash(); ?>
                    <div class="col-md-12">
                        <!--                    <h3><b style="color: orange;">SWAP</b> Morning</h3>
                                            <br><br>-->
                        <br>

                        <div class="row">
                            <label class="control-label col-md-2">
                            </label>
                            <div class="col-md-2">                                                                
                                <?php
                                echo $this->Form->input(
                                        'date', array(
                                    'type' => 'text',
                                    'class' => 'datepicker form-control  ',
                                    'value' => $date_s,
                                    'disabled' => 'disabled'
                                        )
                                );
                                ?> 
                            </div>
                            <br>
                            <br>
                        </div>
                        <div class="row">
                            <label class="control-label col-md-2">
                            </label>
                            <div class="col-md-2">                                                                
                                <?php
                                echo $this->Form->input('swapin1_mo_by', array(
                                    'type' => 'select',
                                    'options' => $supervisor,
                                    'value' => $results['swapin1_mo_by'],
                                    'empty' => 'Select Supervisor',
                                    'class' => 'form-control select2me'
                                        )
                                );
                                ?>
                            </div>
                            <div style=" float: left; margin-top: 0px;">
                                <label class="fa fa-arrow-left">
                                </label>
                                <br>
                                <label class="fa fa-arrow-right">
                                </label>
                            </div>
                            <div class="col-md-2">                                                                
                                <?php
                                echo $this->Form->input('swapin1_mo_for', array(
                                    'type' => 'select',
                                    'options' => $supervisor,
                                    'value' => $results['swapin1_mo_for'],
                                    'empty' => 'Select Supervisor',
                                    'class' => 'form-control select2me'
                                        )
                                );
                                ?>
                            </div>

                            <div class="col-md-2">                                                               
                                <?php
                                echo $this->Form->input('swapin2_mo_by', array(
                                    'type' => 'select',
                                    'options' => $supervisor,
                                    'value' => $results['swapin2_mo_by'],
                                    'empty' => 'Select Supervisor',
                                    'class' => 'form-control select2me pclass',
                                        )
                                );
                                ?>
                            </div>
                            <div style=" float: left; margin-top: 0px;">
                                <label class="fa fa-arrow-left">
                                </label>
                                <br>
                                <label class="fa fa-arrow-right">
                                </label>
                            </div>
                            <div class="col-md-2">                                                                
                                <?php
                                echo $this->Form->input('swapin2_mo_for', array(
                                    'type' => 'select',
                                    'options' => $supervisor,
                                    'value' => $results['swapin2_mo_for'],
                                    'empty' => 'Select Supervisor',
                                    'class' => 'form-control select2me'
                                        )
                                );
                                ?>
                            </div>
                        </div>
                        <br>
                        <hr>
                        <h3>Agent</h3>
                        <br><br>
                        <div class="row">
                            <label class="control-label col-md-2">
                            </label>
                            <div class="col-md-2">                                                                
                                <?php
                                echo $this->Form->input('swapa1_mo_by', array(
                                    'type' => 'select',
                                    'options' => $agent,
                                    'value' => $results['swapa1_mo_by'],
                                    'empty' => 'Select agent',
                                    'class' => 'form-control select2me'
                                        )
                                );
                                ?>
                            </div>
                            <div style=" float: left; margin-top: 0px;">
                                <label class="fa fa-arrow-left">
                                </label>
                                <br>
                                <label class="fa fa-arrow-right">
                                </label>
                            </div>
                            <div class="col-md-2">                                                                
                                <?php
                                echo $this->Form->input('swapa1_mo_for', array(
                                    'type' => 'select',
                                    'options' => $agent,
                                    'value' => $results['swapa1_mo_for'],
                                    'empty' => 'Select agent',
                                    'class' => 'form-control select2me'
                                        )
                                );
                                ?>
                            </div>

                            <div class="col-md-2">                                                               
                                <?php
                                echo $this->Form->input('swapa2_mo_by', array(
                                    'type' => 'select',
                                    'options' => $agent,
                                    'value' => $results['swapa2_mo_by'],
                                    'empty' => 'Select agent',
                                    'class' => 'form-control select2me pclass',
                                        )
                                );
                                ?>
                            </div>
                            <div style=" float: left; margin-top: 0px;">
                                <label class="fa fa-arrow-left">
                                </label>
                                <br>
                                <label class="fa fa-arrow-right">
                                </label>
                            </div>
                            <div class="col-md-2">                                                                
                                <?php
                                echo $this->Form->input('swapa2_mo_for', array(
                                    'type' => 'select',
                                    'options' => $agent,
                                    'value' => $results['swapa2_mo_for'],
                                    'empty' => 'Select agent',
                                    'class' => 'form-control select2me'
                                        )
                                );
                                ?>
                            </div>

                        </div>
                        <br>
                        <div class="row">
                            <label class="control-label col-md-2">
                            </label>
                            <div class="col-md-2">                                                                
                                <?php
                                echo $this->Form->input('swapa3_mo_by', array(
                                    'type' => 'select',
                                    'options' => $agent,
                                    'value' => $results['swapa3_mo_by'],
                                    'empty' => 'Select agent',
                                    'class' => 'form-control select2me'
                                        )
                                );
                                ?>
                            </div>
                            <div style=" float: left; margin-top: 0px;">
                                <label class="fa fa-arrow-left">
                                </label>
                                <br>
                                <label class="fa fa-arrow-right">
                                </label>
                            </div>
                            <div class="col-md-2">                                                                
                                <?php
                                echo $this->Form->input('swapa3_mo_for', array(
                                    'type' => 'select',
                                    'options' => $agent,
                                    'value' => $results['swapa3_mo_for'],
                                    'empty' => 'Select agent',
                                    'class' => 'form-control select2me'
                                        )
                                );
                                ?>
                            </div>
                            <div class="col-md-2">                                                               
                                <?php
                                echo $this->Form->input('swapa4_mo_by', array(
                                    'type' => 'select',
                                    'options' => $agent,
                                    'value' => $results['swapa4_mo_by'],
                                    'empty' => 'Select agent',
                                    'class' => 'form-control select2me pclass',
                                        )
                                );
                                ?>
                            </div>
                            <div style=" float: left; margin-top: 0px;">
                                <label class="fa fa-arrow-left">
                                </label>
                                <br>
                                <label class="fa fa-arrow-right">
                                </label>
                            </div>
                            <div class="col-md-2">                                                                
                                <?php
                                echo $this->Form->input('swapa4_mo_for', array(
                                    'type' => 'select',
                                    'options' => $agent,
                                    'value' => $results['swapa4_mo_for'],
                                    'empty' => 'Select agent',
                                    'class' => 'form-control select2me'
                                        )
                                );
                                ?>
                            </div>
                        </div>
                        <br> <br>
                        <label class="control-label col-md-6">
                        </label>
                        <div class="row" style="text-align: left;">
                            <?php
                            echo $this->Form->button(
                                    'Morning shift swap set', array('class' => 'btn green', 'type' => 'submit')
                            );
                            ?>
                        </div>
                    </div>
                </div>
                <br><br>
                <?php echo $this->Form->end(); ?>
            </div>

            <!--    Afternoon shift start -->
            <br>
            <div class="portlet box blue-steel">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-list-ul"></i> Afternoon

                    </div>
                    <div class="tools">
                        <a  class="reload toggle" data-id="package_exp"></a>
                    </div>
                </div>
                <div class="controls center text-center"> 
                    <!--<div class="portlet-body" id="package_exp" style="display: none;">-->
                    <div class="portlet-body" >
                        <?php
                        echo $this->Form->create('SwapHistorie', array(
                            'inputDefaults' => array(
                                'label' => false,
                                'div' => false,
                                'id' => false
                            ),
                            'id' => 'form_sample_3',
                            'class' => 'form-horizontal',
                            'novalidate' => 'novalidate',
                            'url' => array('controller' => 'roasters', 'action' => 'setswapafternoon')
                                )
                        );
                        ?>
                        <?php
                        echo $this->Form->input('id', array(
                            'type' => 'hidden',
                            'value' => $results['id'],
                                )
                        );
                        ?>

                        <?php
                        echo $this->Form->input('day_name', array(
                            'type' => 'hidden',
                            'value' => $name_day,
                                )
                        );
                        ?>

                        <?php
                        echo $this->Form->input('date', array(
                            'type' => 'hidden',
                            'value' => $date_s,
                                )
                        );
                        ?>
                        <?php
                        echo $this->Form->input('afshift_name_time2', array(
                            'type' => 'hidden',
                            'value' => $results['afshift_name_time2'],
                                )
                        );
                        ?>
                        <?php echo $this->Session->flash(); ?>
                        <div class="col-md-12">
                            <h3> <b style="color: orange;">SWAP</b> Afternoon</h3>
                            <br><br>

                            <div class="row">
                                <label class="control-label col-md-2">
                                </label>
                                <div class="col-md-2">                                                                
                                    <?php
                                    echo $this->Form->input(
                                            'date', array(
                                        'type' => 'text',
                                        'class' => 'datepicker form-control  ',
                                        'value' => $date_s,
                                        'disabled' => 'disabled'
                                            )
                                    );
                                    ?> 
                                </div>
                                <br>
                                <br>
                            </div>
                            <div class="row">
                                <label class="control-label col-md-2">
                                </label>
                                <div class="col-md-2">                                                                
                                    <?php
                                    echo $this->Form->input('swapin1_af_by', array(
                                        'type' => 'select',
                                        'options' => $supervisor,
                                        'value' => $results['swapin1_af_by'],
                                        'empty' => 'Select Supervisor',
                                        'class' => 'form-control select2me'
                                            )
                                    );
                                    ?>
                                </div>
                                <div style=" float: left; margin-top: 0px;">
                                    <label class="fa fa-arrow-left">
                                    </label>
                                    <br>
                                    <label class="fa fa-arrow-right">
                                    </label>
                                </div>
                                <div class="col-md-2">                                                                
                                    <?php
                                    echo $this->Form->input('swapin1_af_for', array(
                                        'type' => 'select',
                                        'options' => $supervisor,
                                        'value' => $results['swapin1_af_for'],
                                        'empty' => 'Select Supervisor',
                                        'class' => 'form-control select2me'
                                            )
                                    );
                                    ?>
                                </div>

                                <div class="col-md-2">                                                               
                                    <?php
                                    echo $this->Form->input('swapin2_af_by', array(
                                        'type' => 'select',
                                        'options' => $supervisor,
                                        'value' => $results['swapin2_af_by'],
                                        'empty' => 'Select Supervisor',
                                        'class' => 'form-control select2me pclass',
                                            )
                                    );
                                    ?>
                                </div>
                                <div style=" float: left; margin-top: 0px;">
                                    <label class="fa fa-arrow-left">
                                    </label>
                                    <br>
                                    <label class="fa fa-arrow-right">
                                    </label>
                                </div>
                                <div class="col-md-2">                                                                
                                    <?php
                                    echo $this->Form->input('swapin2_af_for', array(
                                        'type' => 'select',
                                        'options' => $supervisor,
                                        'value' => $results['swapin2_af_for'],
                                        'empty' => 'Select Supervisor',
                                        'class' => 'form-control select2me'
                                            )
                                    );
                                    ?>
                                </div>
                            </div>

                            <br>
                            <hr>
                            <h3>Agent</h3>
                            <br><br>
                            <div class="row">
                                <label class="control-label col-md-2">
                                </label>
                                <div class="col-md-2">                                                                
                                    <?php
                                    echo $this->Form->input('swapa1_af_by', array(
                                        'type' => 'select',
                                        'options' => $agent,
                                        'value' => $results['swapa1_af_by'],
                                        'empty' => 'Select agent',
                                        'class' => 'form-control select2me'
                                            )
                                    );
                                    ?>
                                </div>
                                <div style=" float: left; margin-top: 0px;">
                                    <label class="fa fa-arrow-left">
                                    </label>
                                    <br>
                                    <label class="fa fa-arrow-right">
                                    </label>
                                </div>
                                <div class="col-md-2">                                                                
                                    <?php
                                    echo $this->Form->input('swapa1_af_for', array(
                                        'type' => 'select',
                                        'options' => $agent,
                                        'value' => $results['swapa1_af_for'],
                                        'empty' => 'Select agent',
                                        'class' => 'form-control select2me'
                                            )
                                    );
                                    ?>
                                </div>

                                <div class="col-md-2">                                                               
                                    <?php
                                    echo $this->Form->input('swapa2_af_by', array(
                                        'type' => 'select',
                                        'options' => $agent,
                                        'value' => $results['swapa2_af_by'],
                                        'empty' => 'Select agent',
                                        'class' => 'form-control select2me pclass',
                                            )
                                    );
                                    ?>
                                </div>
                                <div style=" float: left; margin-top: 0px;">
                                    <label class="fa fa-arrow-left">
                                    </label>
                                    <br>
                                    <label class="fa fa-arrow-right">
                                    </label>
                                </div>
                                <div class="col-md-2">                                                                
                                    <?php
                                    echo $this->Form->input('swapa2_af_for', array(
                                        'type' => 'select',
                                        'options' => $agent,
                                        'value' => $results['swapa2_af_for'],
                                        'empty' => 'Select agent',
                                        'class' => 'form-control select2me'
                                            )
                                    );
                                    ?>
                                </div>

                            </div>
                            <br>
                            <div class="row">
                                <label class="control-label col-md-2">
                                </label>
                                <div class="col-md-2">                                                                
                                    <?php
                                    echo $this->Form->input('swapa3_af_by', array(
                                        'type' => 'select',
                                        'options' => $agent,
                                        'value' => $results['swapa3_af_by'],
                                        'empty' => 'Select agent',
                                        'class' => 'form-control select2me'
                                            )
                                    );
                                    ?>
                                </div>
                                <div style=" float: left; margin-top: 0px;">
                                    <label class="fa fa-arrow-left">
                                    </label>
                                    <br>
                                    <label class="fa fa-arrow-right">
                                    </label>
                                </div>
                                <div class="col-md-2">                                                                
                                    <?php
                                    echo $this->Form->input('swapa3_af_for', array(
                                        'type' => 'select',
                                        'options' => $agent,
                                        'value' => $results['swapa3_af_for'],
                                        'empty' => 'Select agent',
                                        'class' => 'form-control select2me'
                                            )
                                    );
                                    ?>
                                </div>
                                <div class="col-md-2">                                                               
                                    <?php
                                    echo $this->Form->input('swapa4_af_by', array(
                                        'type' => 'select',
                                        'options' => $agent,
                                        'value' => $results['swapa4_af_by'],
                                        'empty' => 'Select agent',
                                        'class' => 'form-control select2me pclass',
                                            )
                                    );
                                    ?>
                                </div>
                                <div style=" float: left; margin-top: 0px;">
                                    <label class="fa fa-arrow-left">
                                    </label>
                                    <br>
                                    <label class="fa fa-arrow-right">
                                    </label>
                                </div>
                                <div class="col-md-2">                                                                
                                    <?php
                                    echo $this->Form->input('swapa4_af_for', array(
                                        'type' => 'select',
                                        'options' => $agent,
                                        'value' => $results['swapa4_af_for'],
                                        'empty' => 'Select agent',
                                        'class' => 'form-control select2me'
                                            )
                                    );
                                    ?>
                                </div>
                            </div>
                            <br> <br>
                            <label class="control-label col-md-6">
                            </label>
                            <div class="row" style="text-align: left;">
                                <?php
                                echo $this->Form->button(
                                        'Afternoon shift swap set', array('class' => 'btn green', 'type' => 'submit')
                                );
                                ?>
                            </div>
                            <br><br>
                        </div>
                    </div>
                    <?php echo $this->Form->end(); ?>
                </div>
            </div>
            <!--  Afternoon shift end -->

            <!--    Night shift start -->
            <br>
            <div class="portlet box blue-steel">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-list-ul"></i>Night

                    </div>
                    <div class="tools">
                        <a  class="reload toggle" data-id="night"></a>
                    </div>
                </div>
                <div class="controls center text-center"> 
                    <div class="portlet-body">
                        <?php
                        echo $this->Form->create('SwapHistorie', array(
                            'inputDefaults' => array(
                                'label' => false,
                                'div' => false,
                                'id' => false
                            ),
                            'id' => 'form_sample_3',
                            'class' => 'form-horizontal',
                            'novalidate' => 'novalidate',
                            'url' => array('controller' => 'roasters', 'action' => 'setswapnight')
                                )
                        );
                        ?>
                        <?php
                        echo $this->Form->input('id', array(
                            'type' => 'hidden',
                            'value' => $results['id'],
                                )
                        );
                        ?>
                        <?php
                        echo $this->Form->input('day_name', array(
                            'type' => 'hidden',
                            'value' => $name_day,
                                )
                        );
                        ?>

                        <?php
                        echo $this->Form->input('date', array(
                            'type' => 'hidden',
                            'value' => $date_s,
                                )
                        );
                        ?>
                        <?php
                        echo $this->Form->input('nishift_name_time3', array(
                            'type' => 'hidden',
                            'value' => $results['nishift_name_time3'],
                                )
                        );
                        ?>
                        <?php echo $this->Session->flash(); ?>
                        <div class="col-md-12">
                            <h3><b style="color: orange;">SWAP</b> Night</h3>
                            <br><br>
                            <br>

                            <div class="row">
                                <label class="control-label col-md-2">
                                </label>
                                <div class="col-md-2">                                                                
                                    <?php
                                    echo $this->Form->input(
                                            'date', array(
                                        'type' => 'text',
                                        'class' => 'datepicker form-control  ',
                                        'value' => $date_s,
                                        'disabled' => 'disabled'
                                            )
                                    );
                                    ?> 
                                </div>
                                <br>
                                <br>
                            </div>
                            <div class="row">
                                <label class="control-label col-md-2">
                                </label>
                                <div class="col-md-2">                                                                
                                    <?php
                                    echo $this->Form->input('swapin1_ni_by', array(
                                        'type' => 'select',
                                        'options' => $supervisor,
                                        'value' => $results['swapin1_ni_by'],
                                        'empty' => 'Select Supervisor',
                                        'class' => 'form-control select2me'
                                            )
                                    );
                                    ?>
                                </div>
                                <div style=" float: left; margin-top: 0px;">
                                    <label class="fa fa-arrow-left">
                                    </label>
                                    <br>
                                    <label class="fa fa-arrow-right">
                                    </label>
                                </div>
                                <div class="col-md-2">                                                                
                                    <?php
                                    echo $this->Form->input('swapin1_ni_for', array(
                                        'type' => 'select',
                                        'options' => $supervisor,
                                        'value' => $results['swapin1_ni_for'],
                                        'empty' => 'Select Supervisor',
                                        'class' => 'form-control select2me'
                                            )
                                    );
                                    ?>
                                </div>

                                <div class="col-md-2">                                                               
                                    <?php
                                    echo $this->Form->input('swapin2_ni_by', array(
                                        'type' => 'select',
                                        'options' => $supervisor,
                                        'value' => $results['swapin2_ni_by'],
                                        'empty' => 'Select Supervisor',
                                        'class' => 'form-control select2me pclass',
                                            )
                                    );
                                    ?>
                                </div>
                                <div style=" float: left; margin-top: 0px;">
                                    <label class="fa fa-arrow-left">
                                    </label>
                                    <br>
                                    <label class="fa fa-arrow-right">
                                    </label>
                                </div>
                                <div class="col-md-2">                                                                
                                    <?php
                                    echo $this->Form->input('swapin2_ni_for', array(
                                        'type' => 'select',
                                        'options' => $supervisor,
                                        'value' => $results['swapin2_ni_for'],
                                        'empty' => 'Select Supervisor',
                                        'class' => 'form-control select2me'
                                            )
                                    );
                                    ?>
                                </div>
                            </div>
                            <br>
                            <hr>
                            <!--<h3><b>SWAP</b> for Agent</h3>-->
                            <h3>Agent</h3>
                            <br><br>
                            <div class="row">
                                <label class="control-label col-md-2">
                                </label>
                                <div class="col-md-2">                                                                
                                    <?php
                                    echo $this->Form->input('swapa1_ni_by', array(
                                        'type' => 'select',
                                        'options' => $agent,
                                        'value' => $results['swapa1_ni_for'],
                                        'empty' => 'Select agent',
                                        'class' => 'form-control select2me'
                                            )
                                    );
                                    ?>
                                </div>
                                <div style=" float: left; margin-top: 0px;">
                                    <label class="fa fa-arrow-left">
                                    </label>
                                    <br>
                                    <label class="fa fa-arrow-right">
                                    </label>
                                </div>
                                <div class="col-md-2">                                                                
                                    <?php
                                    echo $this->Form->input('swapa1_ni_for', array(
                                        'type' => 'select',
                                        'options' => $agent,
                                        'value' => $results['swapa1_ni_for'],
                                        'empty' => 'Select agent',
                                        'class' => 'form-control select2me'
                                            )
                                    );
                                    ?>
                                </div>

                                <div class="col-md-2">                                                               
                                    <?php
                                    echo $this->Form->input('swapa2_ni_by', array(
                                        'type' => 'select',
                                        'options' => $agent,
                                        'value' => $results['swapa2_ni_by'],
                                        'empty' => 'Select agent',
                                        'class' => 'form-control select2me pclass',
                                            )
                                    );
                                    ?>
                                </div>
                                <div style=" float: left; margin-top: 0px;">
                                    <label class="fa fa-arrow-left">
                                    </label>
                                    <br>
                                    <label class="fa fa-arrow-right">
                                    </label>
                                </div>
                                <div class="col-md-2">                                                                
                                    <?php
                                    echo $this->Form->input('swapa2_ni_for', array(
                                        'type' => 'select',
                                        'options' => $agent,
                                        'value' => $results['swapa2_ni_for'],
                                        'empty' => 'Select agent',
                                        'class' => 'form-control select2me'
                                            )
                                    );
                                    ?>
                                </div>

                            </div>
                            <br>
                            <div class="row">
                                <label class="control-label col-md-2">
                                </label>
                                <div class="col-md-2">                                                                
                                    <?php
                                    echo $this->Form->input('swapa3_ni_by', array(
                                        'type' => 'select',
                                        'options' => $agent,
                                        'value' => $results['swapa3_ni_by'],
                                        'empty' => 'Select agent',
                                        'class' => 'form-control select2me'
                                            )
                                    );
                                    ?>
                                </div>
                                <div style=" float: left; margin-top: 0px;">
                                    <label class="fa fa-arrow-left">
                                    </label>
                                    <br>
                                    <label class="fa fa-arrow-right">
                                    </label>
                                </div>
                                <div class="col-md-2">                                                                
                                    <?php
                                    echo $this->Form->input('swapa3_ni_for', array(
                                        'type' => 'select',
                                        'options' => $agent,
                                        'value' => $results['swapa3_ni_for'],
                                        'empty' => 'Select agent',
                                        'class' => 'form-control select2me'
                                            )
                                    );
                                    ?>
                                </div>
                                <div class="col-md-2">                                                               
                                    <?php
                                    echo $this->Form->input('swapa4_ni_by', array(
                                        'type' => 'select',
                                        'options' => $agent,
                                        'value' => $results['swapa4_ni_by'],
                                        'empty' => 'Select agent',
                                        'class' => 'form-control select2me pclass',
                                            )
                                    );
                                    ?>
                                </div>
                                <div style=" float: left; margin-top: 0px;">
                                    <label class="fa fa-arrow-left">
                                    </label>
                                    <br>
                                    <label class="fa fa-arrow-right">
                                    </label>
                                </div>
                                <div class="col-md-2">                                                                
                                    <?php
                                    echo $this->Form->input('swapa4_ni_for', array(
                                        'type' => 'select',
                                        'options' => $agent,
                                        'value' => $results['swapa4_ni_for'],
                                        'empty' => 'Select agent',
                                        'class' => 'form-control select2me'
                                            )
                                    );
                                    ?>
                                </div>
                            </div>
                            <br> <br>
                            <label class="control-label col-md-6">
                            </label>
                            <div class="row" style="text-align: left;">
                                <?php
                                echo $this->Form->button(
                                        'Night shift swap set', array('class' => 'btn green', 'type' => 'submit')
                                );
                                ?>
                            </div>
                        </div>
                    </div>
                    <?php echo $this->Form->end(); ?>
                </div>
            </div>
            <!--  Night shift end -->
        <?php } else { ?>  

            <div style="text-align: center;">
                <br>
                <div class="controls center text-center">   
                    <?php
                    $convert_date = strtotime($date_s);
                    $name_day = date('l', $convert_date);
                    ?>
                    <h3>You can easily modify <b style="color: orange;">SWAP</b> information here</h3>
                    <?php if (!empty($name_day)) { ?>
                        <h4 style="color: royalblue;" title="Day name is : 

                            <?php echo $name_day; ?> :-)">

                        <?php } ?>
                        <?php if (!empty($name_day)) { ?>
                            <?php echo $name_day; ?>
                        <?php } ?>

                    </h4>
                    <h5>Morning</h5>
                    <br><br>
                    <?php
                    echo $this->Form->create('SwapHistorie', array(
                        'inputDefaults' => array(
                            'label' => false,
                            'div' => false,
                            'id' => false
                        ),
                        'id' => 'form_sample_3',
                        'class' => 'form-horizontal',
                        'novalidate' => 'novalidate',
                        'url' => array('controller' => 'roasters', 'action' => 'setswapmorning')
                            )
                    );
                    ?>           
                    <?php
                    echo $this->Form->input('day_name', array(
                        'type' => 'hidden',
                        'value' => $name_day,
                            )
                    );
                    ?>
                    <?php
                    echo $this->Form->input('date', array(
                        'type' => 'hidden',
                        'value' => $date_s,
                            )
                    );
                    ?>

                    <?php echo $this->Session->flash(); ?>
                    <div class="col-md-12">
                        <!--                    <h3><b style="color: orange;">SWAP</b> Morning</h3>
                                            <br><br>-->
                        <br>

                        <div class="row">
                            <label class="control-label col-md-2">
                            </label>
                            <div class="col-md-2">                                                                
                                <?php
                                echo $this->Form->input(
                                        'date', array(
                                    'type' => 'text',
                                    'class' => 'datepicker form-control  ',
                                    'value' => $date_s,
                                    'disabled' => 'disabled'
                                        )
                                );
                                ?> 
                            </div>
                            <br>
                            <br>
                        </div>
                        <div class="row">
                            <label class="control-label col-md-2">
                            </label>
                            <div class="col-md-2">                                                                
                                <?php
                                echo $this->Form->input('swapin1_mo_by', array(
                                    'type' => 'select',
                                    'options' => $supervisor,
                                    'empty' => 'Select Supervisor',
                                    'class' => 'form-control select2me'
                                        )
                                );
                                ?>
                            </div>
                            <div style=" float: left; margin-top: 0px;">
                                <label class="fa fa-arrow-left">
                                </label>
                                <br>
                                <label class="fa fa-arrow-right">
                                </label>
                            </div>
                            <div class="col-md-2">                                                                
                                <?php
                                echo $this->Form->input('swapin1_mo_for', array(
                                    'type' => 'select',
                                    'options' => $supervisor,
                                    'empty' => 'Select Supervisor',
                                    'class' => 'form-control select2me'
                                        )
                                );
                                ?>
                            </div>

                            <div class="col-md-2">                                                               
                                <?php
                                echo $this->Form->input('swapin2_mo_by', array(
                                    'type' => 'select',
                                    'options' => $supervisor,
                                    'empty' => 'Select Supervisor',
                                    'class' => 'form-control select2me pclass',
                                        )
                                );
                                ?>
                            </div>
                            <div style=" float: left; margin-top: 0px;">
                                <label class="fa fa-arrow-left">
                                </label>
                                <br>
                                <label class="fa fa-arrow-right">
                                </label>
                            </div>
                            <div class="col-md-2">                                                                
                                <?php
                                echo $this->Form->input('swapin2_mo_for', array(
                                    'type' => 'select',
                                    'options' => $supervisor,
                                    'empty' => 'Select Supervisor',
                                    'class' => 'form-control select2me'
                                        )
                                );
                                ?>
                            </div>
                        </div>
                        <br>
                        <hr>
                        <h3>Agent</h3>
                        <br><br>
                        <div class="row">
                            <label class="control-label col-md-2">
                            </label>
                            <div class="col-md-2">                                                                
                                <?php
                                echo $this->Form->input('swapa1_mo_by', array(
                                    'type' => 'select',
                                    'options' => $agent,
                                    'empty' => 'Select agent',
                                    'class' => 'form-control select2me'
                                        )
                                );
                                ?>
                            </div>
                            <div style=" float: left; margin-top: 0px;">
                                <label class="fa fa-arrow-left">
                                </label>
                                <br>
                                <label class="fa fa-arrow-right">
                                </label>
                            </div>
                            <div class="col-md-2">                                                                
                                <?php
                                echo $this->Form->input('swapa1_mo_for', array(
                                    'type' => 'select',
                                    'options' => $agent,
                                    'empty' => 'Select agent',
                                    'class' => 'form-control select2me'
                                        )
                                );
                                ?>
                            </div>

                            <div class="col-md-2">                                                               
                                <?php
                                echo $this->Form->input('swapa2_mo_by', array(
                                    'type' => 'select',
                                    'options' => $agent,
                                    'empty' => 'Select agent',
                                    'class' => 'form-control select2me pclass',
                                        )
                                );
                                ?>
                            </div>
                            <div style=" float: left; margin-top: 0px;">
                                <label class="fa fa-arrow-left">
                                </label>
                                <br>
                                <label class="fa fa-arrow-right">
                                </label>
                            </div>
                            <div class="col-md-2">                                                                
                                <?php
                                echo $this->Form->input('swapa2_mo_for', array(
                                    'type' => 'select',
                                    'options' => $agent,
                                    'empty' => 'Select agent',
                                    'class' => 'form-control select2me'
                                        )
                                );
                                ?>
                            </div>

                        </div>
                        <br>
                        <div class="row">
                            <label class="control-label col-md-2">
                            </label>
                            <div class="col-md-2">                                                                
                                <?php
                                echo $this->Form->input('swapa3_mo_by', array(
                                    'type' => 'select',
                                    'options' => $agent,
                                    'empty' => 'Select agent',
                                    'class' => 'form-control select2me'
                                        )
                                );
                                ?>
                            </div>
                            <div style=" float: left; margin-top: 0px;">
                                <label class="fa fa-arrow-left">
                                </label>
                                <br>
                                <label class="fa fa-arrow-right">
                                </label>
                            </div>
                            <div class="col-md-2">                                                                
                                <?php
                                echo $this->Form->input('swapa3_mo_for', array(
                                    'type' => 'select',
                                    'options' => $agent,
                                    'empty' => 'Select agent',
                                    'class' => 'form-control select2me'
                                        )
                                );
                                ?>
                            </div>
                            <div class="col-md-2">                                                               
                                <?php
                                echo $this->Form->input('swapa4_mo_by', array(
                                    'type' => 'select',
                                    'options' => $agent,
                                    'empty' => 'Select agent',
                                    'class' => 'form-control select2me pclass',
                                        )
                                );
                                ?>
                            </div>
                            <div style=" float: left; margin-top: 0px;">
                                <label class="fa fa-arrow-left">
                                </label>
                                <br>
                                <label class="fa fa-arrow-right">
                                </label>
                            </div>
                            <div class="col-md-2">                                                                
                                <?php
                                echo $this->Form->input('swapa4_mo_for', array(
                                    'type' => 'select',
                                    'options' => $agent,
                                    'empty' => 'Select agent',
                                    'class' => 'form-control select2me'
                                        )
                                );
                                ?>
                            </div>
                        </div>
                        <br> <br>
                        <label class="control-label col-md-6">
                        </label>
                        <div class="row" style="text-align: left;">
                            <?php
                            echo $this->Form->button(
                                    'Morning shift swap set', array('class' => 'btn green', 'type' => 'submit')
                            );
                            ?>
                        </div>
                    </div>
                </div>
                <br><br>
                <?php echo $this->Form->end(); ?>
            </div>

            <!--    Afternoon shift start -->
            <br>
            <div class="portlet box blue-steel">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-list-ul"></i> Afternoon

                    </div>
                    <div class="tools">
                        <a  class="reload toggle" data-id="package_exp"></a>
                    </div>
                </div>
                <div class="controls center text-center"> 
                    <!--<div class="portlet-body" id="package_exp" style="display: none;">-->
                    <div class="portlet-body" >
                        <?php
                        echo $this->Form->create('SwapHistorie', array(
                            'inputDefaults' => array(
                                'label' => false,
                                'div' => false,
                                'id' => false
                            ),
                            'id' => 'form_sample_3',
                            'class' => 'form-horizontal',
                            'novalidate' => 'novalidate',
                            'url' => array('controller' => 'roasters', 'action' => 'setswapafternoon')
                                )
                        );
                        ?>


                        <?php
                        echo $this->Form->input('day_name', array(
                            'type' => 'hidden',
                            'value' => $name_day,
                                )
                        );
                        ?>

                        <?php
                        echo $this->Form->input('date', array(
                            'type' => 'hidden',
                            'value' => $date_s,
                                )
                        );
                        ?>

                        <?php echo $this->Session->flash(); ?>
                        <div class="col-md-12">
                            <h3> <b style="color: orange;">SWAP</b> Afternoon</h3>
                            <br><br>

                            <div class="row">
                                <label class="control-label col-md-2">
                                </label>
                                <div class="col-md-2">                                                                
                                    <?php
                                    echo $this->Form->input(
                                            'date', array(
                                        'type' => 'text',
                                        'class' => 'datepicker form-control  ',
                                        'value' => $date_s,
                                        'disabled' => 'disabled'
                                            )
                                    );
                                    ?> 
                                </div>
                                <br>
                                <br>
                            </div>
                            <div class="row">
                                <label class="control-label col-md-2">
                                </label>
                                <div class="col-md-2">                                                                
                                    <?php
                                    echo $this->Form->input('swapin1_af_by', array(
                                        'type' => 'select',
                                        'options' => $supervisor,
                                        'empty' => 'Select Supervisor',
                                        'class' => 'form-control select2me'
                                            )
                                    );
                                    ?>
                                </div>
                                <div style=" float: left; margin-top: 0px;">
                                    <label class="fa fa-arrow-left">
                                    </label>
                                    <br>
                                    <label class="fa fa-arrow-right">
                                    </label>
                                </div>
                                <div class="col-md-2">                                                                
                                    <?php
                                    echo $this->Form->input('swapin1_af_for', array(
                                        'type' => 'select',
                                        'options' => $supervisor,
                                        'empty' => 'Select Supervisor',
                                        'class' => 'form-control select2me'
                                            )
                                    );
                                    ?>
                                </div>

                                <div class="col-md-2">                                                               
                                    <?php
                                    echo $this->Form->input('swapin2_af_by', array(
                                        'type' => 'select',
                                        'options' => $supervisor,
                                        'empty' => 'Select Supervisor',
                                        'class' => 'form-control select2me pclass',
                                            )
                                    );
                                    ?>
                                </div>
                                <div style=" float: left; margin-top: 0px;">
                                    <label class="fa fa-arrow-left">
                                    </label>
                                    <br>
                                    <label class="fa fa-arrow-right">
                                    </label>
                                </div>
                                <div class="col-md-2">                                                                
                                    <?php
                                    echo $this->Form->input('swapin2_af_for', array(
                                        'type' => 'select',
                                        'options' => $supervisor,
                                        'empty' => 'Select Supervisor',
                                        'class' => 'form-control select2me'
                                            )
                                    );
                                    ?>
                                </div>
                            </div>

                            <br>
                            <hr>
                            <h3>Agent</h3>
                            <br><br>
                            <div class="row">
                                <label class="control-label col-md-2">
                                </label>
                                <div class="col-md-2">                                                                
                                    <?php
                                    echo $this->Form->input('swapa1_af_by', array(
                                        'type' => 'select',
                                        'options' => $agent,
                                        'empty' => 'Select agent',
                                        'class' => 'form-control select2me'
                                            )
                                    );
                                    ?>
                                </div>
                                <div style=" float: left; margin-top: 0px;">
                                    <label class="fa fa-arrow-left">
                                    </label>
                                    <br>
                                    <label class="fa fa-arrow-right">
                                    </label>
                                </div>
                                <div class="col-md-2">                                                                
                                    <?php
                                    echo $this->Form->input('swapa1_af_for', array(
                                        'type' => 'select',
                                        'options' => $agent,
                                        'empty' => 'Select agent',
                                        'class' => 'form-control select2me'
                                            )
                                    );
                                    ?>
                                </div>

                                <div class="col-md-2">                                                               
                                    <?php
                                    echo $this->Form->input('swapa2_af_by', array(
                                        'type' => 'select',
                                        'options' => $agent,
                                        'empty' => 'Select agent',
                                        'class' => 'form-control select2me pclass',
                                            )
                                    );
                                    ?>
                                </div>
                                <div style=" float: left; margin-top: 0px;">
                                    <label class="fa fa-arrow-left">
                                    </label>
                                    <br>
                                    <label class="fa fa-arrow-right">
                                    </label>
                                </div>
                                <div class="col-md-2">                                                                
                                    <?php
                                    echo $this->Form->input('swapa2_af_for', array(
                                        'type' => 'select',
                                        'options' => $agent,
                                        'empty' => 'Select agent',
                                        'class' => 'form-control select2me'
                                            )
                                    );
                                    ?>
                                </div>

                            </div>
                            <br>
                            <div class="row">
                                <label class="control-label col-md-2">
                                </label>
                                <div class="col-md-2">                                                                
                                    <?php
                                    echo $this->Form->input('swapa3_af_by', array(
                                        'type' => 'select',
                                        'options' => $agent,
                                        'empty' => 'Select agent',
                                        'class' => 'form-control select2me'
                                            )
                                    );
                                    ?>
                                </div>
                                <div style=" float: left; margin-top: 0px;">
                                    <label class="fa fa-arrow-left">
                                    </label>
                                    <br>
                                    <label class="fa fa-arrow-right">
                                    </label>
                                </div>
                                <div class="col-md-2">                                                                
                                    <?php
                                    echo $this->Form->input('swapa3_af_for', array(
                                        'type' => 'select',
                                        'options' => $agent,
                                        'empty' => 'Select agent',
                                        'class' => 'form-control select2me'
                                            )
                                    );
                                    ?>
                                </div>
                                <div class="col-md-2">                                                               
                                    <?php
                                    echo $this->Form->input('swapa4_af_by', array(
                                        'type' => 'select',
                                        'options' => $agent,
                                        'empty' => 'Select agent',
                                        'class' => 'form-control select2me pclass',
                                            )
                                    );
                                    ?>
                                </div>
                                <div style=" float: left; margin-top: 0px;">
                                    <label class="fa fa-arrow-left">
                                    </label>
                                    <br>
                                    <label class="fa fa-arrow-right">
                                    </label>
                                </div>
                                <div class="col-md-2">                                                                
                                    <?php
                                    echo $this->Form->input('swapa4_af_for', array(
                                        'type' => 'select',
                                        'options' => $agent,
                                        'empty' => 'Select agent',
                                        'class' => 'form-control select2me'
                                            )
                                    );
                                    ?>
                                </div>
                            </div>
                            <br> <br>
                            <label class="control-label col-md-6">
                            </label>
                            <div class="row" style="text-align: left;">
                                <?php
                                echo $this->Form->button(
                                        'Afternoon shift swap set', array('class' => 'btn green', 'type' => 'submit')
                                );
                                ?>
                            </div>
                            <br><br>
                        </div>
                    </div>
                    <?php echo $this->Form->end(); ?>
                </div>
            </div>
            <!--  Afternoon shift end -->

            <!--    Night shift start -->
            <br>
            <div class="portlet box blue-steel">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-list-ul"></i>Night

                    </div>
                    <div class="tools">
                        <a  class="reload toggle" data-id="night"></a>
                    </div>
                </div>
                <div class="controls center text-center"> 
                    <div class="portlet-body">
                        <?php
                        echo $this->Form->create('SwapHistorie', array(
                            'inputDefaults' => array(
                                'label' => false,
                                'div' => false,
                                'id' => false
                            ),
                            'id' => 'form_sample_3',
                            'class' => 'form-horizontal',
                            'novalidate' => 'novalidate',
                            'url' => array('controller' => 'roasters', 'action' => 'setswapnight')
                                )
                        );
                        ?>

                        <?php
                        echo $this->Form->input('day_name', array(
                            'type' => 'hidden',
                            'value' => $name_day,
                                )
                        );
                        ?>

                        <?php
                        echo $this->Form->input('date', array(
                            'type' => 'hidden',
                            'value' => $date_s,
                                )
                        );
                        ?>

                        <?php echo $this->Session->flash(); ?>
                        <div class="col-md-12">
                            <h3><b style="color: orange;">SWAP</b> Night</h3>
                            <br><br>
                            <br>

                            <div class="row">
                                <label class="control-label col-md-2">
                                </label>
                                <div class="col-md-2">                                                                
                                    <?php
                                    echo $this->Form->input(
                                            'date', array(
                                        'type' => 'text',
                                        'class' => 'datepicker form-control  ',
                                        'value' => $date_s,
                                        'disabled' => 'disabled'
                                            )
                                    );
                                    ?> 
                                </div>
                                <br>
                                <br>
                            </div>
                            <div class="row">
                                <label class="control-label col-md-2">
                                </label>
                                <div class="col-md-2">                                                                
                                    <?php
                                    echo $this->Form->input('swapin1_ni_by', array(
                                        'type' => 'select',
                                        'options' => $supervisor,
                                        'empty' => 'Select Supervisor',
                                        'class' => 'form-control select2me'
                                            )
                                    );
                                    ?>
                                </div>
                                <div style=" float: left; margin-top: 0px;">
                                    <label class="fa fa-arrow-left">
                                    </label>
                                    <br>
                                    <label class="fa fa-arrow-right">
                                    </label>
                                </div>
                                <div class="col-md-2">                                                                
                                    <?php
                                    echo $this->Form->input('swapin1_ni_for', array(
                                        'type' => 'select',
                                        'options' => $supervisor,
                                        'empty' => 'Select Supervisor',
                                        'class' => 'form-control select2me'
                                            )
                                    );
                                    ?>
                                </div>

                                <div class="col-md-2">                                                               
                                    <?php
                                    echo $this->Form->input('swapin2_ni_by', array(
                                        'type' => 'select',
                                        'options' => $supervisor,
                                        'empty' => 'Select Supervisor',
                                        'class' => 'form-control select2me pclass',
                                            )
                                    );
                                    ?>
                                </div>
                                <div style=" float: left; margin-top: 0px;">
                                    <label class="fa fa-arrow-left">
                                    </label>
                                    <br>
                                    <label class="fa fa-arrow-right">
                                    </label>
                                </div>
                                <div class="col-md-2">                                                                
                                    <?php
                                    echo $this->Form->input('swapin2_ni_for', array(
                                        'type' => 'select',
                                        'options' => $supervisor,
                                        'empty' => 'Select Supervisor',
                                        'class' => 'form-control select2me'
                                            )
                                    );
                                    ?>
                                </div>
                            </div>
                            <br>
                            <hr>
                            <!--<h3><b>SWAP</b> for Agent</h3>-->
                            <h3>Agent</h3>
                            <br><br>
                            <div class="row">
                                <label class="control-label col-md-2">
                                </label>
                                <div class="col-md-2">                                                                
                                    <?php
                                    echo $this->Form->input('swapa1_ni_by', array(
                                        'type' => 'select',
                                        'options' => $agent,
                                        'empty' => 'Select agent',
                                        'class' => 'form-control select2me'
                                            )
                                    );
                                    ?>
                                </div>
                                <div style=" float: left; margin-top: 0px;">
                                    <label class="fa fa-arrow-left">
                                    </label>
                                    <br>
                                    <label class="fa fa-arrow-right">
                                    </label>
                                </div>
                                <div class="col-md-2">                                                                
                                    <?php
                                    echo $this->Form->input('swapa1_ni_for', array(
                                        'type' => 'select',
                                        'options' => $agent,
                                        'empty' => 'Select agent',
                                        'class' => 'form-control select2me'
                                            )
                                    );
                                    ?>
                                </div>

                                <div class="col-md-2">                                                               
                                    <?php
                                    echo $this->Form->input('swapa2_ni_by', array(
                                        'type' => 'select',
                                        'options' => $agent,
                                        'empty' => 'Select agent',
                                        'class' => 'form-control select2me pclass',
                                            )
                                    );
                                    ?>
                                </div>
                                <div style=" float: left; margin-top: 0px;">
                                    <label class="fa fa-arrow-left">
                                    </label>
                                    <br>
                                    <label class="fa fa-arrow-right">
                                    </label>
                                </div>
                                <div class="col-md-2">                                                                
                                    <?php
                                    echo $this->Form->input('swapa2_ni_for', array(
                                        'type' => 'select',
                                        'options' => $agent,
                                        'empty' => 'Select agent',
                                        'class' => 'form-control select2me'
                                            )
                                    );
                                    ?>
                                </div>

                            </div>
                            <br>
                            <div class="row">
                                <label class="control-label col-md-2">
                                </label>
                                <div class="col-md-2">                                                                
                                    <?php
                                    echo $this->Form->input('swapa3_ni_by', array(
                                        'type' => 'select',
                                        'options' => $agent,
                                        'empty' => 'Select agent',
                                        'class' => 'form-control select2me'
                                            )
                                    );
                                    ?>
                                </div>
                                <div style=" float: left; margin-top: 0px;">
                                    <label class="fa fa-arrow-left">
                                    </label>
                                    <br>
                                    <label class="fa fa-arrow-right">
                                    </label>
                                </div>
                                <div class="col-md-2">                                                                
                                    <?php
                                    echo $this->Form->input('swapa3_ni_for', array(
                                        'type' => 'select',
                                        'options' => $agent,
                                        'empty' => 'Select agent',
                                        'class' => 'form-control select2me'
                                            )
                                    );
                                    ?>
                                </div>
                                <div class="col-md-2">                                                               
                                    <?php
                                    echo $this->Form->input('swapa4_ni_by', array(
                                        'type' => 'select',
                                        'options' => $agent,
                                        'empty' => 'Select agent',
                                        'class' => 'form-control select2me pclass',
                                            )
                                    );
                                    ?>
                                </div>
                                <div style=" float: left; margin-top: 0px;">
                                    <label class="fa fa-arrow-left">
                                    </label>
                                    <br>
                                    <label class="fa fa-arrow-right">
                                    </label>
                                </div>
                                <div class="col-md-2">                                                                
                                    <?php
                                    echo $this->Form->input('swapa4_ni_for', array(
                                        'type' => 'select',
                                        'options' => $agent,
                                        'empty' => 'Select agent',
                                        'class' => 'form-control select2me'
                                            )
                                    );
                                    ?>
                                </div>
                            </div>
                            <br> <br>
                            <label class="control-label col-md-6">
                            </label>
                            <div class="row" style="text-align: left;">
                                <?php
                                echo $this->Form->button(
                                        'Night shift swap set', array('class' => 'btn green', 'type' => 'submit')
                                );
                                ?>
                            </div>
                        </div>
                    </div>
                    <?php echo $this->Form->end(); ?>
                </div>
            </div>
            <!--  Night shift end -->
        <?php } ?>
    </div>
</div>
<!-- END CONTENT -->

