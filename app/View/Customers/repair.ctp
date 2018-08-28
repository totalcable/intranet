<div class="page-content-wrapper">
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>   </li>
                <li>   </li>
                <li>   </li>
            </ul>
            <script></script>
            <div class="page-toolbar">
                <div class="btn-group pull-right">
                    <a id="btnclick" class="btn btn-lg blue hidden-print margin-bottom-5" target="_blank" onclick="printDiv('printableArea')">
                        Print <i class="fa fa-print"></i>
                    </a>

                </div>
            </div>
        </div>
        <!-- END PAGE HEADER-->
        <!-- BEGIN PAGE CONTENT-->
        <div class="invoice" id="printableArea">
            <div class="row invoice-logo">
                <div class="col-xs-12 invoice-logo-space">
                    <!--<img src="../../assets/admin/pages/media/invoice/walmart.png" class="img-responsive" alt="">-->
                    <div class="row">
                        <div class="col-xs-6">
                            <h3 class="page-title">
                                Change Box <small></small>
                            </h3>
                        </div>
                        <div class="col-xs-4">
                        </div>
                        <div class="col-xs-2 invoice-payment">
                            <div style="text-align: left;">
                                <div>   Total Cable USA</div>
                                <div>P.O. BOX 770068,</div>
                                <div>WOODSIDE,</div>
                                <div>NY 11377</div>
                                <div>
                                    <div style="left: 103.238px; top: 144.543px; font-size: 25px; font-family: sans-serif;">☎<small style="font-size: 12px;">&nbsp 1-212-444-8138</small></div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6">
                </div>
            </div>
            <hr>
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
                <div class="col-xs-12">
                    <table class="table table-striped table-hover">
                          <?php echo $this->Session->flash(); ?>
                        <thead>
                            <tr>
                                <th class="hidden-480">
                                    Name
                                </th>
                                <th class="hidden-480">
                                    Address
                                </th>
                                <th class="hidden-480">
                                    Emergency Contact
                                </th>
                                <th class="hidden-480">
                                    Reference Contact
                                </th>
                                <th>
                                    Package
                                </th>
                                <th class="hidden-480">
                                    Follow update
                                </th>
                                <th class="hidden-480">
                                    Comment
                                </th>
                                <th class="hidden-480">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($filteredData as $results):
                                $customer = $results['customers'];
                                ?>
                                <tr>

                                    <td>
                                        <a href="<?php
                                        echo Router::url(array('controller' => 'customers',
                                            'action' => 'edit_registration', $results['customers']['id']))
                                        ?>" 
                                           target="_blank">
                                               <?php
                                               echo $results['customers']['first_name'] . " " .
                                               $results['customers']['middle_name'] . " " .
                                               $results['customers']['last_name'];
                                               ?>
                                        </a> 
                                    </td>
                                    <td class="hidden-480">
                                        <?php echo $results['customers']['address']; ?>                            
                                    </td>
                                    <td class="hidden-480">  
                                        <?php if (!empty($results['customers']['cell'])): ?> 
                                            Cell:    <?php echo $results['customers']['cell']; ?>   
                                        <?php endif; ?>
                                        <br>
                                        <?php if (!empty($results['customers']['home'])): ?>
                                            Home : <?php echo $results['customers']['home']; ?>
                                        <?php endif ?>
                                    </td>
                                    <td>
                                        <?php echo $results['customers']['referred_phone']; ?> 
                                    </td>
                                    <td class="hidden-480">
                                        <ul>
                                            <li>Name:  <?php echo $results['package']['name']; ?> </li>
                                            <li>Duration:  <?php echo $results['package']['duration']; ?> </li>
                                            <li>Amount:  <?php echo $results['package']['amount']; ?> </li>
                                        </ul>

                                    </td>
                                    <td>
                                        <?php echo $results['customers']['follow_date']; ?>
                                    </td>
                                    <td>
                                        <ul>
                                            <?php foreach ($results['comments'] as $comment): ?>
                                                <li><?php echo $comment['content']['content'] . ' -By <i>' . $comment['user']['name']; ?> </i></li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </td>
                                    <td>
                                        <div class="controls center text-center">
                                            <a 
                                                href="#" title="Shedule">
                                                <span id="<?php echo $results['customers']['id']; ?>" class="fa fa-clock-o fa-lg shedule"></span>
                                            </a> 
                                            <div id="shedule_dialog<?php echo $results['customers']['id']; ?>" class="portlet-body form" style="display: none;">
                                                <!-- BEGIN FORM-->
                                                <?php
                                                echo $this->Form->create('PackageCustomer', array(
                                                    'inputDefaults' => array(
                                                        'label' => false,
                                                        'div' => false
                                                    ),
                                                    'id' => 'form_sample_3',
                                                    'class' => 'form-horizontal',
                                                    'novalidate' => 'novalidate',
                                                    'url' => array('controller' => 'customers', 'action' => 'box_change')
                                                        )
                                                );
                                                ?>

                                                <?php
                                                echo $this->Form->input('id', array(
                                                    'type' => 'hidden',
                                                    'value' => $results['customers']['id'],
                                                        )
                                                );
                                                ?>

                                                <?php
                                                echo $this->Form->input(
                                                        'cid', array(
                                                    'type' => 'hidden',
                                                    'value' => $this->params['pass'][0]
                                                ));
                                                ?>
                                                
                                                <div class="form-body">
                                                    <div class="alert alert-danger display-hide">
                                                        <button class="close" data-close="alert"></button>
                                                        You have some form errors. Please check below.
                                                    </div>                                                
                                                    <div class="form-group">
                                                        <div class="form-group">
                                                            <div class="col-md-12">
                                                                <?php
                                                                echo $this->Form->input('technician_id', array(
                                                                    'type' => 'select',
                                                                    'options' => $technician,
                                                                    'empty' => 'Select Technician',
                                                                    'class' => 'form-control select2me required',
                                                                        )
                                                                );
                                                                ?>
                                                            </div>
                                                        </div>
                                                    </div>                                               
                                                </div>
                                                <div class="form-group">                                

                                                    <div class="col-md-4">
                                                        <?php
                                                        echo $this->Form->input(
                                                                'daterange', array(
                                                            'class' => 'span9 text required e3'
                                                                )
                                                        );
                                                        ?>
                                                    </div>
                                                </div>
                                                <div class="form-actions">
                                                    <div class="row">
                                                        <div class="col-md-offset-7 col-md-4">
                                                            <?php
                                                            echo $this->Form->button(
                                                                    'Submit', array('class' => 'btn green', 'type' => 'submit')
                                                            );
                                                            ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php echo $this->Form->end(); ?>
                                                <!-- END FORM-->
                                            </div>
                                        </div>
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
