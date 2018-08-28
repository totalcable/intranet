
<style type="text/css">
    .alert {
        padding: 6px;
        margin-bottom: 5px;
        border: 1px solid transparent;
        border-radius: 4px;
        text-align: center;
    }
</style>

        <!-- BEGIN PAGE HEADER-->
        <h3 class="page-title">
            Summery Report Information<small></small>
        </h3>
        <!-- BEGIN PAGE CONTENT-->
        
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
                        <table class="table table-striped table-hover table-bordered" id="sample_editable_1">
                            <thead>
                                <tr>
                                    <th>
                                        Open Invoice
                                    </th>

                                    <th>
                                        Passed due Invoice
                                    </th>

                                    <th>
                                        Closed Invoice
                                    </th>                                    
                                </tr>
                            </thead>
                            <tbody>
                                <tr>                                    
                                    <td><?php echo $data['invoice']['open']; ?></td>

                                    <td><?php echo $data['invoice']['passed']; ?></td>

                                    <td><?php echo $data['invoice']['close']; ?> </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
 