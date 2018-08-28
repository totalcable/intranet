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
           Done by admin customers List<small></small>
        </h3>
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
                        <table class="table table-striped table-hover table-bordered" id="sample_editable_1">
                            <thead>
                                <tr>
                                    <th class="sorting_desc">
                                        SL.
                                    </th>
                                    <th>
                                        Contact Date
                                    </th>
                                    <th>
                                        Customer Detail
                                    </th>
                                   
                                    <th>
                                        Package
                                    </th>
                                    
                                    <th>
                                        Issue
                                    </th>
                                    <th>
                                        Comment
                                    </th>
                                    <th>
                                        Attachment
                                    </th>                                    

                                    <th>
                                        Assigned to
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
                                    <tr>
                                        <td class="hidden-480">
                                            <?php echo $results['customers']['id']; ?>                            
                                        </td>
                                        <td class="hidden-480"> 
                                            <?php echo date('m-d-Y', strtotime($results['customers']['modified'])); ?>
                                            <br>
                                            <?php echo $results['users']['name']; ?>                            
                                        </td>
                                        <td>
                                            <a href="<?php
                                            echo Router::url(array('controller' => 'customers',
                                                'action' => 'edit', $results['customers']['id']))
                                            ?>" 
                                               target="_blank">
                                                   <?php
                                                   echo $results['customers']['first_name'] . " " .
                                                   $results['customers']['middle_name'] . " " .
                                                   $results['customers']['last_name'];
                                                   ?>
                                            </a><br>
                                            <?php if (!empty($customer['cell'])): ?>
                                                <b>Cell:</b>  <a href="tel:<?php echo $customer['cell'] ?>"><?php echo $customer['cell']; ?></a> &nbsp;&nbsp;
                                            <?php endif; ?><br>
                                            <?php if (!empty($customer['home'])): ?>
                                                <b> Phone: </b> <a href="tel:<?php echo $customer['home'] ?>"><?php echo $customer['home']; ?></a>
                                            <?php endif; ?> <br>

                                            <b> Address: </b> <?php echo $customer_address; ?> 
                                        </td>
                                        
                                        
                                        <td>
                                            <?php if (!empty($results['package']['name'])): ?>
                                                Name:<?php echo $results['package']['name'] ?><br>
                                                Duration:<?php echo $results['package']['duration']; ?><br>
                                                Amount: <?php echo $results['package']['amount']; ?>
                                            <?php endif; ?>
                                        </td>
                                        
                                        <td>
                                            <?php if (!empty($results['issue']['name'])): ?>
                                                <?php echo $results['issue']['name']; ?>
                                            <?php endif; ?>
                                        </td>                                       
                                        <td>
                                            <?php
                                            foreach ($results['comments'] as $comment):
                                                // pr($comment);
                                                ?>
                                                <span title="<?php echo $comment['content']['created']; ?>" class="fa fa-hand-o-right ">  <?php echo $comment['content']['content']; ?> &nbsp;&nbsp;</span> <i> <?php echo $comment['user']['name']; ?></i>
                                                
                                                <br><?php echo $comment['content']['created']; ?>
                                                <br> 
                                                <br> 

                                            <?php endforeach;
                                            ?>
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
                                            <ul>
                                                <li > <?php echo $results['tech']['name']; ?> </li>
                                                <li > <?php echo $results['tech']['email']; ?> </li> 
                                            </ul>

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
