<style type="text/css">
    .alert {
        padding: 6px;
        margin-bottom: 5px;
        border: 1px solid transparent;
        border-radius: 4px;
        text-align: center;
    }

</style>

<div class="page-content-wrapper">
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <div id="initialMsg" class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong><?php echo $msg; ?></strong>
        </div>
        <?php 
        $hide ='';
        if(isset($this->params['pass'][0]) && isset($this->params['pass'][0])=='done'){
            $hide='hide';
        }
?>
        
        <div id="processing" class="alert alert-success display-hide">
            <button type="button" class="close "  data-dismiss="alert">&times;</button>
            <strong><h1> Processing....</h1>.<img src="<?php echo $this->webroot . '/img/ajax-loader.gif'; ?>" ></strong>
        </div>
        <!-- END PAGE CONTENT -->
    </div>
</div>
<!-- END CONTENT -->



