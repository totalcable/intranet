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
            Schedule Customers List <small></small>
        </h3>

        <!-- END PAGE HEADER-->
        <!-- BEGIN PAGE CONTENT-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet box green">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-user"></i>
                        </div>

                        <div class="tools">
                            <a href="javascript:;" class="reload">
                            </a>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <?php echo $this->Session->flash(); ?> 
                        <table class="table table-striped table-hover table-bordered" id="sample_editable_1">
                            <thead>
                                <tr>
                                    <th>
                                        Contact Date
                                    </th>
                                    <th>
                                        Name
                                    </th>
                                    <th>
                                        Customer Type
                                    </th>
                                    <th>
                                        Address
                                    </th>
                                    <th>
                                        Emergency Contact
                                    </th>
                                    <th>
                                        Reference Contact
                                    </th>
                                    <th>
                                        Package
                                    </th>
                                    <th>
                                        Follow update
                                    </th>
                                    <th>
                                        Comment
                                    </th>
                                    <th>
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                               
                              // pr($filteredData);exit();
                                foreach ($filteredData as $results):
                                    $customer = $results['customers'];
                                  
                                 // pr($customer);exit();
                                    ?>
                                    <tr>
                                        <td class="hidden-480">
                                            <?php echo date('m-d-Y', strtotime($results['customers']['modified'])); ?>
                                        </td>
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
                                            <?php
                                            if ($results['customers']['status'] == 'ready') {
                                                echo "New";
                                            } else {
                                                echo "Old";
                                            }
                                            ?>                     
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
                                                <?php if (!empty($results['customers']['comments'])): ?>
                                                    <li><?php echo $results['customers']['comments'] ?> </li>
                                                    <?php endif ?>
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
                                                        'url' => array('controller' => 'customers', 'action' => 'shedule_assian')
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
                                                            ));
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
                <!-- END EXAMPLE TABLE PORTLET-->
            </div>
        </div>
        <!-- END PAGE CONTENT -->
    </div>
</div>
<!-- END CONTENT -->




