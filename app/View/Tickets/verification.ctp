<style type="text/css">
    .alert {
        padding: 6px;
        margin-bottom: 5px;
        border: 1px solid transparent;
        border-radius: 4px;
        text-align: center;
    }
    .txtArea { width:300px; }

</style>

<div class="page-content-wrapper">
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <h3 class="page-title">
            Solved tickets for verification 
            <!--<small>You can resolve, reopen</small>-->
        </h3>
        <!-- END PAGE HEADER-->
        <!-- BEGIN PAGE CONTENT-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet box green">
                    <div class="portlet-title">
                        <div class="caption">
<!--                            <i class="fa fa-ticket"></i>Solved Ticket Total tickets: <?php echo $total; ?> -->
                        </div>

                        <div class="tools">
                            <a href="javascript:;" class="reload">
                            </a>
                        </div>
                    </div>


                    <div class="portlet-body">

                        <!--                        <ul class="pagination" >
                        <?php
                        for ($i = 1; $i <= $total_page; $i++):
                            $active = '';
                            if (isset($this->params['pass'][0]) && $this->params['pass'][0] == $i) {
                                $active = 'active';
                            }
                            ?>
                                                                                                <li class="paginate_button <?php echo $active; ?>" aria-controls="sample_editable_1" tabindex="<?php echo $i; ?>">
                                                                                                    <a href="<?php echo Router::url(array('controller' => 'tickets', 'action' => 'solved_ticket', $i)) ?>"><?php echo $i; ?></a>
                                                                                                </li>
                        <?php endfor; ?>
                                                </ul>-->

                        <?php echo $this->Session->flash(); ?>

                        <table class="table table-striped table-hover table-bordered" id="sample_editable_1">
                            <thead>
                                <tr>
                                    <th>SL.</th>
                                    <th>Subject</th>
                                    <th>Customer Info</th>
                                    <th>Open Time</th>
                                    <th>Detail</th>
                                    <th>Verification</th>
                                    <th>History</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                //pr($data); exit;
                                foreach ($data as $single):
                                    $issue = end($single['history']);
                                    $customer = end($single['history']);
                                    $customer = $customer['pc'];
                                    $ticket = $single['ticket'];
                                    ?>
                                    <tr >
                                        <td>
                                            <?php echo $single['ticket']['id']; ?>                            
                                        </td>
                                        <td><?php echo $issue['i']['name']; ?></td>
                                        <td>
                                            <ul>
                                                <li> Name: <?php echo $customer['first_name'] . ' ' . $customer['middle_name'] . ' ' . $customer['last_name']; ?> </li> 
                                                <li> Cell: <?php echo $customer['cell']; ?> </li> 
                                            </ul>
                                        </td>
                                        <td><?php echo date('m-d-Y h:i:sa', strtotime($ticket['created'])); ?></td>                                        
                                        <td><?php echo $ticket['content']; ?></td>
                                        <td>
                                            <?php if (!empty($ticket['verification_solve'])) { ?>
                                                <?php echo $ticket['verification_solve']; ?>  <br>
                                                <hr>
                                                <b>Verified By:</b><?php echo $ticket['pc_info']; ?>
                                            <?php } ?>


                                        </td>
                                        <td>
                                            <ol>
                                                <?php
                                                $lasthistory = $single['history'][0]['tr'];

                                                foreach ($single['history'] as $history):
                                                    //$tr_id11 = count($history['tr']);
                                                    //pr($history['tr']); exit;
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
                                                        <strong>Time:</strong> 
                                                        <?php echo date('m-d-Y h:i:sa', strtotime($history['tr']['created'])); ?>
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
                                            <?php if (!empty($ticket['verification_not_solve'])) { ?>
                                  <!--<b style="color: green;"> <?php // echo 'Verified';     ?></b>  <br>-->
                         <!-- <b title="That is already verified." style="color: red; font-weight: normal;"> <?php echo $tr_id11; ?> </b>-->  
                                                <b title="That is already verified." style="color: orange; font-weight: normal;"> <?php echo $single['ticket']['verification_not_solve']; ?></b> 
                                            <?php } else { ?>

                                                <?php if ($ticket['verification_solve'] == '') { ?>
                                                    <b title="That is already verified." style="color: red; font-weight: normal;">  </b>
                                                    <a 
                                                        href="#" title="Comment">
                                                        <span id="<?php echo $single['ticket']['id']; ?>" class="fa fa-check fa-lg comment_ticket"></span>
                                                    </a> 

                                                    &nbsp;

                                                    <a href="#" title="Open ticket">
                                                        <span id="<?php echo $single['ticket']['id']; ?>" class="fa fa-forward fa-lg forward_ticket"></span>
                                                    </a> 
                                                <?php } ?>

                                                <div id="comment_dialog<?php echo $single['ticket']['id']; ?>" class="portlet-body form" style="display: none;">
                                                    <!-- BEGIN FORM-->
                                                    <?php
                                                    echo $this->Form->create('Ticket', array(
                                                        'inputDefaults' => array(
                                                            'label' => false,
                                                            'div' => false
                                                        ),
                                                        'id' => 'form_sample_3',
                                                        'class' => 'form-horizontal',
                                                        'novalidate' => 'novalidate',
                                                        'url' => array('controller' => 'tickets', 'action' => 'ticket_verify')
                                                            )
                                                    );
                                                    ?>
                                                    <?php
                                                    echo $this->Form->input('id', array(
                                                        'type' => 'hidden',
                                                        'value' => $single['ticket']['id'],
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
                                                                    echo $this->Form->input('verification_solve', array(
                                                                        'type' => 'textarea',
                                                                        'class' => 'form-control required txtArea',
                                                                        'placeholder' => 'Write customer comments about solved'
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

                                                <div id="forward_dialog<?php echo $single['ticket']['id']; ?>" class="portlet-body form" style="display: none;">
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
                                                        'url' => array('controller' => 'tickets', 'action' => 'open_ticket')
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
                                                                        'empty' => 'Select technician',
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
                                                                    echo $this->Form->input('verification_not_solve', array(
                                                                        'type' => 'textarea',
                                                                        'class' => 'form-control required txtArea',
                                                                        'placeholder' => 'Write your comments about open ticket'
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
                                            <?php } ?>
                                        </td>
                                    </tr>
                                    <?php
                                endforeach;
                                ?>
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

