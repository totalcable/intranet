<div class="page-content-wrapper" style="margin: 0px; padding: 0px;">
    <div class="">
        <!-- BEGIN PAGE CONTENT-->
        <div class="invoice" id="printableArea">

            <hr>
            <div class="row">
                <div class="col-xs-12">
                    <table class="table table-striped table-hover table-bordered" id="sample_editable_1">
                        <thead>
                            <tr> 
                                <th class="hidden-480">
                                    Account no.
                                </th>
                                <th class="hidden-480">
                                    Name
                                </th>
                                <th class="hidden-480">
                                    Address
                                </th>
                                <th class="hidden-480">
                                    Mac
                                </th>
                                <th class="hidden-480">
                                    Cell
                                </th>
                                <th>
                                    Package
                                </th>
                                <th class="hidden-480">
                                    Registration Date
                                </th>
                                <th class="hidden-480">
                                    Installation Date
                                </th>
                            </tr>
                        </thead>
                        <tbody>                                    
                            <?php
//                            pr($data); exit;
                            foreach ($data['cities'] as $info):
                                $pc = $info['pc'];
                                $customer_address = $pc['house_no'] . ' ' . $pc['street'] . ' ' .
                                        $pc['apartment'] . ' ' . $pc['city'] . ' ' . $pc['state'] . ' '
                                        . $pc['zip'];
                                ?>
                                <tr>
                                    <td><?php echo $info['pc']['id']; ?></td>
                                    <td> <a href="<?php echo Router::url(array('controller' => 'customers', 'action' => 'edit', $info['pc']['id'])) ?>" target="_blank"><?php echo $info['pc']['first_name'] . " " . $info['pc']['middle_name'] . " " . $info['pc']['last_name']; ?></a> </td>
                                    <td><?php echo $customer_address; ?></td>
                                    <td><?php echo $info['pc']['mac']; ?></td>
                                    <td><?php echo $info['pc']['cell']; ?></td>
                                    <td>
                                        <?php
                                        if (!empty($info['pc']['psetting_id'])) {
                                            echo $info['ps']['name'];
                                        } elseif (!empty($info['pc']['custom_package_id'])) {
                                            echo $info['cp']['duration'] . ' Months, Custom package ' . $info['cp']['charge'] . '$';
                                        } else {
                                            echo 'Package not set !';
                                        }
                                        ?>
                                    </td>                                                                                   
                                    <td><?php echo date('m-d-Y', strtotime($info['pc']['created'])); ?></td>  
                                    <td><?php echo date('m-d-Y', strtotime($info['pc']['modified'])); ?></td>  
                                </tr>
                            <?php endforeach; ?>                           
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>     