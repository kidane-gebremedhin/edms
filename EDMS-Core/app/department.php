<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class department extends Model
{
   protected $table="departments";

  	public function createdByUser(){
    	return $this->belongsTo('App\User', 'createdByUserId', 'id');
    }
  	public function updatedByUser(){
    	return $this->belongsTo('App\User', 'updatedByUserId', 'id');
    }
}
