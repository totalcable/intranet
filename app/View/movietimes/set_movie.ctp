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
                            <i class="fa fa-plus"></i>Day wise movie information
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
                        echo $this->Form->create('Mtfpc', array(
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
                                <label class="control-label col-md-3" for="required">Select Date:</label>
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

        <div class="page-content-wrapper" style="margin: 0px; padding: 0px;">
            <div class="">                   
                <!-- BEGIN PAGE CONTENT-->
                <div class="invoice"  id="printableArea">
                    <div class="row">
                        <div class="col-xs-6">                    
                        </div>
                        <div class="col-xs-4">
                        </div>
                        <div class="col-xs-2 invoice-payment">
                            <div style="text-align: left;">

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="controls center text-center">                                              
                            <h3>You can easily modify information here</h3>
                            <!--<h4 style="color: royalblue;" title="Hello today is : <?php echo $results['day_name']; ?> :-)"><?php echo $results['day_name']; ?></h4>-->

                            <br><br><br>
                            <?php
                            echo $this->Form->create('MovieHistorie', array(
                                'inputDefaults' => array(
                                    'label' => false,
                                    'div' => false,
                                    'id' => false
                                ),
                                'id' => 'form_sample_3',
                                'class' => 'form-horizontal',
                                'novalidate' => 'novalidate',
                                'url' => array('controller' => 'movietimes', 'action' => 'updatemovie_info')
                                    )
                            );
                            ?>
                            <?php
                            echo $this->Form->input('id', array(
                                'type' => 'hidden',
                                'value' => $results['id']
                                    )
                            );
                            ?>
                            <?php
                            echo $this->Form->input('day_name', array(
                                'type' => 'hidden',
                                'value' => $results['day_name']
                                    )
                            );
                            ?>
                            <?php
                            echo $this->Form->input('date', array(
                                'type' => 'hidden',
                                'value' => $date_s
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
                                   <div class="col-md-3">                                                                
                                        <?php
                                        echo $this->Form->input(
                                                'date', array(
                                            'type' => 'text',
                                            'class' => 'datepicker form-control required',
                                            'value' =>$date_s,
                                            'disabled' => 'disabled'
                                                )
                                        );
                                        ?> 
                                    </div>
                                    <br>
                                    <br>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-6">                                                                
                                                <?php
                                                echo $this->Form->input('m1t', array(
                                                    'type' => 'text',
                                                    'class' => 'form-control ',
                                                    'value' => $results['m1t']
                                                        )
                                                );
                                                ?>
                                            </div>
                                            <div class="col-md-6"> 
                                                <?php
                                                echo $this->Form->input('m1', array(
                                                    'type' => 'select',
                                                    'options' => $movie,
                                                    'value' => $results['m1'],
                                                    'class' => 'form-control select2me',
                                                        )
                                                );
                                                ?>
                                            </div>  
                                        </div><br>
                                        <div class="row">   
                                            <div class="col-md-6">                                                                
                                                <?php
                                                echo $this->Form->input('m2t', array(
                                                    'type' => 'text',
                                                    'class' => 'form-control ',
                                                    'value' => $results['m2t']
                                                        )
                                                );
                                                ?>
                                            </div>
                                            <div class="col-md-6">                                                                
                                                <?php
                                                echo $this->Form->input('m2', array(
                                                    'type' => 'select',
                                                    'class' => 'form-control ',
                                                    'options' => $movie,
                                                    'value' => $results['m2']
                                                        )
                                                );
                                                ?>
                                            </div>
                                        </div><br>
                                        <div class="row">
                                            <div class="col-md-6">                                                                
                                                <?php
                                                echo $this->Form->input('m3t', array(
                                                    'type' => 'text',
                                                    'class' => 'form-control ',
                                                    'value' => $results['m3t']
                                                        )
                                                );
                                                ?>
                                            </div>
                                            <div class="col-md-6">                                                                
                                                <?php
                                                echo $this->Form->input('m3', array(
                                                    'type' => 'select',
                                                    'class' => 'form-control ',
                                                    'options' => $movie,
                                                    'value' => $results['m3']
                                                        )
                                                );
                                                ?>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-6">                                                                
                                                <?php
                                                echo $this->Form->input('m4t', array(
                                                    'type' => 'text',
                                                    'class' => 'form-control ',
                                                    'value' => $results['m4t']
                                                        )
                                                );
                                                ?>
                                            </div>
                                            <div class="col-md-6">                                                                
                                                <?php
                                                echo $this->Form->input('m4', array(
                                                    'type' => 'select',
                                                    'class' => 'form-control ',
                                                    'options' => $movie,
                                                    'value' => $results['m4']
                                                        )
                                                );
                                                ?>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-6">                                                                
                                                <?php
                                                echo $this->Form->input('m5t', array(
                                                    'type' => 'text',
                                                    'class' => 'form-control ',
                                                    'value' => $results['m5t']
                                                        )
                                                );
                                                ?>
                                            </div>
                                            <div class="col-md-6">                                                                
                                                <?php
                                                echo $this->Form->input('m5', array(
                                                    'type' => 'select',
                                                    'class' => 'form-control ',
                                                    'options' => $movie,
                                                    'value' => $results['m5']
                                                        )
                                                );
                                                ?>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-6">                                                                
                                                <?php
                                                echo $this->Form->input('m6t', array(
                                                    'type' => 'text',
                                                    'class' => 'form-control ',
                                                    'value' => $results['m6t']
                                                        )
                                                );
                                                ?>
                                            </div>
                                            <div class="col-md-6">                                                                
                                                <?php
                                                echo $this->Form->input('m6', array(
                                                    'type' => 'select',
                                                    'class' => 'form-control ',
                                                    'options' => $movie,
                                                    'value' => $results['m6']
                                                        )
                                                );
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">  
                                        <div class="row">
                                            <div class="col-md-6">                                                                
                                                <?php
                                                echo $this->Form->input('m7t', array(
                                                    'type' => 'text',
                                                    'class' => 'form-control ',
                                                    'value' => $results['m7t']
                                                        )
                                                );
                                                ?>
                                            </div>
                                            <div class="col-md-6">                                                                
                                                <?php
                                                echo $this->Form->input('m7', array(
                                                    'type' => 'select',
                                                    'class' => 'form-control ',
                                                    'options' => $movie,
                                                    'value' => $results['m7']
                                                        )
                                                );
                                                ?>
                                            </div>
                                        </div><br>
                                        <div class="row">
                                            <div class="col-md-6">                                                                
                                                <?php
                                                echo $this->Form->input('m8t', array(
                                                    'type' => 'text',
                                                    'class' => 'form-control ',
                                                    'value' => $results['m8t']
                                                        )
                                                );
                                                ?>
                                            </div>
                                            <div class="col-md-6">                                                                
                                                <?php
                                                echo $this->Form->input('m8', array(
                                                    'type' => 'select',
                                                    'class' => 'form-control ',
                                                    'options' => $movie,
                                                    'value' => $results['m8']
                                                        )
                                                );
                                                ?>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-md-6">                                                                
                                                <?php
                                                echo $this->Form->input('m9t', array(
                                                    'type' => 'text',
                                                    'class' => 'form-control ',
                                                    'value' => $results['m9t']
                                                        )
                                                );
                                                ?>
                                            </div>
                                            <div class="col-md-6">                                                                
                                                <?php
                                                echo $this->Form->input('m9', array(
                                                    'type' => 'select',
                                                    'class' => 'form-control ',
                                                    'options' => $movie,
                                                    'value' => $results['m9']
                                                        )
                                                );
                                                ?>
                                            </div>
                                        </div>
                                        <!--                                        <br><div class="row">
                                                                                    <div class="col-md-6">                                                                
                                        <?php
                                        echo $this->Form->input('m10t', array(
                                            'type' => 'text',
                                            'class' => 'form-control ',
                                            'value' => $results['m10t']
                                                )
                                        );
                                        ?>
                                                                                    </div>
                                        
                                                                                    <div class="col-md-6">                                                                
                                        <?php
                                        echo $this->Form->input('m10', array(
                                            'type' => 'select',
                                            'class' => 'form-control ',
                                            'empty' => 'Select movie',
                                            'options' => $movie,
                                            'value' => $results['m10']
                                                )
                                        );
                                        ?>
                                                                                    </div>
                                                                                </div>
                                                                                <br>
                                                                                <div class="row">
                                                                                    <div class="col-md-6">                                                                
                                        <?php
                                        echo $this->Form->input('m11t', array(
                                            'type' => 'text',
                                            'class' => 'form-control ',
                                            'value' => $results['m11t']
                                                )
                                        );
                                        ?>
                                                                                    </div>
                                                                                    <div class="col-md-6">                                                                
                                        <?php
                                        echo $this->Form->input('m11', array(
                                            'type' => 'select',
                                            'class' => 'form-control ',
                                            'empty' => 'Select movie',
                                            'options' => $movie,
                                            'value' => $results['m11']
                                                )
                                        );
                                        ?>
                                                                                    </div>
                                                                                </div>
                                                                                <br>
                                                                                <div class="row">
                                                                                    <div class="col-md-6">                                                                
                                        <?php
                                        echo $this->Form->input('m12t', array(
                                            'type' => 'text',
                                            'class' => 'form-control ',
                                            'value' => $results['m12t']
                                                )
                                        );
                                        ?>
                                                                                    </div>
                                                                                    <div class="col-md-6">                                                                
                                        <?php
                                        echo $this->Form->input('m12', array(
                                            'type' => 'select',
                                            'class' => 'form-control ',
                                            'empty' => 'Select movie',
                                            'options' => $movie,
                                            'value' => $results['m12']
                                                )
                                        );
                                        ?>
                                                                                    </div>-->
                                    </div>
                                </div>
                                <br><br><br>
                                <div class="row">
                                    <?php
                                    echo $this->Form->button(
                                            'Set Information', array('class' => 'btn green', 'type' => 'submit')
                                    );
                                    ?>
                                </div>
                                <?php echo $this->Form->end(); ?>
                            </div>
                        </div>

                    </div>
                </div>
            </div>                             
            <?php // endif; ?>
        </div>
    </div>
    <!-- END CONTENT -->

