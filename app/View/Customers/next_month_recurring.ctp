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
            Next month recurring list <small></small>
        </h3>
        <?php
        
        
      
//$date1 = strtotime(date('Y-m-d'));
//$date2 = strtotime($days_ago);
//
//
//$hourDiff=round(abs($date2 - $date1) / (60*60*24),0);
//
//       
//                                     pr($hourDiff);
//                                    exit;
        
        if ($total_cus['total'] > 0) { ?>
            <!-- BEGIN PAGE CONTENT-->
            <div class="row">
                <div class="col-md-12">
                    <!-- BEGIN EXAMPLE TABLE PORTLET-->
                    <div class="portlet box green">
                        <div class="portlet-title">
                            <div class="caption">                            
                                <h3 title="Total next month recuring :-)">Total customers : ( <b style="color: red;"><?php echo $total_cus['total']; ?></b> ) </h3>
                            </div>
                            <!--<div class="tools">-->
                            <div class="tools">
                                <div  style="float: left; height: 20px; width: 23px; background-color: red;">                        
                                    <a style=" color: yellow; margin-left: 5px;" onclick="if (confirm( &quot; Are you sure to execute next recurring Admin? &quot; )) {
                                                    return true;
                                                }
                                                return false;"
                                       href="<?php echo Router::url(array('controller' => 'customers', 'action' => 'generate_next_invoice')) ?>"  enctype="multipart/form-data" title="Click & create next recurring invoice :-)">
                                        <span class="fa fa-check-circle"></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <?php echo $this->Session->flash(); ?> 
                            <table class="table table-striped table-hover table-bordered" id="sample_editable_1">
                                <thead>
                                    <tr>
                                        <th>
                                            SL.
                                        </th> 
                                        <th>
                                            Customer detail
                                        </th>
                                        <th>
                                            Next recurring details
                                        </th>
                                        <th>
                                            Comment
                                        </th>
                                    </tr>
                                </thead>
                                <tbody> 
                                    <?php
                                    foreach ($allData as $customers):
                                        $customer = $customers['package_customers'];
                                        $date = date('Y-m-d', strtotime($customer['next_r_date']));
                                        $days_ago = date('Y-m-d', strtotime('-15 days', strtotime($date)));
                                        
                                        
                                        $customer_address = $customer['house_no'] . ' ' . $customer['street'] . ' ' .
                                                $customer['apartment'] . ' ' . $customer['city'] . ' ' . $customer['state'] . ' '
                                                . $customer['zip'];
                                        ?>
                                        <tr>
                                            <td class="hidden-480">
                                                <?php echo $customer['id']; ?>                            
                                            </td>                                           
                                            <td>
                                                <b>Name: </b> <a href="<?php
                                                echo Router::url(array('controller' => 'customers',
                                                    'action' => 'edit', $customer['id']))
                                                ?>" 
                                                                 target="_blank">
                                                                     <?php
                                                                     echo $customer['first_name'] . " " .
                                                                     $customer['middle_name'] . " " .
                                                                     $customer['last_name'];
                                                                     ?>
                                                </a><br>
                                                <?php if (!empty($customer['cell'])): ?>
                                                    <b>Cell:</b>  <?php echo $customer['cell'] ?> &nbsp;&nbsp;
                                                <?php endif; ?><br>
                                                <?php if (!empty($customer['home'])): ?>
                                                    <b> Phone: </b><?php echo $customer['home'] ?>
                                                <?php endif; ?> <br>
                                                <b> Address: </b> <?php echo $customer_address; ?> 
                                            </td>
                                             <td>
                                                <ul>
                                                    <?php if ($customer['next_recurring'] == 'yes'): ?>
                                                        <b>Next recurring :</b> <?php echo $customer['next_recurring'] ?> <br>
                                                        <b>Next recurring duration :</b>   <?php echo $customer['next_r_duration'] ?>  <br>
                                                        <b>Next billing date :</b> <?php echo $customer['next_r_date'] ?> <br>                                                    
                                                        <b style="color: red;" title="Please click right side of the title bar for create invoice"> Invoice create date : <?php echo $days_ago; ?> </b><br>

                                                        <b>Next billing amount :</b> <?php echo $customer['next_r_payable_amount'] ?> 
                                                    <?php endif ?>
                                                </ul>
                                            </td>
                                            <td>
                                                <ul>
                                                    <?php if (!empty($customer['next_r_comment'])): ?>
                                                        <?php echo $customer['next_r_comment'] ?> 
                                                    <?php endif ?>
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
        <?php } else { ?>
            <div class="page-content-wrapper">
                <div class="page-content">
                    <div class="col-md-12">
                      <canvas id="myCanvas" width="700" height="90"
style="border:1px solid #d3d3d3;">
Your browser does not support the canvas element.
</canvas>
                        
                        
                        <script>
var canvas = document.getElementById("myCanvas");
var ctx = canvas.getContext("2d");
ctx.font = "70px Arial";
ctx.color = "green";
ctx.strokeText("All invoice updated :-)",15,65);
</script>

                    </div>
                </div>
            </div>
        <?php } ?>


    </div>
</div>
<!-- END CONTENT -->



