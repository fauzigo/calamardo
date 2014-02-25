<?php


/**
 * Funciones cargar ciertas funciones que utilizara el sistema
 *
 * @package		calamardo.Framework
 * @since		1.0
 */

class functions
{
    public static $config = null;
    public static $language = null;
	public static $squid_conf_path = null;
	public static $squid_conf = null;
    
	/**
	 * Get a Squid Configuration Object
	 * 
	 * @access public
	 * @param string	The path to the configuration file
	 * 
	 * @return object squidConf 
	 */
	 public static function &getSquidConf($file = null){
	 	static $instance;
		if (!self::$squid_conf)
		{
			if ($file === null) {
                $file = THECLASS.DS.'squid.class.php';
			}
			self::$squid_conf = $instance = functions::_buildSquidConfig($file);
		}
		return $instance;
	 }
	 
	 /**
	 * Build the confiiguration from the given file
	 * 
	 * @access Private
	 * @param String $file file to be loaded
	 * @return config Object from the config file 
	 */
    protected static function &_buildSquidConfig($file)
    {
        require_once $file;
        
        $datosConfiguracion = new squidConf;
        
        return $datosConfiguracion;
    }
	
	
    /**
	 * Get a configuration object
	 *
	 * Returns a reference to the global object, only creating it
	 * if it doesn't already exist.
	 *
	 * @access public
	 * @param string	The path to the configuration file
	 * @param string	The type of the configuration file
	 * @return object Configuracion
	 */
	public static function &getConfig($file = null, $type = 'PHP')
	{
		static $instance;


		if (!self::$config)
		{
			if ($file === null) {
                $file = DIREC_BASE.DS.'config.php';
			}

			self::$config = $instance = functions::_buildConfig($file, $type);
		}

		return $instance;
	}
        
    /**
	 * Build the confiiguration from the given file
	 * 
	 * @access Private
	 * @param String $file file to be loaded
	 * @param string type if it is php or ini 
	 * @return config Object from the config file 
	 */
    protected static function &_buildConfig($file,$type)
    {
        require_once $file;
        
        $datosConfiguracion = new config;
        
        return $datosConfiguracion;
    }
        
        
        /**
         * Funcion que combierte un objeto en un arreglo
         *
         * @access Public
         * @param Object    To be converted
         * @return array Configuration
         */ 
        public static function toArray($configuracion){
            
            $arreglo = array();
            
            if (is_object($configuracion)){
                $arreglo = get_object_vars($configuracion);
            }else{
            	//TODO 
                /**
                 *Colocar una funcion para el manejo de errores
                 */
            }
            
            return is_array($arreglo) ? $arreglo : $arreglo;
        }
	
	
     	
	
	/**
     * Create a language object
     *
     * @return language object
     * @since   1.0
     *
     * @see language
     */
    protected static function _buildLanguage()
    {
		require_once(LANGUAGE.DS.'language.class.php');
        $conf   = self::getConfig();
		$locale = $conf->lang;
        $lang   = language::getInstance($locale);

        return $lang;
    }
	
	
	/**
     * obtain the language object
     *
     * Returns the global {@link language} object, only creating it
     * if it doesn't already exist.
     *
     * @return language object
     * @since   1.0
     *
     * @see language
     */
    public static function getLanguage()
    {
            if (!self::$language) {
                    self::$language = self::_buildLanguage();
			}

            return self::$language;
    }
	
	/**
	 * init initialize everything needed
	 * 
	 * @return void
	 * @since	1.0
	 * 
	 * @author Fauzi Gomez
	 * 
	 * 
	 */
	 public static function init(){
		
		$session_vars = array();
		
		$session_vars['DIREC_BASE'] = DIREC_BASE;
		$session_vars['LINK_BASE'] = LINK_BASE;
		
		$config = functions::getConfig();
		
		$language = $config->lang;
		$session_vars['lang'] = $language;
		
		$squid_conf_path = $config->squid_conf;
		$session_vars['squid_conf_path'] = $squid_conf_path;
		
		self::getSquidConf();
		self::$squid_conf->getConfig($squid_conf_path);
		//print_r(self::$squid_conf->getAcls());
		
		$session_vars['squid_conf_acl']     = json_encode(self::$squid_conf->getAcls());
		$session_vars['squid_conf_rules']   = json_encode(self::$squid_conf->getRules());
		$session_vars['squid_conf_options'] = json_encode(self::$squid_conf->getOptions());
		$session_vars['title'] = $config->sitename;
		
		
		//start the session
		self::initSess();
		
		$session_vars['sess_id'] = self::sessId();
		
		
		//echo JSONS.DS.'acl_conf.'.self::sessId().'.json'; //,$session_vars['squid_conf_acl'];
		
		//set the acls to his respective file
		
		try  
		{  
		   //self::setJson(JSONS.DS.'acl_conf.'.self::sessId().'.json',$session_vars['squid_conf_acl']);
		   file_put_contents(JSONS.DS.'acl_conf.'.self::sessId().'.json',$session_vars['squid_conf_acl']);
		   file_put_contents(JSONS.DS.'rules_conf.'.self::sessId().'.json',$session_vars['squid_conf_rules']);
		}  
		catch (Exception $e)  
		{
			$session_vars['error'] = self::sessId(text::_('SOMETHING_WENT_WRONG').': '.$e);
			throw new Exception( text::_('SOMETHING_WENT_WRONG'), 0, $e);  
		}
		
		
		/**
		if(self::setJson(JSONS.DS.'acl_conf.'.self::sessId().'.json',$session_vars['squid_conf_acl'])){
			//echo 'Bien';
		}else{
			paratal('malooo');
			$session_vars['error'] = self::sessId();
		}
		 */ 
		
		
		self::sSess($session_vars);
		
		
	}
	 
	 
	/**
	 * setJson set JSON file given the content (no necesarlly only for json)
	 * 
	 * @param string $path path to file
	 * @param json $content the json desired content
	 * 
	 * @return boolean true on success, false on fail
	 * @since	1.0
	 * 
	 * @author Fauzi Gomez
	 * 
	 * 
	 */
	 public static function setJson($path,$content){
	 	return file_put_contents($path,$content);
	 }
	 
	 
	 /**
	 * init initialize everything needed
	 * 
	 * @param boolean intoArray, tells the funtion if return an array
	 * @return array Acl from config file
	 * @since	1.0
	 * 
	 * @author Fauzi Gomez
	 * 
	 * 
	 */
	 public static function getAclLoaded($intoArray=TRUE){
	 	$acls = json_decode(self::gSess('squid_conf_acl'),$intoArray);
	 	return $acls;
	 }
	 
	 
	 /**
	 * getRulesLoaded return the rules in the session
	 * 
	 * @param boolean intoArray, tells the funtion if return an array or an object
	 * 
	 * @return array Acl from config file
	 * @since	1.0
	 * 
	 * @author Fauzi Gomez
	 * 
	 * 
	 */
	 public static function getRulesLoaded(){
	 	$rules = json_decode(self::gSess('squid_conf_rules'),FALSE);
	 	return $rules;
	 }
	 
	 
	 /**
	  * initSess initialize session for use
	  * 
	  * @return void 
	  * @since 1.0
	  * 
	  * @author Fauzi Gomez
	  */
	  
	  public static function initSess(){
	  	$sessi = new sessions;
		$sessi->session();
	  }
	  
	  /**
	  * sessId Get the session ID
	  * 
	  * @return string The session ID 
	  * @since 1.0
	  * 
	  * @author Fauzi Gomez
	  */
	  
	  public static function sessId(){
	  	$sessi = new sessions;
		return $sessi->sessionId();
	  }
	  
	  
	 /**
	  * gSess get session vars
	  * 
	  * @param string the var name
	  * 
	  * @return the var value
	  * 
	  * @since 1.0
	  * @author Fauzi 
	  * 
	  * 
	  */
	  public static function gSess($var){
	  	$sessi = new sessions;
		return $sessi->get($var);
	  }
	
	
	 
	 /**
	  * setSess set session vars
	  */
	  public static function sSess($var){
	  	$sessi = new sessions;
		$sessi->set($var);
	  }
	
}