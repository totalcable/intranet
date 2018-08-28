
<style>
    .ui-datepicker-multi-3 {
        display: table-row-group !important;
    }
</style>

<style type="text/css">
    .alert {

        padding: 6px;
        margin-bottom: 5px;
        border: 1px solid transparent;
        border-radius: 4px;
        text-align: center;
    }
    ul.pagination {
/*        display: flex;*/
        justify-content: center;
        color: blue;
    }
</style>

<div class="page-content-wrapper" style="margin: 0px; padding: 0px;">
    <div class="">
        <!-- BEGIN PAGE CONTENT-->
        <div class="invoice" id="printableArea">

            <hr>
            <div class="row">
                <div class="col-xs-12">
                    <ul class="pagination" >
                        <?php
                        for ($i = 1; $i <= $data['total_page']; $i++):
                            $active = '';
                            if (isset($this->params['pass'][2]) && $this->params['pass'][2] == $i) {
                                $active = 'active';
                            }
                            ?>
                            <li class="paginate_button <?php echo $active; ?>" aria-controls="sample_editable_1" tabindex="<?php echo $i; ?>">
                                <a href="<?php echo Router::url(array('controller' => 'customers', 'action' => 'search', $type,$this->params['pass'][1], $i)) ?>"><?php echo $i; ?></a>
                            </li>
                        <?php endfor; ?>
                    </ul>
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
                                    Installation Date
                                </th>
                            </tr>
                        </thead>
                        <tbody>                                    
                            <?php
                            foreach ($data['data'] as $info):
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