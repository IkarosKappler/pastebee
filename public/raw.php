<?php
/**
 * Get a raw output of the paste.
 *
 * @author  Ikaros Kappler
 * @date    2018-07-12
 * @version 1.0.0
 **/

$paste = (include 'retrieve.php');

if( !$paste['mime'] )
    header( 'Content-Type: text/plain; charset=utf-8' );
else
    header( 'Content-Type: ' . $paste['mime'] );

echo $paste['content'];