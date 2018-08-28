
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
            Manage Logistics <small>You can edit, delete </small>
        </h3>
        <!-- BEGIN PAGE CONTENT-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet box green">
                    <div class="portlet-title">
                        <div class="caption">

                        </div>

                        <div class="tools">
                            <a target="_blank" href="<?php echo Router::url(array('controller' => 'Logistics', 'action' => 'logistics_mainten')) ?>" title="Add new logistic" class="fa fa-plus">
                            </a>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <?php echo $this->Session->flash(); ?> 
                        <table class="table table-striped table-hover table-bordered" id="sample_editable_1">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Product</th>
                                    <th>Insert data by</th>
                                    <th>Requisition</th>

                                    <th>Allocated Time</th>
                                    <th>Approved By</th>
                                    <th>Received Condition</th>

<!--<th>Received Date</th>-->
<!--<th>Product Receive Date</th>-->
                                    <th>Hand Over</th>
<!--                                    <th>Hand Over By</th>-->
                                    <th>Insert Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($logistics as $single):
                                    $logistic = $single['l'];
                                    $logistic_p = $single['p'];
                                    $user = $single['u'];
                                    ?>
                                    <tr class="odd gradeX">
                                        <td>
                                            <a target="_blank" href="<?php echo Router::url(array('controller' => 'Logistics', 'action' => 'report', $logistic['id'])) ?>" class="btn btn-default fancybox-fast-view"> <?php echo $logistic['id']; ?></a><br>
                                        </td>
                                        <td><?php echo $logistic_p['name']; ?></td>
                                        <td><?php echo $user['name']; ?></td>
                                        <td><b>Date:</b> <?php echo $logistic['requisition_date']; ?><br>
                                            <b>By:</b> <?php echo $logistic['requisition_by']; ?>
                                        </td>                                       
                                        <td>
                                            <b>From:</b> <?php echo $logistic['from_date']; ?><br>
                                            <b>To: </b>  <?php echo $logistic['to_date']; ?>
                                        </td>
                                        <td><?php echo $logistic['approved_by']; ?></td>
                                        <td><b>Condition:</b> <?php echo $logistic['received_condition']; ?><br>
                                            <b>Date:</b> <?php echo $logistic['received_date']; ?>
                                            <?php // echo $logistic['product_receive_date'];  ?>
                                        </td>
                                        <td><b>Condition:</b> <?php echo $logistic['hand_over_condition']; ?><br>
                                            <b>By: </b><?php echo $logistic['hand_over_by']; ?>
                                        </td>
                                        <td><?php echo $logistic['created']; ?></td>
                                        <td>   
                                            <div class="controls center text-center">
                                                <a target="_blank"  title="edit" href="<?php echo Router::url(array('controller' => 'Logistics', 'action' => 'editlogistic', $logistic['id'])) ?>" >
                                                    <span class="fa fa-pencil"></span></a>
                                                &nbsp;&nbsp;
                                                <!--                                                <a onclick="if (confirm( & quot; Are you sure to delete this Admin? & quot; )) {
                                                                                                            return true;
                                                                                                        }
                                                                                                        return false;"
                                                                                                   href="<?php echo Router::url(array('controller' => 'Logistics', 'action' => 'delete_logistic', $logistic['id'])) ?>" title="delete">
                                                                                                    <span class="fa fa-minus-square"></span>
                                                                                                </a>-->
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
            </div>
        </div>
        <!-- END PAGE CONTENT -->
    </div>
</div>
<!-- END CONTENT -->

