<?php
/**
 * @author  Ikaros Kappler
 * @date    2018-07-31
 * @version 1.0.0
 **/

$pastes = (include '../inc/list.inc.php');

header( 'Content-Type: application/json; charset=utf-8' );
echo json_encode( $pastes );
