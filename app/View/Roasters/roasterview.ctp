
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
                            <h2>Main Roaster</h2>
                            <h3 style="color: blue;">Call Center</h3>                        
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
                                    <th><?php echo 'Date'; ?></th>

                                    <th><?php echo 'Day Name'; ?></th>

                                    <th><?php echo 'Shift incharge one'; ?></th>

                                    <th><?php echo 'Agent 1'; ?></th>

                                    <th><?php echo 'Agent 2'; ?></th> 

                                    <th><?php echo 'Agent 3'; ?></th> 
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($datas as $data):
//                                    pr($data['afa1']['name']); exit;
                                    $results = $data['roasters_histories'];
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
                                        <td>
                                            <a title="Click here for roaster view :-)" href="#product-pop-up<?php echo $results['id']; ?>" class="fancybox-fast-view" style="overflow: -webkit-paged-x;">
                                                <?php
                                                echo $results['date'];
                                                ?> 
                                            </a>
                                            <!-- pop up for data change start -->
                                            <div id="product-pop-up<?php echo $results['id']; ?>" style="overflow: -webkit-paged-x; display: none; height: auto; width: auto;">
                                                <div class="product-page product-pop-up">
                                                    <div class="row">
                                                        <!--<h3>You can easily modify information here</h3>-->
                                                        <h4 style="color: orange; text-align: center;" title="Hello today is : <?php echo $results['date']; ?> :-)"><?php echo $results['date']; ?></h4>
                                                        <h3 style="color: royalblue; text-align: center;" title="Hello today is : <?php echo $results['day_name']; ?> :-)"><?php echo $results['day_name']; ?></h3>


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
                                                                    <td style="text-align: center; font-size: 14px; font-weight: bold; color: salmon;" colspan="3"> <u> Shift Incharge</u></td>
                                                                </tr>
                                                                <tr>
                                                                    <td  style=" line-height: 31px; background-color: palegreen;">
                                                                        <?php if (!empty($shift_incharge['name'])) { ?> 
                                                                            One : <?php echo $shift_incharge['name']; ?> <br>
                                                                            <?php if (!empty($shift_incharge2['name'])) { ?> 
                                                                                Two : <?php echo $shift_incharge2['name']; ?> <br>
                                                                            <?php } ?> 

                                                                            <?php if (!empty($shift_incharge3['name'])) { ?> 
                                                                                Three : <?php echo $shift_incharge3['name']; ?> <br>
                                                                            <?php } ?>
                                                                        <?php } ?> 
                                                                    </td>

                                                                    <td style=" line-height: 31px; background-color: palegreen;"> 
                                                                        <?php if (!empty($afshift_incharge['name'])) { ?> 

                                                                            <?php if (!empty($afshift_incharge['name'])) { ?> 
                                                                                One : <?php echo $afshift_incharge['name']; ?> <br>
                                                                            <?php } ?> 

                                                                            <?php if (!empty($afshift_incharge2['name'])) { ?> 
                                                                                Two : <?php echo $afshift_incharge2['name']; ?> <br>
                                                                            <?php } ?> 

                                                                            <?php if (!empty($afshift_incharge3['name'])) { ?> 
                                                                                Three : <?php echo $shift_incharge3['name']; ?> <br>
                                                                            <?php } ?> 
                                                                        <?php } ?> 
                                                                    </td>

                                                                    <td  style="line-height: 31px; background-color: palegreen;"> 
                                                                        <?php if (!empty($nishift_incharge['name'])) { ?> 
                                                                            <?php if (!empty($nishift_incharge['name'])) { ?> 
                                                                                One : <?php echo $nishift_incharge['name']; ?><br>
                                                                            <?php } ?> 
                                                                            <?php if (!empty($nishift_incharge2['name'])) { ?> 
                                                                                Two : <?php echo $nishift_incharge2['name']; ?> <br>
                                                                            <?php } ?> 
                                                                            <?php if (!empty($nishift_incharge3['name'])) { ?> 
                                                                                Three : <?php echo $nishift_incharge3['name']; ?> <br>
                                                                            <?php } ?>                                                                                 
                                                                        <?php } ?> 
                                                                    </td>
                                                                </tr>
                                                                <tr>                                                               
                                                                    <td style="text-align: center; font-size: 14px; font-weight: bold; color: teal;" colspan="3"> <u>Agents</u></td>
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
                                                                    <?php if (!empty($a3['name'])) { ?>
                                                                        <td> <?php echo $a3['name']; ?>  </td>
                                                                    <?php } ?>    
                                                                    <?php if (!empty($data['afa3']['name'])) { ?> 
                                                                        <td> <?php echo $data['afa3']['name']; ?> </td>
                                                                    <?php } ?>  

                                                                    <?php if (!empty($data['nia3']['name'])) { ?> 
                                                                        <td> <?php echo $data['nia3']['name']; ?> </td>
                                                                    <?php } ?>   
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
                                                                  <?php if (!empty($a5['name'] || $data['afa5']['name'] || $data['nia5']['name'])) { ?>
                                                              
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
                                                                 <?php } ?> 
                                                                <?php if (!empty($a6['name'] || $data['afa6']['name'] || $data['nia6']['name'])) { ?>
                                                                    <tr>
                                                                        <td> <?php if (!empty($a6['name'])) { ?>
                                                                                <?php echo $a6['name']; ?>  
                                                                            <?php } ?>    
                                                                        </td>
                                                                        <td>
                                                                            <?php if (!empty($data['afa6']['name'])) { ?> 
                                                                                <?php echo $data['afa6']['name']; ?> 
                                                                            <?php } ?>  
                                                                        </td>

                                                                        <td>
                                                                            <?php if (!empty($data['nia6']['name'])) { ?> 
                                                                                <?php echo $data['nia6']['name']; ?> 
                                                                            <?php } ?>   
                                                                        </td>
                                                                    </tr>
                                                                <?php } ?> 

                                                                <?php if (!empty($a7['name'] || $data['afa7']['name'] || $data['nia7']['name'])) { ?>                                                                 
                                                                    <tr>
                                                                        <td> 
                                                                            <?php if (!empty($a7['name'])) { ?>
                                                                                <?php echo $a7['name']; ?>  
                                                                            <?php } ?>    
                                                                        </td>
                                                                        <td>
                                                                            <?php if (!empty($data['afa7']['name'])) { ?> 
                                                                                <?php echo $data['afa7']['name']; ?> 
                                                                            <?php } ?>  
                                                                        </td>

                                                                        <td>
                                                                            <?php if (!empty($data['nia7']['name'])) { ?> 
                                                                                <?php echo $data['nia7']['name']; ?> 
                                                                            <?php } ?>   
                                                                        </td>
                                                                    </tr>
                                                                <?php } ?> 

                                                                <?php if (!empty($a8['name'] || $data['afa8']['name'] || $data['nia8']['name'])) { ?>                                                               
                                                                    <tr>
                                                                        <td> 
                                                                            <?php if (!empty($a8['name'])) { ?>
                                                                                <?php echo $a8['name']; ?>  
                                                                            <?php } ?>    
                                                                        </td>
                                                                        <td>
                                                                            <?php if (!empty($data['afa8']['name'])) { ?> 
                                                                                <?php echo $data['afa8']['name']; ?> 
                                                                            <?php } ?>  
                                                                        </td>

                                                                        <td>
                                                                            <?php if (!empty($data['nia8']['name'])) { ?> 
                                                                                <?php echo $data['nia8']['name']; ?> 
                                                                            <?php } ?>   
                                                                        </td>
                                                                    </tr>
                                                                <?php } ?> 

                                                                <?php if (!empty($a9['name'] || $data['afa9']['name'] || $data['nia9']['name'])) { ?>                                                               
                                                                    <tr>
                                                                        <td> 
                                                                            <?php if (!empty($a9['name'])) { ?>
                                                                                <?php echo $a9['name']; ?>  
                                                                            <?php } ?>    
                                                                        </td>
                                                                        <td>
                                                                            <?php if (!empty($data['afa9']['name'])) { ?> 
                                                                                <?php echo $data['afa9']['name']; ?> 
                                                                            <?php } ?>  
                                                                        </td>

                                                                        <td>
                                                                            <?php if (!empty($data['nia9']['name'])) { ?> 
                                                                                <?php echo $data['nia9']['name']; ?> 
                                                                            <?php } ?>   
                                                                        </td>
                                                                    </tr>
                                                                <?php } ?> 

                                                                <?php if (!empty($a10['name'] || $data['afa10']['name'] || $data['nia10']['name'])) { ?>                                                               
                                                                    <tr>
                                                                        <td> 
                                                                            <?php if (!empty($a10['name'])) { ?>
                                                                                <?php echo $a10['name']; ?>  
                                                                            <?php } ?>    
                                                                        </td>
                                                                        <td>
                                                                            <?php if (!empty($data['afa10']['name'])) { ?> 
                                                                                <?php echo $data['afa10']['name']; ?> 
                                                                            <?php } ?>  
                                                                        </td>

                                                                        <td>
                                                                            <?php if (!empty($data['nia10']['name'])) { ?> 
                                                                                <?php echo $data['nia10']['name']; ?> 
                                                                            <?php } ?>   
                                                                        </td>
                                                                    </tr>
                                                                <?php } ?>   
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- pop up for data change end -->
                                        </td>

                                        <td><?php echo $results['day_name']; ?></td>                           

                                        <?php if (!empty($shift_incharge['name'])) { ?> 
                                            <td title="This is : <?php echo $shift_incharge['name']; ?> Shift Incharge of Call Center (call : 5053)" class="hidden-480">
                                                <?php echo $shift_incharge['name']; ?> 
                                            </td>
                                        <?php } ?>                                       

                                        <td >
                                            <?php echo $a1['name']; ?> 
                                        </td>

                                        <td>
                                            <?php echo $a2['name']; ?> 
                                        </td>

                                        <td >
                                            <?php 
                                            if(!empty($a3['name'])){
                                             echo $a3['name'];   
                                            }
                                            ?> 
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

