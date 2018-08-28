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

            <li <?php
            $admins = array('Customersmanage_delete_data', 'Otherspaymentsmanage', 'Otherspaymentscreate', 'Otherspaymentsedit', 'AdminsmanageRole', 'Adminsaddrole', 'Adminseditrole', 'AdminsadjustmentMemo', 'AdminsmanageDepartment', 'Adminsadddepartment', 'Adminseditdepartment', 'Messagesmanage', 'Messagesadd', 'Messagesedit', 'Adminsmanage', 'Adminscreate', 'Adminsedit_admin', 'AdminsmanageIssue', 'Adminsaddissue', 'Adminseditissue', 'Paymentscustom_payment');

            if (in_array($this->name . '' . $this->action, $admins)):
                ?> class="active" <?php endif; ?>  >
                <a href="javascript:;">
                    <i class="fa fa-user"></i> <span class="title">General Setting</span> <span class="arrow "></span>
                </a>
                <ul class="sub-menu">

                    <li <?php if ($this->name . '' . $this->action == 'AdminsmanageRole' || $this->name . '' . $this->action == 'Adminsaddrole' || $this->name . '' . $this->action == 'Adminseditrole'): ?> class="active" <?php endif; ?>  >
                        <a href="<?php echo Router::url(array('controller' => 'admins', 'action' => 'manageRole')) ?>"> <i class="fa fa-dashboard"></i> Roles</a>
                    </li>

                    <li <?php if ($this->name . '' . $this->action == 'Adminsmanage' || $this->name . '' . $this->action == 'Adminscreate' || $this->name . '' . $this->action == 'Adminsedit_admin'): ?> class="active" <?php endif; ?> >
                        <a href="<?php echo Router::url(array('controller' => 'admins', 'action' => 'manage')) ?>"> <i class="fa fa-dashboard"></i> Admin</a>
                    </li>

                    <li <?php if ($this->name . '' . $this->action == 'AdminsmanageDepartment' || $this->name . '' . $this->action == 'Adminsadddepartment' || $this->name . '' . $this->action == 'Adminseditdepartment'): ?> class="active" <?php endif; ?> >
                        <a href="<?php echo Router::url(array('controller' => 'admins', 'action' => 'manageDepartment')) ?>">  <i class="fa fa-dashboard"></i> Department</a>
                    </li>

                    <li <?php if ($this->name . '' . $this->action == 'AdminsmanageIssue' || $this->name . '' . $this->action == 'Adminsaddissue' || $this->name . '' . $this->action == 'Adminseditissue'): ?> class="active" <?php endif; ?> >
                        <a href="<?php echo Router::url(array('controller' => 'admins', 'action' => 'manageIssue')) ?>"> <i class="fa fa-dashboard"></i> Issue</a>
                    </li>

                    <li <?php if ($this->name . '' . $this->action == 'Messagesmanage' || $this->name . '' . $this->action == 'Messagesadd' || $this->name . '' . $this->action == 'Messagesedit'): ?> class="active" <?php endif; ?>  >
                        <a href="<?php echo Router::url(array('controller' => 'messages', 'action' => 'manage')) ?>"> <i class="fa fa-dashboard"></i> Messages</a>
                    </li>

                    <li <?php if ($this->name . '' . $this->action == 'Paymentscustom_payment'): ?> class="active"  <?php endif; ?> >
                        <a href="<?php echo Router::url(array('controller' => 'payments', 'action' => 'custom_payment')) ?>"> <i class="fa fa-dashboard"></i>  Staff Payment</a>
                    </li>

                    <li <?php if ($this->name . '' . $this->action == 'AdminsadjustmentMemo'): ?> class="active" <?php endif; ?>  >
                        <a href="<?php echo Router::url(array('controller' => 'admins', 'action' => 'adjustmentMemo')) ?>"> <i class="fa fa-dashboard"></i>  Adjustment Memo</a>
                    </li>

                    <li <?php if ($this->name . '' . $this->action == 'Otherspaymentsmanage' || $this->name . '' . $this->action == 'Otherspaymentscreate' || $this->name . '' . $this->action == 'Otherspaymentsedit'): ?> class="active" <?php endif; ?> >
                        <a href="<?php echo Router::url(array('controller' => 'otherspayments', 'action' => 'manage')) ?>"> <i class="fa fa-dashboard"></i> Others Payment</a>
                    </li>

                    <li <?php if ($this->name . '' . $this->action == 'Customersmanage_delete_data'): ?> class="active"  <?php endif; ?> >
                        <a href="<?php echo Router::url(array('controller' => 'customers', 'action' => 'manage_delete_data')) ?>"> <i class="fa fa-dashboard"></i> Deleted Customers</a>
                    </li>
                </ul>
            </li>

            <li  <?php
            $services = array('Customerssearch');

            if (in_array($this->name . '' . $this->action, $services)):
                ?> class="active" <?php endif; ?> >                 
                <a href="<?php echo Router::url(array('controller' => 'customers', 'action' => 'search')) ?>"> <i class="fa fa-search"></i>  <span class="title">Search</span> <span class="arrow "></span> </a>
            </li>                                         

            <li <?php
            $tickets = array('Ticketscreate', 'Ticketsmanage', 'Ticketsassigned_to_me', 'Ticketsforwarded_by', 'Ticketssolved_ticket', 'Ticketsin_progress');
            if (in_array($this->name . '' . $this->action, $tickets)):
                ?>  class="active"  <?php endif; ?>  >
                <a href="javascript:;">
                    <i class="fa fa-ticket"></i> <span class="title">Ticket Management</span> <span class="arrow "></span>
                </a>
                <ul class="sub-menu">    

                    <li <?php if ($this->name . '' . $this->action == 'Ticketsmanage'): ?> class="active" <?php endif; ?>  >
                        <a href="<?php echo Router::url(array('controller' => 'tickets', 'action' => 'manage')) ?>"> <i class="fa icon-info"></i> All Tickets</a>
                    </li>

                    <li  <?php if ($this->name . '' . $this->action == 'Assigned_to_me'): ?>  class="active" <?php endif; ?>  >
                        <a href="<?php echo Router::url(array('controller' => 'tickets', 'action' => 'assigned_to_me')) ?>"> <i class="fa icon-loop"></i> Inform to Me</a>
                    </li>

                    <li <?php if ($this->name . '' . $this->action == 'Forwarded_by'): ?> class="active" <?php endif; ?> >
                        <a href="<?php echo Router::url(array('controller' => 'tickets', 'action' => 'forwarded_by')) ?>"> <i class="fa icon-control-rewind"></i> Forwarded by</a>
                    </li>

                    <li <?php if ($this->name . '' . $this->action == 'in_progress'): ?>  class="active" <?php endif; ?> >
                        <a href="<?php echo Router::url(array('controller' => 'tickets', 'action' => 'in_progress ')) ?>"> <i class="fa fa-fast-forward"></i>  In Progress  </a>
                    </li>

                    <li  <?php if ($this->name . '' . $this->action == 'solved_ticket'): ?> class="active"  <?php endif; ?> >
                        <a href="<?php echo Router::url(array('controller' => 'tickets', 'action' => 'solved_ticket')) ?>"> <i class="fa glyphicon glyphicon-check"></i>  Solved Ticket</a>
                    </li>

                </ul>

            <li  <?php
            $services = array('Customersregistration', 'Customersshipment_installation', 'Customersedit_registration', 'Customersfollowup', 'Customersschedule_done');

            if (in_array($this->name . '' . $this->action, $services)):
                ?> class="active" <?php endif; ?> >

                <a href="javascript:;">
                    <i class="fa icon-users"></i> <span class="title">Potential Customer</span> <span class="arrow "></span>
                </a>
                <ul class="sub-menu">
                    <li <?php if ($this->name . '' . $this->action == 'Customersregistration'): ?> class="active" <?php endif; ?>  >

                        <a href="<?php echo Router::url(array('controller' => 'customers', 'action' => 'registration')) ?>"> <i class="fa icon-note"></i> Opportunity</a>
                    </li>

                    <li <?php if ($this->name . '' . $this->action == 'Customsfollowup'): ?> class="active" <?php endif; ?> >
                        <a href="<?php echo Router::url(array('controller' => 'customers', 'action' => 'followup')) ?>">  <i class="fa icon-user-following"></i> Opportunity Follow-up </a>
                    </li>                 

                </ul>
            </li>

            <li <?php
            $services = array('Customersready_installation', 'Customersmoving', 'Customersshipment', 'Customerstroubleshot_technician', 'Customerstroubleshot_shipment', 'Customerswire_problem', 'Customersremote_problem');

            if (in_array($this->name . '' . $this->action, $services)):
                ?>  class="active" <?php endif; ?>  >
                <a href="javascript:;">
                    <i class="fa icon-users"></i>  <span class="title">Ready To Installation</span> <span class="arrow "></span>
                </a>

                <ul class="sub-menu">                 
                    <li <?php if ($this->name . '' . $this->action == 'Customersready_installation'): ?> class="active" <?php endif; ?> >
                        <a href="<?php echo Router::url(array('controller' => 'customers', 'action' => 'ready_installation')) ?>"> <i class="fa icon-like"></i>  Sales Technician </a>
                    </li>

                    <li <?php if ($this->name . '' . $this->action == 'Customersshipment'): ?>  class="active" <?php endif; ?>  >
                        <a href="<?php echo Router::url(array('controller' => 'customers', 'action' => 'shipment')) ?>"> <i class="fa fa-plane"></i> Sales Shipment </a>
                    </li>

                    <li  <?php if ($this->name . '' . $this->action == 'Customerstroubleshot_technician'): ?> class="active"  <?php endif; ?> >
                        <a href="<?php echo Router::url(array('controller' => 'customers', 'action' => 'troubleshot_technician')) ?>"> <i class="fa icon-like"></i>  Troubleshot Technician</a>
                    </li>

                    <li <?php if ($this->name . '' . $this->action == 'Customerstroubleshot_shipment'): ?>  class="active" <?php endif; ?>  >
                        <a href="<?php echo Router::url(array('controller' => 'customers', 'action' => 'troubleshot_shipment')) ?>"> <i class="fa icon-like"></i> Troubleshot Shipment</a>
                    </li>

                    <li <?php if ($this->name . '' . $this->action == 'Customersmoving'): ?> class="active"  <?php endif; ?>  >
                        <a href="<?php echo Router::url(array('controller' => 'customers', 'action' => 'moving')) ?>"> <i class="fa icon-like"></i> Moving</a>
                    </li>

                    <li <?php if ($this->name . '' . $this->action == 'Customerswire_problem'): ?> class="active" <?php endif; ?>>
                        <a href="<?php echo Router::url(array('controller' => 'customers', 'action' => 'wire_problem')) ?>"> <i class="fa icon-like"></i> Wire problem</a>
                    </li>

                    <li <?php if ($this->name . '' . $this->action == 'Customersremote_problem'): ?> class="active" <?php endif; ?> >
                        <a href="<?php echo Router::url(array('controller' => 'customers', 'action' => 'remote_problem')) ?>"> <i class="fa icon-like"></i> Remote Problem</a>
                    </li>
                </ul>
            </li> 

            <li <?php
            $services = array('AdminsscheduleDone', 'Adminsassignedtotech', 'Adminsdonebytech', 'Adminspostponebytech', 'Adminsrescheduledbytech', 'Adminscancelledbytech', 'Adminsdonebyadmin');

            if (in_array($this->name . '' . $this->action, $services)):
                ?> class="active" <?php endif; ?> >
                <a href="javascript:;">
                    <i class="fa icon-users"></i> <span class="title">Work Status</span> <span class="arrow "></span>
                </a>

                <ul class="sub-menu">                 
                    <li <?php if ($this->name . '' . $this->action == 'Adminsassignedtotech'): ?> class="active" <?php endif; ?> >
                        <a href="<?php echo Router::url(array('controller' => 'admins', 'action' => 'assignedtotech')) ?>">  <i class="fa icon-like"></i> Assigned To Tech</a>
                    </li>

                    <li <?php if ($this->name . '' . $this->action == 'AdminsscheduleDone'): ?> class="active" <?php endif; ?> >
                        <a href="<?php echo Router::url(array('controller' => 'admins', 'action' => 'scheduleDone')) ?>"> <i class="fa icon-like"></i> Schedule done</a>
                    </li>

                    <li <?php if ($this->name . '' . $this->action == 'Adminsdonebytech'): ?>class="active" <?php endif; ?>  >
                        <a href="<?php echo Router::url(array('controller' => 'admins', 'action' => 'donebytech')) ?>"> <i class="fa fa-plane"></i> Installation Completed </a>
                    </li>

                    <li <?php if ($this->name . '' . $this->action == 'Adminspostponebytech'): ?> class="active" <?php endif; ?> >
                        <a href="<?php echo Router::url(array('controller' => 'admins', 'action' => 'postponebytech')) ?>"> <i class="fa icon-like"></i> Postpone by Tech</a>
                    </li>

                    <li <?php if ($this->name . '' . $this->action == 'Adminsrescheduledbytech'): ?> class="active" <?php endif; ?> >
                        <a href="<?php echo Router::url(array('controller' => 'admins', 'action' => 'rescheduledbytech')) ?>"> <i class="fa icon-like"></i> Rescheduled by Tech</a>
                    </li>

                    <li <?php if ($this->name . '' . $this->action == 'Adminscancelledbytech'): ?> class="active" <?php endif; ?> >
                        <a href="<?php echo Router::url(array('controller' => 'admins', 'action' => 'cancelledbytech')) ?>"> <i class="fa icon-like"></i> Canceled By Tech</a>
                    </li>

                    <li <?php if ($this->name . '' . $this->action == 'Adminsdonebyadmin'): ?> class="active" <?php endif; ?> >
                        <a href="<?php echo Router::url(array('controller' => 'admins', 'action' => 'donebyadmin')) ?>">  <i class="fa icon-like"></i> Done By Admin</a>
                    </li>
                </ul>
            </li> 

            <li <?php
            $customerRequest = array('Customerscancelrequest', 'Customersholdrequest', 'Customersunholdrequest', 'CustomersreconnectionRequest');

            if (in_array($this->name . '' . $this->action, $customerRequest)):
                ?> class="active"  <?php endif; ?>  >
                <a href="javascript:;">
                    <i class="fa fa-envelope"></i> <span class="title">Change Service</span>  <span class="arrow "></span>
                </a>
                <ul class="sub-menu">                    
                    <li <?php if ($this->name . '' . $this->action == 'Customerscancelrequest'): ?> class="active"  <?php endif; ?>  > 
                        <a href="<?php echo Router::url(array('controller' => 'customers', 'action' => 'cancelrequest')) ?>"> <i class="fa fa-plus"></i> Cancel Request</a>
                    </li>

                    <li <?php if ($this->name . '' . $this->action == 'Customersholdrequest'): ?> class="active" <?php endif; ?> >
                        <a href="<?php echo Router::url(array('controller' => 'customers', 'action' => 'holdrequest')) ?>"> <i class="fa fa-wrench"></i>  Hold Request</a>
                    </li>

                    <li <?php if ($this->name . '' . $this->action == 'Customersunholdrequest'): ?>  class="active"  <?php endif; ?>  >
                        <a href="<?php echo Router::url(array('controller' => 'customers', 'action' => 'unholdrequest')) ?>">  <i class="fa fa-wrench"></i>  Unhold Request</a>
                    </li>

                    <li <?php if ($this->name . '' . $this->action == 'CustomersreconnectionRequest'): ?>  class="active" <?php endif; ?>  >
                        <a href="<?php echo Router::url(array('controller' => 'customers', 'action' => 'reconnectionRequest')) ?>"> <i class="fa fa-wrench"></i>  Reconnection Request</a>
                    </li>
                </ul>
            </li>

        </ul>
        <!-- END SIDEBAR MENU -->
    </div>
    <!-- END SIDEBAR -->