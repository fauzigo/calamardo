<?php

if (isset($_REQUEST['direcBase']) && isset($_REQUEST['linkBase']) ) {
	define ('DIREC_BASE', $_REQUEST['direcBase']);
	define ('LINK_BASE', $_REQUEST['linkBase']);
}
else {
	die ("Error geting arguments");
}

if (isset($_REQUEST['json'])  ) {
	
	$json = $_REQUEST['json'];
	require_once (DIREC_BASE.'/libraries/constants.php');
	require_once (LIBRARIES.DS.'imports.php');

	//Session initialize
	iSess();
	
	$sId = functions::sessId();
	
	if(functions::setJson(JSONS.DS.'acl_conf.'.$sId.'.json', json_encode($json))){
		
		$session_vars['squid_conf_acl'] = json_encode($json);
		/*
		foreach ($json as $key => $value) {
			paratal($key.": ");
			paratal(implode(',',$value));
		}*/
		
		sSess($session_vars);
		echo 'OK';
		
	}else{
		paratal(text::_('ERROR_SETTING_JSON'));
		echo 'ERR';
	}
}
else {
	paratal(text::_('ERROR_SETTING_JSON'));
	die ("Error geting json");
}
?>