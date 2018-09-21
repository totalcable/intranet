<!-- BEGIN SIDEBAR -->
<div class="page-sidebar-wrapper">   
    <div class="page-sidebar navbar-collapse collapse" style="width: 247px; margin-top: 11px; height: 100%; position: fixed;">
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
            $admins = array('Adminsmanagedesignation', 'AdminsAdddesignation', 'Adminseditdesignation', 'Customersref_bonus', 'Customersmanage_delete_data', 'Otherspaymentsmanage', 'Otherspaymentscreate', 'Otherspaymentsedit', 'AdminsmanageRole', 'Adminsaddrole', 'Adminseditrole', 'AdminsadjustmentMemo', 'AdminsmanageDepartment', 'Adminsadddepartment', 'Adminseditdepartment', 'Messagesmanage', 'Messagesadd', 'Messagesedit', 'Adminsmanage', 'Adminscreate', 'Adminsedit_admin', 'AdminsmanageIssue', 'Adminsaddissue', 'Adminseditissue');
            if (in_array($this->name . '' . $this->action, $admins)):
                ?>
                    class="active"
                    <?php
                endif;
                ?>
                >
                <a href="javascript:;">
                    <i class="fa fa-user"></i>
                    <span class="title">General Setting</span>
                    <span class="arrow "></span>
                </a>
                <ul class="sub-menu">

                    <li
                    <?php if ($this->name . '' . $this->action == 'AdminsmanageRole' || $this->name . '' . $this->action == 'Adminsaddrole' || $this->name . '' . $this->action == 'Adminseditrole'):
                        ?>
                            class="active"
                            <?php
                        endif;
                        ?>
                        >
                        <a href="<?php echo Router::url(array('controller' => 'admins', 'action' => 'manageRole')) ?>">
                            <i class="fa fa-dashboard"></i>
                            Roles</a>
                    </li>

                    <li
                    <?php if ($this->name . '' . $this->action == 'Adminsmanage' || $this->name . '' . $this->action == 'Adminscreate' || $this->name . '' . $this->action == 'Adminsedit_admin'):
                        ?>
                            class="active"
                            <?php
                        endif;
                        ?>
                        >
                        <a href="<?php echo Router::url(array('controller' => 'admins', 'action' => 'manage')) ?>">
                            <i class="fa fa-dashboard"></i>
                            Admin</a>
                    </li>
                    <li
                    <?php if ($this->name . '' . $this->action == 'Adminsmanagedesignation' || $this->name . '' . $this->action == 'AdminsAdddesignation' || $this->name . '' . $this->action == 'Adminseditdesignation'):
                        ?>
                            class="active"
                            <?php
                        endif;
                        ?>
                        >
                        <a href="<?php echo Router::url(array('controller' => 'admins', 'action' => 'managedesignation')) ?>">
                            <i class="fa fa-dashboard"></i>
                            Manage Designation</a>
                    </li>

                    <li
                    <?php if ($this->name . '' . $this->action == 'AdminsmanageDepartment' || $this->name . '' . $this->action == 'Adminsadddepartment' || $this->name . '' . $this->action == 'Adminseditdepartment'):
                        ?>
                            class="active"
                            <?php
                        endif;
                        ?>
                        >
                        <a href="<?php echo Router::url(array('controller' => 'admins', 'action' => 'manageDepartment')) ?>">
                            <i class="fa fa-dashboard"></i>
                            Department</a>
                    </li>

                    <li
                    <?php if ($this->name . '' . $this->action == 'AdminsmanageIssue' || $this->name . '' . $this->action == 'Adminsaddissue' || $this->name . '' . $this->action == 'Adminseditissue'):
                        ?>
                            class="active"
                            <?php
                        endif;
                        ?>
                        >
                        <a href="<?php echo Router::url(array('controller' => 'admins', 'action' => 'manageIssue')) ?>">
                            <i class="fa fa-dashboard"></i>
                            Issue</a>
                    </li>

                    <li
                    <?php if ($this->name . '' . $this->action == 'Messagesmanage' || $this->name . '' . $this->action == 'Messagesadd' || $this->name . '' . $this->action == 'Messagesedit'):
                        ?>
                            class="active"
                            <?php
                        endif;
                        ?>
                        >
                        <a href="<?php echo Router::url(array('controller' => 'messages', 'action' => 'manage')) ?>">
                            <i class="fa fa-dashboard"></i>
                            Messages</a>
                    </li>                  

                    <li
                    <?php if ($this->name . '' . $this->action == 'AdminsadjustmentMemo'):
                        ?>
                            class="active"
                            <?php
                        endif;
                        ?>
                        >
                        <a href="<?php echo Router::url(array('controller' => 'admins', 'action' => 'adjustmentMemo')) ?>">
                            <i class="fa fa-dashboard"></i>
                            Adjustment Memo</a>
                    </li>

                    <li
                    <?php if ($this->name . '' . $this->action == 'Otherspaymentsmanage' || $this->name . '' . $this->action == 'Otherspaymentscreate' || $this->name . '' . $this->action == 'Otherspaymentsedit'):
                        ?>
                            class="active"
                            <?php
                        endif;
                        ?>
                        >
                        <a href="<?php echo Router::url(array('controller' => 'otherspayments', 'action' => 'manage')) ?>">
                            <i class="fa fa-dashboard"></i>
                            Tech Payment</a>
                    </li>

                    <li
                    <?php if ($this->name . '' . $this->action == 'Customersmanage_delete_data'):
                        ?>
                            class="active"
                            <?php
                        endif;
                        ?>
                        >
                        <a href="<?php echo Router::url(array('controller' => 'customers', 'action' => 'manage_delete_data')) ?>">
                            <i class="fa fa-dashboard"></i>
                            Delete Data</a>
                    </li>

                    <li <?php if ($this->name . '' . $this->action == 'Customersref_bonus'): ?> class="active" <?php endif; ?> >
                        <a href="<?php echo Router::url(array('controller' => 'admins', 'action' => 'ref_bonus')) ?>"> <i class="fa fa-dashboard"></i> Referral bonus</a>
                    </li>
                </ul>
            </li>

            <li 
            <?php
            $services = array('Customerssearch');
            if (in_array($this->name . '' . $this->action, $services)):
                ?>
                    class="active"
                    <?php
                endif;
                ?>
                >                 
                <a href="<?php echo Router::url(array('controller' => 'customers', 'action' => 'search')) ?>">
                    <i class="fa fa-search"></i>
                    <span class="title">Search</span>
                    <span class="arrow "></span>
                </a>
            </li>                                         


<!--             Roaster menu start 
            <li <?php
            $roaster = array('Roastersstaticroaster', 'Roasterssetroaster', 'Roastersedit', 'Roastersscript', 'Roastersdaily', 'Roastersroasterview');
            if (in_array($this->name . '' . $this->action, $roaster)):
                ?> class="active"<?php endif; ?> ><a href="javascript:;">
                    <i class="fa fa-envelope"></i> <span class="title">Roaster manage</span>  <span class="arrow "></span> </a>
                <ul class="sub-menu">                
                    <li <?php if ($this->name . '' . $this->action == 'Roastersstaticroaster'): ?> class="active" <?php endif; ?> >
                        <a href="<?php echo Router::url(array('controller' => 'roasters', 'action' => 'staticroaster')) ?>"> <i class="fa fa-search"></i> Static roaster</a>
                    </li>      

                    <li <?php if ($this->name . '' . $this->action == 'Roasterssetroaster'): ?> class="active" <?php endif; ?> >
                        <a href="<?php echo Router::url(array('controller' => 'roasters', 'action' => 'setroaster')) ?>"> <i class="fa fa-search"></i> Set roaster</a>
                    </li> 

                    <li <?php if ($this->name . '' . $this->action == 'Roastersedit'): ?> class="active" <?php endif; ?> >
                        <a href="<?php echo Router::url(array('controller' => 'roasters', 'action' => 'edit')) ?>"> <i class="fa fa-search"></i> Roaster edit</a>
                    </li>      

                    <li <?php if ($this->name . '' . $this->action == 'Roastersscript'): ?> class="active" <?php endif; ?> >
                        <a href="<?php echo Router::url(array('controller' => 'roasters', 'action' => 'script')) ?>"> <i class="fa fa-exchange"></i> Script</a>
                    </li>      

                    <li <?php if ($this->name . '' . $this->action == 'Roastersdaily'): ?> class="active" <?php endif; ?> >
                        <a href="<?php echo Router::url(array('controller' => 'roasters', 'action' => 'daily')) ?>"> <i class="fa fa-exchange"></i> Daily</a>
                    </li>

                    <li <?php if ($this->name . '' . $this->action == 'Roastersroasterview'): ?> class="active" <?php endif; ?> >
                        <a href="<?php echo Router::url(array('controller' => 'roasters', 'action' => 'roasterview')) ?>"> <i class="fa fa-exchange"></i> Roaster view</a>
                    </li>
                </ul>
            </li>
             approave by admin for attendance 
            <li <?php
            $atten = array('Adminsapproave', 'Adminsrequested_agent', 'Adminsrequested_si', 'Adminsattend_all');
            if (in_array($this->name . '' . $this->action, $atten)):
                ?> class="active"<?php endif; ?> ><a href="javascript:;">
                    <i class="fa fa-envelope"></i> <span class="title"> Attendance</span>  <span class="arrow "></span> </a>
                <ul class="sub-menu">

                    <li <?php if ($this->name . '' . $this->action == 'Adminsrequested_agent'): ?> class="active" <?php endif; ?> >
                        <a href="<?php echo Router::url(array('controller' => 'admins', 'action' => 'requested_agent')) ?>"> <i class="fa fa-search"></i> Agent <span class="arrow "></span></a>
                    </li>

                    <li <?php if ($this->name . '' . $this->action == 'Adminsrequested_si'): ?> class="active" <?php endif; ?> >
                        <a href="<?php echo Router::url(array('controller' => 'admins', 'action' => 'requested_si')) ?>"> <i class="fa fa-search"></i> SI <span class="arrow "></span></a>
                    </li>

                    <li <?php if ($this->name . '' . $this->action == 'Adminsattend_all'): ?> class="active" <?php endif; ?> >
                        <a href="<?php echo Router::url(array('controller' => 'admins', 'action' => 'attend_all')) ?>"> <i class="fa fa-search"></i> Attend history <span class="arrow "></span></a>
                    </li>

                </ul>
            </li>-->


            <li 
            <?php
            $services = array('Reportsall');
            if (in_array($this->name . '' . $this->action, $services)):
                ?>
                    class="active"
                    <?php
                endif;
                ?>
                >                 
                <a href="<?php echo Router::url(array('controller' => 'reports', 'action' => 'all')) ?>">
                    <i class="fa fa-list"></i>
                    <span class="title">Report & Print Queue</span>
                    <span class="arrow "></span>
                </a>
            </li>                                         

            <li 
            <?php
            $tickets = array('Ticketsverification','Ticketsoldticket_open','Ticketsverified', 'Ticketspromise_pay', 'Ticketscreate', 'Ticketsmanage', 'Ticketsassigned_to_me', 'Ticketsforwarded_by', 'Ticketssolved_ticket', 'Ticketsin_progress', 'Ticketsdecline_ticket', 'Ticketssuccessful');
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
                        <a href="<?php echo Router::url(array('controller' => 'tickets', 'action' => 'assigned_to_me')) ?>">
                            <i class="fa icon-loop"></i>
                            Inform to Me</a>
                    </li>
                    
                    <li<?php if ($this->name . '' . $this->action == 'Forwarded_by'):?> class="active" <?php endif; ?>>
                        <a href="<?php echo Router::url(array('controller' => 'tickets', 'action' => 'forwarded_by')) ?>"><i class="fa icon-control-rewind"></i> Forwarded by</a>
                    </li>
                    
                    <li <?php if ($this->name . '' . $this->action == 'in_progress'): ?> class="active" <?php endif; ?> >
                        <a href="<?php echo Router::url(array('controller' => 'tickets', 'action' => 'in_progress ')) ?>"> <i class="fa fa-fast-forward"></i> In Progress</a>
                    </li>
                    
                    <li <?php if ($this->name . '' . $this->action == 'Ticketspromise_pay'): ?> class="active" <?php endif; ?> >
                        <a href="<?php echo Router::url(array('controller' => 'tickets', 'action' => 'promise_pay ')) ?>"> <i class="fa fa-fast-forward"></i> Promise to Pay</a>
                    </li>
                    
                    <li <?php if ($this->name . '' . $this->action == 'solved_ticket'): ?> class="active" <?php endif; ?> >
                        <a href="<?php echo Router::url(array('controller' => 'tickets', 'action' => 'solved_ticket')) ?>"> <i class="fa glyphicon glyphicon-check"></i> Solved Ticket</a>
                    </li>

                    <li<?php if ($this->name . '' . $this->action == 'Ticketssuccessful'): ?> class="active"<?php endif; ?> >
                        <a href="<?php echo Router::url(array('controller' => 'tickets', 'action' => 'successful')) ?>"><i class="fa glyphicon glyphicon-check"></i> Successful</a>
                    </li>

                    <li<?php if ($this->name . '' . $this->action == 'Ticketsdecline_ticket'): ?> class="active"<?php endif; ?> >
                        <a href="<?php echo Router::url(array('controller' => 'tickets', 'action' => 'decline_ticket')) ?>"><i class="fa glyphicon glyphicon-eye-close"></i> Declined</a>
                    </li>
                    
                    <li <?php if ($this->name . '' . $this->action == 'Ticketsverification'): ?> class="active" <?php endif; ?> >
                        <a href="<?php echo Router::url(array('controller' => 'tickets', 'action' => 'verification')) ?>"> <i class="fa glyphicon glyphicon-check"></i> QA tickets</a>
                    </li>

                    <li<?php if ($this->name . '' . $this->action == 'Ticketsverified'): ?> class="active"<?php endif; ?> >
                        <a href="<?php echo Router::url(array('controller' => 'tickets', 'action' => 'verified')) ?>"><i class="fa glyphicon glyphicon-eye-close"></i> Verified</a>
                    </li>

                    <li<?php if ($this->name . '' . $this->action == 'Ticketsoldticket_open'): ?> class="active"<?php endif; ?> >
                        <a href="<?php echo Router::url(array('controller' => 'tickets', 'action' => 'oldticket_open')) ?>"><i class="fa glyphicon glyphicon-eye-close"></i> Old Ticket Open</a>
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


                </ul>
            </li>

            <li 
            <?php
            $services = array('Customersexcel_moving', 'Customers_tro_excel_sheet', 'Customerstroubleshot_excel_sheet', 'Customersexcel_sheet', 'Customers_excel_sheet', 'Customersready_installation', 'Customersmoving', 'Customersshipment', 'Customerstroubleshot_technician', 'Customerstroubleshot_shipment');
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

<!--<li <?php if ($this->name . '' . $this->action == 'Customersready_installation'): ?> class="active" <?php endif; ?> >
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
</li>-->



                    <li <?php if ($this->name . '' . $this->action == 'Customersexcel_sheet'): ?> class="active" <?php endif; ?> >
                        <a href="<?php echo Router::url(array('controller' => 'customers', 'action' => 'excel_sheet')) ?>"> <i class="fa icon-like"></i> Sales Sheet</a>
                    </li>

                    <li <?php if ($this->name . '' . $this->action == 'Customerstroubleshot_excel_sheet'): ?> class="active" <?php endif; ?> >
                        <a href="<?php echo Router::url(array('controller' => 'customers', 'action' => 'troubleshot_excel_sheet')) ?>"> <i class="fa icon-like"></i> Troubleshoot Sheet</a>
                    </li>

                    <li <?php if ($this->name . '' . $this->action == 'Customersmoving'): ?> class="active"  <?php endif; ?>  >
                        <a href="<?php echo Router::url(array('controller' => 'customers', 'action' => 'moving')) ?>"> <i class="fa icon-like"></i> Moving Sheet</a>
                    </li> 

                  <!--  <li <?php if ($this->name . '' . $this->action == 'Customersexcel_moving'): ?> class="active" <?php endif; ?> >
                        <a href="<?php echo Router::url(array('controller' => 'customers', 'action' => 'excel_moving')) ?>"> <i class="fa icon-like"></i> Moving Excel Sheet</a>
                    </li>
       <li <?php if ($this->name . '' . $this->action == 'Customers_tro_excel_sheet'): ?> class="active" <?php endif; ?> >
    <a href="<?php echo Router::url(array('controller' => 'customers', 'action' => 'tro_excel_sheet')) ?>"> <i class="fa icon-like"></i> Troubleshot Excel Sheet</a>
</li>-->
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
                        <a href="<?php echo Router::url(array('controller' => 'admins', 'action' => 'donebytech')) ?>"> <i class="fa fa-plane"></i> Task Completed </a>
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
                        <a href="<?php echo Router::url(array('controller' => 'customers', 'action' => 'cancelrequest')) ?>"> <i class="fa fa-search"></i> Cancel Request ( <b title="Total Cancel Request" style="color: lightseagreen;"><?php echo $total_cancel_request; ?></b> )</a>
                    </li>

                    <li <?php if ($this->name . '' . $this->action == 'Customersholdrequest'): ?> class="active" <?php endif; ?> >
                        <a href="<?php echo Router::url(array('controller' => 'customers', 'action' => 'holdrequest')) ?>"> <i class="fa fa-search"></i>  Hold Request ( <b title="Total Hold Request" style="color: lightseagreen;"><?php echo $total_hold_request; ?></b> )</a>
                    </li>

                    <li <?php if ($this->name . '' . $this->action == 'Customersunholdrequest'): ?>  class="active"  <?php endif; ?> >
                        <a href="<?php echo Router::url(array('controller' => 'customers', 'action' => 'unholdrequest')) ?>">  <i class="fa fa-search"></i>  Unhold Request ( <b title="Total Unhold Request" style="color: lightseagreen;"><?php echo $total_unhold_request; ?></b> )</a>
                    </li>

                    <li <?php if ($this->name . '' . $this->action == 'CustomersreconnectionRequest'): ?>  class="active" <?php endif; ?>  >
                        <a href="<?php echo Router::url(array('controller' => 'customers', 'action' => 'reconnectionRequest')) ?>"> <i class="fa fa-search"></i>  Reconnection ( <b title="Total Reconnection Request" style="color: lightseagreen;"><?php echo $total_reconnection_request; ?></b> )</a>
                    </li>

                </ul>
            </li>

            <li <?php
            $auto = array('PaymentsprocessAutoRecurring', 'ReportsallAutorecurringSettings', 'Reportsmodify_customer', 'Reportsdecline', 'Reportsflagmodify');

            if (in_array($this->name . '' . $this->action, $auto)):
                ?> class="active"<?php endif; ?> ><a href="javascript:;">
                    <i class="fa fa-envelope"></i> <span class="title">Auto Recurring</span>  <span class="arrow "></span> </a>
                <ul class="sub-menu">                
                    <li <?php if ($this->name . '' . $this->action == 'Reportsallautorecurringsettings'): ?> class="active" <?php endif; ?> >
                        <a href="<?php echo Router::url(array('controller' => 'reports', 'action' => 'allAutorecurringSettings')) ?>"> <i class="fa fa-search"></i> Check Settings</a>
                    </li>

                    <li <?php if ($this->name . '' . $this->action == 'processAutore'): ?> class="active"  <?php endif; ?>  > 
                        <a href="<?php echo Router::url(array('controller' => 'transactions', 'action' => 'processAutore')) ?>"> <i class="fa fa-wrench"> </i> Process</a>
                    </li>

<!--                    <li <?php if ($this->name . '' . $this->action == 'processautorecurring'): ?> class="active"  <?php endif; ?>  > 
    <a href="<?php echo Router::url(array('controller' => 'payments', 'action' => 'processAutoRecurring')) ?>"> <i class="fa fa-wrench"> </i> Process</a>
</li>-->

                    <?php if ($invoice_created > 0) : ?>
                        <li <?php if ($this->name . '' . $this->action == 'Reportsflagmodify'): ?> class="active"  <?php endif; ?>  > 
                            <a href="<?php echo Router::url(array('controller' => 'reports', 'action' => 'flagmodify')) ?>"> <i class="fa fa-wrench"> </i> Modify invoice flag <b title="Total flag have to change" style="color: lightseagreen;"> ( <?php echo $invoice_created; ?> )</b></a>
                        </li>
                    <?php endif; ?>

                    <li <?php if ($this->name . '' . $this->action == 'Reportsmodify_customer'): ?> class="active"  <?php endif; ?>  > 
                        <a href="<?php echo Router::url(array('controller' => 'reports', 'action' => 'notify_customer')) ?>"> <i class="fa fa-search"> </i> Card expiration</a>
                    </li>                    

                    <?php if ($total_declined_sadmin > 0) : ?>
                        <li <?php if ($this->name . '' . $this->action == 'Reportsdecline'): ?> class="active" <?php endif; ?> >
                            <a href="<?php echo Router::url(array('controller' => 'reports', 'action' => 'decline')) ?>"> <i class="fa fa-search"></i> Decline  <b title="Total decline" style="color: lightseagreen;"> ( <?php echo $total_declined_sadmin; ?> )</b></a>
                        </li>
                    <?php endif; ?> 
                </ul>
            </li>

            <li <?php
            $month_recurring = array('Customersdata_next_recurring', 'Customersnext_month_recurring');
            if (in_array($this->name . '' . $this->action, $month_recurring)):
                ?> class="active"<?php endif; ?> ><a href="javascript:;">
                    <i class="fa fa-envelope"></i> <span class="title">Invoice generate </span>  <span class="arrow "></span> </a>
                <ul class="sub-menu"> 
                    <li <?php if ($this->name . '' . $this->action == 'Customersnext_month_recurring'): ?> class="active"  <?php endif; ?>  > 
                        <a title="Total next month recurring :-)" href="<?php echo Router::url(array('controller' => 'customers', 'action' => 'next_month_recurring')) ?>"><i class="fa fa-search"></i> Next month recurring 
                            <?php if ($total_month_cus > 0) { ?>
                                ( <b title="Total month recurring" style="color: red;"><?php echo $total_month_cus; ?></b> )
                            <?php } ?>
                        </a>
                    </li>
                    <li <?php if ($this->name . '' . $this->action == 'Customersdata_next_recurring'): ?> class="active"  <?php endif; ?>  > 
                        <a title="Total next recurring :-)" href="<?php echo Router::url(array('controller' => 'customers', 'action' => 'data_next_recurring')) ?>"> <i class="fa fa-search"> </i>Next recurring list ( <b title="Total next recurring" style="color: lightseagreen;"><?php echo $total_cus_r; ?></b> )</a>
                    </li> 
                </ul>
            </li> 

<!--            <li <?php
            $attendence = array('Admins_attend', 'Customersnext_month_recurring');
            if (in_array($this->name . '' . $this->action, $attendence)):
                ?> class="active"<?php endif; ?> ><a href="javascript:;">
                    <i class="fa fa-envelope"></i> <span class="title">Attendance </span>  <span class="arrow "></span> </a>
                <ul class="sub-menu"> 
                    <li <?php if ($this->name . '' . $this->action == 'Admins_attend'): ?> class="active"  <?php endif; ?>  > 
                        <a  href="<?php echo Router::url(array('controller' => 'admins', 'action' => 'attend')) ?>"><i class="fa fa-search"></i> Present month 
                        </a>
                    </li>
                   
                </ul>
            </li> -->

            <!--   <li <?php
            $log = array('Reportsalllog');
            if (in_array($this->name . '' . $this->action, $log)):
                ?> class="active"<?php endif; ?> ><a href="javascript:;">
                     <i class="fa fa-plane"></i> <span class="title">Log</span>  <span class="arrow "></span> </a>
                 <ul class="sub-menu">                
                    <li <?php if ($this->name . '' . $this->action == 'reportsalllog'): ?> class="active" <?php endif; ?> >
                         <a href="<?php echo Router::url(array('controller' => 'reports', 'action' => 'alllog')) ?>"> <i class="fa fa-refresh "> </i>All</a>
                     </li>
                 </ul>
             </li>-->

        </ul>
        <!-- END SIDEBAR MENU -->
    </div>
    <!-- END SIDEBAR -->