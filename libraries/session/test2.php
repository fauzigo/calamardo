<?php
require_once('./session.class.php');

$sesi = new sessions;

$sesi->session();

//$sesi->set(array('hola'=>'tal'));

print_r($_SESSION);

echo $sesi->get('hola');
?>