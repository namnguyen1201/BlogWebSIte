<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $table = 'like';

    public function user() {
    	return $this->User::belongsTo('App\User');
    }

    public function post() {
    	return $this->Post::belongsTo('App\Post');
    }
}
