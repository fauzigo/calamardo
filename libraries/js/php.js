


var varis = new Object();
//var v = new Array();

/**
 * initApp initialize JS vars and the interface
 * 
 * @param string text pice of text to convert to the user language 
 * 
 * @return string the user language converted text for the UI
 * 
 * @author FG
 * @since 1.0
 */
function initPhpFunctions(base,link){
	
	//Basic Param
	varis['direcBase'] = base;
	varis['linkBase']  = link;
	
	//a baseParams copy
	//v = {linkBase: t['linkBase'],direcBase: t['direcBase']};
	
}




/**
 * getPhpData access the php helper fileto get some data over php
 * 
 * @param Array vars to send including the function to call 
 * 
 * @return string the returned value 
 * 
 * @author FG
 * @since 1.0
 */
function getPhpData (vars){

	var output = '';
	
	//console.log(vars);
	//console.log(vars.linkBase);
	
	$.ajax({
        url: vars['linkBase'] + 'libraries/javascript.helper.php',
        data: vars,
        async: false,
        success: function(data){
        	output = data;
        },
        error: function(jqXHR, textStatus, errorThrown){
        	addWarn('There was a Problem: ' + textStatus,'erno');
        },
        fail: function(){
        	addWarn(_('SERVER_PROBLEMS'),'erno');
        },
        complete: function(){
        	//return output;
        }
    });
    return output;
}



/**
 * getPhpSessionId get the session_id()
 * 
 * @param 
 * 
 * @return string the user language converted text for the UI
 * 
 * @author FG
 * @since 1.0
 */
function getPhpSessionId(){
	var tmpoData = new Object();
	tmpoData = varis;
	
	//
	
	tmpoData['function'] = 'getSessionID';
	//console.log(tmpoData);
	
	return getPhpData(tmpoData);
	//return output;
}






/**
 * getPhpFunction callback a PHP function
 * 
 * @param array variable, function=> '' and fv=>''
 * 
 * @return mixed the PHP function return
 * 
 * @author FG
 * @since 1.0
 */
function getPhpFunction(variable){
	var tmpData = new Object();
	tmpData = varis;
	
	//
	
	tmpData['function'] = variable['function'];
	//tmpData['fv'] = variable['fv'];
	//console.log(tmpoData);
	
	return getPhpData(tmpData);
	//return output;
}