<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
class Post extends Model
{
    protected $table='posts';
    protected $primaryKey='id';
    // protected $='posts';
    public function user(){
        return $this->belongsTo('App\User');
    }
}
