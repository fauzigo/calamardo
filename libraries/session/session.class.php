<?php 

/**
 * Session Class 
 *
 * @package session
 * @subpackage libraries
 * @since 1.0
 * 
 * @author Fauzi Gomez
 * @email fgomez@apogeesystem.net
 * 
 */
 
 
class sessions {
	
	/**
	 * 
	 * Store the session class
	 * session id
	 * 
	 */
	 
	private static $instace;
	
	
	/**
	 * The session variables
	 * 
	 * @access public
	 * @var array
	 */
	 
	 public $vars = array();
	 
	 
	 /**
	  * 
	  * The session id
	  * 
	  * @access private
	  * @var string
	  */
	  
	  private $session_id = '';
	  
	  /**
	   * Session variable name
	   * you will use this name to propagate session (like PHPSESSID)
	   * 
	   * @access private
	   * @var string
	   */
	   
	   private $sid_name = 'PHPSESSID';

	   
	   /**
		* Overwrite php session function, you can use default php function and array
	 * like $_SESSION, and you do not need to change you actual script
	 *
	 * @access private
	 * @var boolean
	 */
	 
	  private $overwrite = true;
		
		/**
		 * Session_id chars length
		 * The length of the session id
		 *
		 * @access private
		 * @var int
		 */
		private $sid_len = 32;
		
		/**
		 * Session duration in seconds
		 * Session will expires if no reload was made in this period
		 *
		 * @access private
		 * @var int
		 */
		private $session_duration = 99999;
		
		
		/**
	     * Use cookie to propagate session.
	     * If yes you do not need to put the session vars in the URL or POST.
	     *
	     * @access private
	     * @var boolean
	     */
	    private $use_cookie = TRUE;
		
		
		
	/**
     * start    start the class
     *
     *
     * @return void
     *
     * @author  Fauzi Gomez
     * @version 1.0
     */
	function __construct ($time=null) {
		
		if (!is_null($time))
			$this->session_duration = $time;
	
	
		// check if we already done this.
		if (!isset ($instance)) {
			$instance = $this; //new sessions;
		} // end if
		
		// Initilize 
		/*
		if ($instance->initialised == FALSE)
			$instance->initialize();
		 */
		
		return $instance;
		
	} // end function
	
	
	/**
     * initialize    set value TRUE
     *
     *
     * @return void
     *
     * @author  Fauzi Gomez
     * @version 1.0
     */
	function initialize() {
		// Set var so we know we initialised
		$this->initialised = TRUE;
	} // end function
	
	
	
	/**
     * session    start the session
     *
     *
     * @return void
     *
     * @author  Fauzi Gomez
     * @version 1.0
     */
	
	function session () {
		
		$session_name = 'calamardo';
		if(session_name()!= $session_name) {
			session_name($session_name);
		}
		session_start();

/**
		if(isset($_SESSION['session_duration'])){
			// calculate the session's "time to live"
			$sessionTTL = time() - $_SESSION['session_duration'];
			if($sessionTTL > $session_duration){
				$this->drop();
			}
		}*/
		$_SESSION['session_duration'] = time();
    }
	
	
	/**
     * set    set one o several variables in session
     *
     *
     * @return void
     *
     * @author  Fauzi Gomez
     * @version 1.0
     */
	function set($v) {
	
		if(isset($v[0]) && is_array($v[0])){
			foreach($v[0] as $k => $value){ 
				if($this->checkVarSyntax($k)) $this->regVars($k, $value); 
			}
		} else {
			foreach($v as $k => $value){ 
				if($this->checkVarSyntax($k)) $this->regVars($k, $value); 
			}
		}
	}
	
	
	/**
     * set    set one o several variables in session
     *
     *
     * @return boolean 
     *
     * @author  Fauzi Gomez
     * @version 1.0
     */
     
	function checkVarSyntax($buff){ 
		if(preg_match("!^[a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*$!i", $buff)) return true;
		else {
			$this->errors[] = "Variable '<i>" . $buff . "</i>' ignored,<br>wrong syntax";
			return false;
		}
	}
	
	
	/**
     * regVars    register a variable on session
     *
     *
     * @return void 
     *
     * @author  Fauzi Gomez
     * @version 1.0
     */
	function regVars($n, $v){
		$version = phpversion();
		
		//in case php version is too old ex. session_register() or $HTTP_SESSION_VARS["foo"]
		if ($version < '4.3'){
			
		}else{
			$_SESSION[$n] = $v;
		}
	}
	
	 
    /**
     * uSet    destroy a session var
     *
     *
     * @return boolean 
     *
     * @author  Fauzi Gomez
     * @version 1.0
     */
    function uSet($var) {
    	$version = phpversion();
    	//in case php version is too old ex. session_unregister() or $HTTP_SESSION_VARS["foo"]
		if ($version < '4.3'){
			
		}else{
			if (iSet($var))
				unset($_SESSION[$var]); 
		}
    } 

    /**
     * iSet    check if the var exist
     *
     *
     * @return boolean 
     *
     * @author  Fauzi Gomez
     * @version 1.0
     */ 
    function iSet($var) {
    	$version = phpversion();
    	//in case php version is too old ex. session_unregister() or $HTTP_SESSION_VARS["foo"]
		if ($version < '4.3'){
			return(session_is_registered($var));
		}else{
			return isset($_SESSION[$var]);
		} 
     
        
    } 

    /**
     * get    get the session's var value if exist
     *
     *
     * @return boolean 
     *
     * @author  Fauzi Gomez
     * @version 1.0
     */ 
    function get($var) {
    	$output = '';
         
        if ($this->iSet($var)) 
            $output = $_SESSION[$var];
		else
            $output = FALSE;

        return $output;
    }

    /**
     * sessionId    get the session's id value if exist
     *
     *
     * @return string  
     *
     * @author  Fauzi Gomez
     * @version 1.0
     */
    function sessionId(){
		$this->session_id = session_id();
        return $this->session_id;
    }

    // fun, who am i ?
    function me() { 
        return($_SERVER['PHP_SELF']);
    } 

    
	/**
     * drop    destroy the session
     *
     *
     * @return boolean 
     *
     * @author  Fauzi Gomez
     * @version 1.0
     */ 
    function drop() { 
        session_destroy(); 
        $_COOKIE=array(); 
    } 
		



}
 
?>