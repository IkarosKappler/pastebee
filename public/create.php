<?php
require '../start.php';
require '../inc/class.RequestValidator.inc.php';

use Models\Paste; 
use Controllers\PasteController;


header( 'Content-Type: application/json; charset=utf-8' );
if( $_SERVER['REQUEST_METHOD'] != 'POST' ) {
    header('HTTP/1.1 403 Bad Request');
    die( json_encode(array( 'message'=>'Request method not supported.')) );
}

$validator = new RequestValidator( [
    'user' => '',
    'title' => '',
    'description' => '',
    'content' => 'required|min:1|max:2048'
] );
$sanitized = $validator->validate( $_POST );
if( !$sanitized ) {
    header('HTTP/1.1 403 Bad Request');
    die( json_encode(['message'=>'There were '.$validator->errorCount.' error(s).',
                      'errors'=>$validator->errors
    ]) );
}

$sanitized['hash'] = hash('sha256', $sanitized['content'].date('YmdHis').rand(1,65535) );

// Import user controller
$paste = PasteController::create_paste( $sanitized );


echo json_encode( array('message'=>'OK', 'hash'=>$sanitized['hash'] ) );

?>