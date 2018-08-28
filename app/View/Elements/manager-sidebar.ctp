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
            $tickets = array('Ticketscreate', 'Ticketsmanage', 'TicketsAssigned_to_me', 'TicketsForwarded_by');
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
                    <?php if ($this->name . '' . $this->action == 'Assigned_to_me'):
                        ?>
                            class="active"
                            <?php
                        endif;
                        ?>
                        >
                        <a href="<?php echo Router::url(array('controller' => 'tickets', 'action' => 'assigned_to_me')) ?>">
                            <i class="fa fa-wrench"></i>
                            Assigned to Me</a>
                    </li>
                    <li
                    <?php if ($this->name . '' . $this->action == 'Forwarded_by'):
                        ?>
                            class="active"
                            <?php
                        endif;
                        ?>
                        >
                        <a href="<?php echo Router::url(array('controller' => 'tickets', 'action' => 'forwarded_by')) ?>">
                            <i class="fa fa-wrench"></i>
                            Forwarded by</a>
                    </li>
                </ul> 
             <li 
            <?php

            $services = array('Customersregistration','Customersedit_registration', 'Customersfollowup','Customersready_installation' );
            if (in_array($this->name . '' . $this->action, $services)):
                ?>
                    class="active"
                    <?php
                endif;
                ?>
                >

                <a href="javascript:;">
                    <i class="fa fa-support"></i>
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
                            <i class="fa fa-support"></i>
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
                            <i class="fa fa-support"></i>
                            Opportunity Follow-up </a>
                    </li>

                    <li

                    <?php if ($this->name . '' . $this->action == 'Customersready_installation'):

                        ?>
                            class="active"
                            <?php
                        endif;
                        ?>
                        >

                        <a href="<?php echo Router::url(array('controller' => 'customers', 'action' => 'ready_installation')) ?>">

                            <i class="fa fa-support"></i>
                            Ready to Installation </a>
                    </li>
                </ul>
            </li>


        </ul>
        <!-- END SIDEBAR MENU -->
    </div>


    <!-- END SIDEBAR -->