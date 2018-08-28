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
            Follow up<small></small>
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
                        <table class="table  table-bordered" id="sample_editable_1">
                            <thead>
                                <tr>
                                    <th>
                                        SL.
                                    </th>
                                    <th>
                                        Customer Details
                                    </th>
                                    <th class="hidden-480">
                                        Reference Contact
                                    </th>
                                    <th style="text-align: center;">
                                        Package
                                    </th>
                                    <th style="text-align: center;">
                                        Issue
                                    </th>
                                    <th class="hidden-480">
                                        Follow update
                                    </th>
                                    <th class="hidden-480" style="text-align: center;">
                                        Comment
                                    </th>
                                    <th class="hidden-480">
                                        Attachment
                                    </th>
                                    <th class="hidden-480">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($filteredData as $results):
                                    $customer = $results['customers'];

                                    $customer_address = $customer['house_no'] . ' ' . $customer['street'] . ' ' .
                                            $customer['apartment'] . ' ' . $customer['city'] . ' ' . $customer['state'] . ' '
                                            . $customer['zip'];
                                    ?>
                                    <?php
                                    $follow_up_time = strtotime($results['customers']['follow_date']);
//                                        pr($milliseconds); exit;
                                    $warning = '';
                                    if ($follow_up_time < time()) {
                                        $warning = 'alert alert-danger';
                                    }
                                    ?>
                                    <tr class="<?php echo $warning; ?>">
                                        <td class="hidden-480">
                                            <?php echo $results['customers']['id']; ?>                            
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
                                            </a><br>
                                            <?php echo $customer_address; ?> 
                                        </td>
                                        <td>
                                            <?php echo $results['customers']['referred_phone']; ?> 
                                        </td>
                                        <td >
                                            <ul>
                                                <li>Name:  <?php echo $results['package']['name']; ?> </li>
                                                <li>Duration:  <?php echo $results['package']['duration']; ?> </li>
                                                <li>Amount:  <?php echo $results['package']['amount']; ?> </li>
                                            </ul>
                                        </td>
                                        <td>
                                            <?php if (!empty($results['issue']['name'])): ?>
                                                <?php echo $results['issue']['name']; ?>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php echo date('m-d-Y h:i:sa', strtotime($results['customers']['follow_date'])); ?>
                                        </td> 
                                        <td>
                                            <ul>
                                                <?php foreach ($results['comments'] as $comment): ?>
                                                    <li><?php echo $comment['content']['content'] . ' -By <i>' . $comment['user']['name']; ?> </i></li>
                                                <?php endforeach; ?>
                                            </ul>
                                        </td>
                                        <td>
                                            <div class="col-md-12 col-sm-12 mix category_2 category_1">
                                                <div class="mix-inner">
                                                    <?php if (!empty($customer['attachment'])) { ?>
                                                        <img class="img-responsive" src="<?php echo $this->webroot . 'attchment' . '/' . $customer['attachment']; ?>" alt="">
                                                        <div class="mix-details">
                                                            <a class="mix-preview fancybox-button" href="<?php echo $this->webroot . 'attchment' . '/' . $customer['attachment']; ?>" title="Project Name" data-rel="fancybox-button">
                                                                <i class="fa fa-eye pull-right"></i>
                                                            </a>
                                                        </div>
                                                    <?php } else { ?>
                                                        <h4> No Attachment</h4>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <a 
                                                href="done_dialog<?php echo $results['customers']['id']; ?>" title="Done" class="toggleDiv">
                                                <span  class="fa fa-check fa-lg "></span>
                                            </a>
                                            &nbsp;
<!--                                            <a 
                                                href="ready_dialog<?php echo $results['customers']['id']; ?>" title="Ready" class="toggleDiv">
                                                <span id="" class="fa fa-reddit fa-lg "></span>
                                            </a>                                             -->
                                            <div id="done_dialog<?php echo $results['customers']['id']; ?>" class=" hideRest portlet-body form" style="display: none;">
                                                <!-- BEGIN FORM-->
                                                <?php
                                                echo $this->Form->create('Comment', array(
                                                    'inputDefaults' => array(
                                                        'label' => false,
                                                        'div' => false
                                                    ),
                                                    'id' => 'form_sample_3',
                                                    'class' => 'form-horizontal',
                                                    'novalidate' => 'novalidate',
                                                    'url' => array('controller' => 'customers', 'action' => 'done')
                                                        )
                                                );
                                                ?>
                                                <?php
                                                echo $this->Form->input('package_customer_id', array(
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
                                                    <?php echo $this->Session->flash(); ?>
                                                    <div class="form-group">
                                                        <div class="form-group">
                                                            <div class="col-md-12">
                                                                <?php
                                                                echo $this->Form->input('content', array(
                                                                    'type' => 'textarea',
                                                                    'class' => 'form-control required txtArea',
                                                                    'placeholder' => 'Write your comments'
                                                                        )
                                                                );
                                                                ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                    <div class="row">
                                                        <div class="col-md-offset-7 col-md-4">
                                                            <?php
                                                            echo $this->Form->button(
                                                                    'Done', array('class' => 'btn green', 'type' => 'submit')
                                                            );
                                                            ?>
                                                        </div>
                                                    </div>
                                                <?php echo $this->Form->end(); ?>
                                                <!-- END FORM-->
                                            </div> 
                                            <div id="ready_dialog<?php echo $results['customers']['id']; ?>" class=" hideRest portlet-body form" style="display: none;">
                                                <!-- BEGIN FORM-->
                                                <?php
                                                echo $this->Form->create('Comment', array(
                                                    'inputDefaults' => array(
                                                        'label' => false,
                                                        'div' => false
                                                    ),
                                                    'id' => 'form_sample_3',
                                                    'class' => 'form-horizontal',
                                                    'novalidate' => 'novalidate',
                                                    'url' => array('controller' => 'customers', 'action' => 'ready')
                                                        )
                                                );
                                                ?>
                                                <?php
                                                echo $this->Form->input('package_customer_id', array(
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
                                                    <?php echo $this->Session->flash(); ?>
                                                    <div class="form-group">
                                                        <div class="col-md-12">
                                                            <?php
                                                            echo $this->Form->input('content', array(
                                                                'type' => 'textarea',
                                                                'class' => 'form-control required txtArea',
                                                                'placeholder' => 'Write your comments'
                                                                    )
                                                            );
                                                            ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-actions">
                                                    <div class="row">
                                                        <div class="col-md-offset-3 col-md-4">
                                                            <?php
                                                            echo $this->Form->button(
                                                                    'Ready', array('class' => 'btn green', 'type' => 'submit')
                                                            );
                                                            ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php echo $this->Form->end(); ?>
                                                <!-- END FORM-->
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








