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


// --------- Parse the multipart message ---------------------------
// https://stackoverflow.com/questions/5483851/manually-parse-raw-multipart-form-data-data-with-php/5488449
function parse_raw_http_request(array &$a_data)
{
  // read incoming data
  $input = file_get_contents('php://input');

  // grab multipart boundary from content type header
  preg_match('/boundary=(.*)$/', $_SERVER['CONTENT_TYPE'], $matches);
  $boundary = $matches[1];

  // split content by boundary and get rid of last -- element
  $a_blocks = preg_split("/-+$boundary/", $input);
  array_pop($a_blocks);

  // loop data blocks
  foreach ($a_blocks as $id => $block)
  {
    if (empty($block))
      continue;

    // you'll have to var_dump $block to understand this and maybe replace \n or \r with a visibile char

    // parse uploaded files
    if (strpos($block, 'application/octet-stream') !== FALSE)
    {
      // match "name", then everything after "stream" (optional) except for prepending newlines 
      preg_match("/name=\"([^\"]*)\".*stream[\n|\r]+([^\n\r].*)?$/s", $block, $matches);
    }
    // parse all other fields
    else
    {
      // match "name" and optional value in between newline sequences
      preg_match('/name=\"([^\"]*)\"[\n|\r]+([^\n\r].*)?\r$/s', $block, $matches);
    }
    $a_data[$matches[1]] = $matches[2];
  }        
}                            
$postData = array();
parse_raw_http_request($postData);

// --------- Validate input ---------------------------
$validator = new RequestValidator( [
    'user' => '',
    'title' => '',
    'description' => '',
    'content' => 'required|min:1|max:2048'
] );
$sanitized = $validator->validate( $postData );
if( !$sanitized ) {
    header('HTTP/1.1 403 Bad Request');
    die( json_encode(['message'=>'There were '.$validator->errorCount.' error(s).',
                      'errors'=>$validator->errors
    ]) );
}
                         

// --------- Fill in additional fields ---------------------------
$sanitized['hash'] = hash('sha256', $sanitized['content'].date('YmdHis').rand(1,65535) );

// --------- Store record ---------------------------
$paste = PasteController::create_paste( $sanitized );

// --------- Send response ---------------------------
echo json_encode( array('message'=>'OK', 'hash'=>$sanitized['hash'] ) );

?>