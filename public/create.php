<?php
require '../start.php';


use Models\Paste; 
use Controllers\PasteController; 
 
// Import user controller
$paste = PasteController::create_paste(
    'ika', // username
    'My first pastebee', // title
    'A record to demonstrate how to create new records', // description
    'test1234' // content
);



header( 'Content-Type: application/json; charset=utf-8' );
echo json_encode( array('message'=>'OK (this whole thing is still extremly under construction. Do not use it yet)' ) );;

?>