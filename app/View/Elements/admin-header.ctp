<?php
echo $this->Html->css(
        array(
            '/assets/admin/layout/css/layout',
            '/assets/admin/layout/css/themes/darkblue',
            '/assets/admin/layout/css/custom',
            // date range picker css
            '/jquery-ui-daterangepicker-0.4.3/jquery-ui.min',
            '/jquery-ui-daterangepicker-0.4.3/bootstrap.min',
            '/jquery-ui-daterangepicker-0.4.3/bootstrap-theme.min',
            '/jquery-ui-daterangepicker-0.4.3/styles',
            '/jquery-ui-daterangepicker-0.4.3/prettify',
            '/jquery-ui-daterangepicker-0.4.3/jquery.comiseo.daterangepicker',
            '/js/formValidationJs/site-demos',
        )
);
?>
</head>
<body class="page-header-fixed page-quick-sidebar-over-content ">
    <!-- BEGIN HEADER -->
    <div class="page-header navbar navbar-fixed-top"> 
        <!-- BEGIN HEADER INNER -->
        <div class="page-header-inner">
            <div class="time">
                <?php
                $dt = new DateTime();
                echo $dt->format('l, F d, Y');
                ?> <!-- DOC: Remove the above "hide" to enable the sidebar toggler button on header -->
                &nbsp;&nbsp; &nbsp; <a style="font-size: 17px; font-weight: bold; color:  lightskyblue; " title="Click here for CRM knowledge :-)" class="fa fa-book"  target="_blank"
                                       href="<?php echo Router::url(array('controller' => 'customers', 'action' => 'knowledge')) ?>"> &nbsp; Knowledge Base
                </a>
            </div>

            <div class="page-logo">
                <a href="<?php echo Router::url(array('controller' => 'customers', 'action' => 'search')) ?>">
                    <img src="<?php echo $this->webroot; ?>images/support_icon_headset_orange.png" alt="logo" class="logo-default" style="margin: 9px 0 0 0;">
                </a>
            </div>



            <div class="top-menu">
                <ul class="nav navbar-nav pull-right">
                    <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                    <li class="dropdown dropdown-user">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                            <?php if (!empty($loggedUserpic)): ?>
                                <img alt="" class="img-circle" src="<?php echo $this->webroot . 'pictures' . '/' . $loggedUserpic; ?>"  width="50px" height="50px" />
                            <?php endif ?>
                            <span class="username username-hide-on-mobile">
                                <?php echo $loggedUser; ?></span>
                            <i class="fa fa-angle-down"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-default">
                            <br>
                            <li>
                                <b style="float: left; color:  tomato; font-size: 12px; text-align: center;"><?= 'Hello ' . $loggedUser . ' Welcome in CRM' ?></b>
                            </li>
                            <br>

                            <li>
                                <a href="<?php echo Router::url(array('controller' => 'admins', 'action' => 'logout')) ?>">
                                    <i class="icon-key"></i> Log Out </a>
                            </li>
                            <li>
                                <a href="<?php echo Router::url(array('controller' => 'admins', 'action' => 'changePassword')) ?>">
                                    <i class="icon-pencil"></i> Change Password</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- END HEADER -->
    <div class="clearfix">
    </div>
    <!-- BEGIN CONTAINER -->