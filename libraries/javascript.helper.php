<?php


/**
 * javascript.helper.php string returning function to send to javascript
 *
 * @package		calamardo.Framework
 * @since		1.0
 */
 
 
//the basic params 
if (isset($_REQUEST['direcBase']) && isset($_REQUEST['linkBase']) ) {
	define ('DIREC_BASE', $_REQUEST['direcBase']);
	define ('LINK_BASE', $_REQUEST['linkBase']);
}
else {
	die ('Error geting arguments');
}

require_once (DIREC_BASE.'/libraries/constants.php');
require_once (LIBRARIES.DS.'imports.php');



//we need at least a function to execute 
if (isset($_REQUEST['function'])) {
	$function = $_REQUEST['function'];
	if($function == 'none'){
		die ('No way dude You are Wrong, Sapo ecerro');
	}
	
	//in case we have some vars for the function
	//paratal($_REQUEST['fv']);
	$vars = isset($_REQUEST['fv']) ? $_REQUEST['fv'] : '';
	paratal($vars); 
}
else {
	//echo text::_('NEED_A_FUNCTION');
	die (text::_('NEED_A_FUNCTION'));
}



echo call_user_func($function,$vars);
//echo htmlentities($function);
//The Result
//echo $function;

 
?>