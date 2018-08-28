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
            $tickets = array('Ticketsverification');
            if (in_array($this->name . '' . $this->action, $tickets)):
                ?> class="active"  <?php endif; ?> >
                <a href="javascript:;"> <i class="fa fa-ticket"></i><span class="title"> QA</span> <span class="arrow "></span></a>
                <ul class="sub-menu">   
                    <li <?php if ($this->name . '' . $this->action == 'Ticketsverification'): ?> class="active" <?php endif; ?> >
                        <a href="<?php echo Router::url(array('controller' => 'tickets', 'action' => 'verification')) ?>"> <i class="fa glyphicon glyphicon-check"></i> Que tickets</a>
                    </li>
                </ul>
        </ul>      
    </div>
    <!-- END SIDEBAR -->