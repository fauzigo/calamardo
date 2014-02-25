/**
 * 
 * Calamardo javascript general file
 * @author Fauzi Gomez
 * @since 1.0
 * 
 */

/* General var, used on all the project */

var baseParams = new Array();
var tal = new Array(); 

//some paths
var jsonPath = 'jsons/';
var controlerPath = 'controlers/json_update.php';


//some php 
var phpSession; // getPhpSessionId();




// Basic setup for ajax use
$.ajaxSetup({
	global: false,
	type: 'POST',
	timeout: 1000
});



//this is the main Var, it always should be a json containing all the squid conf vars
//var squidConf = '';


//Principal style class
var warnError = 'erno';



//Principal Divs
var warnDiv   = '#warn_chanel';
var logDiv    = '#log_chanel';
var tabDiv    = '#tabs';
var dialogDiv = '#dialog';

//for undo, redo stuff 
var stack = new simpleList();
var actualStack;



/* General vars End */









/** General functions, used on the hole project */
	

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
function initApp(base,link){
	
	//Basic Param
	baseParams['direcBase'] = base;
	baseParams['linkBase']  = link;
	
	//Let's prepend the linkBase
	aclAllPath    = baseParams['linkBase'] + aclAllPath;
	aclParamPath  = baseParams['linkBase'] + aclParamPath;
	aclCartPath   = baseParams['linkBase'] + aclCartPath;
	jsonPath      = baseParams['linkBase'] + jsonPath;
	controlerPath = baseParams['linkBase'] + controlerPath;
	
	initPhpFunctions(base,link);
	//console.log(varis);
	
	//a baseParams copy
	tal = {linkBase: baseParams['linkBase'],direcBase: baseParams['direcBase']};
	
	//Start the Tabs
	activateTabs();
}


/**
 * reun redo undo changes on calamardo
 * 
 * @param Array a unserialized array containing multiple values, and occurrence
 * 
 * @return Array unserialized array with just one occurrence of each value
 * 
 * @author FG
 * @since 1.0
 */
function reun(action){
	
	switch (action){
		case 'undo':
			if (stack.first.equals(actualStack)){
				
			}else if(!actualStack){
				
			}else{
				actualStack = actualStack.prev;
				loadReunAction();
			}
			
			
	}
}


function loadReunAction(){
	
}


/**
 * selectDistincArray clean multiple occurrence of a value
 * 
 * @param Array a unserialized array containing multiple values, and occurrence
 * 
 * @return Array unserialized array with just one occurrence of each value
 * 
 * @author FG
 * @since 1.0
 */
function selectDistincArray(a){
	var unique = a.filter(function(itm,i,a){
	    return i == a.indexOf(itm);
	});
	return unique;
}


/**
 * saveJson Saves Json into File
 * 
 * @param Array vars the vars to post (It must include the JSON) 
 * @param string success text to log after sent
 * 
 * @return void
 * 
 * @author FG
 * @since 1.0
 */
function saveJson(vars,success){
	//console.log(vars);
	
	var tmpNode = new node(vars['json'],vars['t_change'],vars['c_made']);
	
	stack.addLast(tmpNode);
	actualStack = stack.last;
	$.post(controlerPath, vars, function(){
		addLog(success);
	});
}


/**
 * _get access the language helper file for multilanguage porpouse
 * 
 * @param string text pice of text to convert to the user language 
 * 
 * @return string the user language converted text for the UI
 * 
 * @author FG
 * @since 1.0
 */
function _get (text){
	
	var tmpData = new Array;
	tmpData = tal;
	tmpData['text'] = text;
	var output = '';
	
	$.ajax({
        url: tal['linkBase'] + 'languages/helper.php',
        data: tmpData,
        async: false,
        success: function(data){
        	output = data;
        },
        error: function(jqXHR, textStatus, errorThrown){
        	addWarn('There was a Problem: ' + textStatus,'erno');
        },
        fail: function(){
        	addWarn(_('SERVER_PROBLEMS'),'erno');
        }
    });
    return output;
}



/**
 * _ transform system text to user language text
 * 
 * @param string text pice of text to convert to the user language 
 * 
 * @return string the user language converted text for the UI
 * 
 * @author FG
 * @since 1.0
 */
function _(text){
	return _get(text);
}


/**
 * setDiv set div content to given data
 * 
 * @param string div div to set
 * @param string data html with the content 
 * 
 * @return void no return
 * 
 * @author FG
 * @since 1.0
 */
function setDiv(div,data)
{ 
 	$(div).html(data);
}


/**
 * appendToDiv append content to a given div
 * 
 * @param string div div to set
 * @param string data html with the content 
 * 
 * @return void no return
 * 
 * @author FG
 * @since 1.0
 */
function appendToDiv(div,data)
{
	//$(div).clone().add(data).appendTo($(div));
	$(div).add(data).appendTo($(div));
}



/**
 * wait set the wait image
 * 
 * @param string div div to set 
 * 
 * @return void no return
 * 
 * @author FG
 * @since 1.0
 */
function wait(div)
{
 	$(div).html('<img src="images/animated-loading.gif">');
}


/**
 * problems set an error mesage on a div
 * 
 * @param string div div to set 
 * 
 * @return void no return
 * 
 * @author FG
 * @since 1.0
 */
function problems(div)
{
 	$(div).text(_('SERVER_PROBLEMS'));
}


/**
 * anError set an error mesage on a div given the cause
 * 
 * @param string div div to set
 * @param Object obj object asociated to the error
 * @param string cause error's cause
 * @param Object oobj other asociated object
 * 
 * @return void no return
 * 
 * @author FG
 * @since 1.0
 */
function anError(div, obj, cause, oobj){
	$(div).text('There was a Problem: ' + cause);
}


/**
 * jqueryAjax execute an ajax request
 * 
 * @param string cual url to load
 * @param string meto 'POST' or 'GET'
 * @param array  para arguments asociated
 * @param string div  div to put the result content
 * @param string after function to execute on complete 
 * 
 * @return void no return
 * 
 * @author FG
 * @since 1.0
 */
function jqueryAjax(cual,meto,para,div,after){

	
    $.ajax({
        url:cual,
        data:para,
        beforeSend:function(){
        	wait(div);
        },
        success:function(data){
        	setDiv(div,data);
        },
        error:function(obj, cause, oobj){
        	anError(div, obj, cause, oobj);
        },
        fail:function(){
        	problems(div);
        },
        complete:function(){
        	switch (after)
        	{
        		default :
        			eval(after);
        			break;
        	}
        	
        }
    });
    //return false;
}



/**
 * jqueryAjaxFromObj execute an ajax request
 * 
 * @param Object obj object with the params
 * 
 * @return void no return
 * 
 * @author FG
 * @since 1.0
 */
function jqueryAjaxFromObj(obj){
	
    $.ajax({
        url: obj['url'], //urt to load TODO verify url
        data: obj['data'], // must be an array
        beforeSend: function(){
        	wait(obj['div']);
        },
        success: function(data){
        	obj['success'] ? eval(obj['success']) : setDiv(obj['div'],data); 
        	/*if(obj['success'])
        		eval(obj['success']);
        	else
        		setDiv(obj['div'],data);*/
        },
        error: function(jqXHR, textStatus, errorThrown){
        	obj['error'] ? eval(obj['error']) : anError(obj['div'], jqXHR, textStatus, errorThrown);	
        },
        fail: function(){
        	obj['fail'] ? eval(obj['fail']) : problems(obj['div']);
        },
        complete: function(){
        	eval (obj['complete']);
        }
    });
}



/**
 * addLog add some log to the log div, show user's modifications to the Squid Configuration
 * 
 * @param string text text to log
 * 
 * @return voit no return
 * 
 * @author FG
 * @since 1.0
 */
function addLog(text){
	
	var output = new String;
	var now = new Date();
	//now.format('mm/dd/yy');
	dateFormat();
	now = now.format();
	
	//now.setDate(now.getDate());
	output = '<div><span class="log">' + now + ": " + text + '</span></div>';
	
	$(logDiv).append(output) 
		.animate({
	    	scrollTop: $(this).scrollTop() + $(this).height()
	    });
}


/**
 * addWarn add some info to the warn div, Show some errors  and other stuff
 * 
 * @param string text text to warn
 * @param string clase in case warning needs extra decoration
 * 
 * @return voit no return
 * 
 * @author FG
 * @since 1.0
 */
function addWarn(text, clase){
	var output = new String;
	output = '<span class="' + clase + '">' + text + '</span>';
	setDiv(warnDiv,output);
}



function varChanged(viejo,nuevo){
	return (viejo != nuevo);
}


/**
 * activateTabs make the tab interface, jquery-ui stuff 
 * 
 * @param 
 * 
 * @return void
 * 
 * @author FG
 * @since 1.0
 */
function activateTabs(){
	$( tabDiv ).tabs({
		ajaxOptions: {
			error: function( xhr, status, index, anchor ) {
				$( anchor.hash ).html(
					"Couldn't load this tab. We'll try to fix this as soon as possible. " +
					"If this wouldn't be a demo." );
			},
		},
		beforeLoad: function(event,ui){
			wait( tabDiv );
		}
	});
}


/**
 * The function searches over the array by certain field value,
 * and replaces occurences with the parameter provided.
 *
 * @param string field Name of the object field to compare
 * @param string oldvalue Value to compare against
 * @param string newvalue Value to replace mathes with
 * 
 * @return json new json
 * @since 1.0
 * 
 */
function jsonReplaceByValue( field, oldvalue, newvalue, json ) {
    for( var k = 0; k < json[field].length; k++ ) {
        if( oldvalue == json[field][k] ) {
            json[field][k] = newvalue ;
        }
    }
    return json;
}


/**
 * changeJsonKeyValue replace a key on the json, it convert the json into s String so replace will only work on the 
 * 					  first ocurrence
 * 
 * TODO verify ocurrences of a key on the json
 * 
 * @param JSON the Actual Json 
 * @param viejo the value before 
 * @param nuevo the new value
 * 
 * @return JSON 
 * 
 * @author FG
 * @since 1.0
 */
function changeJsonKeyValue(jS,viejo,nuevo){
	
	
	//just in case nuevo comes emty
	if(nuevo == '' || !nuevo || typeof nuevo === 'undefined'){
		// ...
	}else{
		jS = JSON.parse(JSON.stringify(jS).replace(viejo,nuevo));
	}
	
	return jS;
}



/**
 * deleteKeyJSON remove an **** from the JSON
 * 
 * @param JSON jS json to manipulate
 * @param string key to delete 
 * @param string testo text to log on succed
 * 
 * @return void
 * 
 * @author FG
 * @since 1.0
 */
function deleteKeyJSON(jS,key,testo,type,tVal){
	
	//let's check if it exist first
	if(jS[key]){
		 delete jS[key];
	}
	
	tmp = tal;
	tmp['json'] = jS;
	tmp['t_change'] = type;
	tmp['c_made'] = tVal;
	
	saveJson(tmp,testo);
	
}


/** END General functions, used on the hole project */





function dialogBox(title,content){
	
	$( dialogDiv ).load('http://localhost/calamardo/tal.php', function() {
		$(this).dialog({
			title: title,
	        resizable: false,
	        height: 'auto',
	        modal: true
		});
	});	
} 



function dialogBoxBoolean(title,content,t,f){
	
	$( dialogDiv ).html(content).dialog({
		title: title,
        resizable: false,
        height: 'auto',
        modal: true,
        html: content,
        buttons: {
                'Yes': function() {
                	eval(t);
                    $( this ).dialog( 'close' );
                    return true;
                },
                'No': function() {
                	eval(f);
                    $( this ).dialog( 'close' );
                    return false;
                }
        }
	});
	
}
