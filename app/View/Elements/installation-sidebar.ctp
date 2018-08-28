<!-- BEGIN SIDEBAR -->
<div class="page-sidebar-wrapper">   
    <div class="page-sidebar navbar-collapse collapse" style="width: 247px; margin-top: 11px; height: 100%;">
        <!-- BEGIN SIDEBAR MENU -->
        <ul class="page-sidebar-menu"  data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
            <!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
            <li class="sidebar-toggler-wrapper">
                <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
                <div class="sidebar-toggler">
                </div>
                <!-- END SIDEBAR TOGGLER BUTTON -->
            </li>               

           
            <li 
            <?php
            $services = array('servicemanage');
            if (in_array($this->name . '' . $this->action, $services)):
                ?>
                    class="active"
                    <?php
                endif;
                ?>
                >                 
                <a href="<?php echo Router::url(array('controller' => 'admins', 'action' => 'servicemanage')) ?>">
                    <i class="fa fa-support"></i>
                    <span class="title">Service Management</span>
                    <span class="arrow "></span>
                </a>
            </li>
            
            <li 
            <?php
            $tickets = array('Ticketscreate', 'Ticketsmanage', 'TicketsAssigned_to_me', 'TicketsForwarded_by', 'Ticketssolved_ticket', 'Ticketsin_progress', 'Ticketsdecline_ticket', 'Ticketssuccessful');
            if (in_array($this->name . '' . $this->action, $tickets)):
                ?>
                    class="active"
                    <?php
                endif;
                ?>
                >
                <a href="javascript:;">
                    <i class="fa fa-ticket"></i>
                    <span class="title">Ticket Management</span>
                    <span class="arrow "></span>
                </a>
                <ul class="sub-menu">


                    <!--                    <li
                    <?php if ($this->name . '' . $this->action == 'Ticketscreate'):
                        ?>
                                                                                                            class="active"
                        <?php
                    endif;
                    ?>
                                            >
                                            <a href="<?php echo Router::url(array('controller' => 'tickets', 'action' => 'create')) ?>">
                                                <i class="fa fa-graduation-cap"></i>
                                                Create New</a>
                                        </li>-->
                    <li
                    <?php if ($this->name . '' . $this->action == 'Ticketsmanage'):
                        ?>
                            class="active"
                            <?php
                        endif;
                        ?>
                        >
                        <a href="<?php echo Router::url(array('controller' => 'tickets', 'action' => 'manage')) ?>">
                            <i class="fa icon-info"></i>
                            All Tickets</a>
                    </li>
                    <li
                    <?php if ($this->name . '' . $this->action == 'Assigned_to_me'):
                        ?>
                            class="active"
                            <?php
                        endif;
                        ?>
                        >
                        <a href="<?php echo Router::url(array('controller' => 'tickets', 'action' => 'Assigned_to_me')) ?>">
                            <i class="fa icon-loop"></i>
                            Inform to Me</a>
                    </li>
                    <li
                    <?php if ($this->name . '' . $this->action == 'Forwarded_by'):
                        ?>
                            class="active"
                            <?php
                        endif;
                        ?>
                        >
                        <a href="<?php echo Router::url(array('controller' => 'tickets', 'action' => 'Forwarded_by')) ?>">
                            <i class="fa icon-control-rewind"></i>
                            Forwarded by</a>
                    </li>
                    <li <?php if ($this->name . '' . $this->action == 'in_progress'): ?> class="active" <?php endif; ?> >
                        <a href="<?php echo Router::url(array('controller' => 'tickets', 'action' => 'in_progress ')) ?>"> <i class="fa fa-fast-forward"></i> In Progress <b title="Total inprogress tickets" style="color:lightseagreen;"> ( <?php echo $total_inprogress; ?> )</b></a>
                    </li>
                    <li <?php if ($this->name . '' . $this->action == 'solved_ticket'): ?> class="active" <?php endif; ?> >
                        <a href="<?php echo Router::url(array('controller' => 'tickets', 'action' => 'solved_ticket')) ?>"> <i class="fa glyphicon glyphicon-check"></i> Solved Ticket</a>
                    </li>

                    <li<?php if ($this->name . '' . $this->action == 'Ticketssuccessful'): ?> class="active"<?php endif; ?> >
                        <a href="<?php echo Router::url(array('controller' => 'tickets', 'action' => 'successful')) ?>"><i class="fa glyphicon glyphicon-check"></i> Successful<b title="Total successful tickets" style="color: lightseagreen;"> ( <?php echo $total_successful; ?> )</b></a>
                    </li>

                    <li<?php if ($this->name . '' . $this->action == 'Ticketsdecline_ticket'): ?> class="active"<?php endif; ?> >
                        <a href="<?php echo Router::url(array('controller' => 'tickets', 'action' => 'decline_ticket')) ?>"><i class="fa glyphicon glyphicon-eye-close"></i> Declined<b title="Total declined tickets" style="color:  lightseagreen;"> ( <?php echo $total_declined; ?> )</b></a>
                    </li>
                </ul>          
          
           

         

      

            <li 
            <?php
            $services = array('Customersregistration', 'Customersshipment_installation', 'Customersedit_registration', 'Customersfollowup', 'Customersschedule_done');
            if (in_array($this->name . '' . $this->action, $services)):
                ?>
                    class="active"
                    <?php
                endif;
                ?>
                >

                <a href="javascript:;">
                    <i class="fa icon-users"></i>
                    <span class="title">Potential Customer</span>
                    <span class="arrow "></span>
                </a>
                <ul class="sub-menu">
                    <li
                    <?php if ($this->name . '' . $this->action == 'Customersregistration'):
                        ?>
                            class="active"
                            <?php
                        endif;
                        ?>
                        >

                        <a href="<?php echo Router::url(array('controller' => 'customers', 'action' => 'registration')) ?>">
                            <i class="fa icon-note"></i>
                            Opportunity</a>
                    </li>
                    <li
                    <?php if ($this->name . '' . $this->action == 'Customsfollowup'):
                        ?>
                            class="active"
                            <?php
                        endif;
                        ?>
                        >
                        <a href="<?php echo Router::url(array('controller' => 'customers', 'action' => 'followup')) ?>">
                            <i class="fa icon-user-following"></i>
                            Opportunity Follow-up </a>
                    </li>
                    <!--                    Temporary Blocked -->
                    <!--                    <li
                    
                    <?php if ($this->name . '' . $this->action == 'Customersschedule_done'):
                        ?>
                                                        class="active"
                        <?php
                    endif;
                    ?>
                                            >
                    
                                            <a href="<?php echo Router::url(array('controller' => 'customers', 'action' => 'schedule_done')) ?>">
                    
                                                <i class="fa icon-like"></i>
                                                Schedule Done </a>
                                        </li>-->
                    <!--Temporary Blocked end -->
                </ul>
            </li>

            <li 
            <?php
            $services = array('custom_payment');
            if (in_array($this->name . '' . $this->action, $services)):
                ?>
                    class="active"
                    <?php
                endif;
                ?>
                >                 
                <a href="<?php echo Router::url(array('controller' => 'payments', 'action' => 'custom_payment')) ?>">
                    <i class="fa fa-support"></i>
                    <span class="title">Custom Payment</span>
                    <span class="arrow "></span>
                </a>
            </li>

            <li 
            <?php
            $services = array('Customersready_installation', 'Customersmoving', 'Customersshipment', 'Customerstroubleshot_technician', 'Customerstroubleshot_shipment', 'Customerswire_problem', 'Customersremote_problem');
            if (in_array($this->name . '' . $this->action, $services)):
                ?>
                    class="active"
                    <?php
                endif;
                ?>
                >
                <a href="javascript:;">
                    <i class="fa icon-users"></i>
                    <span class="title">Ready To Installation</span>
                    <span class="arrow "></span>
                </a>

                <ul class="sub-menu">                 
                    <li
                    <?php if ($this->name . '' . $this->action == 'Customersready_installation'):
                        ?>
                            class="active"
                            <?php
                        endif;
                        ?>
                        >
                        <a href="<?php echo Router::url(array('controller' => 'customers', 'action' => 'ready_installation')) ?>">
                            <i class="fa icon-like"></i>
                            Sales Technician </a>
                    </li>

                    <li
                    <?php if ($this->name . '' . $this->action == 'Customersshipment'):
                        ?>
                            class="active"
                            <?php
                        endif;
                        ?>
                        >
                        <a href="<?php echo Router::url(array('controller' => 'customers', 'action' => 'shipment')) ?>">

                            <i class="fa fa-plane"></i>
                            Sales Shipment </a>
                    </li>
                    <li
                    <?php if ($this->name . '' . $this->action == 'Customerstroubleshot_technician'):
                        ?>
                            class="active"
                            <?php
                        endif;
                        ?>
                        >
                        <a href="<?php echo Router::url(array('controller' => 'customers', 'action' => 'troubleshot_technician')) ?>">
                            <i class="fa icon-like"></i>
                            Troubleshot Technician</a>
                    </li>

                    <li

                        <?php if ($this->name . '' . $this->action == 'Customerstroubleshot_shipment'):
                            ?>
                            class="active"
                            <?php
                        endif;
                        ?>
                        >

                        <a href="<?php echo Router::url(array('controller' => 'customers', 'action' => 'troubleshot_shipment')) ?>">

                            <i class="fa icon-like"></i>
                            Troubleshot Shipment</a>
                    </li>

                    <li
                    <?php if ($this->name . '' . $this->action == 'Customersmoving'):
                        ?>
                            class="active"
                            <?php
                        endif;
                        ?>
                        >
                        <a href="<?php echo Router::url(array('controller' => 'customers', 'action' => 'moving')) ?>">
                            <i class="fa icon-like"></i>
                            Moving</a>
                    </li>

<!--                    <li
                    <?php if ($this->name . '' . $this->action == 'Customerswire_problem'):
                        ?>
                            class="active"
                            <?php
                        endif;
                        ?>
                        >
                        <a href="<?php echo Router::url(array('controller' => 'customers', 'action' => 'wire_problem')) ?>">
                            <i class="fa icon-like"></i>
                            Wire problem</a>
                    </li>
                    <li
                    <?php if ($this->name . '' . $this->action == 'Customersremote_problem'):
                        ?>
                            class="active"
                            <?php
                        endif;
                        ?>
                        >
                        <a href="<?php echo Router::url(array('controller' => 'customers', 'action' => 'remote_problem')) ?>">
                            <i class="fa icon-like"></i>
                            Remote Problem</a>
                    </li>-->
                </ul>
            </li> 
            <li 
            <?php
            $services = array('Adminsassignedtotech', 'Adminsdonebytech', 'Adminspostponebytech', 'Adminsrecheduledbytech', 'Adminscancelledbytech', 'Adminsdonebyadmin');
            if (in_array($this->name . '' . $this->action, $services)):
                ?>
                    class="active"
                    <?php
                endif;
                ?>
                >
                <a href="javascript:;">
                    <i class="fa icon-users"></i>
                    <span class="title">Work Status</span>
                    <span class="arrow "></span>
                </a>

                <ul class="sub-menu">                 
                    <li
                    <?php if ($this->name . '' . $this->action == 'Adminsassignedtotech'):
                        ?>
                            class="active"
                            <?php
                        endif;
                        ?>
                        >
                        <a href="<?php echo Router::url(array('controller' => 'admins', 'action' => 'assignedtotech')) ?>">
                            <i class="fa icon-like"></i>
                            Assigned To Tech</a>
                    </li>

                    <li
                    <?php if ($this->name . '' . $this->action == 'Adminsdonebytech'):
                        ?>
                            class="active"
                            <?php
                        endif;
                        ?>
                        >
                        <a href="<?php echo Router::url(array('controller' => 'admins', 'action' => 'donebytech')) ?>">

                            <i class="fa fa-plane"></i>
                            done by tech </a>
                    </li>
                    <li
                    <?php if ($this->name . '' . $this->action == 'Adminspostponebytech'):
                        ?>
                            class="active"
                            <?php
                        endif;
                        ?>
                        >
                        <a href="<?php echo Router::url(array('controller' => 'admins', 'action' => 'postponebytech')) ?>">
                            <i class="fa icon-like"></i>
                            Postpone by Tech</a>
                    </li>

                    <li

                        <?php if ($this->name . '' . $this->action == 'Adminsrecheduledbytech'):
                            ?>
                            class="active"
                            <?php
                        endif;
                        ?>
                        >

                        <a href="<?php echo Router::url(array('controller' => 'admins', 'action' => 'recheduledbytech')) ?>">

                            <i class="fa icon-like"></i>
                            Rescheduled by Tech</a>
                    </li>

                    <li
                    <?php if ($this->name . '' . $this->action == 'Adminscancelledbytech'):
                        ?>
                            class="active"
                            <?php
                        endif;
                        ?>
                        >
                        <a href="<?php echo Router::url(array('controller' => 'admins', 'action' => 'cancelledbytech')) ?>">

                            <i class="fa icon-like"></i>
                            Canceled By Tech</a>
                    </li>

                    <li
                    <?php if ($this->name . '' . $this->action == 'Adminsdonebyadmin'):
                        ?>
                            class="active"
                            <?php
                        endif;
                        ?>
                        >

                        <a href="<?php echo Router::url(array('controller' => 'admins', 'action' => 'donebyadmin')) ?>">

                            <i class="fa icon-like"></i>
                            Done By Admin</a>
                    </li>

                </ul>
            </li> 

            <li 
            <?php
            $customerRequest = array('Customerscancelrequest', 'Customersholdrequest', 'Customersunholdrequest', 'CustomersreconnectionRequest');


//            $customerRequest = array('Customerscancelrequest', 'Customersholdrequest', 'Customersunholdrequest','CustomersreconnectionRequest');

            if (in_array($this->name . '' . $this->action, $customerRequest)):
                ?>
                    class="active"
                    <?php
                endif;
                ?>
                >
                <a href="javascript:;">
                    <i class="fa fa-envelope"></i>
                    <span class="title">Change Service</span>
                    <span class="arrow "></span>
                </a>
                <ul class="sub-menu">
                    <li
                    <?php if ($this->name . '' . $this->action == 'Customerscancelrequest'):
                        ?>
                            class="active"
                            <?php
                        endif;
                        ?>
                        >

                        <a href="<?php echo Router::url(array('controller' => 'customers', 'action' => 'cancelrequest')) ?>">
                            <i class="fa fa-plus"></i>
                            Cancel Request</a>
                    </li>
                    <li
                    <?php if ($this->name . '' . $this->action == 'Customersholdrequest'):
                        ?>
                            class="active"
                            <?php
                        endif;
                        ?>
                        >

                        <a href="<?php echo Router::url(array('controller' => 'customers', 'action' => 'holdrequest')) ?>">
                            <i class="fa fa-wrench"></i>
                            Hold Request</a>
                    </li>
                    <li
                    <?php if ($this->name . '' . $this->action == 'Customersunholdrequest'):
                        ?>
                            class="active"
                            <?php
                        endif;
                        ?>
                        >

                        <a href="<?php echo Router::url(array('controller' => 'customers', 'action' => 'unholdrequest')) ?>">
                            <i class="fa fa-wrench"></i>
                            Unhold Request</a>
                    </li>

                    <li
                    <?php if ($this->name . '' . $this->action == 'CustomersreconnectionRequest'):
                        ?>
                            class="active"
                            <?php
                        endif;
                        ?>
                        >

                        <a href="<?php echo Router::url(array('controller' => 'customers', 'action' => 'reconnectionRequest')) ?>">
                            <i class="fa fa-wrench"></i>
                            Reconnection Request</a>
                    </li>


                </ul>
            </li>
            

<!--            <li 
            <?php
            $printqueues = array('ReportsopenInvoice25', 'ReportscloseInvoice', 'ReportsextraPayment');
            if (in_array($this->name . '' . $this->action, $printqueues)):
                ?>
                    class="active"
                    <?php
                endif;
                ?>
                >
                <a href="javascript:;">
                    <i class="fa fa-envelope"></i>
                    <span class="title">Print Queue</span>
                    <span class="arrow "></span>
                </a>
                <ul class="sub-menu">
                                        <li
                    <?php if ($this->name . '' . $this->action == 'ReportsopenInvoice'):
                        ?>
                                                        class="active"
                        <?php
                    endif;
                    ?>
                                            >
                                            <a href="<?php echo Router::url(array('controller' => 'reports', 'action' => 'openInvoice')) ?>">
                                                <i class="fa fa-plus"></i>
                                                Open Invoice</a>
                                        </li>
                    <li
                    <?php if ($this->name . '' . $this->action == 'ReportsopenInvoice25'):
                        ?>
                            class="active"
                            <?php
                        endif;
                        ?>
                        >
                        <a href="<?php echo Router::url(array('controller' => 'reports', 'action' => 'openInvoice25')) ?>">
                            <i class="fa fa-plus"></i>
                            Open Invoice</a>
                    </li>


                    <li
                    <?php if ($this->name . '' . $this->action == 'ReportscloseInvoice'):
                        ?>
                            class="active"
                            <?php
                        endif;
                        ?>
                        >
                        <a href="<?php echo Router::url(array('controller' => 'reports', 'action' => 'closeInvoice')) ?>">
                            <i class="fa fa-wrench"></i>
                            Close Invoice</a>
                    </li>
                    <li
                    <?php if ($this->name . '' . $this->action == 'ReportsextraPayment'):
                        ?>
                            class="active"
                            <?php
                        endif;
                        ?>
                        >
                        <a href="<?php echo Router::url(array('controller' => 'reports', 'action' => 'extraPayment')) ?>">
                            <i class="fa fa-wrench"></i>
                            Extra Payment</a>
                    </li>
                </ul>
            </li>-->
            <li 
            <?php
            $Otherspayments = array('OtherspaymentsCreate', 'OtherspaymentsManage');
            if (in_array($this->name . '' . $this->action, $Otherspayments)):
                ?>
                    class="active"
                    <?php
                endif;
                ?>
                >
                <a href="javascript:;">
                    <i class="fa fa-envelope"></i>
                    <span class="title">Others Payment</span>
                    <span class="arrow "></span>
                </a>
                <ul class="sub-menu">
                    <li
                    <?php if ($this->name . '' . $this->action == 'OtherspaymentsCreate'):
                        ?>
                            class="active"
                            <?php
                        endif;
                        ?>
                        >
                        <a href="<?php echo Router::url(array('controller' => 'Otherspayments', 'action' => 'Create')) ?>">
                            <i class="fa fa-plus"></i>
                            Create</a>
                    </li>   
                    <li
                    <?php if ($this->name . '' . $this->action == 'Otherspaymentsmanage'):
                        ?>
                            class="active"
                            <?php
                        endif;
                        ?>
                        >
                        <a href="<?php echo Router::url(array('controller' => 'Otherspayments', 'action' => 'manage')) ?>">
                            <i class="fa fa-wrench"></i>
                            Manage</a>
                    </li>
                </ul>
            </li>
        </ul>
        <!-- END SIDEBAR MENU -->
    </div>
    <!-- END SIDEBAR -->