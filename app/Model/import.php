<?php
class Import extends AppModel
{
	var $name = "import";
	public $belongsTo = array('Product','Category');

}

?>