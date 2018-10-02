<?php

/**
 * Generate link URLs with the configured BASE_URL and the used protocol (http or https).
 *
 * @author  Ikaros Kappler
 * @version 1.0.0
 * @date    2018-10-01
 **/

function make_link( $path ) {
	 if( (isset($_SERVER['HTTPS']) &&
    	     ($_SERVER['HTTPS'] == 'on' || $_SERVER['HTTPS'] == 1) ||
    	     isset($_SERVER['HTTP_X_FORWARDED_PROTO']) &&
    	     $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https') ) {

	     return 'https://' . BASE_URL . $path;
	 } else {
	      return 'http://' . BASE_URL . $path;
	 }
}