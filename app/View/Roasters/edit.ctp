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
                            <i class="fa fa-plus"></i>Search & Edit roaster information
                        </div>
                        <div class="tools">
                            <a href="javascript:;" class="reload">
                            </a>
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <!-- BEGIN FORM-->
                        <?php
                        echo $this->Form->create('RoasterDetail', array(
                            'inputDefaults' => array(
                                'label' => false,
                                'div' => false
                            ),
                            'id' => 'form-validate',
                            'class' => 'form-horizontal',
                            'novalidate' => 'novalidate',
                            'enctype' => 'multipart/form-data',
                            'url' => array('controller' => 'roasters', 'action' => 'edit')
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
                                <label class="control-label col-md-3" for="required"> Enter emp Id</label>
                                <div class="col-md-4">
                                    <?php
                                    echo $this->Form->input(
                                            'emp_id', array(
                                        'class' => 'form-control required',
                                        'type' => 'text'
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
            <h3 class="page-title">
                Modify roaster<small></small>
            </h3>
            <!-- END PAGE HEADER-->
            <!-- BEGIN PAGE CONTENT-->
            <div class="row">
                <div class="col-md-12">
                    <!-- BEGIN EXAMPLE TABLE PORTLET-->
                    <div class="portlet box green">
                        <div class="portlet-title">
                            <div class="tools">
                                <a href="javascript:;" class="reload">
                                </a>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <table class="table table-striped table-hover table-bordered" id="sample_editable_1">
                                <thead>
                                    <tr>                                 
                                        <th>Date</th>
                                        <th>Emp ID</th>
                                        <th>Shift Name</th>      
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($duty as $single):
                                        $data = $single['roaster_details'];
                                        $user = $single['users'];
                                        $id = $data['id'];
                                        ?>
                                        <tr>
                                            <td><?php echo $data['date']; ?></td>  
                                            <td>                                           
                                                <?php echo $user['name']; ?> <b title="Emp Id" style="color:orange;">(<?php echo $data['emp_id']; ?>)</b>
                                            </td>
                                            <td>
                                                <?php
                                                $a = substr($data['shift_name_time'], 0, 1);
                                                if ($a == 'M') {
                                                    $c = 'green';
                                                } elseif ($a == 'A') {
                                                    $c = 'ornage';
                                                } elseif ($a == 'N') {
                                                    $c = 'blue';
                                                }
                                                ?>
                                                <b style= "color:<?php echo $c; ?>">  <?php echo substr($data['shift_name_time'], 0, 1); ?></b>
                                            </td>
                                            <td><?php echo $data['attend_status']; ?></td>
                                            <td> 
                                                <div class="controls center text-center">
                                                    
                                                    <a href="#" title="Modify roaster"> <span id="<?php echo $data['id']; ?>" class="fa fa-edit fa-lg forward_ticket"></span></a>
                                                    <div id="forward_dialog<?php echo $data['id']; ?>" class="portlet-body form" style="display: none;">
                                                        <!-- BEGIN FORM-->
                                                        <?php
                                                        echo $this->Form->create('RoasterDetail', array(
                                                            'inputDefaults' => array(
                                                                'label' => false,
                                                                'div' => false
                                                            ),
                                                            'id' => 'form_sample_3',
                                                            'class' => 'form-horizontal',
                                                            'novalidate' => 'novalidate',
                                                            'url' => array('controller' => 'roasters', 'action' => 'modify_roaster')
                                                                )
                                                        );
                                                        ?>
                                                        <?php
                                                        echo $this->Form->input('id', array(
                                                            'type' => 'hidden',
                                                            'value' => $id,
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
                                                                <div class="form-group">
                                                                    <div class="col-md-12">
                                                                        <?php
                                                                        echo $this->Form->input('emp_id', array(
                                                                            'type' => 'select',
                                                                            'options' => $users,
                                                                            'empty' => 'Select Emp',
                                                                            'class' => 'form-control select2me',
                                                                                )
                                                                        );
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <div class="form-actions">
                                                            <div class="row">
                                                                <div class="col-md-offset-4 col-md-2">
                                                                    <?php
                                                                    echo $this->Form->button(
                                                                            'Modify roaster', array('class' => 'btn green', 'type' => 'submit')
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
                                        <?php
                                    endforeach;
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            
        <?php // endif; ?>

    </div>
</div>
