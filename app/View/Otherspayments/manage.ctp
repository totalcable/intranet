
<style type="text/css">
    .alert {
        padding: 6px;
        margin-bottom: 5px;
        border: 1px solid transparent;
        border-radius: 4px;
        text-align: center;
    }
    ul.pagination {
        display: flex;
        justify-content: center;
    }
</style>

<div class="page-content-wrapper">
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <h3 class="page-title">
            Manage Others Payments <small>You can edit, delete or cancel</small>
        </h3>
        <!-- END PAGE HEADER-->
        <!-- BEGIN PAGE CONTENT-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet box green">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-user"></i>List of all others payments
                        </div>                        
                        <div class="tools">
                            <a href="<?php echo Router::url(array('controller' => 'otherspayments', 'action' => 'create')) ?>" title="Add Others Payment" class="fa fa-plus">
                            </a>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <?php echo $this->Session->flash(); ?> 
                        <table class="table table-striped table-hover table-bordered" id="sample_editable_1">
                            <thead>
                                <tr>
                                    <th>Note</th>
                                    <th>Technician</th>                                    
                                    <th>Payment</th>
                                    <th>Payment Date</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($otherpayments as $single):
                                    ?>
                                    <tr >
                                        <td><?php echo $single['others_payments']['note']; ?></td>
                                        <td><?php echo $single['users']['name']; ?></td>
                                        <td><?php echo $single['others_payments']['payamount']; ?></td>
                                        <td><?php echo date('m-d-Y', strtotime($single['others_payments']['payment_date'])); ?></td>                                        
                                        <td><?php echo $single['others_payments']['status']; ?></td>
                                        <td>   
                                            <div class="controls center text-center">
                                                <?php if ($single['others_payments']['status'] == 'open'): ?>
                                                    <a aria-describedby="qtip-8" data-hasqtip="true" title="Cancel" oldtitle="Remove task" 
                                                       onclick="if (confirm('Are you sure to cancel this Admin?' )) { return true; } return false;"
                                                       href="<?php echo Router::url(array('controller' => 'otherspayments', 'action' => 'cancel', $single['others_payments']['id'])) ?>" title="block">
                                                        <span class="fa  fa-close"></span>
                                                    </a>
                                                &nbsp;
                                                 <a aria-describedby="qtip-8" data-hasqtip="true" title="Done" oldtitle="Remove task" 
                                                       onclick="if (confirm( & quot; Are you sure to done this Admin? & quot; )) { return true; } return false;"
                                                       href="<?php echo Router::url(array('controller' => 'otherspayments', 'action' => 'done', $single['others_payments']['id'])) ?>" title="block">
                                                        <span class="fa  fa-check"></span>
                                                    </a>
                                                <?php endif; ?>

                                                

                                                &nbsp;&nbsp;                                              
                                                <a  title="edit" href="<?php echo Router::url(array('controller' => 'otherspayments', 'action' => 'edit', $single['others_payments']['id'])) ?>" >
                                                    <span class="fa fa-pencil"></span></a>
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
                <!-- END EXAMPLE TABLE PORTLET-->

                <ul class="pagination" >
                    <?php
                    for ($i = 1; $i <= $total_page; $i++):
                        $active = '';
                        if(isset($this->params['pass'][0]) && $this->params['pass'][0] == $i){
                           $active = 'active'; 
                        }
                        ?>
                        <li class="paginate_button <?php echo $active; ?>" aria-controls="sample_editable_1" tabindex="<?php echo $i; ?>">
                            <a href="<?php echo Router::url(array('controller' => 'otherspayments', 'action' => 'manage', $i)) ?>"><?php echo $i; ?></a>
                        </li>
                    <?php endfor; ?>
                </ul>

            </div>
        </div>
        <!-- END PAGE CONTENT -->
    </div>
</div>
<!-- END CONTENT -->

