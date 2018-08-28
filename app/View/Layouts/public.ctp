<?php echo $this->element('common-header'); ?> 
<?php echo $this->element('public-header'); ?> 
<?php 

$exclude = array('Toletsindex','Toletsdetail');
$filepath = '';
 if (!in_array($this->name . '' . $this->action, $exclude)){
        $filepath = APP .'View'.DS.'Elements'.DS.$this->request->params['controller'].'-sidebar.ctp';
    }

//echo $filepath; exit;

 if(file_exists($filepath )){
    echo $this->element($this->request->params['controller'].'-sidebar'); 
 }


?>
<?php echo $this->fetch('content'); ?>
<?php echo $this->element('common-footer'); ?> 
<?php echo $this->element('public-footer'); ?> 