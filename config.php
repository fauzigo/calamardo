<?php
class config {
	var $offline = '0';
	var $list_limit = '20';
	var $secret = 'Xh816a3jw948zQhz';
	
	var $log_path = '/home/calamardo/public_html/calamardo/logs';
	var $tmp_path = '/home/calamardo/public_html/calamardo/tmp';
	var $squid_conf = '/etc/squid/squid.conf';
	
	var $live_site = '';
	//var $link_base = "http://calamardo.org/calamardo/";

	var $lang = 'es-VE';
	
	//var $dbprefix = 'jos_';
	var $mailer = 'mail';
	var $mailfrom = 'fauzigo@gmail.com';
	var $fromname = 'Calamardo Squid Administration';
	
	
	var $sendmail = '/usr/sbin/sendmail';
	var $smtpauth = '0';
	var $smtpsecure = 'none';
	var $smtpport = '25';
	var $smtpuser = '';
	var $smtppass = '';
	var $smtphost = 'localhost';
	
	//var $direc_base = '/var/www/htdocs/calamardo'; //dirname(__FILE__);
	//var $link_base = '/calamardo/'; //$_SERVER['REQUEST_URI'];
	
	//var $MetaAuthor = '1';
	//var $MetaTitle = '1';
	//var $lifetime = '15';
	//var $session_handler = 'database';
	//var $session_db = 'sesion';
	//var $session_db_var = 'sesion_var';
	var $session_id_len = 32;
	var $session_exp = 320;
	var $session_max_dur = 640;
	
	var $password = '1';
	var $dbtype = 'mysql';
	var $host = 'localhost';
	var $user = 'root';
	var $db = 'traefacil';
	
	var $sitename = 'Calamardo Squid Administration .:calamardo.org.:';
	var $MetaDesc = 'Descripcion';
	var $MetaKeys = 'venezuela, valencia';
}
?>
