<?php

//Definimos DS para evitar usar / para la seleccion de archivos
define ('DS', DIRECTORY_SEPARATOR);

//Project primary libraries directory
define ('LIBRARIES',DIREC_BASE.DS.'libraries');

//the main libraries
define ('BASE',LIBRARIES.DS.'base');
define ('LISTL',LIBRARIES.DS.'list');
define ('HTML',LIBRARIES.DS.'html');
define ('SESSIONS',LIBRARIES.DS.'session');

define ('FILESYSTEM',BASE.DS.'filesystem');
define ('LANGUAGE',BASE.DS.'language');


define ('CONTROL', DIREC_BASE.DS.'controlers');
define ('CONTROLRULE', CONTROL.DS.'rules');

//Relativos para usos de href
define ('VIEWS',LINK_BASE.'views');
define ('ACLV',VIEWS.DS.'acl');
define ('RULES',VIEWS.DS.'rules');
define ('INFOV',VIEWS.DS.'info');


//json Files
define ('JSONS',DIREC_BASE.DS.'jsons');


//link to images
define ('LIMAGES',LINK_BASE.DS.'images');



define ('THECLASS',DIREC_BASE.DS.'class'.DS.'squid');

//Not constant but function needed to be executed all the time


define ('S3S',"</br></br></br>");

?>