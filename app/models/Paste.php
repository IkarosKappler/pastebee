<?php
/**
 * @author  Ikaros Kappler
 * @date    2018-07-09
 * @version 1.0.0
 **/
namespace Models;
 
use \Illuminate\Database\Eloquent\Model;
 
class Paste extends Model {
     
    protected $table = 'pastes';
    protected $fillable = ['username','title','hash','content'];

    
}
 
?>