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
                            <i class="fa fa-plus"></i>Day roaster set
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
        <?php // if ($clicked): ?>  


        <div style="text-align: center;">
            <br>
            <div class="controls center text-center">   
                <?php
                if (!empty($datas['static_roasters'])) {
                    $results = $datas['static_roasters'];
//                    pr($results); exit;
                    $convert_date = strtotime($results['day_name']);
                    $name_day = date('l', $convert_date);
                } else {
                    $results = $datas['roasters_histories'];
                }
//                                                    pr($datas)   ; exit;                         


                $shift_incharge = $datas['users'];
                $shift_incharge2 = $datas['u2'];
                $shift_incharge3 = $datas['u3'];

                $afshift_incharge = $datas['af'];
                $afshift_incharge2 = $datas['afu2'];
                $afshift_incharge3 = $datas['afu3'];

                $nishift_incharge = $datas['ni'];
                $nishift_incharge2 = $datas['niu2'];
                $nishift_incharge3 = $datas['niu3'];

                $a1 = $datas['a1'];
                $a2 = $datas['a2'];
                $a3 = $datas['a3'];
                $a4 = $datas['a4']['name'];
                $a5 = $datas['a5'];
                $a6 = $datas['a6'];
                $a7 = $datas['a7'];
                $a8 = $datas['a8'];
                $a9 = $datas['a9'];
                $a10 = $datas['a10'];
                ?>
                <h3>You can easily modify information here</h3>
                <h4 style="color: royalblue;" title="Day name is : <?php echo $results['day_name']; ?> :-)"><?php echo $results['day_name']; ?></h4>
                  
             
                <h5>Morning</h5>
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
                    'url' => array('controller' => 'roasters', 'action' => 'setnewroastermorning')
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
                    'value' => $results['day_name'],
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
                echo $this->Form->input('shift_name_time', array(
                    'type' => 'hidden',
                    'value' => $results['shift_name_time'],
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
                            <label class="control-label col-md-2">Sift incharge one:
                            </label>
                            <div class="col-md-2">                                                                
                                <?php
                                echo $this->Form->input('shift_incharge_id', array(
                                    'type' => 'select',
                                    'options' => $supervisor,
                                    'value' => $shift_incharge,
                                    'empty' => 'Select Sift Incharge',
                                    'class' => 'form-control select2me'
                                        )
                                );
                                ?>
                            </div>
                            <label class="control-label col-md-2">Sift incharge two:
                            </label>
                            <div class="col-md-2">                                                                
                                <?php
                                echo $this->Form->input('shift_incharge2_id', array(
                                    'type' => 'select',
                                    'options' => $supervisor,
                                    'value' => $shift_incharge2,
                                    'empty' => 'Select Sift Incharge',
                                    'class' => 'form-control select2me'
                                        )
                                );
                                ?>
                            </div>
                            <label class="control-label col-md-2">Sift incharge three:
                            </label>
                            <div class="col-md-2">                                                               
                                <?php
                                echo $this->Form->input('shift_incharge3_id', array(
                                    'type' => 'select',
                                    'options' => $supervisor,
                                    'value' => $shift_incharge3,
                                    'empty' => 'Select Sift Incharge',
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
                                echo $this->Form->input('a1_id', array(
                                    'type' => 'select',
                                    'options' => $agent,
                                    'value' => $results['a1_id'],
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
                                    'value' => $results['a2'],
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
                                    'value' => $results['a3'],
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
                                    'value' => $results['a4'],
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
                                    'value' => $results['a5'],
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
                                    'value' => $results['a6'],
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
                                    'value' => $results['a7'],
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
                                    'value' => $results['a8'],
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
                                    'value' => $results['a9'],
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
                                    'value' => $results['a10'],
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
                                    'value' => $results['a11'],
                                    'empty' => 'Select agent',
                                    'class' => 'form-control select2me   pclass',
                                        )
                                );
                                ?>
                            </div>
                            <label class="control-label col-md-2">
                                <a target="_blank" title="Click here for set swap :-)" href="<?php echo Router::url(array('controller' => 'roasters', 'action' => 'set_swap')) ?>" class="fancybox-fast-view" style="overflow: -webkit-paged-x;">
                                    Swap Morning
                                </a> 
                            </label>
                        </div>
                        <br>
                        <br>
                                             
                        <div class="row" style="text-align: center;">
                            <?php
                            echo $this->Form->button(
                                    'Update morning information', array('class' => 'btn green', 'type' => 'submit')
                            );
                            ?>
                        </div>
                       
                    </div>
                 <!--    <?php// }?>-->
                </div>
                <br><br>
                <?php echo $this->Form->end(); ?>
            </div>

            <!--    Afternoon shift start -->
            <br>
             
            <div class="portlet box blue-steel">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-list-ul"></i>Afternoon
                    </div>
                    <div class="tools">
                        <a  class="reload toggle" data-id="package_exp"></a>
                    </div>
                </div>
                <div class="controls center text-center"> 
                    <!--<div class="portlet-body" id="package_exp" style="display: none;">-->
                    <div class="portlet-body" >
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
                            'url' => array('controller' => 'roasters', 'action' => 'setnewroasterafternoon')
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
                            'value' => $results['day_name'],
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
                            <h3>Afternoon</h3>
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
                                <label class="control-label col-md-2">Shift incharge one:
                                </label>
                                <div class="col-md-2">                                                                
                                    <?php
                                    echo $this->Form->input('afshift_incharge_id', array(
                                        'type' => 'select',
                                        'options' => $supervisor,
                                        'value' => $afshift_incharge,
                                        'empty' => 'Select Supervisor',
                                        'class' => 'form-control select2me'
                                            )
                                    );
                                    ?>
                                </div>
                                <label class="control-label col-md-2">Shift incharge two:
                                </label>
                                <div class="col-md-2">                                                                
                                    <?php
                                    echo $this->Form->input('afshift_incharge2_id', array(
                                        'type' => 'select',
                                        'options' => $supervisor,
                                        'value' => $afshift_incharge2,
                                        'empty' => 'Select Supervisor',
                                        'class' => 'form-control select2me'
                                            )
                                    );
                                    ?>
                                </div>
                                <label class="control-label col-md-2">Shift incharge three:
                                </label>
                                <div class="col-md-2">                                                               
                                    <?php
                                    echo $this->Form->input('afshift_incharge3_id', array(
                                        'type' => 'select',
                                        'options' => $supervisor,
                                        'value' => $afshift_incharge3,
                                        'empty' => 'Select Supervisor',
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
                                    echo $this->Form->input('afa1_id', array(
                                        'type' => 'select',
                                        'options' => $agent,
                                        'value' => $results['afa1_id'],
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
                                    echo $this->Form->input('afa2', array(
                                        'type' => 'select',
                                        'options' => $agent,
                                        'value' => $results['afa2'],
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
                                    echo $this->Form->input('afa3', array(
                                        'type' => 'select',
                                        'options' => $agent,
                                        'value' => $results['afa3'],
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
                                    echo $this->Form->input('afa4', array(
                                        'type' => 'select',
                                        'options' => $agent,
                                        'value' => $results['afa4'],
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
                                    echo $this->Form->input('afa5', array(
                                        'type' => 'select',
                                        'options' => $agent,
                                        'value' => $results['afa5'],
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
                                    echo $this->Form->input('afa6', array(
                                        'type' => 'select',
                                        'options' => $agent,
                                        'value' => $results['afa6'],
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
                                    echo $this->Form->input('afa7', array(
                                        'type' => 'select',
                                        'options' => $agent,
                                        'value' => $results['afa7'],
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
                                    echo $this->Form->input('afa8', array(
                                        'type' => 'select',
                                        'options' => $agent,
                                        'value' => $results['afa8'],
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
                                    echo $this->Form->input('afa9', array(
                                        'type' => 'select',
                                        'options' => $agent,
                                        'value' => $results['afa9'],
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
                                    echo $this->Form->input('afa10', array(
                                        'type' => 'select',
                                        'options' => $agent,
                                        'value' => $results['afa10'],
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
                                    echo $this->Form->input('afa11', array(
                                        'type' => 'select',
                                        'options' => $agent,
                                        'value' => $results['afa11'],
                                        'empty' => 'Select agent',
                                        'class' => 'form-control select2me   pclass',
                                            )
                                    );
                                    ?>
                                </div>
                                <label class="control-label col-md-2">
                                    <a target="_blank" title="Click here for set swap :-)" href="<?php echo Router::url(array('controller' => 'roasters', 'action' => 'set_swap')) ?>" class="fancybox-fast-view" style="overflow: -webkit-paged-x;">
                                        Swap Afternoon
                                    </a> 
                                </label>
                            </div>
                            <br>
                            <br>
                             
                            <div class="row" style="text-align: center;">
                                <?php
                                echo $this->Form->button(
                                        'Update afternoon Information', array('class' => 'btn green', 'type' => 'submit')
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
                    <!--<div class="portlet-body" id="night" style="display: none;">-->
                    <div class="portlet-body">
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
                            'url' => array('controller' => 'roasters', 'action' => 'setnewroasternight')
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
                            'value' => $results['day_name'],
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
                            <h3>Night</h3>
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
                                <label class="control-label col-md-2">Sift incharge one:
                                </label>
                                <div class="col-md-2">                                                                
                                    <?php
                                    echo $this->Form->input('nishift_incharge_id', array(
                                        'type' => 'select',
                                        'options' => $supervisor,
                                        'value' => $nishift_incharge,
                                        'empty' => 'Select Supervisor',
                                        'class' => 'form-control select2me'
                                            )
                                    );
                                    ?>
                                </div>
                                <label class="control-label col-md-2">Sift incharge two:
                                </label>
                                <div class="col-md-2">                                                                
                                    <?php
                                    echo $this->Form->input('nishift_incharge2_id', array(
                                        'type' => 'select',
                                        'options' => $supervisor,
                                        'value' => $nishift_incharge2,
                                        'empty' => 'Select Supervisor',
                                        'class' => 'form-control select2me'
                                            )
                                    );
                                    ?>
                                </div>
                                <label class="control-label col-md-2">Sift incharge three:
                                </label>
                                <div class="col-md-2">                                                               
                                    <?php
                                    echo $this->Form->input('nishift_incharge3_id', array(
                                        'type' => 'select',
                                        'options' => $supervisor,
                                        'value' => $nishift_incharge3,
                                        'empty' => 'Select Supervisor',
                                        'class' => 'form-control select2me pclass',
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
                                    echo $this->Form->input('nia1_id', array(
                                        'type' => 'select',
                                        'options' => $agent,
                                        'value' => $results['nia1_id'],
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
                                    echo $this->Form->input('nia2', array(
                                        'type' => 'select',
                                        'options' => $agent,
                                        'value' => $results['nia2'],
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
                                    echo $this->Form->input('nia3', array(
                                        'type' => 'select',
                                        'options' => $agent,
                                        'value' => $results['nia3'],
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
                                    echo $this->Form->input('nia4', array(
                                        'type' => 'select',
                                        'options' => $agent,
                                        'value' => $results['nia4'],
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
                                    echo $this->Form->input('nia5', array(
                                        'type' => 'select',
                                        'options' => $agent,
                                        'value' => $results['nia5'],
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
                                    echo $this->Form->input('nia6', array(
                                        'type' => 'select',
                                        'options' => $agent,
                                        'value' => $results['nia6'],
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
                                    echo $this->Form->input('nia7', array(
                                        'type' => 'select',
                                        'options' => $agent,
                                        'value' => $results['nia7'],
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
                                    echo $this->Form->input('nia8', array(
                                        'type' => 'select',
                                        'options' => $agent,
                                        'value' => $results['nia8'],
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
                                    echo $this->Form->input('nia9', array(
                                        'type' => 'select',
                                        'options' => $agent,
                                        'value' => $results['nia9'],
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
                                    echo $this->Form->input('nia10', array(
                                        'type' => 'select',
                                        'options' => $agent,
                                        'value' => $results['nia10'],
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
                                    echo $this->Form->input('nia11', array(
                                        'type' => 'select',
                                        'options' => $agent,
                                        'value' => $results['nia11'],
                                        'empty' => 'Select agent',
                                        'class' => 'form-control select2me   pclass',
                                            )
                                    );
                                    ?>
                                </div>
                                <label class="control-label col-md-2">
                                    <a target="_blank" title="Click here for set swap :-)" href="<?php echo Router::url(array('controller' => 'roasters', 'action' => 'set_swap')) ?>" class="fancybox-fast-view" style="overflow: -webkit-paged-x;">
                                        Swap Night
                                    </a> 
                                </label>
                            </div>
                            <br>
                            <br>                             
                            <div class="row" style="text-align: center;">
                                <?php
                                echo $this->Form->button(
                                        'Update night Information', array('class' => 'btn green', 'type' => 'submit')
                                );
                                ?>
                            </div>                            
                        </div>
                    </div>
                    <?php echo $this->Form->end(); ?>
                </div>
            </div>
         
            <!--  Night shift end -->
        </div>          




    </div>
    <!-- END CONTENT -->

