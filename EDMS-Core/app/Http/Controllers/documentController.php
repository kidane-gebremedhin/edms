<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\document;
use App\author;
use App\publisher;
use App\document_edition;
use App\user;
use DB;
use Auth;
use mysqli;
use Hash;
use Maatwebsite\Excel\Facades\Excel;
use Validator;
use Illuminate\Support\Facades\Input;
use App\shared_document_edition;
use Session;
use Illuminate\Support\Facades\Storage;
use File;
use Carbon\Carbon;

class documentController extends Controller
{
    public $paginationSize;
    
    public function __construct(){
        $this->middleware('auth:web')->except(['download', 'playlist_categories', 'play', 'playlist', 'streamText_Image', 'streamText_Image_Base64', 'streamMedia']);
     
     $this->paginationSize=DB::table('settings')->first()!=null? DB::table('settings')->first()->paginationSize: 10;        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function sharePost($id, Request $request){

        $userIds=$request->userIds;

        foreach ($userIds as $userId) {
            /*$shared_document_edition=shared_document_edition::where('documentId', $id)->where('sharedToUserId', $userId)->where('sharedByUserId', Auth::guard('web')->user()->id)->first();
            if($shared_document_edition!=null){
                continue;
            }*/

            $shared_document_edition=new shared_document_edition;
            $shared_document_edition->documentId=$id;
            $shared_document_edition->sharedToUserId=$userId;
            $shared_document_edition->sharedByUserId=Auth::guard('web')->user()->id;
            $shared_document_edition->sharedDateTime=(new \App\Date_class)->getCurrentDate();
            $shared_document_edition->save();
        }
        
    \App\Global_var::logAction($request, 'Shared document Id: '.$id.' to '.count($userIds).' users');

    Session::flash("success", "Document shared to ".count($userIds)." users");

    return redirect()->route('documents.show', $id);
    }

    public function share($id, Request $request){
        $currentUser=\App\Global_var::currentUser();

        $document=document::find($id);
        $users=User::where('isDeleted', 'false')->where('isApproved', 'true')->where('id', '!=', $currentUser->id)->orderBy("id", "desc")->pluck('email', 'id')->toArray();
        if($request->ajax())
            return view("documents.ajax.share")->with('document', $document)->with('users', $users);

           return view("documents.http.share")->with('document', $document)->with('users', $users);

        }
        
    public function download($editionId, Request $request)
    {
        $document_edition=document_edition::find($editionId);
        if($document_edition==null){
            if($request->ajax())
                return ["error", "Requested file not found"];
            Session::flash('danger', 'Requested file not found');
            return back();
        }


        $file_path = $document_edition->path;
        $filename=$document_edition->getFileName();

        $headers = array(
        // 'Content-Type: text/pdf',
        'Content-Disposition: attachment; filename='.$filename,
        );

        \App\Global_var::logAction($request, 'Downloaded documentId: '.$document_edition->document->id);

        if ( file_exists( $file_path ) ) {
        return \Response::download( $file_path, $filename, $headers );
        } else {
        exit( 'Requested file does not exist on our server!' );
        }
    }

    public function playlist_categories(Request $request)
    {
       if($request->ajax())
        return view('medias.ajax.playlist_categories');

        return view('medias.http.playlist_categories');
    }

public function playlist(Request $request, $category=null)
    {
        $currentUser=\App\Global_var::currentUser();
        if($category==null)//from body part e.g search
            $category=$request->category;
        $is_search_request=$request->is_search_request;
        $title=$request->title;
        $summery=$request->summery;
        $subCategory=$request->subCategory;
        $authorId=$request->authorId;
        $publisherId=$request->publisherId;
        $yearOfPublishment=$request->yearOfPublishment;

        $documents=document::where('isDeleted', 'false')->where('isApproved', 'true');
       if($category!=null)
            $documents=$documents->where('category', $category);
            
        if($title!=null){
            $author_names=explode(' ', $title);

        if(count($author_names)==3)
            $authors=author::where('firstName', 'like', '%' . $author_names[0] . '%')->where('lastName', 'like', '%' . $author_names[1] . '%')->where('middleName', 'like', '%' . $author_names[2] . '%')->get();
        else if(count($author_names)==2)
            $authors=author::where('firstName', 'like', '%' . $author_names[0] . '%')->where('lastName', 'like', '%' . $author_names[1] . '%')->get();
        else
            $authors=author::where('firstName', 'like', '%' . $title . '%')->orWhere('lastName', 'like', '%' . $title . '%')->orWhere('middleName', 'like', '%' . $title . '%')->get();
            $documents=$documents->where('title', 'like', '%' . $title . '%')->orWhereIn('authorId', $authors->pluck('id')->toArray());            
        }
        if($summery!=null)
            $documents=$documents->where('summery', 'like', '%' . $summery . '%');
        if($subCategory!=null)
            $documents=$documents->where('subCategory', 'like', '%' . $subCategory . '%');
        
        if($authorId!=null)
            $documents=$documents->where('authorId', $authorId);
        if($publisherId!=null){
            $documentIds=document_edition::where('isDeleted', 'false')->where('publisherId', $publisherId)->pluck('documentId')->toArray();
            $documents=$documents->whereIn('id', $documentIds);
        }
        if($yearOfPublishment!=null){
            $documentIds=document_edition::where('isDeleted', 'false')->where('yearOfPublishment', $yearOfPublishment)->pluck('documentId')->toArray();
            $documents=$documents->whereIn('id', $documentIds);
        }

        $allowed_documentIds=array();
        foreach ($documents->get() as $document) {
            if(!$currentUser->isGranted_ID('documents.show', $document->id))
                continue;
            array_push($allowed_documentIds, $document->id); 
        }

        //$documents=$documents->orderBy("id", "desc")->paginate($this->paginationSize);
        $documents=document::whereIn('id', $allowed_documentIds)->orderBy("category", "desc")->paginate($this->paginationSize);

       $years=\App\Global_var::years();
       $authors=DB::table('authors')->where('isDeleted', 'false')->pluck('firstName', 'id')->toArray();
       $publishers=DB::table('publishers')->where('isDeleted', 'false')->pluck('name', 'id')->toArray();

$logAction_message='Searched documents';
if($title!=null)
    $logAction_message=$logAction_message.' by title: '.$title;
if($authorId!=null)
    $logAction_message=$logAction_message.' by authorId: '.$authorId;
if($publisherId!=null)
    $logAction_message=$logAction_message.' by publisherId: '.$publisherId;
if($yearOfPublishment!=null)
    $logAction_message=$logAction_message.' by yearOfPublishment: '.$yearOfPublishment;

$document_editionIds=array();
foreach ($documents as $document) {
    if($document->editions->first()==null)
        continue;
    array_push($document_editionIds, $document->editions->first()->id);
}

$document_editions_ordered=array();
foreach ($document_editionIds as $id) {
    array_push($document_editions_ordered, document_edition::find($id));
}

$document_editions=$document_editions_ordered;

/*
    if($is_search_request){
            \App\Global_var::logAction($request, $logAction_message);
            return view("medias.ajax.playlist_search_result")->with('document_editions', $document_editions);
            }*/
        \App\Global_var::logAction($request, 'Viewed Documents play list');
        

       if($request->ajax())
        return view("medias.ajax.video-playlist")->with('documents', $documents)->with('document_editions', $document_editions)->with('category', $category)->with('years', $years)->with('authors', $authors)->with('publishers', $publishers);

       return view("medias.http.video-playlist")->with('documents', $documents)->with('document_editions', $document_editions)->with('category', $category)->with('years', $years)->with('authors', $authors)->with('publishers', $publishers);
    }

    public function play($id, Request $request)
    {

        $document_edition=document_edition::find($id);
        $related_by_publisher_document_editions=$document_edition->publisher->document_editions;
        $document=$document_edition->document;
        $related_by_author_document_editions=$document->author->document_editions();

    $category=$document->category;
    $years=\App\Global_var::years();
   $authors=DB::table('authors')->where('isDeleted', 'false')->pluck('firstName', 'id')->toArray();
   $publishers=DB::table('publishers')->where('isDeleted', 'false')->pluck('name', 'id')->toArray();

    $related_by_publisher_document_editions=$related_by_publisher_document_editions->filter(function($document_edition){
            $currentUser=\App\Global_var::currentUser();
            return $currentUser->isGranted_ID('documents.show', $document_edition->document->id) /*&& ($document_edition->isAudio() || $document_edition->isVideo())*/;
        });

    $related_by_author_document_editions=$related_by_author_document_editions->filter(function($document_edition){
            $currentUser=\App\Global_var::currentUser();
            return $currentUser->isGranted_ID('documents.show', $document_edition->document->id) /*&& ($document_edition->isAudio() || $document_edition->isVideo())*/;
        });

    // return view("medias.ajax.single-video-playlist")->with('document_edition', $document_edition)->with('related_by_publisher_document_editions', $related_by_publisher_document_editions)->with('related_by_author_document_editions', $related_by_author_document_editions);
    


    //Playlist
    $currentUser=\App\Global_var::currentUser();
        $documents=document::where('isDeleted', 'false')->where('isApproved', 'true');
        $allowed_documentIds=array();
        foreach ($documents->get() as $document) {
            if(!$currentUser->isGranted_ID('documents.show', $document->id))
                continue;
            array_push($allowed_documentIds, $document->id); 
        }

        $documents=document::whereIn('id', $allowed_documentIds)->orderBy("category", "desc")->paginate($this->paginationSize);

$document_editionIds=array();
foreach ($documents as $document) {
    if($document->editions->first()==null)
        continue;
    array_push($document_editionIds, $document->editions->first()->id);
}

$document_editions_ordered=array();
foreach ($document_editionIds as $id) {
    array_push($document_editions_ordered, document_edition::find($id));
}

$document_editions=$document_editions_ordered;

        \App\Global_var::logAction($request, 'Viewed/Played documentId: '.$document->id);
        if($request->ajax())
            return view("medias.ajax.single-video-playlist")->with('documents', $documents)->with('document_edition', $document_edition)->with('related_by_publisher_document_editions', $related_by_publisher_document_editions)->with('related_by_author_document_editions', $related_by_author_document_editions)->with('category', $category)->with('years', $years)->with('authors', $authors)->with('publishers', $publishers)->with('document_editions', $document_editions);
        return view("medias.http.single-video-playlist")->with('documents', $documents)->with('document_edition', $document_edition)->with('related_by_publisher_document_editions', $related_by_publisher_document_editions)->with('related_by_author_document_editions', $related_by_author_document_editions)->with('category', $category)->with('years', $years)->with('authors', $authors)->with('publishers', $publishers)->with('document_editions', $document_editions);
    }


public function streamText_Image($editionId)
    {
        $document_edition=document_edition::find($editionId);
        if($document_edition==null)
            return ["error", "Requested file not found"];


        $file_path = $document_edition->path;        
        $filename=$document_edition->getFileName();
        $headers = array(
        // 'Content-Type: text/pdf',
        'Content-Disposition: attachment; filename='.$filename,
        );
        if ( file_exists( $file_path ) ) {
        //return \Response::file( $file_path, $headers );
        return file_get_contents($file_path);
        } else {
        exit( 'Requested file does not exist on our server!' );
        }
    }
    public function streamText_Image_Base64($editionId)
        {
            $document_edition=document_edition::find($editionId);
            if($document_edition==null)
                return ["error", "Requested file not found"];


            $file_path = $document_edition->path;        
            $filename=$document_edition->getFileName();
            $headers = array(
            // 'Content-Type: text/pdf',
            'Content-Disposition: attachment; filename='.$filename,
            );
            if ( file_exists( $file_path ) ) {
            //return \Response::file( $file_path, $headers );
            //to return byte[]
            //return file_get_contents($file_path);
            //to retutn base64
            return base64_encode(file_get_contents($file_path));
            } else {
            exit( 'Requested file does not exist on our server!' );
            }
        }
    public function read_user_mannual(Request $request, $lang='English')
    {
        \App\Global_var::logAction($request, 'Read '.$lang.' User Mannual');
       if($request->ajax())
        return view("medias.ajax.user-mannual")->with('lang', $lang);

       return view("medias.http.user-mannual")->with('lang', $lang);
    }

    public function streamUser_Mannual($lang='English')
    {
        $file_path = 'mannuals/User-Mannual-'.$lang.'.pdf';        
        $filename='User-Mannual-Tigrigna.pdf';
        $headers = array(
        // 'Content-Type: text/pdf',
        'Content-Disposition: attachment; filename='.$filename,
        );
        if ( file_exists( $file_path ) ) {
        //return \Response::file( $file_path, $headers );
        return file_get_contents($file_path);
        } else {
        exit( 'Requested file does not exist on our server!' );
        }
    }

    public function streamMedia(Request $request, $editionId){
        //return "hh";
        $document_edition=document_edition::find($editionId);
        if($document_edition==null || $document_edition->document==null)
            return ['error', 'Requested dcument not found.'];

        //for base64
        //return base64_encode(file_get_contents(($document_edition->path)));

        $tmp=null;
        switch ($document_edition->document->category) {
            case 'Video':
                $tmp = new \App\VideoStream($document_edition->path);
                break;
            case 'Audio':
                $tmp = new \App\VideoStream($document_edition->path);
                break;
            case 'Image':
                $tmp = new \App\VideoStream($document_edition->path);
                break;
            case 'Text_Document':
                $tmp = new \App\VideoStream($document_edition->path);
                break;
            default:
                return ['error', 'Unsupported document type.'];
                break;
        }

        if($tmp==null)
            return ['error', 'Unsupported document type.'];

        $tmp->start();
    }

    
    public function getDocument($id){
        return document::find($id);
    }

    public function approveDocumentPermissions($id, Request $request){
        $currentUser=\App\Global_var::currentUser();
        if($currentUser->isLibrary_Head() || $currentUser->isAdmin()){
            $document=document::find($id);
            $document->isPermissionApproved='true';
            $document->save();
        \App\Global_var::logAction($request, 'Approved document permissions. documentId: '.$document->id);
            if($document->isDeleted=="false" && $document->isApproved=="false")
                return redirect()->route('documents.newDocuments');
        }
        return redirect()->route('documents.index');
    }

    public function approveNewDocument($id, $approvalStatus, Request $request){
        $redirectToNewDocuments=true;

        $document=document::find($id);

        if($document->isPermissionApproved!='true'){
            return ['error', 'Please approve permissions before document approval.'];
        }

        if($document->isDeleted=='true')
            $redirectToNewDocuments=false;

        if($approvalStatus==1){
            $document->isDeleted='false';
            $document->isApproved='true';
            $document->approvedByUserId=Auth::guard('web')->user()->id;
        \App\Global_var::logAction($request, 'New document Id: '.$document->id.' Title: '.$document->title.' Approval Request Accepted');
        }
        else if($approvalStatus==0){
            $document->isDeleted='true';
            $document->deletedByUserId=Auth::guard('web')->user()->id;
        \App\Global_var::logAction($request, 'New document Id: '.$document->id.' Title: '.$document->title.' Approval Request Rejected');
        }

        $document->save();

        if(!$redirectToNewDocuments)//from rejected documents
            return redirect()->route("documents.rejectedDocuments");
        return redirect()->route("documents.newDocuments");
    }

    public function rejectedDocuments(Request $request)
    {
       $documents=document::where('isDeleted', 'true')->where('isApproved', 'false')->orderBy("id", "desc")->paginate($this->paginationSize);

        \App\Global_var::logAction($request, 'Rejected Documents list viewed');
       if($request->ajax())
        return view("documents.ajax.rejected_documents")->with('documents', $documents);

       return view("documents.http.rejected_documents")->with('documents', $documents);
    }

    public function newDocuments(Request $request)
    {
       $documents=document::where('isDeleted', 'false')->where('isApproved', 'false')->orderBy("id", "desc")->paginate($this->paginationSize);

        \App\Global_var::logAction($request, 'New Documents list viewed');
       if($request->ajax())
        return view("documents.ajax.new_documents")->with('documents', $documents);

       return view("documents.http.new_documents")->with('documents', $documents);
    }

    public function index(Request $request, $category=null)
    {
        $currentUser=\App\Global_var::currentUser();
        if($category==null)//from body part e.g search
            $category=$request->category;
        $is_search_request=$request->is_search_request;
        $title=$request->title;
        $summery=$request->summery;
        $subCategory=$request->subCategory;
        $authorId=$request->authorId;
        $publisherId=$request->publisherId;
        $yearOfPublishment=$request->yearOfPublishment;

        $documents=document::where('isDeleted', 'false')->where('isApproved', 'true');
       if($category!=null)
            $documents=$documents->where('category', $category);
            
        if($title!=null)
            $documents=$documents->where('title', 'like', '%' . $title . '%');
        if($summery!=null)
            $documents=$documents->where('summery', 'like', '%' . $summery . '%');
        if($subCategory!=null)
            $documents=$documents->where('subCategory', 'like', '%' . $subCategory . '%');
        if($authorId!=null)
            $documents=$documents->where('authorId', $authorId);
        if($publisherId!=null){
            $documentIds=document_edition::where('isDeleted', 'false')->where('publisherId', $publisherId)->pluck('documentId')->toArray();
            $documents=$documents->whereIn('id', $documentIds);
        }
        if($yearOfPublishment!=null){
            $documentIds=document_edition::where('isDeleted', 'false')->where('yearOfPublishment', $yearOfPublishment)->pluck('documentId')->toArray();
            $documents=$documents->whereIn('id', $documentIds);
        }

        $allowed_documentIds=array();
        foreach ($documents->get() as $document) {
            if(!$currentUser->isGranted_ID('documents.show', $document->id))
                continue;
            array_push($allowed_documentIds, $document->id); 
        }

        //$documents=$documents->orderBy("id", "desc")->paginate($this->paginationSize);
        $documents=document::whereIn('id', $allowed_documentIds)->orderBy("id", "desc")->paginate($this->paginationSize);

       $years=\App\Global_var::years();
       $authors=DB::table('authors')->where('isDeleted', 'false')->pluck('firstName', 'id')->toArray();
       $publishers=DB::table('publishers')->where('isDeleted', 'false')->pluck('name', 'id')->toArray();

$logAction_message='Searched documents';
if($title!=null)
    $logAction_message=$logAction_message.' by title: '.$title;
if($authorId!=null)
    $logAction_message=$logAction_message.' by authorId: '.$authorId;
if($publisherId!=null)
    $logAction_message=$logAction_message.' by publisherId: '.$publisherId;
if($yearOfPublishment!=null)
    $logAction_message=$logAction_message.' by yearOfPublishment: '.$yearOfPublishment;

    if($is_search_request){
            \App\Global_var::logAction($request, $logAction_message);
            return view("documents.ajax.index_search_result")->with('documents', $documents);
            }

        \App\Global_var::logAction($request, 'Documents list viewed');
       if($request->ajax())
        return view("documents.ajax.index")->with('documents', $documents)->with('category', $category)->with('years', $years)->with('authors', $authors)->with('publishers', $publishers);

       return view("documents.http.index")->with('documents', $documents)->with('category', $category)->with('years', $years)->with('authors', $authors)->with('publishers', $publishers);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $document_categories=\App\Global_var::documentCategories();
        $years=\App\Global_var::years();
       $authors=\App\Global_var::authors();
       $publishers=\App\Global_var::publishers();
        $document_sub_categories=\App\Global_var::documentSub_categories();

        if($request->ajax())
            return view("documents.ajax.create")->with('document_categories', $document_categories)->with('document_sub_categories', $document_sub_categories)->with('years', $years)->with('authors', $authors)->with('publishers', $publishers);
        return view("documents.http.create")->with('document_categories', $document_categories)->with('document_sub_categories', $document_sub_categories)->with('years', $years)->with('authors', $authors)->with('publishers', $publishers);
    }

    public function create_edition($documentId, Request $request)
    {
        $document=document::find($documentId);
        $document_categories=\App\Global_var::documentCategories();
        $document_sub_categories=\App\Global_var::documentSub_categories();
        $years=\App\Global_var::years();
       $authors=DB::table('authors')->where('isDeleted', 'false')->pluck('firstName', 'id')->toArray();
       $publishers=DB::table('publishers')->where('isDeleted', 'false')->pluck('name', 'id')->toArray();

        if($request->ajax())
            return view("documents.ajax.create_edition")->with('document', $document)->with('document_categories', $document_categories)->with('document_sub_categories', $document_sub_categories)->with('years', $years)->with('authors', $authors)->with('publishers', $publishers);
        return view("documents.http.create_edition")->with('document', $document)->with('document_categories', $document_categories)->with('document_sub_categories', $document_sub_categories)->with('years', $years)->with('authors', $authors)->with('publishers', $publishers);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
    $file_size=0;
    $file_path='';
    $document=document::where('title', '=', $request->title)->first();
        if($document!=null){
            if($request->ajax())
                return ['error', 'Title already exists. Please try another title.'];
            return back();
        } 

    $this->validate($request, [
            'title'=>'required|unique:documents',
            'category'=>'required',
            ]);


    //Upload file
    if($request->hasFile('file')){
            $file = $request->file('file');
            $filename = time().'-'.$file->getClientOriginalName();
            $storage_path = \App\Global_var::repositoryPath();
            $file->move($storage_path, $filename);
            $file_path=$storage_path.$filename;
            $file_size = File::size($file_path);//Storage::size($file_path);
            //convert to KB
            $file_size=round(($file_size/1024), 2);
        }

        $author=new author;
        $author->firstName=$request->firstName;
        $author->middleName=$request->middleName;
        $author->lastName=$request->lastName;
        $author->email=$request->author_email;
        $author->phoneNumber=$request->author_phoneNumber;
        $author->createdByUserId=Auth::guard('web')->user()->id;
        if($request->authorId==null)
            $author->save();

        $publisher=new publisher;
        $publisher->name=$request->name;
        $publisher->yearOfEstablishment=$request->yearOfEstablishment;
        $publisher->email=$request->publisher_email;
        $publisher->phoneNumber=$request->publisher_phoneNumber;
        $publisher->createdByUserId=Auth::guard('web')->user()->id;
        if($request->publisherId==null)
            $publisher->save();

        $document=new document;
        $document->title=$request->title;
        $document->category=$request->category;
        $document->subCategory=$request->subCategory;
        $document->summery=$request->summery;
        $document->location=$request->location;
        $document->uploadedDateTime=(new \App\Date_class)->getCurrentDate();
        $document->authorId=$request->authorId!=null? $request->authorId: $author->id;
        $document->createdByUserId=Auth::guard('web')->user()->id;
        $document->save();


        $document_edition=new document_edition;
        $document_edition->documentId=$document->id;
        $document_edition->edition=$request->edition;
        $document_edition->path=$file_path;
        $document_edition->sizeInBytes=$file_size;
        $document_edition->uploadedDateTime=(new \App\Date_class)->getCurrentDate();
        $document_edition->publisherId=$request->publisherId!=null? $request->publisherId: $publisher->id;
        $document_edition->yearOfPublishment=$request->yearOfPublishment;
        $document_edition->description=$request->description;
        $document_edition->createdByUserId=Auth::guard('web')->user()->id;
        $document_edition->save();        

        \App\Global_var::logAction($request, 'Uploaded new document '.$document->title.'. Size: '.$file_size.' KBytes');

        //return redirect()->route("documents.index");
        return redirect()->route("permissions.document_role_permissions", $document->id);
    }

    public function store_edition($documentId, Request $request)
    {
    $file_size=0;
    $file_path='';
    $document=document::find($documentId);
/*
    $this->validate($request, [
            'title'=>'required|unique:documents',
            'category'=>'required',
            ]);*/

foreach ($document->editions as $document_edition) {
    if($document_edition->edition==$request->edition){
        $message='Document edition '.$request->edition.' already exists.';
        if($request->ajax())
            return ['error', $message];
        Session::flash('danger', $message);
        return back()->withInput($request->all());
    }
}

    //Upload file
    if($request->hasFile('file')){
            $file = $request->file('file');
            $filename = time().'-'.$file->getClientOriginalName();
            $storage_path = \App\Global_var::repositoryPath();
            $file->move($storage_path, $filename);
            $file_path=$storage_path.$filename;
            $file_size = File::size($file_path);//Storage::size($file_path);
            //convert to KB
            $file_size=round(($file_size/1024), 2);
        }

        $publisher=new publisher;
        $publisher->name=$request->name;
        $publisher->yearOfEstablishment=$request->yearOfEstablishment;
        $publisher->email=$request->publisher_email;
        $publisher->phoneNumber=$request->publisher_phoneNumber;
        $publisher->createdByUserId=Auth::guard('web')->user()->id;
        if($request->publisherId==null)
            $publisher->save();

        $document_edition=new document_edition;
        $document_edition->documentId=$documentId;
        $document_edition->edition=$request->edition;
        $document_edition->path=$file_path;
        $document_edition->sizeInBytes=$file_size;
        $document_edition->uploadedDateTime=(new \App\Date_class)->getCurrentDate();
        $document_edition->publisherId=$request->publisherId!=null? $request->publisherId: $publisher->id;
        $document_edition->yearOfPublishment=$request->yearOfPublishment;
        $document_edition->description=$request->description;
        $document_edition->createdByUserId=Auth::guard('web')->user()->id;
        $document_edition->save();        

        \App\Global_var::logAction($request, 'Uploaded new edition '.$document_edition->edition.' of dcument '.$document->title.'. Size: '.$file_size.' KBytes');

        return redirect()->route("documents.show", $documentId);
    }


    public function make_shared_documents_viewed($id, Request $request)
    {
        $shared_document_edition=shared_document_edition::find($id);
        $document=$shared_document_edition->document;

        $currentUser=\App\Global_var::currentUser();

        if($shared_document_edition!=null){
            if($currentUser->isAdmin())
                $shared_document_edition->isViewedByAdmin='true';
            
            if($shared_document_edition->sharedToUserId==$currentUser->id){
                //if($currentUser->isGranted_ID('documents.show', $document->id))
                    $shared_document_edition->isViewed='true';
            }

            $shared_document_edition->save();            
        }

        \App\Global_var::logAction($request, 'Viewed shared document ID '.$id.'');
        if($request->ajax())
            return view("documents.ajax.show_shared_document")->with('shared_document_edition', $shared_document_edition);
        return view("documents.http.show_shared_document")->with('shared_document_edition', $shared_document_edition);

        // $document_edition=$document->editions->first();
        // return redirect()->route('documents.play', $document_edition->id);
    }
    public function show($id, Request $request)
    {
        $document=document::find($id);
        $roles=DB::table('roles')->get();
        \App\Global_var::logAction($request, 'Viewed document ID '.$document->id.' details');
        if($request->ajax())
            return view("documents.ajax.show")->with('document', $document)->with('roles', $roles);
        return view("documents.http.show")->with('document', $document)->with('roles', $roles);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
        $document=document::find($id);
        $document_categories=\App\Global_var::documentCategories();
        $document_sub_categories=\App\Global_var::documentSub_categories();
        $years=\App\Global_var::years();
       $authors=\App\Global_var::authors();
       $publishers=\App\Global_var::publishers();

        if($request->ajax())
            return view("documents.ajax.edit")->with('document', $document)->with('document_categories', $document_categories)->with('document_sub_categories', $document_sub_categories)->with('years', $years)->with('authors', $authors)->with('publishers', $publishers);
        return view("documents.http.edit")->with('document', $document)->with('document_categories', $document_categories)->with('document_sub_categories', $document_sub_categories)->with('years', $years)->with('authors', $authors)->with('publishers', $publishers);
    }

    public function edit_edition($id, Request $request)
    {
        $document_edition=document_edition::find($id);
        $document_categories=\App\Global_var::documentCategories();
        $years=\App\Global_var::years();
       $authors=DB::table('authors')->where('isDeleted', 'false')->pluck('firstName', 'id')->toArray();
       $publishers=DB::table('publishers')->where('isDeleted', 'false')->pluck('name', 'id')->toArray();

        if($request->ajax())
            return view("documents.ajax.edit_edition")->with('document_edition', $document_edition)->with('document_categories', $document_categories)->with('years', $years)->with('authors', $authors)->with('publishers', $publishers);
        return view("documents.http.edit_edition")->with('document_edition', $document_edition)->with('document_categories', $document_categories)->with('years', $years)->with('authors', $authors)->with('publishers', $publishers);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
    $file_size=0;
    $file_path='';
    $document=document::where('title', '=', $request->title)->first();
        if($document!=null && $document->id!=$id){
            if($request->ajax())
                return ['error', 'Title already exists. Please try another title.'];
            return back();
        }

    $this->validate($request, [
            'title'=>'required',
            'category'=>'required',
            ]);


    //Upload file
    if($request->hasFile('file')){
            $file = $request->file('file');
            $filename = time().'-'.$file->getClientOriginalName();
            $storage_path = \App\Global_var::repositoryPath();
            $file->move($storage_path, $filename);
            $file_path=$storage_path.$filename;
            $file_size = File::size($file_path);//Storage::size($file_path);
            //convert to KB
            $file_size=round(($file_size/1024), 2);
        }

        $author=author::find($request->authorId);
        if($author==null)
            $author=new author;
        $author->firstName=$request->firstName;
        $author->middleName=$request->middleName;
        $author->lastName=$request->lastName;
        $author->email=$request->author_email;
        $author->phoneNumber=$request->author_phoneNumber;
        $author->updatedByUserId=Auth::guard('web')->user()->id;
        if($request->authorId==null){
            $author->createdByUserId=Auth::guard('web')->user()->id;
        }else{
            $author->updatedByUserId=Auth::guard('web')->user()->id;
        }
        $author->save();

        $publisher=publisher::find($request->publisherId);
        if($publisher==null)
            $publisher=new publisher;
        $publisher->name=$request->name;
        $publisher->yearOfEstablishment=$request->yearOfEstablishment;
        $publisher->email=$request->publisher_email;
        $publisher->phoneNumber=$request->publisher_phoneNumber;
        $publisher->updatedByUserId=Auth::guard('web')->user()->id;
        if($request->publisherId==null){
            $publisher->createdByUserId=Auth::guard('web')->user()->id;
        }
        else{
            $publisher->updatedByUserId=Auth::guard('web')->user()->id;            
        }
        $publisher->save();

        $document=document::find($id);
        $document->title=$request->title;
        $document->category=$request->category;
        $document->subCategory=$request->subCategory;
        $document->summery=$request->summery;
        $document->location=$request->location;
        $document->uploadedDateTime=(new \App\Date_class)->getCurrentDate();
        $document->authorId=$request->authorId!=null? $request->authorId: $author->id;
        $document->updatedByUserId=Auth::guard('web')->user()->id;
        $document->save();


        $document_edition=$document->editions->first();
        if($document_edition!=null){
            $document_edition->documentId=$document->id;
            $document_edition->edition=$request->edition;
            if($file_path!=''){
                $document_edition->path=$file_path;
                $document_edition->sizeInBytes=$file_size;
                $document_edition->uploadedDateTime=(new \App\Date_class)->getCurrentDate();
                }
            $document_edition->publisherId=$request->publisherId!=null? $request->publisherId: $publisher->id;
            $document_edition->yearOfPublishment=$request->yearOfPublishment;
            $document_edition->description=$request->description;
            $document_edition->updatedByUserId=Auth::guard('web')->user()->id;
            $document_edition->save();        
        }

        \App\Global_var::logAction($request, 'Updated document ID: '.$document->id.' Title: '.$document->title.'. Size: '.$file_size.' KBytes');

        return redirect()->route("documents.show", $id);
   }


    public function update_edition($id, Request $request)
    {
    $file_size=0;
    $file_path='';
    $document_edition=document_edition::find($id);
/*
    $this->validate($request, [
            'title'=>'required|unique:documents',
            'category'=>'required',
            ]);*/
$document=$document_edition->document;
foreach ($document->editions as $doc_edition) {
    if($doc_edition->edition==$request->edition && $doc_edition->id!=$id){
        $message='Document edition '.$request->edition.' already exists.';
        if($request->ajax())
            return ['error', $message];
        Session::flash('danger', $message);
        return back()->withInput($request->all());
    }
}

    //Upload file
    if($request->hasFile('file')){
            $file = $request->file('file');
            $filename = time().'-'.$file->getClientOriginalName();
            $storage_path = \App\Global_var::repositoryPath();
            $file->move($storage_path, $filename);
            $file_path=$storage_path.$filename;
            $file_size = File::size($file_path);//Storage::size($file_path);
            //convert to KB
            $file_size=round(($file_size/1024), 2);
        }

        $publisher=$document_edition->publisher;
        $publisher->name=$request->name;
        $publisher->yearOfEstablishment=$request->yearOfEstablishment;
        $publisher->email=$request->publisher_email;
        $publisher->phoneNumber=$request->publisher_phoneNumber;
        $publisher->updatedByUserId=Auth::guard('web')->user()->id;
        if($request->publisherId==null)
            $publisher->save();

        if($file_path!=''){
            $document_edition->path=$file_path;
            $document_edition->sizeInBytes=$file_size;
            $document_edition->uploadedDateTime=(new \App\Date_class)->getCurrentDate();
            }

        $document_edition->publisherId=$request->publisherId!=null? $request->publisherId: $publisher->id;
        $document_edition->yearOfPublishment=$request->yearOfPublishment;
        $document_edition->description=$request->description;
        $document_edition->updatedByUserId=Auth::guard('web')->user()->id;
        $document_edition->save();        

        \App\Global_var::logAction($request, 'Updated new edition '.$document_edition->edition.' of dcument '.$document->title.'. Size: '.$file_size.' KBytes');

        return redirect()->route("documents.show", $document->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id, Request $request)
    {        
    $document=document::find($id);
       if($request->ajax())
        return view('documents.ajax.delete-confirm')->with('document', $document);
        
        return view('documents.http.delete-confirm')->with('document', $document);
    }

 public function destroy($id, Request $request)
    {   
        $document=document::find($id);

        /*$document->shares()->detach();
        $document->editions()->detach();
        $document->publishers()->detach();
        $document->configuredRole_Resources()->detach();*/

        //$document_editions=document_edition::where('isDeleted', 'false')->whereIn('id', $document->editions->pluck('id'))->get();
        foreach ($document->editions as $document_edition) {
            //$document_edition->delete();
            $this->destroy_edition($document_edition->id, $request);
        }

        //$document->delete();
        $document->isDeleted="true";
        $document->save();

        \App\Global_var::logAction($request, 'Deleted document ID: '.$document->id.' Title: '.$document->title);
        return redirect()->route('documents.index');
    }

    public function delete_edition($editionId, Request $request)
    {        
    $document_edition=document_edition::find($editionId);
       if($request->ajax())
        return view('documents.ajax.delete-confirm_edition')->with('document_edition', $document_edition);
        
        return view('documents.http.delete-confirm_edition')->with('document_edition', $document_edition);
    }

     public function destroy_edition($editionId, Request $request)
        {   
        $document_edition=document_edition::find($editionId);
        //$document_edition->delete();
        //$document_edition->delete();
        $document_edition->isDeleted="true";
        $document_edition->save();

        \App\Global_var::logAction($request, 'Deleted document edition ID: '.$document_edition->id);
        return redirect()->route('documents.show', $editionId);
        }
 
}
