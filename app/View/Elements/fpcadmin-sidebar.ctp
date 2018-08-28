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



                </ul>
            </li>

           <li <?php
            $fpcs = array('Movietimesmovie_mange','Movietimesmovie_time','Movietimesset_movie','Movietimesmanage');
            if (in_array($this->name . '' . $this->action, $fpcs)):
                ?> class="active"<?php endif; ?> ><a href="javascript:;">
                    <i class="fa fa-plane"></i> <span class="title">FPC</span>  <span class="arrow "></span> </a>
                <ul class="sub-menu">  
                    <li <?php if ($this->name . '' . $this->action == 'Movietimesmovie_mange'): ?> class="active" <?php endif; ?> >
                        <a href="<?php echo Router::url(array('controller' => 'movietimes', 'action' => 'movie_mange')) ?>"> <i class="fa fa-refresh "> </i>Add</a>
                    </li>
                    <li <?php if ($this->name . '' . $this->action == 'Movietimesmovie_time'): ?> class="active" <?php endif; ?> >
                        <a href="<?php echo Router::url(array('controller' => 'movietimes', 'action' => 'movie_time')) ?>"> <i class="fa fa-refresh "> </i>Movie time</a>
                    </li>
                    
                    <li <?php if ($this->name . '' . $this->action == 'Movietimesset_movie'): ?> class="active" <?php endif; ?> >
                        <a href="<?php echo Router::url(array('controller' => 'movietimes', 'action' => 'set_movie')) ?>"> <i class="fa fa-refresh "> </i>Set movie</a>
                    </li>
                    
                    <li <?php if ($this->name . '' . $this->action == 'Movietimesmanage'): ?> class="active" <?php endif; ?> >
                        <a href="<?php echo Router::url(array('controller' => 'movietimes', 'action' => 'manage')) ?>"> <i class="fa fa-refresh "> </i>Manage</a>
                    </li>
                </ul>
            </li>
        </ul>
        <!-- END SIDEBAR MENU -->
    </div>
    <!-- END SIDEBAR -->