/**
 * @author Fauzi
 */




/* For RULES use only */
var cuentaTales;

//this var will always be the acl json only
var $rulesConf = '';

//on change values
var actualRule      = '';


//acl divs
var rulesAclDiv   = '#rules-acl';
var rulesRulDiv   = '#rules-rul';
var rulesCarDiv   = '#rules-cart';


//views path for ajax access
var rulesAclPath   = 'views/rules/rules.acl.php';
var rulesRulPath   = 'views/rules/rules.all.php';
var rulesCarPath   = 'views/rules/rules.cart.php';


/* End for RULES use Only */



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
function initRulesManage(){
	
	tmpData = tal;
	tmpData['function'] = 'getSessionID';
	phpSession = getPhpData(tmpData);
	
	
	if ( actualStack ){
		$rulesConf = actualStack;
		console.log($rulesConf);
	}else{
		tmpData['function'] = 'gSessJson';
		tmpData['fv'] = 'rules';
		$rulesConf = jQuery.parseJSON(getPhpData(tmpData));
		
		var toLog = _('JSON_FILE_SUSSECFULL_LOADED') + ': '; //+ path;
	  	addLog(toLog);
	  	delete toLog;
	}
	
	
	path = jsonPath + 'rules_conf.' + phpSession + '.json';
	$.getJSON( path, function(data) {
		var toLog = _('JSON_FILE_SUSSECFULL_LOADED') + ': '+ path;
		addLog(toLog);
		delete toLog;
	});
	
	loadAclRulesView();
	

	cartHeight1 = $(window).height() - ((2.6 * $('#console').height()) + (1.5 * $('#rules-rul').height()));
    $('#rules-cart').height(cartHeight1);
    
    delete cartHeight1;
	//loadRulesView();
	//delete path;
	//delete phpSession;
	delete tmpData;
}


/**
 * loadRulesView loads all the Rules availables for add new ones the squid conf
 * 
 * @param 
 * 
 * @return void
 * 
 * @author FG
 * @since 1.0
 */
function loadRulesView () {
	
	tmpObj1 = new Object();
	
	tmpObj1['div']      = rulesRulDiv;
	tmpObj1['url']      = rulesRulPath;
	tmpObj1['data']     = tal;
	//tmpObj['complete'] = 'activateDraggable();setAclRulesClass()'; //loadRulesCart();
	
	//Load all the rules for adding new rules
	jqueryAjaxFromObj(tmpObj1);
  
}


/**
 * loadCartView loads all the Rules availables and it conf
 * 
 * @param 
 * 
 * @return void
 * 
 * @author FG
 * @since 1.0
 */
function loadCartView () {
    
    tmpObj = new Object();
    
    tmpObj['div']      = rulesCarDiv;
    tmpObj['url']      = rulesCarPath;
    tmpObj['data']     = tal;
    //tmpObj['complete'] = 'activateDraggable();setAclRulesClass()'; //loadRulesCart();
    
    //Load all the rules for adding new rules
    jqueryAjaxFromObj(tmpObj);
    
    console.log('tal');  
}


/**
 * loadAclRulesView loads all the ACL availables for add new acls to the squid conf
 * 
 * @param 
 * 
 * @return void
 * 
 * @author FG
 * @since 1.0
 */
function loadAclRulesView () {
	
	tmpObj = new Object();
	
	tmpObj['div']      = rulesAclDiv;
	tmpObj['url']      = rulesAclPath;
	tmpObj['data']     = tal;
	tmpObj['complete'] = 'activateAclDrag();setAclRulesClass();loadRulesView();loadCartView()'; //loadRulesCart();
	
	//Load all the rules for adding new rules
	jqueryAjaxFromObj(tmpObj);
  
}

function setAclRulesClass(){
	$ ('#catalog li:even').addClass ('even');
    $ ('#catalog li:odd').addClass ('odd');
}




/**
 * activateAclDrag allows the Acl to be dragable
 * 
 * @param 
 * 
 * @return void
 * 
 * @author FG
 * @since 1.0
 */
function activateAclDrag(){
	
	//start the all Acl menu
	$( '#rules-acl > #products > #catalog' ).accordion({
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
}


/**
 * activateRulDrag allows the Rules to be dragable
 * 
 * @param 
 * 
 * @return void
 * 
 * @author FG
 * @since 1.0
 */
function activateRulDrag(){
	//make the all Acl draggable
	$( '#list-rules li' ).draggable({
		revert: 'invalid',
		cursor: 'move',
		//connectToSortable: "#cart ol",
		appendTo: 'body',
		helper: 'clone'
	});
	
	//console.log('tt');
}

/**
 * activateDropable allows the rules to be dropable
 * 
 * @param 
 * 
 * @return void
 * 
 * @author FG
 * @since 1.0
 */
function activateDropable(){



	
	//make the cart dropable and sortable
	
	$( '#cart ol' ).droppable({
		activeClass: 'ui-state-default',
		hoverClass: 'ui-state-hover',
		accept: '.da-rulaz',
		cursor: 'move',
		drop: function( event, ui ) {
			
			//transform the acl given
			itemDropedOnRulesCart(ui.draggable.text());
			
			//scroll down where it droped
			$('#rules-cart').animate({
		    	scrollTop: $(this).scrollTop() + $(this).height()
		    });
		    
		    //set focus on it
		    $( '#rules-cart li' ).last().find( 'input' ).focus().click();

		}
	}).sortable({
		items: 'li:not(.placeholder)',
		sort: function() {
			// gets added unintentionally by droppable interacting with sortable
			// using connectWithSortable fixes this, but doesn't allow you to customize active/hoverClass options
			$( this ).removeClass( 'ui-state-default' );
			
		}
	});
	
	
	
	$( '#acl-list' ).droppable({
        activeClass: 'ui-state-default',
        hoverClass: 'ui-state-hover',
        accept: '.da-aclz',
        cursor: 'move',
        drop: function( event, ui ) {
            
            //transform the acl given
            itemDropedOnRulesCartAcl(ui.draggable.text());

            //set focus on it
            $( '#rules-cart li' ).last().find( 'input' ).focus().click();

        }
    });
    

}


/**
 * itemDropedOnRulesCart create all the html tag from a given rule name and drop it on the cart
 * 
 * @param string name acl type 
 * @param string val the value in case it have
 * 
 * @return void
 * 
 * @author FG
 * @since 1.0
 */
function itemDropedOnRulesCart(rule){
    
    $( '#cart ol' ).find( '.placeholder' ).remove();
    
    $cosa = $( '<li>' + createRuleRow(rule) + '</li>' );
    
    //set events 
    setEventsToAcl($cosa);
    
    $cosa.appendTo( $( '#cart ol' ) );
    
    //actualizaCountAcl(acl);
    
}


/**
 * itemDropedOnRulesCart create all the html tag from a given rule name and drop it on the cart
 * 
 * @param string name acl type 
 * @param string val the value in case it have
 * 
 * @return void
 * 
 * @author FG
 * @since 1.0
 */
function itemDropedOnRulesCartAcl(acl){
    

    $cosa = $( '<span class="acl-item">' + acl + '</span>' );
    
    //set events 
    setEventsToAcl($cosa);
    
    $cosa.appendTo( $( '#cart ol' ) );
    
    //actualizaCountAcl(acl);
    
}





/**
 * createRuleRow create the full input and its icons to show futher
 * 
 * @param string acl the ACL 
 * 
 * @return string the html corresponding 
 * 
 * @author FG
 * @since 1.0
 */
function createRuleRow(rule){
    return '<table width="100%"><tr>' +
            '<td width="100px"><input class="acl-name" type="hidden" id="' +  rule  + '" name="' +  rule  + '"> <span class="rule-type">' +  rule  + '<span></td>' +
            '<td width="100px"><span class="rule-perm-allow">allow</span></td>' +
            '<td ><div id="acl-list">&nbsp;</div></td>' +
            '<td width="16px"><a class="rule_actions ui-icon ui-icon-document" title="Edit" href="#"></a></td>' +
            '<td width="16px"><a class="rule_actions ui-icon ui-icon-cancel" title="Delete" href="#"></a></td>' +
            '</tr></table>';
}


/**
 * setEventsToRule set the events to to a rule
 * 
 * @param Object item object to aply the events
 * 
 * @return void
 * 
 * @author FG
 * @since 1.0
 */
function setEventsToRule(item){
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

