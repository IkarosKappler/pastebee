<?php
/**
 * Create a new record.
 *
 * @author  Ikaros Kappler
 * @date    2018-07-07
 * @version 1.0.0
 **/

// --------- Load Illuminate/Eloquent ---------------------------
require '../start.php';
require '../inc/class.RequestValidator.inc.php';
use Models\Paste; 
use Controllers\PasteController;

// --------- Always send JSON ---------------------------
header( 'Content-Type: application/json; charset=utf-8' );


// --------- Check if method is POST ---------------------------
if( $_SERVER['REQUEST_METHOD'] != 'POST' ) {
    header('HTTP/1.1 403 Bad Request');
    die( json_encode(array( 'message'=>'Request method not supported.')) );
}


// --------- Validate input ---------------------------
$validator = new RequestValidator( [
    'username' => '',
    'title' => '',
    'description' => '',
    'mime' => '',
    'public' => 'boolean',
    'filename' => '',
    'content' => 'required|min:1|max:2048'
] );
$sanitized = $validator->validate( $_POST );
if( !$sanitized ) {
    header('HTTP/1.1 403 Bad Request');
    die( json_encode(['message'=>'There were '.$validator->errorCount.' error(s).',
                      'errors'=>$validator->errors
    ]) );
}
                                                     

// --------- Store record ---------------------------
try {
    $paste = PasteController::create_paste( $sanitized );

    // --------- Send response ---------------------------
    echo json_encode( array('message'=>'OK', 'hash'=>$paste->hash ) );

    // Send notification email
    mail( NOTIFICATION_EMAIL,
          'Paste stored (id='.$paste->id.').',
          'Paste was stored (remote_address=' . $paste->hashed_ip . ")\n".
          'content: ' . $paste->content
    );
} catch( Exception $e ) {
    header('HTTP/1.1 503 Service Unavailable');
    die( json_encode(['message'=>$e->getMessage()]) );
}

