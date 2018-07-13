<?php
/**
 * @author  Ikaros Kappler
 * @date    2018-07-13 (Friday 13th!)
 * @version 1.0.0
 **/

// --------- Load Illuminate/Eloquent ---------------------------
require '../start.php';
require '../inc/class.RequestValidator.inc.php';

use Models\Paste; 
use Controllers\PasteController;


// --------- Check if method is GET ---------------------------
if( $_SERVER['REQUEST_METHOD'] != 'GET' ) {
    header( 'HTTP/1.1 403 Bad Request' );
    header( 'Content-Type: application/json; charset=utf-8' );
    die( json_encode(array( 'message'=>'Request method not supported.')) );
}


// --------- Validate input ---------------------------
$validator = new RequestValidator( [
    'hash' => 'required|min:1|max:256'
] );
$sanitized = $validator->validate( $_GET );
if( !$sanitized ) {
    header( 'HTTP/1.1 403 Bad Request' );
    header( 'Content-Type: application/json; charset=utf-8' );
    die( json_encode(['message'=>'There were '.$validator->errorCount.' error(s).',
                      'errors'=>$validator->errors
    ]) );
}


// --------- Retrieve record by hash ---------------------------
$paste = Paste::where('hash',$sanitized['hash'])->get()->first();

if( !$paste ) {
    header( 'HTTP/1.1 404 Not Found' );
    header( 'Content-Type: application/json; charset=utf-8' );
    die( json_encode(['message'=>'Paste with hash '.$hash.' not found.']) );
}

return $paste;
