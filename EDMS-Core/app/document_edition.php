<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class document_edition extends Authenticatable
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
    protected $table="document_editions";


    public function views_per_role($roleId){
        $count=0;
        $role=Role::find($roleId);
        if($role==null)
            return $count;

        $views=viewed_document_edition::where('document_editionId', $this->id)->get();
        foreach ($views as $view) {
            if($view->viewedByUser!=null){
                if($roleId!=$view->viewedByUser->roleId)
                    continue;
            }
            else if(!$role->isPublic()){
                continue;
            }

            $count++;
        }
        return $count;
    }

    public function views_count(){
        return count($this->hasMany('App\viewed_document_edition', 'document_editionId', 'id')->get());
    }

    public function handleViewsCount(){
        $currentUser=Global_var::currentUser();
            $already_counted=\Cookie::get('view_counted_'.$this->id.'_'.$currentUser->id);
            if($already_counted)
                return;

             \Cookie::queue('view_counted_'.$this->id.'_'.$currentUser->id, true, \App\Global_var::countViewsAllowedIntervalInHours());

        $this->view_count=$this->view_count+1;
        $this->save();

        $currentUser=\App\Global_var::currentUser();
        $viewed_document_edition=new viewed_document_edition;
        $viewed_document_edition->document_editionId=$this->id;
        if(!$currentUser->isPublic())
            $viewed_document_edition->viewedByUserId=$currentUser->id;
        $viewed_document_edition->save();
    }
    public function sizeInfo(){
        $sizeinKBs=$this->sizeInBytes;
        switch ($sizeinKBs) {
            case $sizeinKBs>=1024*1024:
                return round(($sizeinKBs/(1024*1024)), 2).'GB';
                break;
            case $sizeinKBs>=1024:
                return round(($sizeinKBs/1024), 2).'MB';
                break;
            default:
                return ($sizeinKBs).'KB';
                break;
        }
    }

    public function isVideo_Audio(){
        if($this->document==null)
            return false;

        return $this->document->category=='Audio' || $this->document->category=='Video';
    }
    public function isVideo(){
        if($this->document==null)
            return false;

        return $this->document->category=='Video';
    }
    public function isAudio(){
        if($this->document==null)
            return false;

        return $this->document->category=='Audio';
    }
    public function isText_Image(){
        if($this->document==null)
            return false;

        return $this->document->category=='News_Paper' || $this->document->category=='Magazine' || $this->document->category=='Book' || $this->document->category=='Text_Document' || $this->document->category=='Image';
    }
    public function isText(){
        if($this->document==null)
            return false;

        return $this->document->category=='News_Paper' || $this->document->category=='Magazine' || $this->document->category=='Book' || $this->document->category=='Text_Document';
    }
    public function isImage(){
        if($this->document==null)
            return false;

        return $this->document->category=='Image';
    }

    public function getFileName(){
        $file_path = $this->path;
        $rev_path=strrev($file_path);
        $filename=substr($rev_path, 0, strpos($rev_path, '/'));
        $filename=strrev($filename);
        $filename=substr($filename, strpos($filename, '-')+1);
        return $filename;
    }

    public function document(){
        return $this->belongsTo('App\document', 'documentId', 'id');
    }
    public function publisher(){
        return $this->belongsTo('App\publisher', 'publisherId', 'id');
    }
    public function createdByUser(){
        return $this->belongsTo('App\User', 'createdByUserId', 'id');
    }
    public function updatedByUser(){
        return $this->belongsTo('App\User', 'updatedByUserId', 'id');
    }
    public function approvedByUser(){
        return $this->belongsTo('App\User', 'approvedByUserId', 'id');
    }
    public function archivedByUser(){
        return $this->belongsTo('App\User', 'archivedByUserId', 'id');
    }
    public function deletedByUser(){
        return $this->belongsTo('App\User', 'deletedByUserId', 'id');
    }
}
