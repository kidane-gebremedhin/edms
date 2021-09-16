<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class viewed_document_edition extends Model
{
   protected $table="viewed_document_editions";
   
  	public function document_edition(){
    	return $this->belongsTo('App\document_edition', 'document_editionId', 'id');
    }
  	public function viewedByUser(){
    	return $this->belongsTo('App\User', 'viewedByUserId', 'id');
    }
}
