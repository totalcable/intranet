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
                            Daily roaster set  
                        </div>
<!--                        <div class="tools">
                            <a href="javascript:;" class="reload">
                            </a>
                                                        <a href="javascript:;" class="reload">
                                                        </a>
                        </div>-->
                    </div>
                    
                    <div class="portlet-body form">
                        <!-- BEGIN FORM-->
                        <?php
                        echo $this->Form->create('RoasterHistorie', array(
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
                            <div class="caption" style="text-align: center;">
                           <span style="color:red;"> <?php echo $this->Session->flash(); ?></span> 
                        </div>
                            <div class="alert alert-danger display-hide">
                                <button class="close" data-close="alert"></button>
                                You have some form errors. Please check below.
                            </div>
                           
                            <div class="form-group">  
                                <br>
                                <label class="control-label col-md-3" for=" ">Select date:</label>
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

                            <div class="form-group">  
                                <label class="control-label col-md-3" for=" ">Select shift :</label>
                                <div class="col-md-2">
                                    <?php
                                    echo $this->Form->input('shift', array(
                                        'type' => 'select',
                                        'options' => array('Morning (07.30 - 12.00)' => 'Morning (07.30 - 12.00)', 'Afternoon (12.00 - 20.00)' => 'Afternoon (12.00 - 20.00)', 'Night (20.00-02.00)' => 'Night (20.00-02.00)'),
                                        'empty' => 'Select Shift',
                                        'class' => 'form-control select2me required'
                                            )
                                    );
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-4 col-md-5">
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
        <?php if ($clicked): ?>  
            <div style="text-align: center;">
                
                <br>
                <div class="controls center text-center">   
                    <h3>You can easily modify information here</h3>
                    <h4 style="color: royalblue;" title="Day name is : <?php echo $name_day; ?> :-)"><?php echo $name_day; ?></h4>
                    <h5><b style="color: tomato;"><?php echo $array2[0];?></b></h5>
                    <br><br>
                    
                  
                    <?php
                    echo $this->Form->create('RoasterHistorie', array(
                        'inputDefaults' => array(
                            'label' => false,
                            'div' => false,
                            'id' => false
                        ),
                        'id' => 'form_sample_3',
                        'class' => 'form-horizontal',
                        'novalidate' => 'novalidate',
                        'enctype' => 'multipart/form-data',
                        'url' => array('controller' => 'roasters', 'action' => 'setnewroaster')
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
                    echo $this->Form->input('shift', array(
                        'type' => 'hidden',
                        'value' => $array2[0]
                            )
                    );
                    ?>
                    
                  <?php
                    echo $this->Form->input('alphabet', array(
                        'type' => 'hidden',
                        'value' => $array2[4]
                            )
                    );
                    ?>
                    <div class="form-body">
                        <div class="alert alert-danger display-hide">
                            <button class="close" data-close="alert"></button>
                            You have some form errors. Please check below.
                        </div>
                        <?php echo $this->Session->flash(); ?>
                        <div class="col-md-12">
                            <div class="row">
                                <label class="control-label col-md-2">
                                </label>
                                <div class="col-md-2">                                                                
                                    <?php
                                    echo $this->Form->input(
                                            'date.', array(
                                        'type' => 'text',
                                        'class' => 'form-control',
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
                                <label class="control-label col-md-2">Shift incharge one:
                                </label>
                                <div class="col-md-2">                                                                
                                    <?php
                                    
                                                                       
                                    echo $this->Form->input('shift_incharge_id', array(
                                        'type' => 'select',
                                        'options' => $supervisor,
                                        'value' => $array2['1'],
                                        'empty' => 'Select Shift Incharge',
                                        'class' => 'form-control select2me'
                                            )
                                    );
                                    ?>
                                </div>
                                <label class="control-label col-md-2">Shift incharge two:
                                </label>
                                <div class="col-md-2">                                                                
                                    <?php
                                    echo $this->Form->input('shift_incharge2_id', array(
                                        'type' => 'select',
                                        'options' => $supervisor,
                                        'value' => $array2[2],
                                        'empty' => 'Select Shift Incharge',
                                        'class' => 'form-control select2me'
                                            )
                                    );
                                    ?>
                                </div>
                                <label class="control-label col-md-2">Shift incharge three:
                                </label>
                                <div class="col-md-2">                                                               
                                    <?php
                                    echo $this->Form->input('shift_incharge3_id', array(
                                        'type' => 'select',
                                        'options' => $supervisor,
                                        'value' => $array2[3],
                                        'empty' => 'Select Shift Incharge',
                                        'class' => 'form-control select2me   pclass',
                                            )
                                    );
                                    ?>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <label class="control-label col-md-2">Agent one:
                                </label>
                                <div class="col-md-2">                                                                
                                    <?php
//                                                                        pr($array2[4]); exit;
                                    echo $this->Form->input('a1', array(
                                        'type' => 'select',
                                        'options' => $agent,
                                        'value' => $array2[5],
                                        'empty' => 'Select agent',
                                        'class' => 'form-control select2me'
                                            )
                                    );
                                    ?>
                                </div>
                                <label class="control-label col-md-2">Agent two:
                                </label>
                                <div class="col-md-2">                                                                
                                    <?php
                                    echo $this->Form->input('a2', array(
                                        'type' => 'select',
                                        'options' => $agent,
                                        'value' => $array2[6],
                                        'empty' => 'Select agent',
                                        'class' => 'form-control select2me'
                                            )
                                    );
                                    ?>
                                </div>
                                <label class="control-label col-md-2">Agent three:
                                </label>
                                <div class="col-md-2">                                                               
                                    <?php
                                    echo $this->Form->input('a3', array(
                                        'type' => 'select',
                                        'options' => $agent,
                                        'value' => $array2[7],
                                        'empty' => 'Select agent',
                                        'class' => 'form-control select2me ',
                                            )
                                    );
                                    ?>
                                </div>
                            </div>
                            <br>
                            <div class="row">                                    
                                <label class="control-label col-md-2">Agent four:
                                </label>
                                <div class="col-md-2">   
                                    <?php
                                    echo $this->Form->input('a4', array(
                                        'type' => 'select',
                                        'options' => $agent,
                                        'value' => $array2[8],
                                        'empty' => 'Select agent',
                                        'class' => 'form-control select2me'
                                            )
                                    );
                                    ?>
                                </div>
                                <label class="control-label col-md-2">Agent five:
                                </label>
                                <div class="col-md-2">                                                               
                                    <?php
                                    echo $this->Form->input('a5', array(
                                        'type' => 'select',
                                        'options' => $agent,
                                        'value' => $array2[9],
                                        'empty' => 'Select agent',
                                        'class' => 'form-control select2me   pclass',
                                            )
                                    );
                                    ?>
                                </div>

                                <label class="control-label col-md-2">Agent six:
                                </label>
                                <div class="col-md-2">                                                               
                                    <?php
                                    echo $this->Form->input('a6', array(
                                        'type' => 'select',
                                        'options' => $agent,
                                        'value' => $array2[10],
                                        'empty' => 'Select agent',
                                        'class' => 'form-control select2me   pclass',
                                            )
                                    );
                                    ?>
                                </div>
                            </div>
                            <br>
                            <div class="row"> 
                                <label class="control-label col-md-2">Agent seven:
                                </label>
                                <div class="col-md-2">                                                               
                                    <?php
                                    echo $this->Form->input('a7', array(
                                        'type' => 'select',
                                        'options' => $agent,
                                        'value' => $array2[11],
                                        'empty' => 'Select agent',
                                        'class' => 'form-control select2me   pclass',
                                            )
                                    );
                                    ?>
                                </div>

                                <label class="control-label col-md-2">Agent eight:
                                </label>
                                <div class="col-md-2">                                                               
                                    <?php
                                    echo $this->Form->input('a8', array(
                                        'type' => 'select',
                                        'options' => $agent,
                                        'value' => $array2[12],
                                        'empty' => 'Select agent',
                                        'class' => 'form-control select2me   pclass',
                                            )
                                    );
                                    ?>
                                </div>
                                <label class="control-label col-md-2">Agent nine:
                                </label>
                                <div class="col-md-2">                                                               
                                    <?php
                                    echo $this->Form->input('a9', array(
                                        'type' => 'select',
                                        'options' => $agent,
                                        'value' => $array2[13],
                                        'empty' => 'Select agent',
                                        'class' => 'form-control select2me   pclass',
                                            )
                                    );
                                    ?>
                                </div>
                            </div>
                            <br> 
                            <div class="row"> 
                                <label class="control-label col-md-2">Agent ten:
                                </label>
                                <div class="col-md-2">                                                               
                                    <?php
                                    echo $this->Form->input('a10', array(
                                        'type' => 'select',
                                        'options' => $agent,
                                        'value' => $array2[14],
                                        'empty' => 'Select agent',
                                        'class' => 'form-control select2me   pclass',
                                            )
                                    );
                                    ?>
                                </div>
                                <label class="control-label col-md-2">Agent eleven:
                                </label>
                                <div class="col-md-2">                                                               
                                    <?php
                                    echo $this->Form->input('a11', array(
                                        'type' => 'select',
                                        'options' => $agent,
                                        'value' => !empty($array2[15]),
                                        'empty' => 'Select agent',
                                        'class' => 'form-control select2me pclass',
                                            )
                                    );
                                    ?>
                                </div>
                                <label class="control-label col-md-2">
                                    <a target="_blank" title="Click here for set swap :-)" href="<?php echo Router::url(array('controller' => 'roasters', 'action' => 'set_swap')) ?>" class="fancybox-fast-view" style="overflow: -webkit-paged-x;">
                                        Swap
                                    </a> 
                                </label>
                            </div>
                            <br>
                            <br>
                            <div class="row" style="text-align: center;">
                                <?php
                                echo $this->Form->button(
                                        'Update information', array('class' => 'btn green', 'type' => 'submit')
                                );
                                ?>
                            </div>
                        </div>
                    </div>
                    <br><br>
                    <?php echo $this->Form->end(); ?>
                </div>
                <br>
            </div>
        <?php endif; ?>
    </div>

