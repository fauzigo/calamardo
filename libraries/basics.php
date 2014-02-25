<?php
		
	/**
	 * function to log some string into a file
	 * 
	 * @param string String stringo to log
	 * 
	 * @return void
	 * 
	 * @since 1.0
	 * 
	 */
	 function paratal($string){
	 	exec('echo "'.$string.'" >> /tmp/tal');
	 }
	 
	 
	/**
	 * function equivalent to session_start()
	 * 
	 * @return void
	 * 
	 * @since 1.0
	 * @author Fauzi Gomez
	 * 
	 */
	 function iSess(){
	 	functions::initSess();
	 }
	 
	 
	 /**
	 * function insert a new var into session
	 * 
	 * @param array var to set
	 * @return void
	 * 
	 * @since 1.0
	 * @author Fauzi Gomez
	 * 
	 */
	 function sSess($var){
	 	functions::sSess($var);
	 }
	 
	 /**
	 * function get a session var
	 * 
	 * @param string var name 
	 * @return mixed var value
	 * 
	 * @since 1.0
	 * @author Fauzi Gomez
	 * 
	 */
	 function gSess($var){
	 	return functions::gSess($var);
	 }
	 
	 /**
	 * function get a session var
	 * 
	 * @param string var name 
	 * @return mixed var value
	 * 
	 * @since 1.0
	 * @author Fauzi Gomez
	 * 
	 */
	 function gSessJson($which){
	 	iSess();
		
		switch ($which){
			case 'acl':
				$final = 'squid_conf_acl';
				break;
			case 'rules':
				$final = 'squid_conf_rules';
				break;
			default:
				$final = 'squid_conf_options';
				break;
		}
	 	return functions::gSess($final);
	 }
	 
	 /**
	 * function jsReady comify a var for JS porpouse
	 * 
	 * @param string $var value 
	 * @return string var 'value'
	 * 
	 * @since 1.0
	 * @author Fauzi Gomez
	 * 
	 */
	 function jsReady($var){
	 	return '\''.$var.'\'';
	 }
	 
	 
	 /**
	 * function string_sanitize clean string
	 * 
	 * @param string $s the string 
	 * @return string sanitized
	 * 
	 * @since 1.0
	 * @author Fauzi Gomez
	 * 
	 */
	 function string_sanitize($s) {
	    $result = preg_replace("/[^a-zA-Z0-9]+/", "", html_entity_decode($s, ENT_QUOTES));
	    return $result;
	 }
	 
	 
	 
	 /**
	  * function getSessionID return the php session id
	  * 
	  * @param
	  * @return string php session id
	  * 
	  * @since 1.0
	  * @author FG
	  */
	  
	function getSessionID(){
		iSess();
		return functions::sessId();
	}
	 
	 
	 /**
	 * function quote_sanitize clean quotes from string
	 * 
	 * @param string $s the string 
	 * @return string sanitized
	 * 
	 * @since 1.0
	 * @author Fauzi Gomez
	 * 
	 */
	 function quote_sanitize($s) {
		return str_replace("\"", '', $s);
	 }

?>