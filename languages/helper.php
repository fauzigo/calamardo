<?php
/*
 * 
 * 
 * 
 * 
 * 
 */
 
if (isset($_REQUEST['direcBase']) && isset($_REQUEST['linkBase']) ) {
	define ('DIREC_BASE', $_REQUEST['direcBase']);
	define ('LINK_BASE', $_REQUEST['linkBase']);
}
else {
	die ("Error geting arguments");
}


require_once (DIREC_BASE.'/libraries/constants.php');
require_once (LIBRARIES.DS.'imports.php');


if (isset($_REQUEST['text']) && !is_null($_REQUEST['text']) ) {
	$text = $_REQUEST['text'];
	echo text::_($text);
}
else {
	die ("Error geting text");
}

?>