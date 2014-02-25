/**
 * @author Fauzi
 */




/* For ACL use only */
var cuentaTales;

//this var will always be the acl json only
var $aclConf = '';

//on change values
var actualAcl      = '';
var actualAclParam = '';


//acl divs
var aclAllDiv   = '#acl-all';
var aclCartDiv  = '#acl-cart';
var aclParamDiv = '#acl-param'; 


//views path for ajax access
var aclAllPath   = 'views/acl/acl.all.php';
var aclParamPath = 'views/acl/acl.params.php';
var aclCartPath  = 'views/acl/acl.cart.php';




/* End for ACL use Only */



/**
 * initAclManage initialize the interface, basiclly it set the primary vars, then call the rest of the function
 * 
 * @param json s_conf the squid config gotten from the config file on the config.php file 
 * 
 * @return void
 * 
 * @author FG
 * @since 1.0
 */
function initAclManage(){
	
	tmpData = tal;
	tmpData['function'] = 'getSessionID';
	phpSession = getPhpData(tmpData);
	
	
	if ( actualStack ){
		$aclConf = actualStack;
		console.log($aclConf);
	}else{
		tmpData['function'] = 'gSessJson';
		tmpData['fv'] = 'acl';
		$aclConf = jQuery.parseJSON(getPhpData(tmpData));
		
		var toLog = _('JSON_FILE_SUSSECFULL_LOADED') + ': '; //+ path;
	  	addLog(toLog);
	}
	
	
	path = jsonPath + 'acl_conf.' + phpSession + '.json';
	$.getJSON( path, function(data) {
		var toLog = _('JSON_FILE_SUSSECFULL_LOADED') + ': '+ path;
		addLog(toLog);
	});
	
	loadAllAclView();
	delete tmpData;
}


/**
 * loadAllAclView loads all the ACL availables for add new acls to the squid conf
 * 
 * @param 
 * 
 * @return void
 * 
 * @author FG
 * @since 1.0
 */
function loadAllAclView () {
	
	var tmpObj = new Object();
	
	tmpObj['div']      = aclAllDiv;
	tmpObj['url']      = aclAllPath;
	tmpObj['data']     = tal;
	tmpObj['complete'] = 'loadAclCart();setAllAclsClass()';
	
	//Load all the acls for adding new acls
	jqueryAjaxFromObj(tmpObj);
  
}


function setAllAclsClass(){
	$ ('#catalog li:even').addClass ('even');
    $ ('#catalog li:odd').addClass ('odd');
}


/**
 * loadAclCart loads the acl from the configuration file from config.php for 
 * 				editing, it initialize the cart alse, making it droppable 
 * 
 * @param 
 * 
 * @return void
 * 
 * @author FG
 * @since 1.0
 */
function loadAclCart(){
	
	//load the cart that contains the actual acl and the container for new acls
	var tmpObj = new Object();
	
	tmpObj['div']      = aclCartDiv;
	tmpObj['url']      = aclCartPath;
	tmpObj['data']     = tal;
	tmpObj['complete'] = 'completeCartConfig();activateAclManager();';
	
	jqueryAjaxFromObj(tmpObj);
	
	delete tmpObj;
	
}



/**
 * completeCartConfig when the cart is first show, no action are asigned to the 
 * 				      components, they are set here
 * 
 * @param 
 * 
 * @return void
 * 
 * @author FG
 * @since 1.0
 */
function completeCartConfig(){
	var spans = new Array(); 
	
	$('#cart li').each(function(){
		spans.push( $( this ).find('span').text() );	
	});
	
	spans = selectDistincArray(spans);
	
	$.each(spans,function(index,value){
		actualizaCountAcl(value);
	});
	
	$('#cart li').each(function(){
		//set events 
		setEventsToAcl($ ( this ) );
		
	});
}



/**
 * setEventsToAcl set the events to to an acl
 * 
 * @param Object tal object to aply the events
 * 
 * @return void
 * 
 * @author FG
 * @since 1.0
 */
function setEventsToAcl(item){
	$( item ).bind({
			focusout: function(event) {
				aclFocusLostHandler($( item ),$( event.target ),$( item ).find('input').attr('name'));
			},
			focus: function(event) {
				aclButtonHandler($( item ),$( event.target ),$( item ).find('input').attr('name'));
			},
			click: function(event) {
				aclButtonHandler($( item ),$( event.target ),$( item ).find('input').attr('name'));
			}
		});
}




/**
 * deleteAclFromCart remove an ACL from the cart
 * 
 * @param Object $item html object to be removed (usuallyu a li ) 
 * 
 * @return void
 * 
 * @author FG
 * @since 1.0
 */
function deleteAclFromCart(item){
	
	item.fadeOut(function() {
		
		//remove from cart
		item.remove();
		 
    	showAclParams( 'none' );
    });
}


/**
 * deleteAclFromJSON remove an ACL from the JSON
 * 
 * @param Object $item html object to be removed (usuallyu a li ) 
 * 
 * @return void
 * 
 * @author FG
 * @since 1.0
 */
function deleteAclFromJSON($item){
	
	var acl = cleanAcl($item.find( 'input' ).attr('name'));
	var nam = $item.find( 'input' ).attr('value') ? $item.find( 'input' ).attr('value') : _('EMPTY_ACL');
	
	
	var testo = _('ACL_DELETED');
	testo = testo.replace('s1',acl);
	testo = testo.replace('s2','<span class="out">' + nam + '</span>');
	
	deleteKeyJSON($aclConf,nam,testo,'acl',acl);
		
}


/**
 * deleteAcl show the dialog box for deleting confirmation, on "Yes" the acl will be removed
 * 
 * @param Object $item html object to be removed (usuallyu a li ) 
 * 
 * @return void
 * 
 * @author FG
 * @since 1.0
 */
function deleteAcl( $item ) {
	
	//let's verify we are dealing with the input
	//cleanAcl();
	//acl = $item.find( "input" ).attr('name');
    var acl = cleanAcl($item.find( 'input' ).attr('name'));
    //acl.substr(0, acl.indexOf('-'));
	
	//create the message
	var title = _('ALERT'); //'Alert';
	var content = _('ARE_Y_S_Y_W_T_D_T_ACL') +
					'</br></br>'+_('TYPE') + ': ' + acl +
					'</br>' +_('VALUE') + ': ' + $item.find( 'input' ).attr('value');
	
	//show dialog
	$( dialogDiv ).html(content).dialog({
		title: title,
        resizable: false,
        height: 'auto',
        modal: true,
        html: content,
        buttons: {
                'Yes': function() {
                    deleteAclFromCart($item);
                    deleteAclFromJSON($item);
                    //console.log(acl);
                    actualizaCountAcl(acl);
                    $( this ).dialog( 'close' );
                },
                'No': function() {
                    $( this ).dialog( 'close' );
                }
        }
	});
	//actualizaCountAcl();
}


function cleanAcl(acl){
	return acl.substr(0, acl.indexOf('-'));
}


/**
 * showAclParams show the params corresponding to a given ACL 
 * 
 * @param string acl the acl 
 * @param Object item the input containing the name of the acl
 * 
 * @return void
 * 
 * @author FG
 * @since 1.0
 */
function showAclParams(acl,item){
	
	actualAcl = item ?  item.val() : 'none';

	tmpData = new Array;
	tmpData = tal;
	tmpData['acl'] = cleanAcl(acl);
	tmpData['acl_from'] = acl;
	tmpData['acl_name'] = $( item ).val();
	//path = aclParamPath;
	
	var tmpObj = new Object();
	
	tmpObj['div'] = aclParamDiv;
	tmpObj['url'] = aclParamPath;
	tmpObj['data'] = tmpData;
	tmpObj['complete'] = 'aclParamsEvents();';
	
	jqueryAjaxFromObj(tmpObj);
	
	delete tmpData;
	delete tmpObj;
	
	
	addWarn(acl,'');
}


function aclParamsEvents(){
	
	$( aclParamDiv + ' input[type="text"]').each(function(){
		$( this ).bind({
			focusout: function(event) {
				aclParamFocusLostHandler($( this ),$( event.target ),$( this ).find('input').attr('name'));
			},
			focus: function(event) {
				actualAclParam = $( this ).val();
				//aclParamHandler($( tal ),$( event.target ),$( tal ).find('input').attr('name'));
			},
			click: function(event) {
				actualAclParam = $( this ).val();
				//aclParamHandler($( tal ),$( event.target ),$( tal ).find('input').attr('name'));
			}
		});
		
	});
}



/**
 * aclParamFocusLostHandler ACL's input and icon behavior
 * 
 * @param Object item the object clicked 
 * @param Object theEvent the especific object clicket
 * 
 * @return void
 * 
 * @author FG
 * @since 1.0
 */
function aclParamFocusLostHandler(item){
	
	if (!$( item ).val() ){
		testo = _('ACL_PARAM_CANT_BE_BLANK');
		emptyAclHandler($( item ),testo);
		$( item ).focus();
	}
	else{
		if (varChanged(actualAclParam, $ ( item ).val())){
			changedAclParamHandler($( item ));
		}
		addWarn('','');
	}
}



function changedAclParamHandler(item){
	
    var tmp = new Array;
    var testo = '';
    var $from = $( aclParamDiv + ' input[id=from]' );
    
    if(actualAclParam == '' || !actualAclParam || typeof actualAclParam === 'undefined'){
    	testo = _('NEW_ACL_PARAM_ADDED');
    	testo = testo.replace('s1', $from.val());
		testo = testo.replace('s2','<span class="in">' + $(item).val() + '</span>');
		
		$cosa = $aclConf[$from.val()];
		$cosa.push($(item).val());
		$aclConf[$from.val()] = $cosa;
		
	}else{
		testo = _('ACL_PARAM_HAS_CHANGED');
		testo = testo.replace('s1', $from.val());
		testo = testo.replace('s2','<span class="out">' + actualAclParam + '</span>');
		testo = testo.replace('s3','<span class="in">' + $(item).val() + '</span>');
		$aclConf = jsonReplaceByValue($from.val(),actualAclParam,$(item).val(),$aclConf);
	}
    
	tmp = tal;
	tmp['json'] = $aclConf;
	tmp['t_change'] = 'acl';
	tmp['c_made'] = $from.val();
	
	saveJson(tmp,testo);
	
}






/**
 * createAclInput create the full input and its icons to show futher
 * 
 * @param string acl the ACL 
 * 
 * @return string the html corresponding 
 * 
 * @author FG
 * @since 1.0
 */
function createAclInput(acl){
	return '<table width="100%"><tr>' +
			'<td ><input class="acl-name" type="text" id="' +  acl  + '" name="' +  acl  + '"> <span class="acl-label">( ' +  acl  + ' )<span></td>' +
			'<td width="16px"><a class="acl_actions ui-icon ui-icon-document" title="Edit" href="#"></a></td>' +
			'<td width="16px"><a class="acl_actions ui-icon ui-icon-cancel" title="Delete" href="#"></a></td>' +
			'</tr></table>';
}



/**
 * aclButtonHandler ACL's input and icon behavior
 * 
 * @param Object item the object clicked 
 * @param Object theEvent the especific object clicket
 * 
 * @return void
 * 
 * @author FG
 * @since 1.0
 */
function aclButtonHandler(item,theEvent,acl){		
		
	if ( theEvent.is( 'a.ui-icon-cancel' ) ) {
        deleteAcl( item );
    } else if ( theEvent.is( 'input' ) ) {
        showAclParams( acl,theEvent );
    } else if ( theEvent.is( 'a.ui-icon-document' ) ) {
        showAclParams( acl,item.find('input') );
    }
    
}



/**
 * emptyAclHandler verify if a acl input is empty
 * 
 * @param Object item the object clicked 
 * @param Object tEvent the especific object clicket
 * 
 * @return boolean true if it's emty, false otherwise
 * 
 * @author FG
 * @since 1.0
 */
function emptyAclHandler(item,warn){
        
    
	addWarn(warn,warnError);
	item.effect('shake', { times:3 }, 100);
	item.find('input').focus();
	//theEvent.focus();
}





/**
 * changedAclHandler verify if an ACL chaged value on lost focus (The input)
 * 
 * @param Object theEvent the specific object clicked 
 * @param string acl the acl manipulated
 * 
 * @return void
 * 
 * @author FG
 * @since 1.0
 */
function changedAclHandler(theEvent,acl){

    var $target = theEvent;
    var tmp = new Array;
    var testo = '';
    
    if(actualAcl == '' || !actualAcl || typeof actualAcl === 'undefined'){
    	testo = _('NEW_ACL_ADDED');
    	testo = testo.replace('s1',cleanAcl(acl));
		testo = testo.replace('s2','<span class="in">' + $target.val() + '</span>');
		
		$aclConf[$target.val()] = new Array(cleanAcl(acl));
	}else{
		testo = _('ACL_HAS_CHANGED');
		testo = testo.replace('s1',acl);
		testo = testo.replace('s2','<span class="out">' + actualAcl + '</span>');
		testo = testo.replace('s3','<span class="in">' + $target.val() + '</span>');
		
		console.log($aclConf);
		$aclConf = changeJsonKeyValue($aclConf,actualAcl,$target.val());
	}
	
	$( aclParamDiv + ' input[name=from]').val($target.val());
    
	tmp = tal;
	tmp['json'] = $aclConf;
	tmp['t_change'] = 'acl';
	tmp['c_made'] = acl;
	
	saveJson(tmp,testo);
	delete tmp;
}




function aclFocusLostHandler(theItem,theEvent,acl){
	
	switch (theEvent.get(0).tagName) {
		case 'INPUT' :
			if (!theEvent.val() ){
				testo = _('ACL_CANT_BE_BLANK');
				emptyAclHandler(theItem,testo);
				theEvent.focus();
			}
			else{
				if (varChanged(actualAcl,theEvent.val())){
					changedAclHandler(theEvent,acl);
				}
				addWarn('','');
			}
			break;
	}
}



/**
 * activateAclManager start de acordion menu and the cart
 * 
 * 
 * @return void
 * 
 * @author FG
 * @since 1.0
 */
function activateAclManager(){
	
	//start the all Acl menu
	$( '#catalog' ).accordion({
		event: 'mouseover'
	});
	
	//make the all Acl draggable
	$( '#catalog li' ).draggable({
		revert: 'invalid',
		cursor: 'move',
		//connectToSortable: "#cart ol",
		appendTo: 'body',
		helper: 'clone'
	});
	
	//make the cart dropable and sortable
	$( '#cart ol' ).droppable({
		activeClass: 'ui-state-default',
		hoverClass: 'ui-state-hover',
		accept: ':not(.ui-sortable-helper)',
		cursor: 'move',
		drop: function( event, ui ) {
			
			//transform the acl given
			itemDropedOnCart(ui.draggable.text());
			
			//scroll down where it droped
			$('#acl-cart').animate({
		    	scrollTop: $(this).scrollTop() + $(this).height()
		    });
		    
		    //set focus on it
		    $( '#acl-cart li' ).last().find( 'input' ).focus().click();

		}
	}).sortable({
		items: 'li:not(.placeholder)',
		sort: function() {
			// gets added unintentionally by droppable interacting with sortable
			// using connectWithSortable fixes this, but doesn't allow you to customize active/hoverClass options
			$( this ).removeClass( 'ui-state-default' );
			
		}
	});
 
	//Set the height 
	cartHeight = $(window).height() - (2.6 * $('#console').height());
	$('#acl-cart').height(cartHeight);
	
	
}


/**
 * itemDropedOnCart create all the html tag from a given acl name and drop it on the cart
 * 
 * @param string name acl type 
 * @param string val the value in case it have
 * 
 * @return void
 * 
 * @author FG
 * @since 1.0
 */
function itemDropedOnCart(acl){
	
	$( '#cart ol' ).find( '.placeholder' ).remove();
	
	var new_acl  = new String,
	    	    
	n       = countAcl(acl) + 1;
	new_acl = acl + '-' + n;

	$cosa = $( '<li>' + createAclInput(new_acl) + '</li>' );
	

	//set events 
	setEventsToAcl($cosa);
	
	$cosa.appendTo( $( '#cart ol' ) );
	
	actualizaCountAcl(acl);
	
}


function actualizaCuentaTales(tales){
	cuentaTales = $('#cart input[name^="'+ tales +'"]').length;
}


function countAcl(acl){
	return $('#cart input[name^="'+ acl +'"]').length;
}



function actualizaCountAcl(acl){
	
	var count = 1;
	$('#cart input[name^=' + acl + ']').each(function(){
		$( this ).attr('name', acl + '-' + count);
		$( this ).attr('id', acl + '-' + count);
		count++;
	});
	
	count = 1;
	$('#cart span:contains(' + acl + ')').each(function(){
		$( this ).html('( ' + acl + ' - ' + count + ' )');
		count++;
	});
	
}