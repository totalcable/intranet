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
        <!-- BEGIN PAGE CONTENT-->
        <div class="row">
            <div class="col-md-7">
                <div class="portlet box green">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-search"></i>Search Panel
                        </div>

                    </div>
                    <div class="portlet-body form">
                        <!-- BEGIN FORM-->
                        <?php
                        echo $this->Form->create('PackageCustomer', array(
                            'inputDefaults' => array(
                                'label' => false,
                                'div' => false
                            ),
                            'id' => 'form_sample_3',
                            'class' => 'form-horizontal',
                            'novalidate' => 'novalidate',
                                )
                        );
                        ?>
                        <div class="form-body">
                            <div class="alert alert-danger display-hide">
                                <button class="close" data-close="alert"></button>
                                You have some form errors. Please check below.
                            </div>
                            <?php echo $this->Session->flash(); ?>
                            <div class="form-group">
                                <div class="col-md-9  hide-rest" id="only-date-range">
                                    <?php
                                    echo $this->Form->input('param', array(
                                        'type' => 'text',
                                        'placeholder' => 'Type search parameter',
                                        'class' => 'form-control ',
                                        'style' => 'font-size: 15px;'
                                            )
                                    );
                                    ?>
                                </div>

                                <div class="col-md-9 display-hide hide-rest" id="only-city">
                                    <div class="col-md-4">
                                        <?php
                                        echo $this->Form->input('state', array(
                                            'type' => 'select',
                                            'options' => $states,
                                            'empty' => 'Select State',
                                            'class' => 'form-control select2me '
                                                )
                                        );
                                        ?>
                                    </div> 

                                    <div class="col-md-4">
                                        <?php
                                        echo $this->Form->input('city', array(
                                            'type' => 'select',
                                            'options' => $cities,
                                            'empty' => 'Select City',
                                            'class' => 'form-control select2me '
                                                )
                                        );
                                        ?>
                                    </div> 
                                    <div class="col-md-4">
                                        <?php
                                        echo $this->Form->input('zip', array(
                                            'type' => 'text',
                                            'placeholder' => 'Type search zip',
                                            'class' => 'form-control ',
                                            'style' => 'font-size: 15px;'
                                                )
                                        );
                                        ?>
                                    </div> 
                                </div>

                                <div class="col-md-3">
                                    <?php
                                    $search = array("1" => "Customer",  "2" => "Invoice No", "3" => "Transaction ID", '4' => 'Customer By Location',"5" => "Ticket ID");
//                                                    pr($clicked); exit;
                                    echo $this->Form->input(
                                            'search', array(
                                        'class' => 'form-control ',
                                        'default' => 'Customer',
                                        'options' => $search,
                                        'label' => false,
                                        'id' => 'actionforSearch',
                                        'style' => 'margin-left: -24px; width: 191px;'
                                            )
                                    );
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-7 col-md-4">
                                    <?php
                                    echo $this->Form->button(
                                            'Search', array('class' => 'btn green', 'type' => 'submit')
                                    );
                                    ?>
                                </div>
                            </div>
                        </div>
                        <?php echo $this->Form->end(); ?>
                        <!-- END FORM-->
                    </div>
                    <!-- END VALIDATION STATES-->
                </div>
            </div>

            <div class="col-md-5 col-sm-5">
                <!-- BEGIN PORTLET-->
                <div class="portlet">
                    <div class="portlet-title line" style="color:red;">
                        <div class="caption">
                            <i class="fa fa-envelope-o fa-lg" style="color:red;"></i>Announcements From Admin 
                        </div>
                    </div>
                    <div class="portlet-body" id="chats"/>
                    <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto;"><div class="scroller" style="overflow: hidden; width: auto;" data-always-visible="1" data-rail-visible1="1" data-initialized="1">
                            <ul class="chats ">
                                <?php
                                foreach ($admin_messages as $message):
                                    ?>
                                    <li class="in">
                                        <a style="color: #E02222; font-weight: bold;" href="#" class="name">
                                            <?php echo $message['u']['name']; ?> </a>                                                
                                        <span class="datetime">
                                            at
                                            <?php
                                            $dt = new DateTime($message['m']['created']);
                                            echo $dt->format('g:i A');
                                            ;?>  
                                        </span>
                                        <span class="body">
                                            <?php echo $message['m']['message']; ?> 
                                        </span>                                      
                                    </li> 
                                    <span class="devider"></span>
                                <?php endforeach ?>
                            </ul>
                        </div><div class="slimScrollBar" style="width: 7px; position: absolute; top: 0px; opacity: 0.4; display: block; border-radius: 7px; z-index: 99; right: 1px; height: 185.485px; background: rgb(187, 187, 187);"></div><div class="slimScrollRail" style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; opacity: 0.2; z-index: 90; right: 1px; background: rgb(234, 234, 234);"></div></div>
                </div>
            </div>
            <!-- END PORTLET-->
        </div>
    </div>
    <!-- END PAGE CONTENT -->        

    <?php
    if ($clicked == 1) {
        echo $this->element('customers', array('data' => $data, 'type' => $clicked,'param' =>$param));
    }

    if ($clicked == 2) {
        echo $this->element('transaction', array('data' => $data, 'type' => $clicked,'param' =>$param));
    }

    if ($clicked == 3) {
        echo $this->element('invoice', array('data' => $data, 'type' => $clicked,'param' =>$param));
    }

    if ($clicked == 4) {
        echo $this->element('customerbyloaction', array('data' => $data, 'type' => $clicked,'param' =>$param));
    }

    if ($clicked == 5) {
        echo $this->element('customerbyticketid', array('data' => $data, 'type' => $clicked,'param' =>$param));
    }
    ?>

</div>
</div>
<!-- END CONTENT -->

