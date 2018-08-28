
<div class="page-content-wrapper">
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>   </li>
                <li>   </li>
                <li>   </li>
            </ul>
            <script></script>
            <div class="page-toolbar">
                <div class="btn-group pull-right">
                    <a id="btnclick" class="btn btn-lg blue hidden-print margin-bottom-5" target="_blank" onclick="printDiv('printableArea')">
                        Print <i class="fa fa-print"></i>
                    </a>

                </div>
            </div>
        </div>
        <!-- END PAGE HEADER-->
        <!-- BEGIN PAGE CONTENT-->
        <div class="invoice" id="printableArea">
            <div class="row invoice-logo">
                <div class="col-xs-12 invoice-logo-space">
                    <!--<img src="../../assets/admin/pages/media/invoice/walmart.png" class="img-responsive" alt="">-->
                    <div class="row">
                        <div class="col-xs-6">
                            <h3 class="page-title">
                                Sales and Support Department Report<small></small>
                            </h3>
                        </div>
                        <div class="col-xs-4">
                        </div>
                        <div class="col-xs-2 invoice-payment">
                            <div style="text-align: left;">
                                <div>   Total Cable USA</div>
                                <div>P.O. BOX 770068,</div>
                                <div>WOODSIDE,</div>
                                <div>NY 11377</div>
                                <div>
                                    <div style="left: 103.238px; top: 144.543px; font-size: 25px; font-family: sans-serif;">☎<small style="font-size: 12px;">&nbsp 1-212-444-8138</small></div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6">
                </div>
            </div>
            <hr>
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
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
<!--                                <th style="text-align: center;">
                                    Total Call
                                </th>
                                <th class="hidden-480" style="text-align: center;">
                                    New Order Taken
                                </th>
                                <th class="hidden-480" style="text-align: center;">
                                    Sales Done
                                </th>
                                <th style="text-align: center;">
                                    Sales Query
                                </th>-->
                                
                                <th class="hidden-480" style="text-align: center;">
                                    New installation
                                </th>
<!--                                <th class="hidden-480" style="text-align: center;">
                                    Additional installation
                                </th>
                                <th class="hidden-480" style="text-align: center;">
                                    Total box installed
                                </th>-->
                                 <th class="hidden-480" style="text-align: center;">
                                    Hold
                                </th>
                                <th class="hidden-480" style="text-align: center;">
                                    Unhold
                                </th>
                                  <th class="hidden-480" style="text-align: center;">
                                    Reconnect
                                </th>
                                <th class="hidden-480" style="text-align: center;">
                                    Full service cancel
                                </th>
                                <th class="hidden-480" style="text-align: center;">
                                    Cancel from due bill
                                </th>
                               
                              
                            </tr>
                        </thead>
                        <tbody>                           
                            <tr>
<!--                                <td style="text-align: center;">  
                                    <?php if (!empty($total['0'])) : ?> 
                                        <?php echo $total['0']; ?> 
                                    <?php endif; ?>
                                </td>  
                                <td style="text-align: center;">   
                                    <?php if (!empty($total['ready'])): ?>
                                        <?php echo $total['ready']; ?> 
                                    <?php endif; ?>
                                </td>  
                                <td style="text-align: center;">   
                                    <?php if (!empty($total['done'])): ?>
                                        <?php echo $total['done']; ?> 
                                    <?php endif; ?>
                                </td>  
                                <td style="text-align: center;">      
                                    <?php if (!empty($total['sales_query'])) : ?>
                                        <?php echo $total['sales_query']; ?> 
                                    <?php endif; ?>
                                </td>  -->
                                <td style="text-align: center;"> 
                                    <?php if (!empty($total['installation'])): ?>
                                        <?php echo $total['installation']; ?> 
                                    <?php endif; ?>
                                </td>  
<!--                                <td style="text-align: center;"> 
                                    <?php if (!empty($total['hold'])) : ?>
                                        <?php echo $total['hold']; ?> 
                                    <?php endif; ?>
                                </td> 
                                <td style="text-align: center;">                
                                    <?php if (!empty($total['unhold'])): ?>
                                        <?php echo $total['unhold']; ?> 
                                    <?php endif; ?>
                                </td>  -->
                                <td style="text-align: center;"> 
                                    <?php if (!empty($total['hold'])) : ?>
                                        <?php echo $total['hold']; ?> 
                                    <?php endif; ?>
                                </td> 
                                <td style="text-align: center;">                
                                    <?php if (!empty($total['unhold'])): ?>
                                        <?php echo $total['unhold']; ?> 
                                    <?php endif; ?>
                                </td>                                 
                                                              
                                 <td style="text-align: center;"> 
                                    <?php if (!empty($total['reconnection'])) : ?>
                                        <?php echo $total['reconnection']; ?> 
                                    <?php endif; ?>
                                </td> 
                                <td style="text-align: center;">                
                                    <?php if (!empty($total['servicecancel'])) : ?>
                                        <?php echo $total['servicecancel']; ?> 
                                    <?php endif; ?>
                                </td> 
                                <td style="text-align: center;">                                        
                                  <?php if (!empty($total['cancelduebill'])): ?>
                                        <?php echo $total['cancelduebill']; ?> 
                                    <?php endif; ?>
                                </td> 
                                 
                            </tr>                                                 
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
