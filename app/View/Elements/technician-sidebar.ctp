
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
            $technicians = array('TechniciansnewCustomer', 'TechniciansdoneCustomer','TechnicianspostPone','TechniciansrescheduledCustomer','TechnicianscancelledCustomer','TechnicianspostponeView');
            if (in_array($this->name . '' . $this->action, $technicians)):
                ?>
                    class="active"
                    <?php
                endif;
                ?>
                >
                <a href="javascript:;">
                    <i class="fa fa-bug"></i>
                    <span class="title">My Work</span>
                    <span class="arrow "></span>
                </a>
                <ul class="sub-menu">
                    <li
                    <?php if ($this->name . '' . $this->action == 'TechniciansnewCustomer'):
                        ?>
                            class="active"
                            <?php
                        endif;
                        ?>
                        >
                        <a href="<?php echo Router::url(array('controller' => 'technicians', 'action' => 'newCustomer')) ?>">
                            <i class="fa fa-plus"></i>
                            New</a>
                    </li>
                    <li
                    <?php if ($this->name . '' . $this->action == 'TechniciansactiveCustomer'):
                        ?>
                            class="active"
                            <?php
                        endif;
                        ?>
                        >
                        <a href="<?php echo Router::url(array('controller' => 'technicians', 'action' => 'doneCustomer')) ?>">
                            <i class="fa fa-pencil"></i>
                            Done</a>
                    </li>
                    
                      <li
                    <?php if ($this->name . '' . $this->action == 'TechnicianspostponeView'):
                        ?>
                            class="active"
                            <?php
                        endif;
                        ?>
                        >
                        <a href="<?php echo Router::url(array('controller' => 'technicians', 'action' => 'postponeView')) ?>">
                            <i class="fa fa-pencil"></i>
                            Post Pone</a>
                    </li>
                    
                      <li
                    <?php if ($this->name . '' . $this->action == 'TechniciansrescheduledCustomer'):
                        ?>
                            class="active"
                            <?php
                        endif;
                        ?>
                        >
                        <a href="<?php echo Router::url(array('controller' => 'technicians', 'action' => 'rescheduledCustomer')) ?>">
                            <i class="fa fa-pencil"></i>
                            Reschedule</a>
                    </li>
                      <li
                    <?php if ($this->name . '' . $this->action == 'Technicianscancel'):
                        ?>
                            class="active"
                            <?php
                        endif;
                        ?>
                        >
                        <a href="<?php echo Router::url(array('controller' => 'technicians', 'action' => 'cancelledCustomer')) ?>">
                            <i class="fa fa-times"></i>
                            Cancel</a>
                    </li>
                </ul>
                
                 <li 
            <?php
            $payments = array('Techniciansmy_payment');
            if (in_array($this->name . '' . $this->action, $payments)):
                ?>
                    class="active"
                    <?php
                endif;
                ?>
                >                 
                <a href="<?php echo Router::url(array('controller' => 'technicians', 'action' => 'my_payment')) ?>">
                    <i class="fa fa-money"></i>
                    <span class="title">My Payment</span>
                    <span class="arrow "></span>
                </a>
            </li> 
            
            </li> 
        </ul>
    </div>
    <!-- END SIDEBAR -->

