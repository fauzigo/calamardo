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


//Session initialize
iSess();

	$arg = array();
	
	//Squid configs
	$squid_conf = functions::getSquidConf();
	$allRules = $squid_conf->getRulesTypes();
	
	$hola = html::h1FromArray(array('class'=>'ui-widget-header'), text::_('RULES'));
	
	$header = html::divFromArray(array('class'=>'h-16'),  $hola);
	
	$all_content_li = '';
	
	//$acls = functions::getAclLoaded(FALSE);
	
	//var_dump($acls);
	
	foreach ($allRules as $key => $value) {
		
		$all_content_li .= html::liFromArray(array('class'=>'ui-draggable da-rulaz'), $key);
		
	}
	
	$all_content = html::ulFromArray($arg, $all_content_li);
	
	$all_catalog = html::divFromArray(array('id'=>'list-rules','class'=>'ui-widget'), $all_content);
	
	$all = html::divFromArray(array('id'=>'rules-content'), $header.$all_catalog);
	
	echo $all.html::blankImage('activateRulDrag');;


//print_r($allRules);

	
	
?>