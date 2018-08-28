
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
            Customer Box Information<small></small>
        </h3>
        <!-- BEGIN PAGE CONTENT-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet box green">
                    <div class="portlet-title">
                        <div class="caption" style="color: Balck;">
                            Total Active : <?php echo $total_active; ?> &nbsp;
                            Total Canceled : <?php echo $total_canceled; ?>&nbsp; 
                            Total Hold : <?php echo $total_hold; ?>&nbsp; 
                            Total Unhold : <?php echo $total_unhold; ?>
                        </div>
                    </div>
                    <div class="portlet-body">                       
                        <table class="table table-striped table-hover table-bordered" id="sample_editable_1">
                            <thead>
                                <tr>
                                    <th>
                                        Active Customers
                                    </th>

                                    <th>
                                        Canceled Customers
                                    </th>

                                    <th>
                                        Hold Customers
                                    </th>

                                    <th>
                                        Unhold Customers
                                    </th>                                    
                                </tr>
                            </thead>
                            <tbody>
                                <tr>                                    
                                    <td>
                                        <b>CMS1 :</b><?php echo $active['cms1']; ?><br>
                                        <b>CMS2 :</b><?php echo $active['cms2']; ?><br>
                                        <b>CMS3 :</b><?php echo $active['cms3']; ?><br>
                                        <b>Portal :</b><?php echo $active['portal']; ?><br>
                                        <b>Portal1 :</b><?php echo $active['portal1']; ?>
                                    </td>

                                    <td>
                                        <b>CMS1 :</b><?php echo $canceled['cms1']; ?><br>
                                        <b>CMS2 :</b><?php echo $canceled['cms2']; ?><br>
                                        <b>CMS3 :</b><?php echo $canceled['cms3']; ?><br>
                                        <b>Portal :</b><?php echo $canceled['portal']; ?><br>
                                        <b>Portal1 :</b><?php echo $canceled['portal1']; ?>
                                    </td>

                                    <td>
                                        <b>CMS1 :</b><?php echo $hold['cms1']; ?><br>
                                        <b>CMS2 :</b><?php echo $hold['cms2']; ?><br>
                                        <b>CMS3 :</b><?php echo $hold['cms3']; ?><br>
                                        <b>Portal :</b><?php echo $hold['portal']; ?><br>
                                        <b>Portal1 :</b><?php echo $hold['portal1']; ?>
                                    </td>

                                    <td>
                                        <b>CMS1:</b><?php echo $unhold['cms1']; ?><br>
                                        <b>CMS2 :</b><?php echo $unhold['cms2']; ?><br>
                                        <b>CMS3 :</b><?php echo $unhold['cms3']; ?><br>
                                        <b>Portal :</b><?php echo $unhold['portal']; ?><br>
                                        <b>Portal1 :</b><?php echo $unhold['portal1']; ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
