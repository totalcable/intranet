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
        <!--        <div class="row">
                    <div class="col-md-12">
                        <div class="portlet box green">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="fa fa-plus"></i>Leave
                                </div>
                                <div class="tools">
                                    <a href="javascript:;" class="reload">
                                    </a>
                                </div>
                            </div>
                            <div class="portlet-body form">
                                 BEGIN FORM
        <?php
        echo $this->Form->create('Leave', array(
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
                                 END FORM
                            </div>
                             END VALIDATION STATES
                        </div>                
                    </div>
                </div>-->
        <!-- END PAGE CONTENT -->
        <?php // if ($clicked): ?> 
        <h3 class="page-title">
            Approve Leaves<small></small>
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
                                    <th>Emp Information</th>
                                    <th>Date</th>      
                                    <th>Type</th>      
                                    <th>Purpose</th>      
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($leaves as $single):
                                    $data = $single['leaves'];
                                    $des = $single['designations'];
                                    $dep = $single['departments'];
                                    $us = $single['users'];
                                    $emp = $single['emps'];
                                    $id = $data['id'];
                                    ?>
                                    <tr>
                                        <td><?php echo $data['date']; ?></td>  
                                        <td>                                           
                                            <b>Name :</b>  <?php echo $us['name']; ?> <b title="Emp Id" style="color:orange;">(<?php echo $data['emp_id']; ?>)</b>
                                            <br> <b>Designation :</b>  <?php echo $des['name']; ?>
                                            <br><b>Department :</b> <?php echo $dep['name']; ?>
                                        </td>
                                        <td>
                                            <b>From : </b> <?php echo $data['from_date']; ?><br>
                                            <b>To : </b> <?php echo $data['to_date']; ?><br>
                                            <b>Total Days : </b> <b ><a target="_blank" href="<?php echo Router::url(array('controller' => 'leaves', 'action' => 'leaveofroaster',$data['from_date'],$data['to_date'],$us['id'])) ?>" title="Click here for information" style="font-weight: normal; color: tomato;"><?php echo $data['total']; ?></a></b>
                                       
                                        </td>  
                                        <td><?php echo ucfirst($data['nature_leave']); ?></td>
                                        <td><?php echo ucfirst($data['purpose']); ?></td>
                                        <td><?php 
                                        if($data['status']=='admin_approved'){
                                             echo 'Aprroved';
                                        }                                       
                                        ?></td>
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
