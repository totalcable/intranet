
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

    .center{
        text-align: center;
    }
</style>

<div class="page-content-wrapper">
    <div class="page-content">
        <div class="page-content-wrapper" style="margin: 0px; padding: 0px;">
            <div class="">                   
                <!-- BEGIN PAGE CONTENT-->
                <br>
                <div class="row">
                    <div class="col-xs-4">                    
                    </div>
                    <div class="col-xs-4">
                        <div style="text-align: center;">
                            <h2><?php echo $mon; ?> Duty</h2>
                            <h3 style="color: blue;">Call Center</h3>
                            <!--<a title="Click here for add new data" href="#product-pop-up" class="fancybox-fast-view" style="overflow: -webkit-paged-x;">Add new </a>-->

                            <!--                             pop up for data add start 
                                                        <div id="product-pop-up" style="overflow: -webkit-paged-x;display: none; height: 615px; width: 900px;">
                                                            <div class="product-page product-pop-up">
                                                                <div class="row">
                                                                    <div class="controls center text-center">                                              
                                                                        <h3>You can add new record here :-)</h3><br><br><br>
                            <?php
                            echo $this->Form->create('StaticRoaster', array(
                                'inputDefaults' => array(
                                    'label' => false,
                                    'div' => false,
                                    'id' => false
                                ),
                                'id' => 'form_sample_3',
                                'class' => 'form-horizontal',
                                'novalidate' => 'novalidate',
                                'url' => array('controller' => 'roasters', 'action' => 'add')
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
                                                                                    <div class="col-md-3">                                                                
                            <?php
                            echo $this->Form->input('m1', array(
                                'type' => 'text',
                                'class' => 'form-control ',
                                'placeholder' => 'Write info'
                                    )
                            );
                            ?>
                                                                                    </div>
                            
                                                                                    <div class="col-md-3">                                                                
                            <?php
                            echo $this->Form->input('m1t', array(
                                'type' => 'text',
                                'class' => 'form-control ',
                                'placeholder' => '00:00:00'
                                    )
                            );
                            ?>
                                                                                    </div>
                            
                                                                                    <div class="col-md-3">                                                                
                            <?php
                            echo $this->Form->input('m2', array(
                                'type' => 'text',
                                'class' => 'form-control ',
                                'placeholder' => 'Write info'
                                    )
                            );
                            ?>
                                                                                    </div>
                            
                                                                                    <div class="col-md-3">                                                                
                            <?php
                            echo $this->Form->input('m2t', array(
                                'type' => 'text',
                                'class' => 'form-control ',
                                'placeholder' => '00:00:00'
                                    )
                            );
                            ?>
                                                                                    </div>
                                                                                </div><br>
                            
                                                                                <div class="row">
                                                                                    <div class="col-md-3">                                                                
                            <?php
                            echo $this->Form->input('m3', array(
                                'type' => 'text',
                                'class' => 'form-control ',
                                'placeholder' => 'Write info'
                                    )
                            );
                            ?>
                                                                                    </div>
                            
                                                                                    <div class="col-md-3">                                                                
                            <?php
                            echo $this->Form->input('m3t', array(
                                'type' => 'text',
                                'class' => 'form-control ',
                                'placeholder' => '00:00:00'
                                    )
                            );
                            ?>
                                                                                    </div>
                            
                                                                                    <div class="col-md-3">                                                                
                            <?php
                            echo $this->Form->input('m4', array(
                                'type' => 'text',
                                'class' => 'form-control ',
                                'placeholder' => 'Write info'
                                    )
                            );
                            ?>
                                                                                    </div>
                            
                                                                                    <div class="col-md-3">                                                                
                            <?php
                            echo $this->Form->input('m4t', array(
                                'type' => 'text',
                                'class' => 'form-control ',
                                'placeholder' => '00:00:00'
                                    )
                            );
                            ?>
                                                                                    </div>
                                                                                </div>
                            
                                                                                <br>
                                                                                <div class="row">
                                                                                    <div class="col-md-3">                                                                
                            <?php
                            echo $this->Form->input('m5', array(
                                'type' => 'text',
                                'class' => 'form-control ',
                                'placeholder' => 'Write info'
                                    )
                            );
                            ?>
                                                                                    </div>
                            
                                                                                    <div class="col-md-3">                                                                
                            <?php
                            echo $this->Form->input('m5t', array(
                                'type' => 'text',
                                'class' => 'form-control ',
                                'placeholder' => '00:00:00'
                                    )
                            );
                            ?>
                                                                                    </div>
                            
                                                                                    <div class="col-md-3">                                                                
                            <?php
                            echo $this->Form->input('m6', array(
                                'type' => 'text',
                                'class' => 'form-control ',
                                'placeholder' => 'Write info'
                                    )
                            );
                            ?>
                                                                                    </div>
                            
                                                                                    <div class="col-md-3">                                                                
                            <?php
                            echo $this->Form->input('m6t', array(
                                'type' => 'text',
                                'class' => 'form-control ',
                                'placeholder' => '00:00:00'
                                    )
                            );
                            ?>
                                                                                    </div>
                                                                                </div>
                            
                                                                                <br>
                                                                                <div class="row">
                                                                                    <div class="col-md-3">                                                                
                            <?php
                            echo $this->Form->input('m7', array(
                                'type' => 'text',
                                'class' => 'form-control ',
                                'placeholder' => 'Write info'
                                    )
                            );
                            ?>
                                                                                    </div>
                            
                                                                                    <div class="col-md-3">                                                                
                            <?php
                            echo $this->Form->input('m7t', array(
                                'type' => 'text',
                                'class' => 'form-control ',
                                'placeholder' => '00:00:00'
                                    )
                            );
                            ?>
                                                                                    </div>
                            
                                                                                    <div class="col-md-3">                                                                
                            <?php
                            echo $this->Form->input('m8', array(
                                'type' => 'text',
                                'class' => 'form-control ',
                                'placeholder' => 'Write info'
                                    )
                            );
                            ?>
                                                                                    </div>
                            
                                                                                    <div class="col-md-3">                                                                
                            <?php
                            echo $this->Form->input('m8t', array(
                                'type' => 'text',
                                'class' => 'form-control ',
                                'placeholder' => '00:00:00'
                                    )
                            );
                            ?>
                                                                                    </div>
                                                                                </div>
                            
                                                                                <br>
                                                                                <div class="row">
                                                                                    <div class="col-md-3">                                                                
                            <?php
                            echo $this->Form->input('m9', array(
                                'type' => 'text',
                                'class' => 'form-control ',
                                'placeholder' => 'Write info'
                                    )
                            );
                            ?>
                                                                                    </div>
                            
                                                                                    <div class="col-md-3">                                                                
                            <?php
                            echo $this->Form->input('m9t', array(
                                'type' => 'text',
                                'class' => 'form-control ',
                                'placeholder' => '00:00:00'
                                    )
                            );
                            ?>
                                                                                    </div>
                            
                                                                                    <div class="col-md-3">                                                                
                            <?php
                            echo $this->Form->input('m10', array(
                                'type' => 'text',
                                'class' => 'form-control ',
                                'placeholder' => 'Write info'
                                    )
                            );
                            ?>
                                                                                    </div>
                            
                                                                                    <div class="col-md-3">                                                                
                            <?php
                            echo $this->Form->input('m10t', array(
                                'type' => 'text',
                                'class' => 'form-control ',
                                'placeholder' => '00:00:00'
                                    )
                            );
                            ?>
                                                                                    </div>
                                                                                </div>
                            
                                                                                <br>
                                                                                <div class="row">
                                                                                    <div class="col-md-3">                                                                
                            <?php
                            echo $this->Form->input('m11', array(
                                'type' => 'text',
                                'class' => 'form-control ',
                                'placeholder' => 'Write info'
                                    )
                            );
                            ?>
                                                                                    </div>
                            
                                                                                    <div class="col-md-3">                                                                
                            <?php
                            echo $this->Form->input('m11t', array(
                                'type' => 'text',
                                'class' => 'form-control ',
                                'placeholder' => '00:00:00'
                                    )
                            );
                            ?>
                                                                                    </div>
                            
                                                                                    <div class="col-md-3">                                                                
                            <?php
                            echo $this->Form->input('m11', array(
                                'type' => 'text',
                                'class' => 'form-control ',
                                'placeholder' => 'Write info'
                                    )
                            );
                            ?>
                                                                                    </div>
                            
                                                                                    <div class="col-md-3">                                                                
                            <?php
                            echo $this->Form->input('m12t', array(
                                'type' => 'text',
                                'class' => 'form-control ',
                                'placeholder' => '00:00:00'
                                    )
                            );
                            ?>
                                                                                    </div>
                                                                                </div>
                                                                            </div><br>
                                                                        </div><br>
                                                                        <div class="row">
                            <?php
                            echo $this->Form->button(
                                    'Save', array('class' => 'btn green', 'type' => 'submit')
                            );
                            ?>
                                                                        </div>
                            <?php echo $this->Form->end(); ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                         pop up for data add end   -->
                        </div>
                    </div>
                    <div class="col-xs-4 ">

                    </div>
                </div>
                <br>
                <br>
                <br>
                <div class="row">
                    <div class="col-xs-12">
                        <table class="table table-striped table-hover table-bordered" id="sample_editable_1">
                            <thead>
                                <tr>  
                                    <th> EMP ID</th>
                                    <th> Name</th>
                                    <th> Total Duty</th>                                   
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($roaster_duty as $data):
                                    //pr($data); exit;
                                    $results = $data['roaster_details'];
                                    $us = $data['users'];
                                    ?>                               
                                    <tr>
                                        <td class="hidden-480">                                             
                                            <?php echo $data['roaster_details']['user_id']; ?> 
                                        </td>

                                        <td class="hidden-480">
                                            <?php echo $us['name']; ?> 
                                        </td>

                                        <td class="hidden-480">
                                            <a target="_blank" title="Click here for roaster :-)" href="<?php echo Router::url(array('controller' => 'roasters', 'action' => 'emp_duty_detail', $data['roaster_details']['user_id'])) ?>" class="fancybox-fast-view" style="overflow: -webkit-paged-x;">
                                                <?php echo $data[0]['total_duty']; ?> 
                                            </a> 
                                        </td>                                                                               
                                    </tr>                                  
                                <?php endforeach; ?> 
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>                             
    </div>
</div>
<!-- END CONTENT -->

