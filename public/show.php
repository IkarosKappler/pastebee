<?php
/**
 * @author  Ikaros Kappler
 * @date    2018-07-12
 * @version 1.0.0
 **/

require '../start.php';
require '../inc/class.RequestValidator.inc.php';

use Models\Paste; 
use Controllers\PasteController;


header( 'Content-Type: application/json; charset=utf-8' );
if( $_SERVER['REQUEST_METHOD'] != 'GET' ) {
    header('HTTP/1.1 403 Bad Request');
    die( json_encode(array( 'message'=>'Request method not supported.')) );
}

$validator = new RequestValidator( [
    'hash' => 'required|min:1|max:256'
] );
$sanitized = $validator->validate( $_GET );
if( !$sanitized ) {
    header('HTTP/1.1 403 Bad Request');
    die( json_encode(['message'=>'There were '.$validator->errorCount.' error(s).',
                      'errors'=>$validator->errors
    ]) );
}

$paste = Paste::where('hash',$sanitized['hash'])->get()->first();




echo json_encode( array('message'=>'OK', 'paste' => $paste ) );

?>