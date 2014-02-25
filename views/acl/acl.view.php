<?php

if (isset($_REQUEST['direcBase']) && isset($_REQUEST['linkBase']) ) {
	define ('DIREC_BASE', $_REQUEST['direcBase']);
	define ('LINK_BASE', $_REQUEST['linkBase']);
}
else {
	die ("Error geting arguments");
}


require_once (DIREC_BASE.'/libraries/constants.php');
require_once (LIBRARIES.DS.'imports.php');


//Let's init the session do no matther if it's already 
iSess();

//$config = functions::getConfig();
	
	
	
	
	//Final Table
	$td = new l_td;
	$tr = new l_tr;
	$table = new table;
	
	$arg = array();
	
	
	$todos = html::divFromArray(array('id'=>'acl-all'), '');
	$carga = html::divFromArray(array('id'=>'acl-cart'), '');
	$param = html::divFromArray(array('id'=>'acl-param'),'');
	
	
	$td->add_col(array($todos,array('width'=>'20%')));
	$td->add_col(array($carga,array('width'=>'40%')));
	$td->add_col(array($param,array('width'=>'40%')));
	
	$td->p_td();
	
	$tr->add_row(array($td,$arg));
	
	$tr->p_tr();
	
	$arg = array('width'=>'100%');
	$table->p_table($arg, $tr);
	
	//echo htmlentities($table->get_tr());
	
	$content = html::divFromArray(array('id'=>'acl-manager'),$table->get_table());
	
	//$table->print_table();
	
	
	//$squid_conf = jsReady(gSess('squid_conf_acl'));
	//$squid_conf = json_decode(gSess('squid_conf_acl'),true);
	//var_dump($squid_conf);
	echo $content.html::blankImage('initAclManage');
?>

