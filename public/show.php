<?php
/**
 * @author  Ikaros Kappler
 * @date    2018-07-12
 * @version 1.0.0
 **/

$paste = (include 'retrieve.php');

header( 'Content-Type: application/json; charset=utf-8' );
echo json_encode( $paste );