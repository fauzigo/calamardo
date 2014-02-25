<?php


define ('DIREC_BASE', dirname(__FILE__));
define ('LINK_BASE',$_SERVER['REQUEST_URI']);

//echo LINK_BASE;

require_once (DIREC_BASE.'/libraries/constants.php');
require_once (LIBRARIES.DS.'imports.php');

functions::init();

//var_dump($_SESSION);
/*
echo session_id();
echo '</br>'.$_SERVER['HTTP_X_FORWARDED_FOR'];
echo '</br>'.$_SERVER['REMOTE_ADDR'];

$sessi = new sessions;
$sessi->session();
echo $sessi->sessionId();
*/

?>
<!DOCTYPE html>
<html>
<head>
  <link href="theme/css/excite-bike/jquery.ui.all.css" rel="stylesheet" type="text/css"/>
  <link href="theme/css/demos.css" rel="stylesheet" type="text/css"/>
  <link href="theme/css/default.css" rel="stylesheet" type="text/css"/>
  <script src="libraries/js/jquery/jquery-1.8.0.min.js"></script>
  <script src="libraries/js/jquery/ui/js/jquery-ui-1.8.23.custom.min.js"></script>
  <script src="libraries/js/date.format.js"></script>
  <script src="libraries/js/php.js"></script>
  <script src="libraries/js/list/simpleList.js"></script>
  <script src="libraries/js/general.js"></script>
  <script src="libraries/js/rules.js"></script>
  <script src="libraries/js/acl.js"></script>
  
  
  
  
	<script>
  
  $(function() {
  	//initPhpFunctions('<?php echo DIREC_BASE; ?>','<?php echo LINK_BASE; ?>');
	initApp('<?php echo DIREC_BASE; ?>','<?php echo LINK_BASE; ?>');
	//squidConf = '';
	//initPhpFunctions('<?php echo DIREC_BASE; ?>','<?php echo LINK_BASE; ?>');
	});



	</script>
	
	<title><?php echo gSess('title'); ?></title>
</head>

<body>
	<div id="gosh_input"><input type="text" id="coso" name="coso" /></div>
<div id='dialog'></div>  
  <?php 
  
    $undo = html::buttonFromArray(array('id'=>'undo_button','type'=>'button'),text::_('UNDO'));
	$undo = html::divFromArray(array('id'=>'undo'), $undo);
	
	$redo = html::buttonFromArray(array('id'=>'redo_button','type'=>'button'),text::_('REDO'));
	$redo = html::divFromArray(array('id'=>'redo'), $redo);
	
	$menusillo = html::divFromArray(array('id'=>'sub_menusillo'), $undo.$redo);
	$menusillo = html::divFromArray(array('id'=>'menusillo'), $menusillo);
	
	echo $menusillo;

 ?>
  
<div id="tabs">
    <ul>
        <li><a href="<?php echo RULES.DS."rules.view.php?direcBase=".DIREC_BASE."&linkBase=".LINK_BASE; ?>"><span><?php echo text::_('RULES'); ?></span></a></li>
    	<li><a href="<?php echo ACLV.DS."acl.view.php?direcBase=".DIREC_BASE."&linkBase=".LINK_BASE; ?>"><span><?php echo text::_('ACL'); ?></span></a></li>
    	<li><a href="theme/index.html"><span><?php echo text::_('DELAY'); ?></span></a></li>
        <li><a href="#fragment-1"><span><?php echo text::_('GENERAL'); ?></span></a></li>
        <li><a href="theme/index.html"><span><?php echo text::_('AUTH'); ?></span></a></li>
    </ul>
    <div id="fragment-1">
        <p>First tab is active by default:</p>
        <pre><code>$('#example').tabs();</code></pre>
    </div>
    <!--
    <div id="fragment-2">
        Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.
        Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.
    </div>
    
    <div id="fragment-3">
        Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.
        Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.
        Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.
        <button id="alelta">aleltal</button>
    </div>
    -->
</div>

<div id="extra_heigh">		
	<input type="hidden" id="valor" name="valor"/>
	<?php
	//print_r(gSess('squid_conf'));
	//print_r($_SESSION);
?>
</div>

<div id="console">
		<div id="log_chanel"></div>
		<div id="warn_chanel"></div>
</div>

<div id="hiden"></div>


</body>
</html>