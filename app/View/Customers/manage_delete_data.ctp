
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
            All delete data<small></small>
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
                        <table class="table table-striped table-hover table-bordered" id="sample_editable_1">
                            <thead>
                                <tr>
                                    <th>
                                        Customer Id
                                    </th>
                                    <th>
                                        Contact Detail
                                    </th>

                                    <th>
                                        Information Detail
                                    </th>

                                    <th>
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($data as $results):
                                    
                                    $customer = $results['BackupPackageCustomer'];
                                    $customer_address = $customer['house_no'] . ' ' . $customer['street'] . ' ' .
                                            $customer['apartment'] . ' ' . $customer['city'] . ' ' . $customer['state'] . ' '
                                            . $customer['zip'];
                                    ?>
                                    <tr>
                                        <td>
                                            <?php echo $customer['id']; ?>
                                        </td>
                                        <td>
                                            <ul>
                                                <b>  Name :</b>  <a href="
                                                <?php
                                                echo Router::url(array('controller' => 'BackupPackageCustomer',
                                                    'action' => 'edit_registration', $results['BackupPackageCustomer']['id']))
                                                ?>" 
                                                                    target="_blank">
                                                                        <?php
                                                                        echo $results['BackupPackageCustomer']['first_name'] . " " .
                                                                        $results['BackupPackageCustomer']['middle_name'] . " " .
                                                                        $results['BackupPackageCustomer']['last_name'];
                                                                        ?>
                                                </a><br>
                                                <b>  Address :  </b>
                                                <?php if (!empty($customer_address)): ?>
                                                    <?php echo $customer_address; ?>
                                                <?php endif; ?>
                                                <br>

                                                <?php if (!empty($customer['cell'])): ?>
                                                    <b> Cell :</b> <a href="tel:<?php echo $customer['cell'] ?>"><?php echo $customer['cell']; ?></a><br>
                                                <?php endif; ?>
                                                <?php if (!empty($customer['home'])): ?>
                                                    <b>  Home :</b>  <a href="tel:<?php echo $customer['home'] ?>"><?php echo $customer['home']; ?></a>
                                                <?php endif; ?> 
                                            </ul>
                                        </td>

                                        <td>                                       

                                <li>Mac: $<?php echo $results['BackupPackageCustomer']['mac']; ?></li>
                                <li>STBS: $<?php echo $results['BackupPackageCustomer']['stbs']; ?></li>
                                <li>Status: $<?php echo $results['BackupPackageCustomer']['status']; ?></li>


                                </td>                                                                             

                                <td> 
                                    <div class="controls center text-center">

                                        <a aria-describedby="qtip-8" data-hasqtip="true" title="Restore" 
                                           onclick="if (confirm('Are you sure to restore this Customer?')) {
                                                       return true;
                                                   }
                                                   return false;"

                                           href="<?php
                                           echo Router::url(array('controller' => 'customers', 'action' => 'restore', $results['BackupPackageCustomer']['id'])
                                           )
                                           ?>"
                                           class="tip"><span class="fa fa-recycle fa-lg"></span></a>



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



