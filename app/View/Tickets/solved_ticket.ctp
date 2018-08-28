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
            Solved tickets <small>You can resolve, unresolve or froward</small>
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
                                    <th>History</th>
                                    <!--<th>Action</th>-->
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($data as $single):
                                    //pr($single); exit;
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

