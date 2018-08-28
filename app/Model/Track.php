<?php
/**
 * 
 */
class Track extends AppModel {
    var $belongsTo = array('User', 'Ticket');
}

?>