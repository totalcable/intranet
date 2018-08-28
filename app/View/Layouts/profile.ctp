<?php echo $this->element('common-header'); ?> 
<?php echo $this->element('public-header'); ?> 
<?php 
$exclude = array('login','index');
$filepath = APP .'View'.DS.'Elements'.DS.$this->request->params['action'].'-sidebar.ctp';
 if(file_exists($filepath )){
    echo $this->element($this->request->params['action'].'-sidebar'); 
 }
?>
<?php echo $this->fetch('content'); ?>
<?php echo $this->element('profile-footer'); ?> 
<?php echo $this->element('public-footer'); ?> 