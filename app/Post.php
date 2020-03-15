<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //table name
    protected $table= 'posts';
    //primary key
    public $primarykey='id';
    //time stamp
    public $timestamps=true;

    public function user(){
        return $this->belongsTo('App\User');
    }
}
