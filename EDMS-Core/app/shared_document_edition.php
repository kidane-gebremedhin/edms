<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class shared_document_edition extends Authenticatable
{

    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $table="shared_document_editions";

    public function document(){
        return $this->belongsTo('App\document', 'documentId', 'id');
    }
    public function sharedByUser(){
        return $this->belongsTo('App\User', 'sharedByUserId', 'id');
    }
    public function sharedToUser(){
        return $this->belongsTo('App\User', 'sharedToUserId', 'id');
    }
}
