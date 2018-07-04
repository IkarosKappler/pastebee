<?php
namespace Controllers;

use Models\Paste;

class PasteController {
    
    public static function create_paste($username,$title,$description,$content)
    {
        $user = Paste::create(['username'=>$username,'title'=>$title,'description'=>$description,'content'=>$content]);
        return $user;
    }
}
