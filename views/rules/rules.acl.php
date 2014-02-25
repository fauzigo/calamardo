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


	$all_header = html::hFromArray(1,array('class'=>'ui-widget-header'), text::_('ACL'));
	
	$all_content_header = html::hFromArray(3, $arg,html::lintTo('#', text::_('ACTIVES')));
	
	$all_content_li = '';
	
	$acls = functions::getAclLoaded(FALSE);
	
	//var_dump($acls);
	
	foreach ($acls as $key => $value) {
		
		$all_content_li .= html::liFromArray(array('class'=>'da-aclz'), $key);
		
	}
	
	$all_content = $all_content_header.html::divFromArray($arg, html::ulFromArray($arg, $all_content_li));

	$all_catalog = html::divFromArray(array('id'=>'catalog'), $all_content);
	
	$all = html::divFromArray(array('id'=>'products'), $all_header.$all_catalog);
	
	echo $all;
	
	
?>