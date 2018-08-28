<!-- BEGIN SIDEBAR -->
<div class="page-sidebar-wrapper">
    <div class="page-sidebar navbar-collapse collapse">
        <!-- BEGIN SIDEBAR MENU -->

        <ul class="page-sidebar-menu" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
            <!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
            <li class="sidebar-toggler-wrapper">
                <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
                <div class="sidebar-toggler">
                </div>
                <!-- END SIDEBAR TOGGLER BUTTON -->
            </li>
            <!-- DOC: To remove the search box from the sidebar you just need to completely remove the below "sidebar-search-wrapper" LI element -->
            <li class="sidebar-search-wrapper">
                <form class="sidebar-search " action="extra_search.html" method="POST">
                    <a href="javascript:;" class="remove">
                        <i class="icon-close"></i>
                    </a>
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search...">
                        <span class="input-group-btn">
                            <a href="javascript:;" class="btn submit"><i class="icon-magnifier"></i></a>
                        </span>
                    </div>
                </form>
                <!-- END RESPONSIVE QUICK SEARCH FORM -->
            </li>
            
            <li 
            <?php
            $data = array('Dataaddcity', 'Dataeditcity', 'Dataaddlocation', 'Dataeditlocation');

            if (in_array($this->name . '' . $this->action, $data)):
                ?>
                    class="active"
                    <?php
                endif;
                ?>
                >
                <a href="javascript:;">
                    <i class="fa fa-leaf"></i>
                    <span class="title">Data Management</span>
                    <span class="arrow "></span>
                </a>
                <ul class="sub-menu">
                    <li
                    <?php if ($this->name . '' . $this->action == 'Dataaddcity'):
                        ?>
                            class="active"
                            <?php
                        endif;
                        ?>
                        >
                        <a href="<?php echo Router::url(array('controller' => 'data', 'action' => 'addcity')) ?>">
                            <i class="fa fa-plus"></i>
                            Add city
                        </a>
                    </li>
                    <li
                    <?php if ($this->name . '' . $this->action == 'Dataeditcity'):
                        ?>
                            class="active"
                            <?php
                        endif;
                        ?>
                        >
                        <a href="<?php echo Router::url(array('controller' => 'data', 'action' => 'editcity')) ?>">
                            <i class="fa fa-pencil"></i>
                            Edit city</a>
                    </li>
                    <li
                    <?php if ($this->name . '' . $this->action == 'Dataaddlocation'):
                        ?>
                            class="active"
                            <?php
                        endif;
                        ?>
                        >
                        <a href="<?php echo Router::url(array('controller' => 'data', 'action' => 'addlocation')) ?>">
                            <i class="fa fa-plus"></i>
                            Add location </a>
                    </li>
                    <li
                    <?php if ($this->name . '' . $this->action == 'Dataeditlocation'):
                        ?>
                            class="active"
                            <?php
                        endif;
                        ?>
                        >
                        <a href="<?php echo Router::url(array('controller' => 'data', 'action' => 'editlocation')) ?>">
                            <i class="fa fa-pencil"></i>
                            Edit location </a>
                    </li>

                    <li
                    <?php if ($this->name . '' . $this->action == 'Csvsprocess'):
                        ?>
                            class="active"
                            <?php
                        endif;
                        ?>
                        >
                        <a href="<?php echo Router::url(array('controller' => 'csvs', 'action' => 'process')) ?>">
                            <i class="fa fa-pencil"></i>
                            Upload  csv file(customer table)</a>
                    </li>


                </ul>
            </li>


            
              <li 
            <?php
            $tolets = array('Toletsadd', 'Toletsedit');
            if (in_array($this->name . '' . $this->action, $tolets)):
                ?>
                    class="active"
                    <?php
                endif;
                ?>
                >
                <a href="javascript:;">
                    <i class="icon-basket"></i>
                    <span class="title">Tolets Management</span>
                    <span class="arrow "></span>
                </a>
                <ul class="sub-menu">
                    <li
                    <?php if ($this->name . '' . $this->action == 'Toletsadd'):
                        ?>
                            class="active"
                            <?php
                        endif;
                        ?>
                        >
                        <a href="<?php echo Router::url(array('controller' => 'tolets', 'action' => 'add')) ?>">
                            <i class="fa fa-phone"></i>
                            Add Tolets</a>
                    </li>
                    <li
                    <?php if ($this->name . '' . $this->action == 'Toletsmanage'):
                        ?>
                            class="active"
                            <?php
                        endif;
                        ?>
                        >
                        <a href="<?php echo Router::url(array('controller' => 'tolets', 'action' => 'manage')) ?>">
                            <i class="fa fa-check"></i>
                            Manage Tolet</a>
                    </li>
                   
                   
                </ul>
            </li>    

        </ul>
        <!-- END SIDEBAR MENU -->
    </div>
</div>
<!-- END SIDEBAR -->