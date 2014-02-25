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


	$arg = array();
	
	//Squid configs
	$squid_conf = functions::getSquidConf();
	//$allAcls = $squid_conf->getAclTypes();
	$allAclsClass = $squid_conf->getAclClass();


	$all_header = html::hFromArray(1,array('class'=>'ui-widget-header'), text::_('CLASSES'));
    
    $all_content= '';

	
	foreach ($allAclsClass as $key => $value) {
		$allAclsClasses = $squid_conf->getAclClass($key);
		
		$all_content_header = html::hFromArray(3, $arg,html::lintTo('#', $key));
		
		$all_content_li = '';
		
		foreach ($allAclsClasses as $key1 => $value1) {
			
			$all_content_li .= html::liFromArray($arg, $key1);
			
		}
		
		$all_content .= $all_content_header.html::divFromArray($arg, html::ulFromArray($arg, $all_content_li));
		
	}

	$all_catalog = html::divFromArray(array('id'=>'catalog'), $all_content);
	
	$all = html::divFromArray(array('id'=>'products'), $all_header.$all_catalog);
	
	echo $all;
	
	
?>

<!--
<div id="products">
	<h1 class="ui-widget-header">Classes</h1>	
	<div id="catalog">
		<?php
			foreach ($allAclsClass as $key => $value) {
				$allAclsClasses = $squid_conf->getAclClass($key);

		?>
			<h3><a href="#"><?php echo $key; ?></a></h3>
				<div>
					<ul>
		<?php
		
				foreach ($allAclsClasses as $key1 => $value1) {
					
		?>
						<li><?php echo $key1; ?></li>
		<?php
							
				}
		?>
					</ul>
				</div>
		<?php
			}
		?>
		
		
	</div>
</div>
-->
