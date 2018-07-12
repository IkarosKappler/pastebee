<?php
/**
 * @author  Ikaros Kappler
 * @date    2018-07-09
 * @version 1.0.0
 **/
namespace Controllers;

use Models\Paste;

class PasteController {
    
    public static function create_paste( $data )
    {
        $paste = Paste::create( $data );
        return $paste;
    }
}
