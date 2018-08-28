<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Admin</title>


        <!-- Mobile Specific Metas -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <!-- Le styles -->

        <?php
        echo $this->Html->css(
                array(
                    'bootstrap/bootstrap',
                    'bootstrap/bootstrap-responsive',
                    'supr-theme/jquery.ui.supr',
                    'icons',
                    '/plugins/forms/uniform/uniform.default',
                    'main'
                )
        );
        ?>



        <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
          <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
          <![endif]-->

        <!-- Le fav and touch icons -->
    <!--   <link rel="shortcut icon" href="<?php echo $this->webroot; ?>/images/favicon.ico" / > -->
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo $this->webroot; ?>/images/apple-touch-icon-144-precomposed.png" />

        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo $this->webroot; ?>/images/apple-touch-icon-114-precomposed.png" />
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo $this->webroot; ?>/images/apple-touch-icon-72-precomposed.png" />
        <link rel="apple-touch-icon-precomposed" href="<?php echo $this->webroot; ?>/images/apple-touch-icon-57-precomposed.png" />

    </head>

    <body class="loginPage">

        <div class="container-fluid">

            <div id="header">

                <div class="row-fluid">

                    <div class="navbar">
                        <div class="navbar-inner">
                            <div class="container">
                                <a class="brand" href="#">Admin</a>
                            </div>
                        </div><!-- /navbar-inner -->
                    </div><!-- /navbar -->


                </div><!-- End .row-fluid -->

            </div><!-- End #header -->

        </div><!-- End .container-fluid -->    