/**
 * @author  Ikaros Kappler
 * @date    2018-07-06
 * @version 1.0.2
 **/

window.PASTEBEE_VERSION = '1.0.2';

(function() {
    'use strict';

    // +---------------------------------------------------------------
    // | Mobile and tablet list from
    // |   http://detectmobilebrowsers.com/
    // +-----------------------------------------------------
    window.mobileAndTabletcheck = function()
    {
	var check = false;
	(function(a){if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino|android|ipad|playbook|silk/i.test(a)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0,4))) check = true;})(navigator.userAgent||navigator.vendor||window.opera);
	return check;
    };
    
    // +---------------------------------------------------------------
    // | Add a class to the given element.
    // |
    // | @param HTMLElement The DOM element to add the class to.
    // | @param string      The class's name.
    // +-----------------------------------------------------
    function addClass(element,name)
    {
	var arr;
	arr = element.className.split(" ");
	if( arr.indexOf(name) == -1 ) {
            element.className += " " + name;
	}
    }

    // +---------------------------------------------------------------
    // | Remove a class from the given element.
    // |
    // | @param HTMLElement The DOM element to remove the class from.
    // | @param string      The class's name.
    // +-----------------------------------------------------
    function removeClass(element,name)
    {
	var arr;
	arr = element.className.split(" ");
	var pos;
	if( (pos = arr.indexOf(name)) != -1 ) {
	    arr.splice(pos,1);
            element.className = arr.join(' ');
	}
    }

    // +---------------------------------------------------------------
    // | Toggle a class on/off in the given element.
    // |
    // | @param HTMLElement The DOM element to remove the class from.
    // | @param string      The class's name.
    // +-----------------------------------------------------
    function toggleClass(element,name)
    {
	var arr;
	arr = element.className.split(" ");
	var pos;
	if( (pos = arr.indexOf(name)) != -1 ) {
	    arr.splice(pos,1);
            element.className = arr.join(' ');
	    return false;
	} else {
	    element.className += " " + name;
	    return true;
	}
    }

    // +---------------------------------------------------------------
    // | Get the current paste's hash (from the document metadata).
    // | 
    // | If currently no paste is loaded the function returns null.
    // |
    // | @return string (The hash of the current paste).
    // +-----------------------------------------------------
    function getPasteHash() {
	var meta = document.querySelector("meta[name='paste:hash']");
	return meta ? meta.getAttribute("content") : null;
    };

    // +---------------------------------------------------------------
    // | Get the current paste's hash (from the document metadata).
    // | 
    // | If currently no paste is loaded the function returns null.
    // |
    // | @return string (The hash of the current paste).
    // +-----------------------------------------------------
    function getParentHash() {
	var meta = document.querySelector("meta[name='paste:parent_hash']");
	return meta ? meta.getAttribute("content") : null;
    };

    // +---------------------------------------------------------------
    // | Get the URI GET params as an assoc.
    // |
    // | A nicer version with regex
    // | Found at
    // |   https://stackoverflow.com/questions/979975/how-to-get-the-value-from-the-get-parameters?utm_medium=organic&utm_source=google_rich_qa&utm_campaign=google_rich_qa
    // +-----------------------------------------------------
    function gup()
    {
	var vars = {};
	var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi,    
						 function(m,key,value) {
						     vars[key] = value;
						 });
	return vars;
    }


    // +---------------------------------------------------------------
    // | Fetch the GET params in an assoc.
    // +-----------------------------------------------------
    var _GET      = gup();
    var _editmode = _GET['mode']=='edit';



    // +---------------------------------------------------------------
    // | Send an asynchronous HTTP GET request.
    // |
    // | @param url      The fully qualified URL to call.
    // | @param options.onComplete An optional callback to call when the request succeeded.
    // | @param options.onError    An optional callback to call when the request failed.
    // +-----------------------------------------------------
    function sendGETRequest( url, options )
    {
	console.log('Sending GET request to :' + url );
	var request = new XMLHttpRequest();
	request.open('GET', url, true);
	request.onload = function() {
	    if (this.status == 200 ) {
		// Success!
		if( options.onComplete )
		    options.onComplete( this );
	    } else {
		// We reached our target server, but it returned an error
		console.log( 'Status ' + this.status );
		if( options.onError )
		    options.onError( this );
	    }
	};
	request.onerror = function() {
	    // There was a connection error of some sort
	    console.error( "Error." );
	};
	request.send();
	return request;
    }
    
    
    // +---------------------------------------------------------------
    // | Send an asynchronous HTTP POST request.
    // |
    // | @param url      The fully qualified URL to call.
    // | @param data     The data/form-data to send (object or FormData instance).
    // | @param options.onComplete An optional callback to call when the request succeeded.
    // | @param options.onError    An optional callback to call when the request failed.
    // +-----------------------------------------------------
    function sendPOSTRequest( url, data, options )
    {
	var request = new XMLHttpRequest();
	request.open('POST', url, true);
	request.onload = function() {
	    if (this.status == 200 ) {
		// Success!
		if( options.onComplete )
		    options.onComplete( this );
	    } else {
		// We reached our target server, but it returned an error
		console.log( 'Status ' + this.status );
		if( options.onError )
		    options.onError( this );
	    }
	};
	request.onerror = function() {
	    // There was a connection error of some sort
	    console.error( "Error." );
	};
	request.send(data);
    }


    // +---------------------------------------------------------------
    // | Clear the search input and optionally retract the search container.
    // |
    // | @param hideSearchContainer Specify if the search container should be retracted (set invisible).
    // +-----------------------------------------------------
    function clearSearch( hideSearchContainer ) {

	if( hideSearchContainer )
	    addClass(document.getElementById('search-container'),'d-none');

	document.getElementById('search-input').value = '';
	clearSearchResults();
    };


    // +---------------------------------------------------------------
    // | Clear the search result display.
    // +-----------------------------------------------------
    function clearSearchResults() {
	document.getElementById('search-results').innerHTML = '';
    }

    
    // +---------------------------------------------------------------
    // | Initialize the pastebee app.
    // +-----------------------------------------------------
    function init()
    {
	// Set the menubar retractable only on desktop devices.
	if( !mobileAndTabletcheck() ) {
	    var header = document.getElementsByTagName('header')[0];
	    addClass( header, 'mtop-transition-0px' );
	    // Show menu bar if mouse pointer is close enough
	    document.body.addEventListener('mousemove', function(event) {
		if( event.clientY < 76 )
		    removeClass(header,'mtop-transition-36px');
		else {
		    addClass(header,'mtop-transition-36px');
		    // clearSearch(true);
		}
	    } );

	    addClass( header, 'mtop-transition-36px' );
	}

	// Add listener to the 'Edit' button.
	var btn_edit = document.getElementById('btn-edit');
	if( btn_edit ) {
	    btn_edit.addEventListener('click', function(e) {
		e.preventDefault();
		if( this.getAttribute('data-action') == 'edit' ) {
		    console.log( 'edit ...' );
		    window.location.href = '/?mode=edit&hash=' + _GET['hash'];
		} else {
		    console.log( 'close ...' );
		    window.location.href = '/?hash=' + _GET['hash'];
		}
	    } );
	}

	// Add listener to the 'Save' button.
	var btn_save = document.getElementById('btn-save');
	if( btn_save ) {
	    btn_save.addEventListener('click', function(e) {
		e.preventDefault();
		// console.log( 'save ...' );
		var content = document.getElementById('content').value;
		var data = new FormData( document.getElementById('pastebee-form') );
		data.append( 'parent_hash', getPasteHash() );
		sendPOSTRequest( '/create.php',
				 data,
				 { onComplete : function( request ) {
				     console.log( request );
				     var response = JSON.parse( request.response );
				     console.log( response );
				     console.log( "/?hash=" + response.hash );
				     window.location.href = "/?hash=" + response.hash;
				 },
				   onError : function( request ) {
				       console.error( request );
				       if( request.status == 403 ) {
					   var responseData = JSON.parse( request.responseText );
					   var msg = [ responseData.message ];
					   for( var arg in responseData.errors )
					       msg.push( arg + ': ' + responseData.errors[arg].join('. ') ) ;
				       }
				       window.alert( msg.join("\n") );
				       // Show pretty error warning here?
				   }
				 }
			       );
	    } );
	}

	// Add listener to the 'Search' icon.
	document.getElementById('search-icon').addEventListener( 'click', function(e) {
	    var visible = !toggleClass( document.getElementById('search-container'), 'd-none' );
	    document.getElementById('search-input').focus();
	} );

	
	// Add listener to the search input field (automatically search on changes).
	var searchXHR = null;
	document.getElementById('search-input').addEventListener( 'keyup', function(e) {
	    // Start search
	    var term = e.target.value;
	    // console.log('Going to search for ' + term );
	    if( !term || (term = term.trim()).length <= 2 ) {
		document.getElementById('search-results').innerHTML = 'Enter at least 3 characters.';
		return;
	    }
	    clearSearchResults();
	    
	    searchXHR = sendGETRequest( 'search.php?search=' + encodeURIComponent(term),
					{ onComplete : function( request ) {
					    if( searchXHR != request )
						return;
					    console.log( request );
					    var response = JSON.parse( request.response );
					    console.log( response );
					    var resultContainer = document.getElementById('search-results');
					    for( var i in response ) {
						// console.log( 'Create result link for result record ' + i );
						var node = document.createElement('a');
						node.setAttribute('href','?hash='+response[i].hash);
						node.innerHTML = '<i class="icon-caret-right"></i>&nbsp;' + response[i].created_at + '&nbsp;<i class="icon-caret-right"></i>&nbsp;' +(response[i].title ? response[i].title : 'No-title');
						resultContainer.appendChild(node);
					    }
					    if( response.length == 0 )
						resultContainer.innerHTML = 'No results.';
					},
					  onError : function( request ) {
					      if( searchXHR != request )
						return;
					      console.error( request );
					      if( request.status == 403 ) {
						  var responseData = JSON.parse( request.responseText );
						  var msg = [ responseData.message ];
						  for( var arg in responseData.errors )
						      msg.push( arg + ': ' + responseData.errors[arg].join('. ') ) ;
					      }
					      window.alert( msg.join("\n") );
					      // Show pretty error warning here?
					  }
					}
				      );
	    
	} );

	// Clear search if requested.
	document.getElementById('clear-search').addEventListener( 'click', function() {
	    clearSearch(false);
	    document.getElementById('search-input').focus();
	} );

	// Clear search and retract search container on mouse-leave.
	document.getElementById('search-container').addEventListener('mouseleave',function(e) {
	    clearSearch(true);
	} );

	// Start a new paste.
	document.getElementById('btn-new').addEventListener('click', function(e) {
	    // Just jump to the start page.
	    window.location.href = "/";
	} );

	// Load the parent paste.
	var btn_loadParent = document.getElementById('btn-loadParent');
	if( btn_loadParent ) {
	    btn_loadParent.addEventListener('click', function(e) {
		e.preventDefault();
		var parentHash = getParentHash();
		if( parentHash ) {
		    console.log( 'load parent ...' );
		    window.location.href = '/?hash=' + parentHash;
		} else {
		    console.warn( 'Cannot load parent: no parent hash specified.' );
		}
	    } );
	}
	
	// If there is currently a paste loaded in display mode (not edit mode), then activate syntax highlighting.
	if( !_editmode && _GET['hash']!=null ) {
	    hljs.initHighlightingOnLoad();
	    hljs.initLineNumbersOnLoad();
	    hljs.highlightBlock( document.getElementById('content') );
	    hljs.lineNumbersBlock( document.getElementById('content') );
	}

	console.log( 'hash=' + getPasteHash() );
    }

    window.addEventListener('load',init);

    

})();
