<?php
/**
 * @author  Ikaros Kappler
 * @date    2018-07-09
 * @version 1.0.0
 **/
namespace Controllers;

use Models\Paste;
use Exception;

class PasteController {

    /**
     * Creates a new paste in the 'pastes' table by using the 'Paste' model.
     *
     * @param Array The data to use.
     * @return The newly created paste.
     **/
    public static function create_paste( Array $data )
    {
        // Merge-in additional fields.
        $pasteData = array_merge( $data,
                                  array( 'hashed_ip' => hash('sha256', $_SERVER['REMOTE_ADDR'] ),
                                         'hash'      => hash('sha256', $data['content'].date('YmdHis').rand(1,65535) ),
                                         'public'    => $data['public'] ? '1' : '0'
                                  )
        );
        // Check if N records from the same IP exist from within the last hour.
        $pastes =
                Paste::where( 'hashed_ip', $pasteData['hashed_ip'] )
                ->where('created_at','>=',date('Y-m-d H:i:s',time()-3600))
                ->limit(MAX_PASTES_PER_HOUR+1)
                ->get();
        if( $pastes->count() >= MAX_PASTES_PER_HOUR )
            throw new Exception("Quota exceeded for the current hour.");
        
        return Paste::create( $pasteData );
    }
}
