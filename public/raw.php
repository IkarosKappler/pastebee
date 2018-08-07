<?php
/**
 * Get a raw output of the paste.
 *
 * @author  Ikaros Kappler
 * @date    2018-07-12
 * @version 1.0.0
 **/

$paste = (include '../inc/retrieve.inc.php');

if( !$paste['mime'] )
    header( 'Content-Type: text/plain; charset=utf-8' );
else
    header( 'Content-Type: ' . $paste['mime'] );

if( $paste['filename'] )
    header('Content-Disposition: attachment; filename="'.str_replace('"',"-",$paste['filename']).'"');

echo $paste['content'];