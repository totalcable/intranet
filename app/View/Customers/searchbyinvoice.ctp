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
            <div class="col-md-6">
                <div class="portlet box green">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-search"></i>Search Payment Information by Invoice
                        </div>
                        <!--                        <div class="tools">
                                                    <a href="javascript:;" class="reload">
                                                    </a>
                                                </div>-->
                    </div>
                    <div class="portlet-body form">
                        <!-- BEGIN FORM-->
                        <?php
                        echo $this->Form->create('Transaction', array(
                            'inputDefaults' => array(
                                'label' => false,
                                'div' => false
                            ),
                            'id' => 'form_sample_3',
                            'class' => 'form-horizontal',
                            'novalidate' => 'novalidate',
                                //'url' => array('controler' => 'Admins', 'action' => 'changeservice')
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
                                <div class="col-md-12">
                                    <?php
                                    echo $this->Form->input('id', array(
                                        'type' => 'text',
                                        'placeholder' => 'Type Invoice Number here',
                                        'class' => 'form-control required',
                                            )
                                    );
                                    ?>
                                </div>
                            </div>                           
                        </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-7 col-md-4">
                                    <?php
                                    echo $this->Form->button(
                                            'Search', array('class' => 'btn green', 'type' => 'submit')
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

            <div class="row-fluid">
                <table cellpadding="0" cellspacing="0" border="0" class="responsive dynamicTable display table table-bordered" width="100%">
                    <thead>
                        <tr>                                           
                            <th>Customer Info</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Payment Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($trinfo as $result):
                            //pr($result['tr']); exit;
                            $customer_address = $result['pc']['house_no'] . ' ' . $result['pc']['street'] . ' ' .
                                    $result['pc']['apartment'] . ' ' . $result['pc']['city'] . ' ' . $result['pc']['state'] . ' '
                                    . $result['pc']['zip'];
                            ?>
                            <tr class="odd gradeX">
                                <td>
                                    <ul>
                                        <li>Name: <a href="<?php  echo Router::url(array('controller' => 'customers','action' => 'edit', $result['pc']['id'])) ?>" 
                                         target="_blank"><?php echo $result['pc']['first_name'] . ' ' . $result['pc']['middle_name'] . ' ' . $result['pc']['last_name']; ?></a></li>
                                        <li>Address: <?php echo $customer_address; ?></li>
                                        <li>Cell: <?php echo $result['pc']['cell']; ?></li>                                    
                                        <li>Email: <?php echo $result['pc']['email']; ?></li>                                    
                                    </ul>
                                </td>
                                <td>
                                        <?php echo $result['tr']['payable_amount']; ?>                                          
                                </td>
                                <td>
                                        <?php echo $result['tr']['status']; ?>                                          
                                </td>
                                <td>                               
                                    <?php echo $result['tr']['created']; ?>                               
                                </td>                               
                            </tr>
                            <?php
                        endforeach;
                        ?>
                    </tbody>
                </table>
            </div>
            <?php
        endif;
        ?>
    </div>
</div>
<!-- END CONTENT -->

