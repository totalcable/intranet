
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
        /*display: flex;*/
        justify-content: center;
        color: blue;
    }
</style>
<div class="row-fluid">
    <ul class="pagination" >
        <?php
        for ($i = 1; $i <= $data['total_page']; $i++):
            $active = '';
            if (isset($this->params['pass'][2]) && $this->params['pass'][2] == $i) {
                $active = 'active';
            }
            ?>
            <li class="paginate_button <?php echo $active; ?>" aria-controls="sample_editable_1" tabindex="<?php echo $i; ?>">
                <a href="<?php echo Router::url(array('controller' => 'customers', 'action' => 'search', $type, $param, $i)) ?>"><?php echo $i; ?></a>
            </li>
        <?php endfor; ?>
    </ul>
    <table cellpadding="0" cellspacing="0" border="0" class="responsive dynamicTable display table table-bordered" width="100%">
        <thead>
            <tr>  
                <th>SL.</th>
                <th>Name</th>
                <th>Customer Detail</th>                
                <th>Status</th>
                <th>Action</th>

            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($data['customer'] as $index => $d):

                $customer = $d;
                $customer_address = $customer['house_no'] . ' ' . $customer['street'] . ' ' .
                        $customer['apartment'] . ' ' . $customer['city'] . ' ' . $customer['state'] . ' '
                        . $customer['zip'];
                $name = $customer['first_name'] . ' ' . $customer['middle_name'] . ' ' . $customer['last_name'];
                $package = array();

                if (count($data['package']) > 0) {
                    $package = $data['package'][$index];
                }
                ?>
                <tr class="odd gradeX">
                    <td><?php echo $customer['id']; ?></td>
                    <td>
                        <a target="_blank" title="Click & open customer information page :-)" href="<?php
                        echo Router::url(array('controller' => 'customers',
                            'action' => 'edit', $customer['id']))
                        ?>"style="color: royalblue;"> <b><?php echo $name; ?></b>
                        </a>


                    </td>
                    <td>
                        <ul>
                            <li><strong>Cell:</strong><?php echo $customer['cell']; ?></li>
                            <li><strong>Address:</strong><?php echo $customer_address; ?></li>
                            <li><strong>Package:</strong>
                                <?php if (!empty(($package['duration']))) { ?>
                                    <ul>
                                        <li> Name: <?php echo $package['name']; ?></li>
                                        <li> Month: <?php echo $package['duration']; ?></li>
                                        <li> Charge: <?php echo $package['charge']; ?></li>
                                    </ul>
                                <?php } else { ?> 
                                    <?php echo 'No Package Selected!' ?>                                    
                                <?php } ?>

                            </li>
                            <?php if (!empty($customer['mac'])) { ?>
                                <li> <strong>Mac:</strong> <?php echo $customer['mac']; ?></li>
                            <?php } ?>
                        </ul>
                    </td>

                    <td>                               
                        <?php echo $customer['mac_status']; ?></li>                              
                    </td>
                    <td>
                        <?php
                        echo $this->Form->create('PackageCustomer', array(
                            'inputDefaults' => array(
                                'label' => false,
                                'div' => false
                            ),
                            'id' => 'form_sample_3',
                            'class' => 'form-horizontal',
                            'novalidate' => 'novalidate',
                            'url' => array('controller' => 'admins', 'action' => 'changeservice')
                                )
                        );
                        ?>
                        <?php
                        echo $this->Form->input('id', array(
                            'type' => 'hidden',
                            'value' => $customer['id']
                                )
                        );
                        ?>
                        <?php
                        echo $this->Form->input('status', array(
                            'type' => 'select',
                            'options' => Array('ticket' => 'Generate Ticket', 'info' => 'Customer  Information', 'history' => 'Ticket History'),
                            'empty' => 'Select Action',
                            'class' => 'form-control form-filter input-sm ',
                                )
                        );
                        ?>
                        <br>
                        <?php
                        echo $this->Form->button(
                                'Go', array('class' => 'btn blue', 'title' => 'Do this selected action', 'type' => 'submit')
                        );
                        ?>
                        <?php echo $this->Form->end(); ?>
                    </td>
                </tr>
                <?php
            endforeach;
            ?>
        </tbody>
    </table>
</div>