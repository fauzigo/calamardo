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


	//Final Table
	$td = new l_td;
	$tr = new l_tr;
	$table = new table;
	
	$arg = array();
	
	
	$acls = html::divFromArray(array('id'=>'rules-acl'), '');
	
	$todos = html::divFromArray(array('id'=>'rules-rul'), '');
	$manip = html::divFromArray(array('id'=>'rules-cart'), 'chao');
	
	
	$manip = html::divFromArray(array('id'=>'rules-manipulation'), $todos.$manip);
	
	
	$td->add_col(array($acls,array('class'=>'rules-lef')));
	$td->add_col(array($manip,array('class'=>'rules-rig')));
	
	$td->p_td();
	
	$tr->add_row(array($td,$arg));
	
	$tr->p_tr();
	
	$arg = array('width'=>'100%');
	$table->p_table($arg, $tr);
	
	
	$content = html::divFromArray(array('id'=>'rules-manager'),$table->get_table());
	
	//$content = html::divFromArray(array('id'=>'rules-manager'),$acls.$manip);
	
	
	
	echo $content.html::blankImage('initRulesManage');
	

?>