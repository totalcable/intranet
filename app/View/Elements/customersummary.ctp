
<style type="text/css">
    .alert {
        padding: 6px;
        margin-bottom: 5px;
        border: 1px solid transparent;
        border-radius: 4px;
        text-align: center;
    }
</style>

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
                            Total Active : <?php echo $data['total_active']; ?> &nbsp;
                            Total Canceled : <?php echo $data['total_canceled']; ?>&nbsp; 
                            Total Hold : <?php echo $data['total_hold']; ?>&nbsp; 
                            Total Unhold : <?php echo $data['total_unhold']; ?>
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
                                        <b>CMS1 :</b><?php echo $data['active']['cms1']; ?><br>
                                        <b>CMS2 :</b><?php echo $data['active']['cms2']; ?><br>
                                        <b>CMS3 :</b><?php echo $data['active']['cms3']; ?><br>
                                        <b>Portal :</b><?php echo $data['active']['portal']; ?><br>
                                        <b>Portal1 :</b><?php echo $data['active']['portal1']; ?>
                                    </td>

                                    <td>
                                        <b>CMS1 :</b><?php echo $data['canceled']['cms1']; ?><br>
                                        <b>CMS2 :</b><?php echo $data['canceled']['cms2']; ?><br>
                                        <b>CMS3 :</b><?php echo $data['canceled']['cms3']; ?><br>
                                        <b>Portal :</b><?php echo $data['canceled']['portal']; ?><br>
                                        <b>Portal1 :</b><?php echo $data['canceled']['portal1']; ?>
                                    </td>

                                    <td>
                                        <b>CMS1 :</b><?php echo $data['hold']['cms1']; ?><br>
                                        <b>CMS2 :</b><?php echo $data['hold']['cms2']; ?><br>
                                        <b>CMS3 :</b><?php echo $data['hold']['cms3']; ?><br>
                                        <b>Portal :</b><?php echo $data['hold']['portal']; ?><br>
                                        <b>Portal1 :</b><?php echo $data['hold']['portal1']; ?>
                                    </td>

                                    <td>
                                        <b>CMS1:</b><?php echo $data['unhold']['cms1']; ?><br>
                                        <b>CMS2 :</b><?php echo $data['unhold']['cms2']; ?><br>
                                        <b>CMS3 :</b><?php echo $data['unhold']['cms3']; ?><br>
                                        <b>Portal :</b><?php echo $data['unhold']['portal']; ?><br>
                                        <b>Portal1 :</b><?php echo $data['unhold']['portal1']; ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
  
