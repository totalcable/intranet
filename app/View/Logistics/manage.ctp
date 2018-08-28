
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
            Manage Product <small>You can edit, delete or block</small>
        </h3>
        <!-- BEGIN PAGE CONTENT-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet box green">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-user"></i>List of All Products
                        </div>

                        <div class="tools">
                            <a href="<?php echo Router::url(array('controller' => 'Logistics', 'action' => 'add_product')) ?>" title="Add new product" class="fa fa-plus">
                            </a>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <?php echo $this->Session->flash(); ?> 
                        <table class="table table-striped table-hover table-bordered" id="sample_editable_1">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($products as $single):
                                    $products = $single['Product'];
                                    ?>
                                    <tr >
                                        <td><?php echo $products['id']; ?></td>
                                        <td><?php echo $products['name']; ?></td>
                                        <td><?php echo $products['created']; ?></td>
                                        <td>   
                                            <div class="controls center text-center">
                                                <a  title="edit" href="<?php echo Router::url(array('controller' => 'Logistics', 'action' => 'ediproduct', $products['id'])) ?>" >
                                                    <span class="fa fa-pencil"></span></a>
<!--                                                &nbsp;&nbsp;
                                                <a onclick="if (confirm(&quot; Are you sure to delete this Admin?&quot; )) {
                                                                return true;
                                                            }
                                                            return false;"
                                                    href="<?php echo Router::url(array('controller' => 'Logistics', 'action' => 'delete', $products['id'])) ?>" title="delete">
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

