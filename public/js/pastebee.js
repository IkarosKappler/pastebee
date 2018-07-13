/**
 * @author  Ikaros Kappler
 * @date    2018-07-06
 * @version 1.0.0
 **/

(function() {
    'use strict';

    // Mobile and tablet list from
    //    http://detectmobilebrowsers.com/
    window.mobileAndTabletcheck = function()
    {
	var check = false;
	(function(a){if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino|android|ipad|playbook|silk/i.test(a)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0,4))) check = true;})(navigator.userAgent||navigator.vendor||window.opera);
	return check;
    };
    
    /**
     * Add a class to the given element.
     *
     * @param HTMLElement The DOM element to add the class to.
     * @param string      The class's name.
     **/
    function addClass(element,name)
    {
	var arr;
	arr = element.className.split(" ");
	if( arr.indexOf(name) == -1 ) {
            element.className += " " + name;
	}
    }

    /**
     * Remove a class from the given element.
     *
     * @param HTMLElement The DOM element to remove the class from.
     * @param string      The class's name.
     **/
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

    /*
    function sendGETRequest( url, data, options )
    {
	var request = new XMLHttpRequest();
	request.open('GET', url, true);
	
	request.onload = function() {
	    if (this.status >= 200 && this.status < 400) {
		// Success!
		var data = JSON.parse(this.response);
	    } else {
		// We reached our target server, but it returned an error
		
	    }
	};
	request.onerror = function() {
	    // There was a connection error of some sort
	};	
	request.send();
    }
    */

    
    function sendPOSTRequest( url, data, options )
    {
	var request = new XMLHttpRequest();
	request.open('POST', url, true);
	request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
	request.onload = function() {
	    if (this.status == 200 ) { //  >= 200 && this.status < 400) {
		// Success!
		// var resp = this.response;
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
	//request.send(urlEncodedData);
    }

    
    /**
     * Initialize the pastebee app.
     **/
    function init()
    {
	if( !mobileAndTabletcheck() ) {
	    var header = document.getElementsByTagName('header')[0];
	    addClass( header, 'mtop-transition-0px' );
	    header.addEventListener('mouseenter', function() { removeClass(header,'mtop-transition-36px'); } );
	    header.addEventListener('mouseleave', function() { addClass(header,'mtop-transition-36px'); } );
	    addClass( header, 'mtop-transition-36px' );
	}

	document.getElementById('btn-save').addEventListener('click', function(e) {
	    console.log( 'save ...' );
	    var content = document.getElementById('content').value;
	    var data = new FormData();
	    data.append('content',content);
	    sendPOSTRequest( '/create.php',
			     data,
			     { onComplete : function( request ) {
				 console.log( request );
				 var response = JSON.parse( request.response );
				 console.log( response );
				 window.location.href = "/?hash=" + response.hash;
			     },
			       onError : function( request ) {
				   console.error( request );
			       }
			     }
			   );
	} );

	document.getElementById('btn-new').addEventListener('click', function(e) {
	    console.log( 'new ...' );
	    window.location.href = "/";
	} );
	
    }

    window.addEventListener('load',init);

    

})();