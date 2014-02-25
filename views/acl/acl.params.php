<?php

if (isset($_REQUEST['direcBase']) && isset($_REQUEST['linkBase']) ) {
	define ('DIREC_BASE', $_REQUEST['direcBase']);
	define ('LINK_BASE', $_REQUEST['linkBase']);
}
else {
	die ('Error geting arguments');
}

if (isset($_REQUEST['acl']) && !is_null($_REQUEST['acl']) ) {
	$acl = $_REQUEST['acl'];
	if($acl == 'none'){
		die ('no se que paso');
	}
	//echo $acl.'ssssssssssss';
}
else {
	die ('Error geting acl');
}

if (isset($_REQUEST['acl_name']) && !is_null($_REQUEST['acl_name']) ) {
	$acl_name = $_REQUEST['acl_name'];
	if($acl_name == 'none'){
		die ();
	}
	//echo $acl.'aaaaaaa';
}
else {
	
	die ('no name');
}




require_once (DIREC_BASE.'/libraries/constants.php');
require_once (LIBRARIES.DS.'imports.php');

//Let's init the session do no matther if it's already 
iSess();

$acl_conf = json_decode(gSess('squid_conf_acl'),true);
//var_dump($acl_conf[$acl_name]);
$especific_acl = $acl_conf[$acl_name];


//Global configs
//$config = functions::getConfig();


$arg = array();

//Squid configs
$squid_conf = functions::getSquidConf();
$acl_params = $squid_conf->getAclTypes($acl);



/** Fields's header  it's all about information*/
$param_header   = html::hFromArray(1, array('class'=>'ui-widget-header'), text::_('ACL_PARAMS'));

//$param_header = html::legendFromArray($arg, text::_('ACL_PARAMS'));

$desc_header    = html::spanFromArray(array('class'=>'acl_titles'), text::_('DESCRIPTION').':  '); //($text)(2, $arg, text::_('DESCRIPTION'));
$desc           = html::divFromArray($arg, $desc_header.$acl_params['desc']);

$syntax_header  = html::spanFromArray(array('class'=>'acl_titles'), text::_('SYNTAX').':  '); //html::hFromArray(2, $arg, text::_('SYNTAX'));
$syntax         = html::divFromArray($arg, $syntax_header.$acl_params['syntax']);

$example_header = html::spanFromArray(array('class'=>'acl_titles'), text::_('EXAMPLE').':  '); //html::hFromArray(2, $arg, text::_('EXAMPLE'));
$example        = html::divFromArray($arg, $example_header.$acl_params['example']);


//this is the acl this params belong to
$from           = html::inputFromArray(array('type'=>'hidden','id'=>'from','name'=>'from','value'=>$acl_name));

$header         = html::divFromArray(array('class'=>'param_header'), $param_header.$desc.$syntax.$example);

/** Field's header ends */


/** Fields's inputs */

//in case the acl is case sensitive
$case = $acl_params['case'] == 'yes' ? html::checkboxFromArray(array('label'=>text::_('CASE_SENSTIVE'),'id'=>'case_sensitive','name'=>'case_sensitive')) : '';
$case = $acl_params['case'] == 'yes' ? html::divFromArray(array('class'=>'case_sensitive'), $case) : $case;


$count = 1;
foreach ($acl_params['params'] as $key => $value) {
	
	if ($acl == 'time'){
		
		if ($value == 'check'){
			$params_content = html::checkboxFromArray(array('class'=>'cb','type'=>'text','name'=>$key,'id'=>$key,'label'=>$key));
			$params_container1 .= $params_content; //html::divFromArray($arg, $params_content);
			$count = 0;
		}else{
			$value = quote_sanitize($especific_acl[$count]);
			$params_content = html::inputFromArray(array('value'=>$value,'type'=>'text','name'=>$key,'id'=>$key,'label'=>$key));
			$params_container2 .= html::divFromArray(array('class'=>'campo'), $params_content);
		}
		
	}else{
		$value = quote_sanitize($especific_acl[$count]);
		$params_content = html::inputFromArray(array('value'=>$value,'type'=>'text','name'=>$key,'id'=>$key,'label'=>$key));
		$params_container .= html::divFromArray(array('class'=>'campo'), $params_content);
	}
	$count++;
}

if ($acl == 'time'){
	$params_container1 = html::divFromArray($arg, $params_container1);
	$params_container2 = html::divFromArray(array('class'=>'separated'), $params_container2);
	
	$params_container = $params_container1.$params_container2;
}

$fieldset_legend = html::legendFromArray($arg, text::_('ACL_INPUTS'));

$fieldset = html::fieldsetFromArray($arg, $fieldset_legend.$case.$params_container);

$fieldset_container = html::divFromArray(array('class'=>'param_fields'), $fieldset);


$content = html::divFromArray(array('class'=>'param_container'), $from.$header.$fieldset_container);


echo $content;

var_dump($especific_acl);

?>