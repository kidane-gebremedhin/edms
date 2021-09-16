<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Resource;
use App\General;
use DB;
use Auth;
use Carbon\Carbon;
use App\Role;
use App\Global_var;
use App\shared_document_edition;
use App\document;
use App\user;
use DateTime;
use Andegna;
use Session;
use Storage;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $paginationSize;
    
    public function __construct()
    {
        $this->middleware('auth:web', ['except'=>['getLiveCount', 'showWelcomePage']]);
     
     $this->paginationSize=DB::table('settings')->first()!=null? DB::table('settings')->first()->paginationSize: 10;        
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    

/*---NEW---*/
public function approvals_intro(Request $request){
    if($request->ajax())
        return view('users.ajax.approvals_intro');
    return view('users.http.approvals_intro');
    }
public function upload_video(Request $request){ 
             $data=$request->all();
              $rules=[
                'video'          =>'mimes:mpeg,ogg,mp4,webm,3gp,mov,flv,avi,wmv,ts|max:100040|required'];
             $validator = Validator($data,$rules);

             if ($validator->fails()){
                 return redirect()
                             ->back()
                             ->withErrors($validator)
                             ->withInput();
             }else{
                        $video=$data['video'];
                        $input = time().$video->getClientOriginalExtension();
                        $destinationPath = 'uploads/videos';
                        $video->move($destinationPath, $input);

                            $user['video']       =$input;
                            $user['created_at']  =date('Y-m-d h:i:s');
                            $user['updated_at']  =date('Y-m-d h:i:s');
                            $user['user_id']     =session('user_id');
                            DB::table('user_videos')->insert($user);
                            return redirect()->back()->with('upload_success','upload_success');
                    }
}
 public function upload(Request $request)
    {
        if($request->hasFile('file')){
            $file = $request->file('file');
            $filename = $file->getClientOriginalName();
            $path = \App\Global_var::repositoryPath();
            return $file->move($path, $filename);
        }

    }
public function generateDocx()
    {
        $phpWord = new \PhpOffice\PhpWord\PhpWord();

        $section = $phpWord->addSection();


        $description = "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
proident, sunt in culpa qui officia deserunt mollit anim id est laborum.";


        $section->addImage("http://itsolutionstuff.com/frontTheme/images/logo.png");
        $section->addText($description);


        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        try {
            $objWriter->save(storage_path('/app/public/new_dir/helloWorld22.docx'));
        } catch (Exception $e) {
        }


        return response()->download(storage_path('/app/public/new_dir/helloWorld22.docx'));
    }
/*---END OF NEW---*/



    public function generateReportByDateInterval(Request $request){
        $startDate=$request->startDate;
        $endDate=$request->endDate;
        $nextUrl=$request->nextUrl;
        $category=$request->category;
        /*if($startDate>$endDate)
            return ['error', 'Negative_Date_Interval'];*/
        Session::put("startDate", $startDate);
        Session::put("endDate", $endDate);
        Session::put("category", $category);
        /*echo $startDate." ".$endDate."<br>";
        echo "<br>From Session<br>";
        echo Session::get('startDate')." ".Session::get('endDate')."<br>";
        dd($nextUrl);*/
        return redirect($nextUrl);
    }

    public function showWelcomePage(Request $request){
        /*to authenticate*/
        //return redirect("/login");
        //return redirect()->route('documents.playlist');
        return redirect()->route('documents.playlist_categories');
    }   

    public function manageMore(Request $request){
        $roleId=Auth::guard('web')->user()!=null? (Auth::guard('web')->user()->role!=null? Auth::guard('web')->user()->role->id: 0): 0;
        $role=Role::find($roleId);
         $resources=$role->resources_menuLevel_2;
        if($request->ajax())
        return view('resources.ajax.manageMore')->withResources($resources);
        
        return view('resources.http.manageMore')->withResources($resources);
    }

    public function manageMore_3rdLevel(Request $request){
        $roleId=Auth::guard('web')->user()!=null? (Auth::guard('web')->user()->role!=null? Auth::guard('web')->user()->role->id: 0): 0;
        $role=Role::find($roleId);
         $resources=$role->resources_menuLevel_3;
        if($request->ajax())
        return view('resources.ajax.manageMore')->withResources($resources);
        
        return view('resources.http.manageMore')->withResources($resources);
    }

    public function dashboardData()
    {
/*        $eth_date = new Andegna\DateTime(new DateTime());
        // $year = $eth_date->format('d/m/Y');
        $year = explode('/',$eth_date->format('d/m/Y'));
        
    $currentUser=Auth::guard('web')->user();
    $ksi_mezgebIds=array();
    
    foreach ($currentUser->ksi_mezgeb_brkitat() as $ksi_mezgeb_brki) {
        
        if(!\App\Global_var::isWithIn_One_YearInterval($ksi_mezgeb_brki))
          continue;

        if($ksi_mezgeb_brki->ksi_mezgeb!=null){
            if(!Global_var::existsInArray($ksi_mezgebIds, $ksi_mezgeb_brki->ksi_mezgeb->id))
                  array_push($ksi_mezgebIds, $ksi_mezgeb_brki->ksi_mezgeb->id);
        }
    }
    $ksi_mezgebat=ksi_mezgeb::whereIn('id', $ksi_mezgebIds)->get();
        $ksiMezgeb=[];
        $ksiMezgebClosed=[];
        $ksiMezgebAppeal=[];
        $ksiMezgebNotDecided=[];

        $ksiZtemesretelom=[];
        $bezhiAkabiHgiZretalu=[];
        $bezhiBAkabiHgiZtedegefu=[];
        $bezhiAkabiHgiZretalomYgbeaniMezagbti=[];
        $bezhiKebedtiMezagbti=[];
        $bezhiKttlZtegeberelomKebedtiMezagbti=[];
        //Ksi Mezgeb
        foreach ($ksi_mezgebat as $ksi_mezgeb) {
            if(!Global_var::existsInArray($ksiMezgeb, $ksi_mezgeb))
            array_push($ksiMezgeb,  $ksi_mezgeb);
            if($ksi_mezgeb->crimeWeight=="Medium_And_Havy"){
            if(!Global_var::existsInArray($bezhiKebedtiMezagbti, $ksi_mezgeb))
                array_push($bezhiKebedtiMezagbti, $ksi_mezgeb);
            if($ksi_mezgeb->is_followed_up=="true"){
            if(!Global_var::existsInArray($bezhiKttlZtegeberelomKebedtiMezagbti, $ksi_mezgeb))
                array_push($bezhiKttlZtegeberelomKebedtiMezagbti, $ksi_mezgeb);
            }
            }

            foreach ($ksi_mezgeb->ksi_mezgeb_brkitat as $ksi_mezgeb_brki) {
                if(!$currentUser->isAdmin() && !$currentUser->isZone_Admin() && !$currentUser->brkiAllowsAction($ksi_mezgeb_brki->brkiId))
                    continue;
                
                foreach ($ksi_mezgeb_brki->crimes as $crime) {
                if($ksi_mezgeb_brki->isDirect()){
                    if($crime->akabiHgi_decisionType!=null && (($crime->akabiHgi_decisionType->name=="መረዳእታ ብዘይምርካብ ዝተዓፀወ" && $crime->afterCrimeCommited=='Crime_Commited') || $crime->akabiHgi_decisionType->name=="ተጠርጣሪ ብምስኣን ዝተዓፀወ")){
                    if(!Global_var::existsInArray($ksiMezgebClosed, $ksi_mezgeb))
                        array_push($ksiMezgebClosed, $ksi_mezgeb);
                }
                if($ksi_mezgeb_brki->isDecidedBy_betFrdi(null, null)){
                    if($crime->betFrdiDesisionType!=null && $crime->betFrdiDesisionType->name=="ጥፍኣት"){
                    if(!Global_var::existsInArray($bezhiAkabiHgiZretalu, $ksi_mezgeb))
                        array_push($bezhiAkabiHgiZretalu, $ksi_mezgeb);
                    }
                }
                else{
                    if(!Global_var::existsInArray($ksiMezgebNotDecided, $ksi_mezgeb))
                        array_push($ksiMezgebNotDecided,  $ksi_mezgeb);
                }


                if($crime->akabiHgi_decisionType!=null && $crime->akabiHgi_decisionType->name=="ክሲ ዝተመስረቶ"){
                    if(!Global_var::existsInArray($ksiZtemesretelom, $ksi_mezgeb))
                        array_push($ksiZtemesretelom, $ksi_mezgeb);
                }
                }

            if(!$ksi_mezgeb_brki->isDirect()){
                if(($currentUser->isAdmin() || $currentUser->isZone_Admin()) || $currentUser->brkiAllowsAction($ksi_mezgeb_brki->brkiId)){
                    if(!Global_var::existsInArray($ksiMezgebAppeal, $ksi_mezgeb))
                        array_push($ksiMezgebAppeal,  $ksi_mezgeb);
                    if($crime->lawyerSupportStatus=="Supported"){
                    if(!Global_var::existsInArray($bezhiBAkabiHgiZtedegefu, $ksi_mezgeb))
                        array_push($bezhiBAkabiHgiZtedegefu,  $ksi_mezgeb);
                    }
                    if($crime->betFrdiDesisionType!=null && $crime->betFrdiDesisionType->name=="ጥፍኣት"){
                    if(!Global_var::existsInArray($bezhiAkabiHgiZretalomYgbeaniMezagbti, $ksi_mezgeb))
                        array_push($bezhiAkabiHgiZretalomYgbeaniMezagbti,  $ksi_mezgeb);
                    }
                    
                }
                }
            }
            
        }
        }
    $ksi_mezgebIds=array();
    
    foreach ($currentUser->ftabher_mezgeb_brkitat() as $ksi_mezgeb_brki) {
       
        if(!\App\Global_var::isWithIn_One_YearInterval($ksi_mezgeb_brki))
          continue;

        if($ksi_mezgeb_brki->ksi_mezgeb!=null){
            if(!Global_var::existsInArray($ksi_mezgebIds, $ksi_mezgeb_brki->ksi_mezgeb->id))
                  array_push($ksi_mezgebIds, $ksi_mezgeb_brki->ksi_mezgeb->id);
        }
    }
    
    $ksi_mezgebat=ftabher_mezgeb::whereIn('id', $ksi_mezgebIds)->get();

        $ftabherMezgeb=[];
        $ftabherMezgebClosed=[];
        $ftabherMezgebAppeal=[];
        $ftabherMezgebNotDecided=[];

        $ftabher_ksiZtemesretelom=[];
        $ftabher_bezhiAkabiHgiZretalu=[];
        $ftabher_bezhiBAkabiHgiZtedegefu=[];
        $ftabher_bezhiAkabiHgiZretalomYgbeaniMezagbti=[];
        //Ftabher Mezgeb
        foreach ($ksi_mezgebat as $ksi_mezgeb) {
            if(!Global_var::existsInArray($ftabherMezgeb, $ksi_mezgeb))
            array_push($ftabherMezgeb,  $ksi_mezgeb);
        foreach ($ksi_mezgeb->ksi_mezgeb_brkitat as $ksi_mezgeb_brki) {
                if(!$currentUser->isAdmin() && !$currentUser->isZone_Admin() && !$currentUser->brkiAllowsAction($ksi_mezgeb_brki->brkiId))
                    continue;
                
                foreach ($ksi_mezgeb_brki->crimes as $crime) {
                if($ksi_mezgeb_brki->isDirect()){
                    if($crime->akabiHgi_decisionType!=null && $crime->akabiHgi_decisionType->keyWord=="Insufficient_To_Accuse"){
                    if(!Global_var::existsInArray($ftabherMezgebClosed, $ksi_mezgeb))
                        array_push($ftabherMezgebClosed,  $ksi_mezgeb);
                    }
                if($ksi_mezgeb_brki->isDecidedBy_betFrdi(null)){
                    if($crime->betFrdiDesisionType!=null && $crime->betFrdiDesisionType->keyWord=="Guilty"){
                    if(!Global_var::existsInArray($ftabher_bezhiAkabiHgiZretalu, $ksi_mezgeb))
                        array_push($ftabher_bezhiAkabiHgiZretalu, $ksi_mezgeb);
                    }
                }
                else{
                    if(!Global_var::existsInArray($ftabherMezgebNotDecided, $ksi_mezgeb))
                        array_push($ftabherMezgebNotDecided,  $ksi_mezgeb);
                }
                
                if($crime->akabiHgi_decisionType!=null && $crime->akabiHgi_decisionType->name=="ክሲ ዝተመስረቶ"){
                    if(!Global_var::existsInArray($ftabher_ksiZtemesretelom, $ksi_mezgeb))
                        array_push($ftabher_ksiZtemesretelom, $ksi_mezgeb);
                }

                }

            if(!$ksi_mezgeb_brki->isDirect()){
                if(($currentUser->isAdmin() || $currentUser->isZone_Admin()) || $currentUser->brkiAllowsAction($ksi_mezgeb_brki->brkiId)){
                    if(!Global_var::existsInArray($ftabherMezgebAppeal, $ksi_mezgeb))
                        array_push($ftabherMezgebAppeal,  $ksi_mezgeb);
                    if($crime->lawyerSupportStatus=="Supported"){
                    if(!Global_var::existsInArray($ftabher_bezhiBAkabiHgiZtedegefu, $ksi_mezgeb))
                        array_push($ftabher_bezhiBAkabiHgiZtedegefu,  $ksi_mezgeb);
                    }
                    if($crime->betFrdiDesisionType!=null && $crime->betFrdiDesisionType->keyWord=="Guilty"){
                    if(!Global_var::existsInArray($ftabher_bezhiAkabiHgiZretalomYgbeaniMezagbti, $ksi_mezgeb))
                        array_push($ftabher_bezhiAkabiHgiZretalomYgbeaniMezagbti,  $ksi_mezgeb);
                    }
                    
                }
                }
                }
        }
        }
*/        

        $data=array(
                    'ksiMezgeb' => [],//$ksiMezgeb, 
                    'ksiMezgebClosed' => [],//$ksiMezgebClosed, 
                    'ksiMezgebAppeal' => [],//$ksiMezgebAppeal, 
                    'ksiMezgebNotDecided' => [],//$ksiMezgebNotDecided,

                    'ksiZtemesretelom' => [],//$ksiZtemesretelom,
                    'bezhiAkabiHgiZretalu' => [],//$bezhiAkabiHgiZretalu,
                    'bezhiBAkabiHgiZtedegefu' => [],//$bezhiBAkabiHgiZtedegefu,
                    'bezhiAkabiHgiZretalomYgbeaniMezagbti' => [],//$bezhiAkabiHgiZretalomYgbeaniMezagbti,
                    'bezhiKebedtiMezagbti' => [],//$bezhiKebedtiMezagbti,
                    'bezhiKttlZtegeberelomKebedtiMezagbti' => [],//$bezhiKttlZtegeberelomKebedtiMezagbti,


                    'ftabherMezgeb' => [],//$ftabherMezgeb, 
                    'ftabherMezgebClosed' => [],//$ftabherMezgebClosed, 
                    'ftabherMezgebAppeal' => [],//$ftabherMezgebAppeal, 
                    'ftabherMezgebNotDecided' => [],//$ftabherMezgebNotDecided,
   
                    'ftabher_ksiZtemesretelom' => [],//$ftabher_ksiZtemesretelom,
                    'ftabher_bezhiAkabiHgiZretalu' => [],//$ftabher_bezhiAkabiHgiZretalu,
                    'ftabher_bezhiBAkabiHgiZtedegefu' => [],//$ftabher_bezhiBAkabiHgiZtedegefu,
                    'ftabher_bezhiAkabiHgiZretalomYgbeaniMezagbti' => [],//$ftabher_bezhiAkabiHgiZretalomYgbeaniMezagbti,
                     );

    return $data;
    }

    public function index(Request $request)
    {
        /*Storage::makeDirectory('public/new_dir');
        return Storage::allFiles('public');
        $this->generateDocx();*/
//Log::channel('my_app')->info('Visited Dashboard');

        $dashboardData = $this->dashboardData(); 
        $ksiMezgeb = 0;//ksi_mezgeb::get()->count(); 
        $ksiMezgebNotDecided = 0;//ksi_mezgeb::get()->count(); 
        $ksiMezgebAppeal = 0;//ksi_mezgeb::get()->count(); 
        $ksiMezgebClosed = 0;//ksi_mezgeb::get()->count();

        $ftabherMezgeb = 0;//ftabher_mezgeb::get()->count(); 
        $ftabherMezgebNotDecided = 0;//ftabher_mezgeb::get()->count(); 
        $ftabherMezgebAppeal = 0;//ftabher_mezgeb::get()->count(); 
        $ftabherMezgebClosed = 0;//ftabher_mezgeb::get()->count(); 

     \App\Global_var::logAction($request, 'Visited Dashboard');

       if($request->ajax())
        return view('dashboards.ajax.home')
                ->with('dashboardData',$dashboardData)
                ->with('ksiMezgeb',$ksiMezgeb)
                ->with('ksiMezgebNotDecided',$ksiMezgebNotDecided)
                ->with('ksiMezgebAppeal',$ksiMezgebAppeal)
                ->with('ksiMezgebClosed',$ksiMezgebClosed)
                ->with('ftabherMezgeb',$ftabherMezgeb)
                ->with('ftabherMezgebNotDecided',$ftabherMezgebNotDecided)
                ->with('ftabherMezgebAppeal',$ftabherMezgebAppeal)
                ->with('ftabherMezgebClosed',$ftabherMezgebClosed);

        return view('dashboards.http.home')
                ->with('dashboardData',$dashboardData)
                ->with('ksiMezgeb',$ksiMezgeb)
                ->with('ksiMezgebNotDecided',$ksiMezgebNotDecided)
                ->with('ksiMezgebAppeal',$ksiMezgebAppeal)
                ->with('ksiMezgebClosed',$ksiMezgebClosed)
                ->with('ftabherMezgeb',$ftabherMezgeb)
                ->with('ftabherMezgebNotDecided',$ftabherMezgebNotDecided)
                ->with('ftabherMezgebAppeal',$ftabherMezgebAppeal)
                ->with('ftabherMezgebClosed',$ftabherMezgebClosed);
    }


public function getLiveCount(){
$currentUser=Auth::guard('web')->user();
if($currentUser!=null){

$documents=document::where('isDeleted', 'false')->where('isApproved', 'true');
$total_documents=collect($documents->get());
$permitted_documents=$total_documents->filter(function($document){
    $currentUser=Auth::guard('web')->user();//requires own local variable
    return $currentUser->isGranted_ID('documents.show', $document->id);
});

$video_documents = $permitted_documents->filter(function($document){
    return $document->category=='Video';
});//->where('category', 'Video');
$audio_documents = $permitted_documents->filter(function($document){
    return $document->category=='Audio';
});//$documents->where('category', 'Audio');
$image_documents = $permitted_documents->filter(function($document){
    return $document->category=='Image';
});//$documents->where('category', 'Image');
$news_paper_documents = $permitted_documents->filter(function($document){
    return $document->category=='News_Paper';
});//$documents->where('category', 'News_Paper');
$magazine_documents = $permitted_documents->filter(function($document){
    return $document->category=='Magazine';
});//$documents->where('category', 'Magazine');
$book_documents = $permitted_documents->filter(function($document){
    return $document->category=='Book';
});//$documents->where('category', 'Book');
$text_document_documents = $permitted_documents->filter(function($document){
    return $document->category=='Text_Document';
});//$documents->where('category', 'Text_Document');


$total_users=user::where('isDeleted', 'false')->where('isApproved', 'true')->get();
$new_documents = document::where('isDeleted', 'false');
$users = user::where('isDeleted', 'false');
$unapproved_users_and_documents = count($users->where('isApproved', 'false')->get()) + count($new_documents->where('isApproved', 'false')->get());

    $user=$currentUser;
    $unviwedInboxMessages=$user->unviwedInboxMessages;

$unviewed_shared_document_editions=$currentUser->sharedInbox_document_editions;
if($currentUser->isAdmin()){
    //$shared_documentIds=shared_document_edition::where('isViewedByAdmin', 'false')->pluck('documentId');
    $unviewed_shared_document_editions=shared_document_edition::where('isViewedByAdmin', 'false')->get();//document::whereIn('id', $shared_documentIds)->get();
}

$unviewed_shared_document_editions->map(function($shared_doc){
    return [
            'document'=>$shared_doc->document,
            'shared_by_user'=>$shared_doc->sharedByUser,
            ];
});

   $dashboardData=$this->dashboardData();
    $data = array(
        'unviewed_shared_document_editions' => $unviewed_shared_document_editions ,
        'unviwedInboxMessages' => $unviwedInboxMessages,
        'total_users' => count($total_users),
        'unapproved_users_and_documents' => $unapproved_users_and_documents,
        'total_documents' => count($permitted_documents),
        'video_documents' => count($video_documents),
        'audio_documents' => count($audio_documents),
        'image_documents' => count($image_documents),
        'news_paper_documents' => count($news_paper_documents),
        'magazine_documents' => count($magazine_documents),
        'book_documents' => count($book_documents),
        'text_document_documents' => count($text_document_documents),
        );
    return $data;
}
}
}
