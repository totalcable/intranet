<?php
class OrderProduct extends AppModel
{
	var $name = "orderProducts";
    
      var $belongsTo = array('Product','Psetting');
}

?>