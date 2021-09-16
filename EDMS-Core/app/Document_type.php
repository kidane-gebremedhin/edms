<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Document_type extends Model
{
    public function createdByUser(){
    	return $this->belongsTo('App\User', 'createdByUserId', 'id');
    }

}
