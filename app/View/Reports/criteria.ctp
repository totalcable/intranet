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
    .txtArea { width:300px; }
    ul.pagination {
        display: flex;
        justify-content: center;
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
                            <i class="fa fa-plus"></i>Criteria

                        </div>
                        <div class="tools">
                            <a href="javascript:;" class="reload">
                            </a>
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <!-- BEGIN FORM-->
                        <?php
                        echo $this->Form->create('PackageCustomer', array(
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
                                <label class="control-label col-md-3" for="required">Criteria 1</label>
                                <div class="col-md-4">
                                    <?php
                                    echo $this->Form->input('criteria', array(
                                        'type' => 'select',
                                        'options' => array(
                                            'empty' => 'Select Option',
                                            'customertype' => 'Customer Type',
                                            'supportcenter' => 'Support Center',
                                            'installers' => 'Installers',
                                        ),
                                        'class' => 'criteria form-control pclass')
                                    );
                                    ?>
                                </div>
                            </div> 
                            <div class="form-group">                                
                                <label class="control-label col-md-3" for="required">Criteria 2</label>
                                <div class="col-md-4">
                                    <?php
                                    $status = array("active" => "Active", "hold" => "Hold", "Cancelled" => "Cancelled");
                                    echo $this->Form->input(
                                            'status', array(
                                        'class' => 'form-control required cclass',
                                        'options' => $status,
                                        'label' => false,
                                        'id' => 'cid',
                                        'empty' => 'Select status',
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
        <?php if ($clicked): ?>    
            <div class="page-content-wrapper" style="margin: 0px; padding: 0px;">
                <div class="">
                    <!-- BEGIN PAGE HEADER-->

                    <!-- END PAGE HEADER-->
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
                            <div class="col-xs-12">
                                
                                <table class="table table-striped table-hover table-bordered" id="sample_editable_1">
                                    <thead>
                                        <tr>
                                            <th>Subject</th>
                                            <th>Customer Info</th>
                                            <th>Open Time</th>
                                            <th>Detail</th>
                                            <th>History</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($filteredTicket as $single):
                                            $issue = end($single['history']);
                                            $customer = end($single['history']);
                                            $customer = $customer['pc'];
                                            $ticket = $single['ticket'];
                                            ?>
                                            <tr >
                                                <td><?php echo $issue['i']['name']; ?></td>
                                                <td>
                                                    <ul>
                                                        <li> Name: <?php echo $customer['first_name'] . ' ' . $customer['middle_name'] . ' ' . $customer['last_name']; ?> </li> 
                                                        <li> Cell: <?php echo $customer['cell']; ?> </li> 
                                                    </ul>
                                                </td>
                                                <td><?php echo date('m-d-Y', strtotime($ticket['created'])); ?></td>

                                                <td><?php echo $ticket['content']; ?></td>
                                                <td>
                                                    <ol>
                                                        <?php
                                                        $lasthistory = $single['history'][0]['tr'];

                                                        foreach ($single['history'] as $history):
                                                            ?>
                                                            <li>
                                                                <?php if ($history['tr']['status'] != 'open') { ?>
                                                                    <strong><?php echo ucfirst($history['tr']['status']); ?> By:</strong>
                                                                <?php } else {
                                                                    ?>
                                                                    <strong>Forwarded By:</strong>
                                                                    <?php
                                                                }
                                                                ?>
                                                                <?php echo $history['fb']['name']; ?>
                                                                <p><strong>Forwarded To:</strong><ul><li><?php echo $history['fi']['name']; ?> </li><li><?php echo $history['fd']['name']; ?> </li></ul>
                                                                <strong>Time:</strong> <?php echo date('m-d-Y', strtotime($history['tr']['created'])); ?>
                                                                &nbsp;&nbsp;<strong>Status:</strong> <?php echo $history['tr']['status']; ?><br>
                                                                <?php
                                                                if (!empty($history['tr']['comment'])):
                                                                    echo '<strong>';
                                                                    echo 'Comment : ';
                                                                    echo '</strong>';
                                                                    echo $history['tr']['comment'];
                                                                endif;
                                                                ?> 
                                                            </li>
                                                            <br>
                                                        <?php endforeach; ?>
                                                    </ol>
                                                </td>
                                                <td>   
                                                    <div class="controls center text-center">
                                                        <?php if ($lasthistory['status'] == 'open') { ?>
                                                            <a 
                                                                href="#" title="Solved">
                                                                <span id="<?php echo $ticket['id']; ?>" class="fa fa-check fa-lg solve_ticket"></span>
                                                            </a>
                                                            &nbsp;
                                                            <a 
                                                                href="#" title="Unresolved">
                                                                <span id="<?php echo $ticket['id']; ?>" class="fa fa-times fa-lg unsolve_ticket"></span>
                                                            </a>
                                                            &nbsp;
                                                            <a 
                                                                href="#" title="Forward">
                                                                <span id="<?php echo $ticket['id']; ?>" class="fa fa-mail-forward fa-lg forward_ticket"></span>
                                                            </a>
                                                            &nbsp;
                                                            <a 
                                                                href="#" title="Comment">
                                                                <span id="<?php echo $ticket['id']; ?>" class="fa fa-comment fa-lg comment_ticket"></span>
                                                            </a>
                                                            <div id="forward_dialog<?php echo $ticket['id']; ?>" class="portlet-body form" style="display: none;">
                                                                <!-- BEGIN FORM-->
                                                                <?php
                                                                echo $this->Form->create('Track', array(
                                                                    'inputDefaults' => array(
                                                                        'label' => false,
                                                                        'div' => false
                                                                    ),
                                                                    'id' => 'form_sample_3',
                                                                    'class' => 'form-horizontal',
                                                                    'novalidate' => 'novalidate',
                                                                    'url' => array('controller' => 'tickets', 'action' => 'forward')
                                                                        )
                                                                );
                                                                ?>

                                                                <?php
                                                                echo $this->Form->input('ticket_id', array(
                                                                    'type' => 'hidden',
                                                                    'value' => $ticket['id'],
                                                                        )
                                                                );
                                                                ?>
                                                                <?php
                                                                echo $this->Form->input('package_customer_id', array(
                                                                    'type' => 'hidden',
                                                                    'value' => $lasthistory['package_customer_id'],
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
                                                                                echo $this->Form->input('user_id', array(
                                                                                    'type' => 'select',
                                                                                    'options' => $users,
                                                                                    'empty' => 'Select From Existing admins panel user',
                                                                                    'class' => 'form-control select2me',
                                                                                        )
                                                                                );
                                                                                ?>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">

                                                                        <div class="form-group">

                                                                            <div class="col-md-12">
                                                                                <?php
                                                                                echo $this->Form->input('role_id', array(
                                                                                    'type' => 'select',
                                                                                    'options' => $roles,
                                                                                    'empty' => 'Select Department or Role',
                                                                                    'class' => 'form-control select2me',
                                                                                        )
                                                                                );
                                                                                ?>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <div class="form-group">
                                                                            <div class="col-md-12">
                                                                                <?php
                                                                                echo $this->Form->input('priority', array(
                                                                                    'type' => 'select',
                                                                                    'options' => array('low' => 'Low', 'medium' => 'Medium', 'high' => 'High'),
                                                                                    'empty' => 'Select Priority',
                                                                                    'class' => 'form-control select2me  pclass',
                                                                                        )
                                                                                );
                                                                                ?>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <div class="form-group">
                                                                            <div class="col-md-12">
                                                                                <?php
                                                                                echo $this->Form->input('comment', array(
                                                                                    'type' => 'textarea',
                                                                                    'class' => 'form-control ',
                                                                                    'placeholder' => 'Write your comments'
                                                                                        )
                                                                                );
                                                                                ?>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-actions">
                                                                    <div class="row">
                                                                        <div class="col-md-offset-7 col-md-4">
                                                                            <?php
                                                                            echo $this->Form->button(
                                                                                    'Forward', array('class' => 'btn green', 'type' => 'submit')
                                                                            );
                                                                            ?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <?php echo $this->Form->end(); ?>
                                                                <!-- END FORM-->
                                                            </div>

                                                            <div id="solve_dialog<?php echo $ticket['id']; ?>" class="portlet-body form" style="display: none;">

                                                                <!-- BEGIN FORM-->
                                                                <?php
                                                                echo $this->Form->create('Track', array(
                                                                    'inputDefaults' => array(
                                                                        'label' => false,
                                                                        'div' => false
                                                                    ),
                                                                    'id' => 'form_sample_3',
                                                                    'class' => 'form-horizontal',
                                                                    'novalidate' => 'novalidate',
                                                                    'url' => array('controller' => 'tickets', 'action' => 'solve')
                                                                        )
                                                                );
                                                                ?>

                                                                <?php
                                                                echo $this->Form->input('ticket_id', array(
                                                                    'type' => 'hidden',
                                                                    'value' => $ticket['id'],
                                                                        )
                                                                );
                                                                ?>

                                                                <?php
                                                                echo $this->Form->input('id', array(
                                                                    'type' => 'hidden',
                                                                    'value' => $single['history'][0]['tr']['id'],
                                                                        )
                                                                );
                                                                ?>

                                                                <?php
                                                                echo $this->Form->input('user_id', array(
                                                                    'type' => 'hidden',
                                                                    'value' => $lasthistory['user_id'],
                                                                        )
                                                                );
                                                                ?>
                                                                <?php
                                                                echo $this->Form->input('role_id', array(
                                                                    'type' => 'hidden',
                                                                    'value' => $lasthistory['role_id'],
                                                                        )
                                                                );
                                                                ?>
                                                                <?php
                                                                echo $this->Form->input('issue_id', array(
                                                                    'type' => 'hidden',
                                                                    'value' => $lasthistory['issue_id'],
                                                                        )
                                                                );
                                                                ?>
                                                                <?php
                                                                echo $this->Form->input('package_customer_id', array(
                                                                    'type' => 'hidden',
                                                                    'value' => $lasthistory['package_customer_id'],
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
                                                                                echo $this->Form->input('comment', array(
                                                                                    'type' => 'textarea',
                                                                                    'class' => 'form-control  txtArea',
                                                                                    'placeholder' => 'Write your comments'
                                                                                        )
                                                                                );
                                                                                ?>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-actions">
                                                                    <div class="row">
                                                                        <div class="col-md-offset-7 col-md-4">
                                                                            <?php
                                                                            echo $this->Form->button(
                                                                                    'Done', array('class' => 'btn green', 'type' => 'submit')
                                                                            );
                                                                            ?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <?php echo $this->Form->end(); ?>
                                                                <!-- END FORM-->
                                                            </div> 
                                                            <div id="unsolve_dialog<?php echo $ticket['id']; ?>" class="portlet-body form" style="display: none;">

                                                                <!-- BEGIN FORM-->
                                                                <?php
                                                                echo $this->Form->create('Track', array(
                                                                    'inputDefaults' => array(
                                                                        'label' => false,
                                                                        'div' => false
                                                                    ),
                                                                    'id' => 'form_sample_3',
                                                                    'class' => 'form-horizontal',
                                                                    'novalidate' => 'novalidate',
                                                                    'url' => array('controller' => 'tickets', 'action' => 'unsolve')
                                                                        )
                                                                );
                                                                ?>

                                                                <?php
                                                                echo $this->Form->input('ticket_id', array(
                                                                    'type' => 'hidden',
                                                                    'value' => $ticket['id'],
                                                                        )
                                                                );
                                                                ?>
                                                                <?php
                                                                echo $this->Form->input('user_id', array(
                                                                    'type' => 'hidden',
                                                                    'value' => $lasthistory['user_id'],
                                                                        )
                                                                );
                                                                ?>
                                                                <?php
                                                                echo $this->Form->input('role_id', array(
                                                                    'type' => 'hidden',
                                                                    'value' => $lasthistory['role_id'],
                                                                        )
                                                                );
                                                                ?>
                                                                <?php
                                                                echo $this->Form->input('issue_id', array(
                                                                    'type' => 'hidden',
                                                                    'value' => $lasthistory['issue_id'],
                                                                        )
                                                                );
                                                                ?>
                                                                <?php
                                                                echo $this->Form->input('package_customer_id', array(
                                                                    'type' => 'hidden',
                                                                    'value' => $lasthistory['package_customer_id'],
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
                                                                                echo $this->Form->input('comment', array(
                                                                                    'type' => 'textarea',
                                                                                    'class' => 'form-control  txtArea',
                                                                                    'placeholder' => 'Write your comments'
                                                                                        )
                                                                                );
                                                                                ?>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-actions">
                                                                    <div class="row">
                                                                        <div class="col-md-offset-7 col-md-4">
                                                                            <?php
                                                                            echo $this->Form->button(
                                                                                    'Done', array('class' => 'btn green', 'type' => 'submit')
                                                                            );
                                                                            ?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <?php echo $this->Form->end(); ?>
                                                                <!-- END FORM-->
                                                            </div> 

                                                            <div id="comment_dialog<?php echo $ticket['id']; ?>" class="portlet-body form" style="display: none;">

                                                                <!-- BEGIN FORM-->
                                                                <?php
                                                                echo $this->Form->create('Track', array(
                                                                    'inputDefaults' => array(
                                                                        'label' => false,
                                                                        'div' => false
                                                                    ),
                                                                    'id' => 'form_sample_3',
                                                                    'class' => 'form-horizontal',
                                                                    'novalidate' => 'novalidate',
                                                                    'url' => array('controller' => 'tickets', 'action' => 'ticket_comment')
                                                                        )
                                                                );
                                                                ?>

                                                                <?php
                                                                echo $this->Form->input('ticket_id', array(
                                                                    'type' => 'hidden',
                                                                    'value' => $ticket['id'],
                                                                        )
                                                                );
                                                                ?>

                                                                <?php
                                                                echo $this->Form->input('user_id', array(
                                                                    'type' => 'hidden',
                                                                    'value' => $lasthistory['user_id'],
                                                                        )
                                                                );
                                                                ?>
                                                                <?php
                                                                echo $this->Form->input('role_id', array(
                                                                    'type' => 'hidden',
                                                                    'value' => $lasthistory['role_id'],
                                                                        )
                                                                );
                                                                ?>
                                                                <?php
                                                                echo $this->Form->input('issue_id', array(
                                                                    'type' => 'hidden',
                                                                    'value' => $lasthistory['issue_id'],
                                                                        )
                                                                );
                                                                ?>
                                                                <?php
                                                                echo $this->Form->input('package_customer_id', array(
                                                                    'type' => 'hidden',
                                                                    'value' => $lasthistory['package_customer_id'],
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
                                                                                echo $this->Form->input('comment', array(
                                                                                    'type' => 'textarea',
                                                                                    'class' => 'form-control  txtArea',
                                                                                    'placeholder' => 'Write your comments'
                                                                                        )
                                                                                );
                                                                                ?>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-actions">
                                                                    <div class="row">
                                                                        <div class="col-md-offset-7 col-md-4">
                                                                            <?php
                                                                            echo $this->Form->button(
                                                                                    'Comments', array('class' => 'btn green ', 'type' => 'submit')
                                                                            );
                                                                            ?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <?php echo $this->Form->end(); ?>
                                                                <!-- END FORM-->
                                                            </div> 
                                                            <?php
                                                        } else {
                                                            echo 'Close';
                                                        }
                                                        ?>
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
            </div>                             
        <?php endif; ?>
    </div>
</div>
<!-- END CONTENT -->

