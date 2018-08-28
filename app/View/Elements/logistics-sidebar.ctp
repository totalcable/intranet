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
            $admins = array('Logisticsmanage', 'Logisticsadd_product', 'Customersref_bonus', 'Customersmanage_delete_data', 'Otherspaymentsmanage', 'Otherspaymentscreate', 'Otherspaymentsedit', 'AdminsmanageRole', 'Adminsaddrole', 'Adminseditrole', 'AdminsadjustmentMemo', 'AdminsmanageDepartment', 'Adminsadddepartment', 'Adminseditdepartment', 'Messagesmanage', 'Messagesadd', 'Messagesedit', 'Adminsmanage', 'Adminscreate', 'Adminsedit_admin', 'AdminsmanageIssue', 'Adminsaddissue', 'Adminseditissue');
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
                    <li <?php if ($this->name . '' . $this->action == 'Logisticsmanage'): ?> class="active" <?php endif; ?> >
                        <a href="<?php echo Router::url(array('controller' => 'logistics', 'action' => 'manage')) ?>"> <i class="fa fa-dashboard"></i> Products</a>
                    </li>                    
                </ul>
            </li>

            <li <?php
            $logistics = array('LogisticslogisticsMainten', 'Logisticslogistics_manage');
            if (in_array($this->name . '' . $this->action, $logistics)):
                ?> class="active"<?php endif; ?> ><a href="javascript:;">
                    <i class="fa fa-plane"></i> <span class="title">Logistics</span>  <span class="arrow "></span> </a>
                <ul class="sub-menu">                
                    <li <?php if ($this->name . '' . $this->action == 'Logisticslogistics_manage'): ?> class="active" <?php endif; ?> >
                        <a href="<?php echo Router::url(array('controller' => 'logistics', 'action' => 'logistics_manage')) ?>"> <i class="fa fa-refresh "> </i> Logistics Manage</a>
                    </li>
                </ul>
            </li>
        </ul>
        <!-- END SIDEBAR MENU -->
    </div>
    <!-- END SIDEBAR -->