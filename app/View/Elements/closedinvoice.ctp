<div class="col-md-12">
    <!-- BEGIN EXAMPLE TABLE PORTLET-->
    <div class="portlet box green">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa ">Total Customers: <?php echo count($data); ?></i>
            </div>
            <div class="tools">
                <a href="javascript:;" class="reload">
                </a>
            </div>
        </div>
        <div class="portlet-body">
            <?php echo $this->Session->flash(); ?> 
            <ul class="pagination" >
                <?php
                //echo $issue.':'.$agent.':'.$status;
                for ($i = 1; $i <= $total_page; $i++):
                    $active = '';

                    if (isset($this->params['pass'][0]) && $this->params['pass'][0] == $i) {
                        $active = 'active';
                    }
                    ?>
                    <li class="paginate_button <?php echo $active; ?>" aria-controls="sample_editable_1" tabindex="<?php echo $i; ?>">
                        <a href="<?php echo Router::url(array('controller' => 'reports', 'action' => 'all', $action, $i, $start, $end)) ?>"><?php echo $i; ?></a>
                    </li>
                <?php endfor; ?>
            </ul>

            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>
                            #
                        </th>
                        <th>
                            Name
                        </th>
                        <th>
                            DESCRIPTION
                        </th>
                        <th>
                            STB QUANTITY
                        </th>
                        <th>
                            PRICE
                        </th>
                        <th>
                            Paid Amount
                        </th>
                        <th>
                            SUBSCRIPION
                        </th>

                        <th>
                            TOTAL
                        </th>
                        <th>
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>                                    
                    <?php
                    foreach ($data['packagecustomers'] as $single):
                        ?>
                        <tr>
                            <td>
                                <?php
                                echo getInvoiceNumbe($single['tr']['id']);
                                ?>
                            </td>
                            <td>
                                <?php echo $single['0']['name']; ?>
                            </td>
                            <td>
                                <b><?php echo $single['ps']['name']; ?></b><br>
                                <?php echo $single['p']['name']; ?>
                            </td> 
                            <td>
                                <?php echo count(json_decode($single['pc']['mac'])); ?> 
                            </td>
                            <td>
                                $ <?php echo $single['ps']['amount']; ?>.00
                            </td>
                            <td>
                                $ <?php echo $single['tr']['paid_amount']; ?>.00
                            </td>
                            <td>
                                <?php echo $single['ps']['duration']; ?>
                            </td>
                            <td>
                                $<?php echo $single['ps']['amount']; ?>.00 USD
                            </td>
                            <td>
                                <div class="controls center text-center">
                                    <a   target="_blank" title="Add to pdf" href="<?php echo Router::url(array('controller' => 'reports', 'action' => 'invoice', $single['tr']['id'])) ?>" class="btn default btn-xs green-stripe">
                                        Invoice </a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>                           
                </tbody>
            </table>              
        </div>
    </div>
</div>