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

require_once (CONTROLRULE.DS.basename(__FILE__));

//Session initialize
iSess();

$rules_for_cart = '';

//get the squid configuration from the file config.php and setted on session 
if (gSess('squid_conf_rules') !== FALSE){
    $rules_array = functions::getRulesLoaded();
    
    foreach ($rules_array as $key => $value) {
        $js_params = '\''.$value[0].'\',\''.$key.'\'';
        //this way we asure to call the same JS function that's called when a item is droped on the cart
            
            
            //Final Table 
            $td = new l_td;
            $tr = new l_tr;
            $table = new table;
            
            $arg = array();
            
            
            $type = html::divFromArray(array('id'=>'line_type'), html::spanFromArray(array('class'=>'rule-type'), $value[0]));
            $perm = html::divFromArray(array('id'=>'line_perm'), html::spanFromArray(array('class'=>formatPermit($value[1])), $value[1]));
            
            $acls = explode(' ', $value[2]);
            $acl  = '';
            foreach ($acls as $key1 => $value1) {
                $acl .= html::spanFromArray(array('class'=>'acl-item'),$value1).' ';
            }
            
            $acl = html::divFromArray(array('id'=>'acl-list'), $acl);
            
            $edit    = html::linkFromArray(array('href'=>'#','title'=>'Edit','class'=>'acl_actions ui-icon ui-icon-document')); //('#', '', 'Edit', 'acl_actions ui-icon ui-icon-document');
            $delete  = html::lintTo('#', '', 'Delete', 'acl_actions ui-icon ui-icon-cancel');
            
            
            $td->add_col(array($type,array('width'=>'100px')));
            $td->add_col(array($perm,array('width'=>'100px')));
            $td->add_col(array($acl ,array('id'=>'where-acl-goes')));
            $td->add_col(array($edit,array('width'=>'16px')));
            $td->add_col(array($delete,array('width'=>'16px')));
            
            $td->p_td();
    
            $tr->add_row(array($td,$arg));
            
            $tr->p_tr();
            
            $arg = array('width'=>'100%');
            $table->p_table($arg, $tr);
            
            $arg = array();
            
            $rules_for_cart .= html::liFromArray($arg, $table->get_table());
            
            
        //$acls_for_cart .= html::blankImage('itemDropedOnCart',null,$js_params);
    }
    //$acls_for_cart = html::divFromArray(array(), $acls_for_cart);
}else{
    $rules_for_cart = html::liFromArray(array('class'=>'placeholder'), text::_('ADD_YOUR_ITEMS_HERE'));
    //<li class="placeholder">'.text::_('ADD_YOUR_ITEMS_HERE').'</li>
}





    $cart_header = html::hFromArray(1, array('class'=>'ui-widget-header'), text::_('RULES')); //'<h1 class="ui-widget-header">'.text::_('ACL').'</h1>';
    $cart_container = '<ol class="cart">'.$rules_for_cart.'</ol>';
    $cart_content = html::divFromArray(array('id'=>'ui-widget-content'), $cart_container);
    $cart = html::divFromArray(array('id'=>'cart'), $cart_header.$cart_content);
    
    
    echo $cart.html::blankImage('activateDropable');

?>