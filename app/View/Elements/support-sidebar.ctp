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
            $orders = array(
                'Ordersnocontact',
                'Ordersconfirmed',
                'Ordersdelivered',
                'Ordersreceived',
                'Orderssold',
                'Orderscanceled',
                'Ordersbacked',
                'OrdersprintData',
                'Ordersedit'
            );
            if (in_array($this->name . '' . $this->action, $orders)):
                ?>
                    class="active"
                    <?php
                endif;
                ?>
                >
                <a href="javascript:;">
                    <i class="icon-basket"></i>
                    <span class="title">Order Management</span>
                    <span class="arrow "></span>
                </a>
                <ul class="sub-menu">

                    <li
                    <?php if ($this->name . '' . $this->action == 'Ordersnocontact'):
                        ?>
                            class="active"
                            <?php
                        endif;
                        ?>
                        >
                        <a href="<?php echo Router::url(array('controller' => 'orders', 'action' => 'nocontact')) ?>">
                            <i class="fa fa-phone"></i>
                            No Contact Order</a>
                    </li>
                    <li
                    <?php if ($this->name . '' . $this->action == 'Ordersconfirmed'):
                        ?>
                            class="active"
                            <?php
                        endif;
                        ?>
                        >
                        <a href="<?php echo Router::url(array('controller' => 'orders', 'action' => 'confirmed')) ?>">
                            <i class="fa fa-check"></i>
                            Confirmed Order</a>
                    </li>

                    <li
                    <?php if ($this->name . '' . $this->action == 'OrdersprintData'):
                        ?>
                            class="active"
                            <?php
                        endif;
                        ?>
                        >
                        <a href="<?php echo Router::url(array('controller' => 'orders', 'action' => 'printData')) ?>">
                            <i class="fa fa-print"></i>
                            Print Address</a>
                    </li>

                    <li
                    <?php if ($this->name . '' . $this->action == 'Ordersdelivered'):
                        ?>
                            class="active"
                            <?php
                        endif;
                        ?>
                        >
                        <a href="<?php echo Router::url(array('controller' => 'orders', 'action' => 'delivered')) ?>">
                            <i class="fa  fa-plane"></i>
                            Delivered Order</a>
                    </li>
                    <li
                    <?php if ($this->name . '' . $this->action == 'Ordersreceived'):
                        ?>
                            class="active"
                            <?php
                        endif;
                        ?>
                        >
                        <a href="<?php echo Router::url(array('controller' => 'orders', 'action' => 'received')) ?>">
                            <i class="fa fa-heart"></i>
                            Received Order</a>
                    </li>
                    <li
                    <?php if ($this->name . '' . $this->action == 'Orderssold'):
                        ?>
                            class="active"
                            <?php
                        endif;
                        ?>
                        >
                        <a href="<?php echo Router::url(array('controller' => 'orders', 'action' => 'sold')) ?>">
                            <i class="fa fa-dollar"></i>
                            Sold Order</a>
                    </li>
                    <li
                    <?php if ($this->name . '' . $this->action == 'Orderscanceled'):
                        ?>
                            class="active"
                            <?php
                        endif;
                        ?>
                        >
                        <a href="<?php echo Router::url(array('controller' => 'orders', 'action' => 'canceled')) ?>">
                            <i class="fa  fa-ban"></i>
                            Canceled Order</a>
                    </li>

                    <li
                    <?php if ($this->name . '' . $this->action == 'Ordersbacked'):
                        ?>
                            class="active"
                            <?php
                        endif;
                        ?>
                        >
                        <a href="<?php echo Router::url(array('controller' => 'orders', 'action' => 'backed')) ?>">
                            <i class="fa  fa-exchange"></i>
                            Backed Order</a>
                    </li>


                </ul>
            </li>

             <li 
            <?php
            $data = array('Dataaddcity', 'Dataeditcity', 'Dataaddlocation','Dataeditlocation');
            if (in_array($this->name . '' . $this->action, $data)):
                ?>
                    class="active"
                    <?php
                endif;
                ?>
                >
                <a href="javascript:;">
                    <i class="fa fa-spinner "></i>
                    <span class="title">Data Entry</span>
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
                            <i class="fa fa-university"></i>
                            Add City
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
                            Edit City
                        </a>
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
                            <i class="fa  fa-map-marker"></i>
                            Add Location
                        </a>
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
                            Edit Location
                        </a>
                    </li>
                </ul>
            </li>

                    
           </ul>
        <!-- END SIDEBAR MENU -->
    </div>
</div>
<!-- END SIDEBAR -->