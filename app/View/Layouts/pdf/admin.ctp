<?php echo $this->element('common-header'); ?> 
<?php echo $this->element('admin-header'); ?> 

<?php 
if(isset($sidebar)){
      echo $this->element($sidebar.'-sidebar'); 	
 }
?> 
<div style="margin-top: 19px;">
<?php echo $this->fetch('content'); ?>
</div>
<?php echo $this->element('admin-footer'); ?> 