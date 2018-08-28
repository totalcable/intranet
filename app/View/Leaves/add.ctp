<style type="text/css">
    .alert {
        padding: 6px;
        margin-bottom: 5px;
        border: 1px solid transparent;
        border-radius: 4px;
        text-align: center;
    }

</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
    $(document).ready(function () {
        $('#show').click(function () {
            $('.menu').toggle("slide");
        });
    });
</script>
<div class="page-content-wrapper">
    <div class="page-content">
        <!-- BEGIN PAGE CONTENT-->


        <div class="">
            <div class="portlet-title">
                <div class="caption">
<!--                    <i class="fa fa-plus"></i>Add new employee information-->
                </div>
                <div class="tools">
                    <a href="javascript:;" class="reload">
                    </a>
                </div>
            </div>
            <div class="portlet-body form">
                <!-- BEGIN FORM-->
                <?php
                echo $this->Form->create('Leave', array(
                    'inputDefaults' => array(
                        'label' => false,
                        'div' => false
                    ),
                    'id' => 'form_sample_3',
                    'class' => 'form-horizontal',
                    'novalidate' => 'novalidate',
                    'enctype' => 'multipart/form-data',
                        )
                );
                ?>
                <div class="form-body">
                    <div class="alert alert-danger display-hide">
                        <button class="close" data-close="alert"></button>
                        You have some form errors. Please check below.
                    </div>
                    <?php echo $this->Session->flash(); ?>
                    <h2 style="text-align: center;color: green;"><b style="color: orange;">Hello <?php echo $name; ?></b>, Insert your leave information</h2><br><br>
                    <h3 style="text-align: center; color:  mediumslateblue;">Your remaning Leave <b style="text-align: center;color: red;">(<?php echo $r_l; ?>)</b></h3>
                    <div class="form-group">
                        <div class="row"><br>
                            <label class="control-label col-md-2">Form & To date<span class="required">
                                </span>
                            </label>
                            <div class="col-md-4">
                                <?php
                                echo $this->Form->input(
                                        'daterange', array(
                                    'class' => 'span9 text e1' /* e1 is past to current date, e2 is past to future date */
                                        )
                                );
                                ?>

                            </div>
                            <label class="control-label col-md-2"><span class="required">
                                </span>
                            </label>
                            <div class="col-md-4">
                                <div id="show" title="Click here for shift information">Click to Show shift information</div><br><br>
                                <div class="menu" style="display: none;">
                                    <ol>
                                        <?php
                                        foreach ($duty as $h) {
                                            $d = $h['roaster_details']['date'];
                                            $s = $h['roaster_details']['shift_name_time'];
                                            echo '<b style="color:tomato;">' . $d . ' ' . $s . '</b>' . '<br>';
                                        }
                                        ?>
                                    </ol>
                                </div>
                            </div>
                        </div>    
                        <div class="row"><br>
                            <label class="control-label col-md-2">Nature of leave<span class="required">
                                </span>
                            </label>
                            <div class="col-md-4">
                                <?php
                                echo $this->Form->input('nature_leave', array(
                                    'type' => 'select',
                                    'options' => array('c/l' => 'Casual', 'e/l' => 'Earn', 'marriage' => 'Marriage', 'maternity' => 'Mternity', 'parental' => 'Parental', 's/l' => 'Sick'),
                                    'empty' => 'Select leave nature',
                                    'class' => 'span12 uniform nostyle select1 form-control'
                                        )
                                );
                                ?>
                            </div>  
                            <label class="control-label col-md-2">Purpose<span class="required">
                                </span>
                            </label>
                            <div class="col-md-4">
                                <?php
                                echo $this->Form->input('purpose', array(
                                    'type' => 'select',
                                    'options' => array('family' => 'Family', 'personal' => 'Personal'),
                                    'empty' => 'Select purpose',
                                    'class' => 'span12 uniform nostyle select1 form-control'
                                        )
                                );
                                ?>
                            </div>
                        </div> 
                        <div class="row"><br>
                            <label class="control-label col-md-2">Comment<span class="required">
                                </span>
                            </label>
                            <div class="col-md-4">
                                <?php
                                echo $this->Form->input(
                                        'comment', array(
                                    'class' => 'form-control ',
                                    'type' => 'textarea'
                                        )
                                );
                                ?>
                            </div>  
                        </div> 
                    </div>
                </div><br><br>

                <div class="form-actions">
                    <div class="row">
                        <div class="col-md-offset-6 col-md-4">
                            <?php
                            if(!empty($r_l)){
                              echo $this->Form->button(
                                    'Save', array('class' => 'btn green', 'type' => 'submit')
                            );  
                            }                            
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END CONTENT -->

