<?php
echo $this->Html->css(
        array(
// BEGIN THEME STYLES 
            '/assets/frontend/layout/css/style',
            '/assets/frontend/pages/css/style-shop',
            '/assets/frontend/layout/css/style-responsive',
            '/assets/frontend/layout/css/themes/red',
            //END THEME STYLES
// BEGIN MY CSS
            'order',
            'responsive'
// END My css
        )
);
?>
</head>
<!-- Head END -->
<?php $action = $this->request->params['action']; 
   if($action =="login" || $action =="registration"){
    $class = "login";
   }
   else{
    $class = "ecommerce";
   }
?>
<body class="<?php echo $class; ?> ">
    <!-- BEGIN TOP BAR -->
    <div class="pre-header">
        <div class="container">
            <div class="row">
                <!-- BEGIN TOP BAR LEFT PART -->
                <div class="col-md-3 col-sm-4 additional-shop-info">
                    <ul class="list-unstyled list-inline">

                 

                        <!-- BEGIN CURRENCIES -->
                        <li class="shop-currencies">

                        </li>
                        <!-- END CURRENCIES -->

                    </ul>
                </div>
                <div class="col-md-7 col-sm-12 feedback-container">
                    <div class="user-feedback">
                

                    </div>

                </div>

                <!-- END TOP BAR LEFT PART -->
                <!-- BEGIN TOP BAR MENU -->
                <!--                <div class="col-md-2 col-sm-2 additional-nav">
                                    <ul class="list-unstyled list-inline pull-right">
                                        <li><a href="shop-account.html">My Account</a></li>
                                   </ul>
                                </div>-->
                <!-- END TOP BAR MENU -->
            </div>
        </div>        
    </div>
    <!-- END TOP BAR -->

    <!-- BEGIN HEADER -->
    <div class="header">
        <div class="container">
            <a href="javascript:void(0);" class="mobi-toggler"><i class="fa fa-bars"></i></a>
            <div class="header-navigation">
                
            </div>
            <!-- END NAVIGATION -->
        </div>
    </div>
    <!-- Header END -->

    <div class="main">
        <div class="container">

