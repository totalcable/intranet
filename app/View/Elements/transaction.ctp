<div class="row-fluid">
    <table cellpadding="0" cellspacing="0" border="0" class="responsive dynamicTable display table table-bordered" width="100%">
        <thead>
            <tr>                                           
                <th>Customer Info</th>
                <th>Paid Amount</th>
                <th>Payment Date</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($data as $result):
//                            pr($result['tr']['package_customer_id']); exit;
                $customer_address = $result['pc']['house_no'] . ' ' . $result['pc']['street'] . ' ' .
                        $result['pc']['apartment'] . ' ' . $result['pc']['city'] . ' ' . $result['pc']['state'] . ' '
                        . $result['pc']['zip'];
                ?>
                <tr class="odd gradeX">
                    <td>
                        <ul>
                            <li>Name: <a href="<?php echo Router::url(array('controller' => 'customers', 'action' => 'edit', $result['pc']['id'])) ?>" 
                                         ><?php echo $result['pc']['first_name'] . ' ' . $result['pc']['middle_name'] . ' ' . $result['pc']['last_name']; ?></a></li>
                            <li>Address: <?php echo $customer_address; ?></li>
                            <li>Cell: <?php echo $result['pc']['cell']; ?></li>                                    
                            <li>Email: <?php echo $result['pc']['email']; ?></li>                                    
                        </ul>
                    </td>
                    <td>
                        <?php if (count($result['tr']['paid_amount']) > 0): ?>                                       
                            <?php echo $result['tr']['paid_amount']; ?>                                          
                        <?php endif; ?>
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