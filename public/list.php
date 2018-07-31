<?php
/**
 * List the keys (hashes) of public pastes, filtered by a search term for the title.
 * 
 * @author  Ikaros Kappler
 * @date    2018-07-25
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
    'search' => 'required|min:1|max:256'
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
$pastes = Paste::select('hash','title')->where('title','LIKE','%'.$sanitized['search'].'%')->where('deleted_at',null)->orderBy('id','DESC')->limit(100)->get();



return $pastes;