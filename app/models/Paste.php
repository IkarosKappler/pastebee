<?php
/**
 * @author  Ikaros Kappler
 * @date    2018-07-09
 * @version 1.0.0
 **/
namespace Models;
 
use \Illuminate\Database\Eloquent\Model;
 
class Paste extends Model {

    /**
     * The database table to use.
     **/
    protected $table = 'pastes';

    
    /**
     * Fillable attributes.
     **/
    protected $fillable = ['username','title','filename','hash','mime','content','public','hashed_ip','parent_hash'];

    
}
 
?>