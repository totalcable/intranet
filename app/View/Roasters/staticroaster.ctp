
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
                            <h2>Static Roaster</h2>
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
                                    <th>
                                        <?php echo 'SL'; ?> 
                                    </th>

                                    <th>
                                        <?php echo 'Day Name'; ?> 
                                    </th>

                                    <th>
                                        <?php echo 'Shift One'; ?> 
                                    </th> 

                                    <th>
                                        <?php echo 'Shift Two'; ?> 
                                    </th> 

                                    <th>
                                        <?php echo 'Shift Three'; ?> 
                                    </th> 

                                    <th>
                                        <?php echo 'Shift incharge one'; ?> 
                                    </th>

                                    <th>
                                        <?php echo 'Shift incharge two'; ?> 
                                    </th>

                                    <th>
                                        <?php echo 'Shift incharge three'; ?> 
                                    </th> 

                                    <th>
                                        <?php echo 'Agent 1'; ?> 
                                    </th>

                                    <th>
                                        <?php echo 'Agent 2'; ?> 
                                    </th> 

                                    <th>
                                        <?php echo 'Agent 3'; ?> 
                                    </th> 

                                    <th>
                                        <?php echo 'Agent 4'; ?> 
                                    </th> 

                                    <th>
                                        <?php echo 'Agent 5'; ?> 
                                    </th> 

                                    <th>
                                        <?php echo 'Agent 6'; ?> 
                                    </th> 

                                    <th>
                                        <?php echo 'Agent 7'; ?> 
                                    </th> 

                                    <th>
                                        <?php echo 'Agent 8'; ?> 
                                    </th> 

                                    <th>
                                        <?php echo 'Agent 9'; ?> 
                                    </th> 

<!--                                    <th>
                                    <?php echo 'Agent 10'; ?> 
                                    </th> 

                                    <th>
                                    <?php echo 'Agent 11'; ?> 
                                    </th> -->
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($datas as $data):
//                                    pr($data['afa1']['name']); exit;
                                    $results = $data['static_roasters'];

                                    $shift_incharge = $data['users'];
                                    $shift_incharge2 = $data['u2'];
                                    $shift_incharge3 = $data['u3'];

                                    $afshift_incharge = $data['af'];
                                    $afshift_incharge2 = $data['afu2'];
                                    $afshift_incharge3 = $data['afu3'];

                                    $nishift_incharge = $data['ni'];
                                    $nishift_incharge2 = $data['niu2'];
                                    $nishift_incharge3 = $data['niu3'];

                                    $a1 = $data['a1'];
                                    $a2 = $data['a2'];
                                    $a3 = $data['a3'];
                                    $a4 = $data['a4'];
                                    $a5 = $data['a5'];
                                    $a6 = $data['a6'];
                                    $a7 = $data['a7'];
                                    $a8 = $data['a8'];
                                    $a9 = $data['a9'];
                                    $a10 = $data['a10'];
                                    $a11 = $data['a11'];
                                    ?>                               
                                    <tr>
                                        <td class="hidden-480">                                             
                                            <a target="_blank" title="Click here for update data :-)" href="<?php echo Router::url(array('controller' => 'roasters', 'action' => 'roaster_edit', $results['id'])) ?>" class="fancybox-fast-view" style="overflow: -webkit-paged-x;">
                                                <?php echo $results['id']; ?> 
                                            </a>                                           

                                        </td>
                                        <td class="hidden-480">
                                            <a title="Click here for update data :-)" href="#product-pop-up<?php echo $results['id']; ?>" class="fancybox-fast-view" style="overflow: -webkit-paged-x;">
                                                <?php
//                                                $convert_date = strtotime($results['date']);
//                                                $name_day = date('l', $convert_date);
//                                                echo $name_day;
                                                echo $results['day_name'];
                                                ?> 
                                            </a>
                                            <!-- pop up for data change start -->
                                            <div id="product-pop-up<?php echo $results['id']; ?>" style="overflow: -webkit-paged-x; display: none; height: auto; width: auto;">
                                                <div class="product-page product-pop-up">
                                                    <div class="row">
                                                        <!--<h3>You can easily modify information here</h3>-->
                                                        <h4 style="color: royalblue; text-align: center;" title="Hello today is : <?php echo $results['day_name']; ?> :-)"><?php echo $results['day_name']; ?></h4>

                                                        <table class="table table-striped table-hover table-bordered" id="sample_editable_1" style="width: 751px; margin: 31px 31px 31px 31px; ">
                                                            <thead>
                                                                <tr style=" background-color: lightsteelblue; text-align: center;">  
                                                                    <th class="center">
                                                                        <?php echo $data1['shift_name_time']; ?> 
                                                                    </th>

                                                                    <th class="center">
                                                                        <?php echo $data1['afshift_name_time2']; ?> 
                                                                    </th> 

                                                                    <th class="center">
                                                                        <?php echo $data1['nishift_name_time3']; ?> 
                                                                    </th> 
                                                                </tr>
                                                            </thead>
                                                            <tbody >
                                                                <tr>
                                                                    <td class="hidden-480" style=" line-height: 31px; background-color: palegreen;">
                                                                        <?php if (!empty($shift_incharge['name'])) { ?> 
                                                                            Incharge One : <b><?php echo $shift_incharge['name']; ?></b> <br>
                                                                            <?php if (!empty($shift_incharge2['name'])) { ?> 
                                                                                Incharge Two :    <b><?php echo $shift_incharge2['name']; ?></b> <br>
                                                                            <?php } ?> 

                                                                            <?php if (!empty($shift_incharge3['name'])) { ?> 
                                                                                Incharge Three : <b><?php echo $shift_incharge3['name']; ?></b> <br>
                                                                            <?php } ?>
                                                                        <?php } ?> 
                                                                    </td>

                                                                    <td class="hidden-480" style=" line-height: 31px; background-color: palegreen;"> 
                                                                        <?php if (!empty($afshift_incharge['name'])) { ?> 

                                                                            <?php if (!empty($afshift_incharge['name'])) { ?> 
                                                                                Incharge One : <b><?php echo $afshift_incharge['name']; ?></b> <br>
                                                                            <?php } ?> 

                                                                            <?php if (!empty($afshift_incharge2['name'])) { ?> 
                                                                                Incharge Two : <b><?php echo $afshift_incharge2['name']; ?></b> <br>
                                                                            <?php } ?> 

                                                                            <?php if (!empty($afshift_incharge3['name'])) { ?> 
                                                                                Incharge Three : <b><?php echo $shift_incharge3['name']; ?></b> <br>
                                                                            <?php } ?> 
                                                                        <?php } ?> 
                                                                    </td>

                                                                    <td class="hidden-480" style=" line-height: 31px; background-color: palegreen;"> 
                                                                        <?php if (!empty($nishift_incharge['name'])) { ?> 
                                                                            <?php if (!empty($nishift_incharge['name'])) { ?> 
                                                                                Incharge One : <b><?php echo $nishift_incharge['name']; ?></b> <br>
                                                                            <?php } ?> 
                                                                            <?php if (!empty($nishift_incharge2['name'])) { ?> 
                                                                                Incharge Two : <b><?php echo $nishift_incharge2['name']; ?></b> <br>
                                                                            <?php } ?> 
                                                                            <?php if (!empty($nishift_incharge3['name'])) { ?> 
                                                                                Incharge Three : <b><?php echo $nishift_incharge3['name']; ?></b> <br>
                                                                            <?php } ?>                                                                                 

                                                                        <?php } ?> 
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <?php if (!empty($a1['name'])) { ?> 
                                                                        <td> <?php echo $a1['name']; ?> </td>
                                                                    <?php } ?>

                                                                    <?php if (!empty($data['afa1']['name'])) { ?> 
                                                                        <td> <?php echo $data['afa1']['name']; ?> </td>
                                                                    <?php } ?>

                                                                    <?php if (!empty($data['nia1']['name'])) { ?> 
                                                                        <td> <?php echo $data['nia1']['name']; ?> </td>
                                                                    <?php } ?>
                                                                </tr>

                                                                <tr>
                                                                    <?php if (!empty($a2['name'])) { ?> 
                                                                        <td> <?php echo $a2['name']; ?> </td>
                                                                    <?php } ?>  

                                                                    <?php if (!empty($data['afa2']['name'])) { ?> 
                                                                        <td> <?php echo $data['afa2']['name']; ?> </td>
                                                                    <?php } ?>    

                                                                    <?php if (!empty($data['nia2']['name'])) { ?> 
                                                                        <td><?php echo $data['nia2']['name']; ?></td>
                                                                    <?php } ?>  
                                                                </tr>
                                                                <tr>
                                                                    <td> 
                                                                        <?php if (!empty($a3['name'])) { ?>
                                                                            <?php echo $a3['name']; ?>  
                                                                        <?php } ?>  
                                                                    </td>
                                                                    <td>
                                                                        <?php if (!empty($data['afa3']['name'])) { ?> 
                                                                            <?php echo $data['afa3']['name']; ?> 
                                                                        <?php } ?>  

                                                                    </td>
                                                                    <td>
                                                                        <?php if (!empty($data['nia3']['name'])) { ?> 
                                                                            <?php echo $data['nia3']['name']; ?> 
                                                                        <?php } ?>   
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <?php if (!empty($a4['name'])) { ?> 
                                                                            <?php echo $a4['name']; ?>
                                                                        <?php } ?>
                                                                    </td>
                                                                    <td>
                                                                        <?php if (!empty($data['afa4']['name'])) { ?> 
                                                                            <?php echo $data['afa4']['name']; ?>
                                                                        <?php } ?> 
                                                                    </td>
                                                                    <td>
                                                                        <?php if (!empty($data['nia4']['name'])) { ?> 
                                                                            <?php echo $data['nia4']['name']; ?>
                                                                        <?php } ?> 
                                                                    </td>
                                                                </tr>

                                                                <tr>
                                                                    <td>
                                                                        <?php if (!empty($a5['name'])) { ?> 
                                                                            <?php echo $a5['name']; ?>
                                                                        <?php } ?> 
                                                                    </td>
                                                                    <td>
                                                                        <?php if (!empty($data['afa5']['name'])) { ?> 
                                                                            <?php echo $data['afa5']['name']; ?>
                                                                        <?php } ?> 
                                                                    </td>
                                                                    <td>
                                                                        <?php if (!empty($data['nia5']['name'])) { ?> 
                                                                            <?php echo $data['nia5']['name']; ?>
                                                                        <?php } ?> 
                                                                    </td>
                                                                </tr>

                                                                <tr>                                                                 
                                                                    <?php if (!empty($a6['name'])) { ?> 
                                                                        <td> <?php echo $a6['name']; ?> </td>
                                                                    <?php } ?>

                                                                    <?php if (!empty($data['afa6']['name'])) { ?> 
                                                                        <td> <?php echo $data['afa6']['name']; ?> </td>
                                                                    <?php } ?>

                                                                    <?php if (!empty($data['nia6']['name'])) { ?> 
                                                                        <td> <?php echo $data['nia6']['name']; ?> </td>
                                                                    <?php } ?>
                                                                </tr>
                                                                <tr> 
                                                                    <?php if (!empty($a7['name'])) { ?> 
                                                                        <td> <?php echo $a7['name']; ?> </td>
                                                                    <?php } ?> 

                                                                    <?php if (!empty($data['afa7']['name'])) { ?> 
                                                                        <td> <?php echo $data['afa7']['name']; ?> </td>
                                                                    <?php } ?> 

                                                                    <?php if (!empty($data['nia7']['name'])) { ?> 
                                                                        <td> <?php echo $data['nia7']['name']; ?> </td>
                                                                    <?php } ?> 
                                                                </tr>
                                                                <tr>
                                                                    <?php if (!empty($a8['name'])) { ?> 
                                                                        <td> <?php echo $a8['name']; ?> </td>
                                                                    <?php } ?>  

                                                                    <?php if (!empty($data['afa8']['name'])) { ?> 
                                                                        <td> <?php echo $data['afa8']['name']; ?> </td>
                                                                    <?php } ?>  

                                                                    <?php if (!empty($data['nia8']['name'])) { ?> 
                                                                        <td> <?php echo $data['nia8']['name']; ?> </td>
                                                                    <?php } ?>  
                                                                </tr>
                                                                <tr>
                                                                    <?php if (!empty($a9['name'])) { ?> 
                                                                        <td> <?php echo $a9['name']; ?> </td>
                                                                    <?php } ?> 

                                                                    <?php if (!empty($data['afa9']['name'])) { ?> 
                                                                        <td> <?php echo $data['afa9']['name']; ?> </td>
                                                                    <?php } ?> 

                                                                    <?php if (!empty($data['nia9']['name'])) { ?> 
                                                                        <td> <?php echo $data['nia9']['name']; ?> </td>
                                                                    <?php } ?>  

                                                                </tr>
                                                                <tr>
                                                                    <?php if (!empty($a10['name'])) { ?> 
                                                                        <td> <?php echo $a10['name']; ?> </td>
                                                                    <?php } ?>  

                                                                    <?php if (!empty($data['afa10']['name'])) { ?> 
                                                                        <td> <?php echo $data['afa10']['name']; ?> </td>
                                                                    <?php } ?>  

                                                                    <?php if (!empty($data['nia10']['name'])) { ?> 
                                                                        <td> <?php echo $data['nia10']['name']; ?> </td>
                                                                    <?php } ?>
                                                                <tr>
                                                                    <?php if (!empty($a11['name'])) { ?> 
                                                                        <td> <?php echo $a11['name']; ?> </td>
                                                                    <?php } ?>  

                                                                    <?php if (!empty($data['afa11']['name'])) { ?> 
                                                                        <td> <?php echo $data['afa11']['name']; ?> </td>
                                                                    <?php } ?>  

                                                                    <?php if (!empty($data['nia11']['name'])) { ?> 
                                                                        <td> <?php echo $data['nia11']['name']; ?> </td>
                                                                    <?php } ?>                                                             
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- pop up for data change end -->
                                        </td>

                                        <td class="hidden-480">
                                            <?php echo $results['shift_name_time']; ?> 
                                        </td>

                                        <td class="hidden-480" >
                                            <?php echo $results['afshift_name_time2']; ?> 
                                        </td>

                                        <td  class="hidden-480" >
                                            <?php echo $results['nishift_name_time3']; ?> 
                                        </td>

                                        <?php if (!empty($shift_incharge['name'])) { ?> 
                                            <td title="This is : <?php echo $shift_incharge['name']; ?> Shift Incharge of Call Center (call : 5053)" class="hidden-480">
                                                <?php echo $shift_incharge['name']; ?> 
                                            </td>
                                        <?php } ?> 

                                        <?php if (!empty($shift_incharge2['name'])) { ?> 
                                            <td title="This is : <?php echo $shift_incharge2['name']; ?> Shift Incharge of Call Center (call : 5053)" class="hidden-480">
                                                <?php echo $shift_incharge2['name']; ?> 
                                            </td>
                                        <?php } ?> 

                                        <?php if (!empty($shift_incharge3['name'])) { ?> 
                                            <td title="This is : <?php echo $shift_incharge3['name']; ?> Sift Incharge of Call Center (call : 5053)" class="hidden-480">
                                                <?php echo $shift_incharge3['name']; ?> 
                                            </td>
                                        <?php } ?> 

                                        <td class="hidden-480">
                                            <?php echo $a1['name']; ?> 
                                        </td>

                                        <td class="hidden-480">
                                            <?php echo $a2['name']; ?> 
                                        </td>

                                        <td class="hidden-480">
                                            <?php echo $a3['name']; ?> 
                                        </td>

                                        <td class="hidden-480">
                                            <?php echo $a4['name']; ?> 
                                        </td>

                                        <td class="hidden-480">
                                            <?php echo $a5['name']; ?> 
                                        </td>

                                        <td class="hidden-480">
                                            <?php echo $a6['name']; ?> 
                                        </td>                                          
                                        <td class="hidden-480">
                                            <?php echo $data['a7']['name']; ?> 
                                        </td>                                          
                                        <td class="hidden-480">
                                            <?php echo $data['a8']['name']; ?> 
                                        </td>                                          
                                        <td class="hidden-480">
                                            <?php echo $data['a9']['name']; ?> 
                                        </td>                                          
                                        <td class="hidden-480">
                                            <?php echo $data['a10']['name']; ?> 
                                        </td>                                          
                                        <td class="hidden-480">
                                            <?php echo $data['a11']['name']; ?> 
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

