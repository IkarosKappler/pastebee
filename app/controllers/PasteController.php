<?php
/**
 * @author  Ikaros Kappler
 * @date    2018-07-09
 * @version 1.0.0
 **/
namespace Controllers;

use Models\Paste;

class PasteController {

    /**
     * Creates a new paste in the 'pastes' table by using the 'Paste' model.
     *
     * @param Array The data to use.
     * @return The newly created paste.
     **/
    public static function create_paste( Array $data )
    {
        $paste = Paste::create( $data );
        return $paste;
    }
}
