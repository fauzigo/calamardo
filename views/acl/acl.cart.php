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

$acls_for_cart = '';

//get the squid configuration from the file config.php and setted on session 
if (gSess('squid_conf_acl') !== FALSE){
	$acl_array = functions::getAclLoaded();
	
	foreach ($acl_array as $key => $value) {
		$js_params = '\''.$value[0].'\',\''.$key.'\'';
		//this way we asure to call the same JS function that's called when a item is droped on the cart
			
			//Final Table 
			$td = new l_td;
			$tr = new l_tr;
			$table = new table;
			
			$arg = array();
			
			$input = html::inputFromArray(array('type'=>'text','class'=>'acl-name','id'=>$value[0],'name'=>$value[0],'value'=>$key));
			$label = html::spanFromArray(array('class'=>'acl-label'), $value[0]);
			
			$edit    = html::linkFromArray(array('href'=>'#','title'=>'Edit','class'=>'acl_actions ui-icon ui-icon-document')); //('#', '', 'Edit', 'acl_actions ui-icon ui-icon-document');
			$delete  = html::lintTo('#', '', 'Delete', 'acl_actions ui-icon ui-icon-cancel');
			
			
			$td->add_col(array($input.$label,$arg));
			$td->add_col(array($edit,array('width'=>'16px')));
			$td->add_col(array($delete,array('width'=>'16px')));
			
			$td->p_td();
	
			$tr->add_row(array($td,$arg));
			
			$tr->p_tr();
			
			$arg = array('width'=>'100%');
			$table->p_table($arg, $tr);
			
			$arg = array();
			
			$acls_for_cart .= html::liFromArray($arg, $table->get_table());
			
			
		//$acls_for_cart .= html::blankImage('itemDropedOnCart',null,$js_params);
	}
	//$acls_for_cart = html::divFromArray(array(), $acls_for_cart);
}else{
	$acls_for_cart = html::liFromArray(array('class'=>'placeholder'), text::_('ADD_YOUR_ITEMS_HERE'));
	//<li class="placeholder">'.text::_('ADD_YOUR_ITEMS_HERE').'</li>
}





	$cart_header = html::hFromArray(1, array('class'=>'ui-widget-header'), text::_('ACL')); //'<h1 class="ui-widget-header">'.text::_('ACL').'</h1>';
	$cart_container = '<ol class="cart">'.$acls_for_cart.'</ol>';
	$cart_content = html::divFromArray(array('id'=>'ui-widget-content'), $cart_container);
	$cart = html::divFromArray(array('id'=>'cart'), $cart_header.$cart_content);
	
	
	echo $cart;
?>