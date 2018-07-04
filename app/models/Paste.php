<?php
 
namespace Models;
 
use \Illuminate\Database\Eloquent\Model;
 
class Paste extends Model {
     
    protected $table = 'pastes';
    protected $fillable = ['username','title','description','content'];

    
}
 
?>