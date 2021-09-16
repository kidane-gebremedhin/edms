<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\ሓፈሻዊ_ሓበሬታ_ነባሪ_ጣብያ;
use App\ኩነታት_መታወቅያ;
use App\ርክብ_ቤተሰብ;
use App\Tabya;
use Auth;
use DB;

class ReportController extends Controller
{
    public $paginationSize;

    public function __construct(){
        $this->middleware('auth:web');
    
     $this->paginationSize=DB::table('settings')->first()!=null? DB::table('settings')->first()->paginationSize: 10;        

    }

    public function ዝርዝር_ተጠቀምቲ_ምግቢ_ውሕስና(Request $request)
    {
        $logged_user=Auth::guard('web')->user();
        $tabyas=$logged_user->isAdmin()? DB::table('tabyas')->pluck('name', 'id')->toArray() : $logged_user->tabyas->pluck('name', 'id')->toArray();
      $ሓፈሻዊ_ሓበሬታ_ነበርቲ_ጣብያታት=ሓፈሻዊ_ሓበሬታ_ነባሪ_ጣብያ::orderBy('id', 'desc');
      
       if($request->ajax())
        return view("Reports.ዝርዝር_ተጠቀምቲ_ምግቢ_ውሕስና.ajax.ዝርዝር_ተጠቀምቲ_ምግቢ_ውሕስና")->withTabya(null)->withTabyas($tabyas)->withሓፈሻዊ_ሓበሬታ_ነበርቲ_ጣብያታት($ሓፈሻዊ_ሓበሬታ_ነበርቲ_ጣብያታት);

       return view("ዝርዝር_ተጠቀምቲ_ምግቢ_ውሕስና.http.ዝርዝር_ተጠቀምቲ_ምግቢ_ውሕስና")->withTabya(null)->withTabyas($tabyas)->withሓፈሻዊ_ሓበሬታ_ነበርቲ_ጣብያታት($ሓፈሻዊ_ሓበሬታ_ነበርቲ_ጣብያታት);
    }

public function ዝርዝር_ተጠቀምቲ_ምግቢ_ውሕስና_ajaxBody(Request $request, $tabyaId){
       $tabya=Tabya::find($tabyaId);
       $ሓፈሻዊ_ሓበሬታ_ነበርቲ_ጣብያታት=$tabya->ሓፈሻዊ_ሓበሬታ_ነበርቲ_ጣብያታት;

  if($request->ajax())
      return view('Reports.ዝርዝር_ተጠቀምቲ_ምግቢ_ውሕስና.ajax.ዝርዝር_ተጠቀምቲ_ምግቢ_ውሕስና_ajaxBody')->withሓፈሻዊ_ሓበሬታ_ነበርቲ_ጣብያታት($ሓፈሻዊ_ሓበሬታ_ነበርቲ_ጣብያታት)->withTabya($tabya);

      return view('Reports.ዝርዝር_ተጠቀምቲ_ምግቢ_ውሕስና.http.ዝርዝር_ተጠቀምቲ_ምግቢ_ውሕስና_ajaxBody')->withሓፈሻዊ_ሓበሬታ_ነበርቲ_ጣብያታት($ሓፈሻዊ_ሓበሬታ_ነበርቲ_ጣብያታት)->withTabya($tabya);
    }

public function ዝርዝር_ነበርቲ_ብፆታን_ዓይነት_ስራሕን(Request $request){
        $logged_user=Auth::guard('web')->user();
        $tabyas=$logged_user->isAdmin()? DB::table('tabyas')->pluck('name', 'id')->toArray() : $logged_user->tabyas->pluck('name', 'id')->toArray();
      $ሓፈሻዊ_ሓበሬታ_ነበርቲ_ጣብያታት=ሓፈሻዊ_ሓበሬታ_ነባሪ_ጣብያ::orderBy('id', 'desc');
        
  if($request->ajax())
      return view('Reportsዝርዝር_ነበርቲ_ብፆታን_ዓይነት_ስራሕን.ajax.ዝርዝር_ነበርቲ_ብፆታን_ዓይነት_ስራሕን')->withTabya($tabya)->withTabyas($tabyas)->withሓፈሻዊ_ሓበሬታ_ነበርቲ_ጣብያታት($ሓፈሻዊ_ሓበሬታ_ነበርቲ_ጣብያታት);

      return view('Reportsዝርዝር_ነበርቲ_ብፆታን_ዓይነት_ስራሕን.http.ዝርዝር_ነበርቲ_ብፆታን_ዓይነት_ስራሕን')->withTabya($tabya)->withTabyas($tabyas)->withሓፈሻዊ_ሓበሬታ_ነበርቲ_ጣብያታት($ሓፈሻዊ_ሓበሬታ_ነበርቲ_ጣብያታት);
    }

public function ዝርዝር_ነበርቲ_ብፆታን_ዓይነት_ስራሕን_ajaxBody(Request $request, $tabyaId){
       $tabya=Tabya::find($tabyaId);
       $ሓፈሻዊ_ሓበሬታ_ነበርቲ_ጣብያታት=$tabya->ሓፈሻዊ_ሓበሬታ_ነበርቲ_ጣብያታት;

  if($request->ajax())
      return view('Reports.ዝርዝር_ነበርቲ_ብፆታን_ዓይነት_ስራሕን.ajax.ዝርዝር_ነበርቲ_ብፆታን_ዓይነት_ስራሕን_ajaxBody')->withTabya($tabya)->withሓፈሻዊ_ሓበሬታ_ነበርቲ_ጣብያታት($ሓፈሻዊ_ሓበሬታ_ነበርቲ_ጣብያታት);

      return view('Reports.ዝርዝር_ነበርቲ_ብፆታን_ዓይነት_ስራሕን.http.ዝርዝር_ነበርቲ_ብፆታን_ዓይነት_ስራሕን_ajaxBody')->withTabya($tabya)->withሓፈሻዊ_ሓበሬታ_ነበርቲ_ጣብያታት($ሓፈሻዊ_ሓበሬታ_ነበርቲ_ጣብያታት);
    }

public function ዝርዝር_ነበርቲ_መለለይ_መንነት_ዝወሰዱ(Request $request){
        $logged_user=Auth::guard('web')->user();
        $tabyas=$logged_user->isAdmin()? DB::table('tabyas')->pluck('name', 'id')->toArray() : $logged_user->tabyas->pluck('name', 'id')->toArray();
        $tabyas_ids=$logged_user->isAdmin()? DB::table('tabyas')->pluck('id')->toArray() : $logged_user->tabyas->pluck('id')->toArray();
        $ኩነታት_መታወቅያ=ኩነታት_መታወቅያ::where('name', '=', 'ኣለዎ')->first();
        $ኩነታት_መታወቅያ_id=$ኩነታት_መታወቅያ!=null? $ኩነታት_መታወቅያ->id: '0';
      $ሓፈሻዊ_ሓበሬታ_ነበርቲ_ጣብያታት=ሓፈሻዊ_ሓበሬታ_ነባሪ_ጣብያ::whereIn('tabyaId', $tabyas_ids)->orderBy('id', 'desc')->get();
      $ኣባላት_ቤተሰብ=ርክብ_ቤተሰብ::where('kunetatMetawekiyaId', '=', $ኩነታት_መታወቅያ_id)->orderBy('id', 'desc')->get();
        
  if($request->ajax())
      return view('Reports.ዝርዝር_ነበርቲ_መለለይ_መንነት_ዝወሰዱ.ajax.ዝርዝር_ነበርቲ_መለለይ_መንነት_ዝወሰዱ')->withTabya(null)->withTabyas($tabyas)->withሓፈሻዊ_ሓበሬታ_ነበርቲ_ጣብያታት($ሓፈሻዊ_ሓበሬታ_ነበርቲ_ጣብያታት);

      return view('Reports.ዝርዝር_ነበርቲ_መለለይ_መንነት_ዝወሰዱ.http.ዝርዝር_ነበርቲ_መለለይ_መንነት_ዝወሰዱ')->withTabya(null)->withTabyas($tabyas)->withሓፈሻዊ_ሓበሬታ_ነበርቲ_ጣብያታት($ሓፈሻዊ_ሓበሬታ_ነበርቲ_ጣብያታት);
    }

public function ዝርዝር_ነበርቲ_መለለይ_መንነት_ዝወሰዱ_ajaxBody(Request $request, $tabyaId){
        $logged_user=Auth::guard('web')->user();
       $tabya=Tabya::find($tabyaId);
        $tabyas=$logged_user->isAdmin() ? DB::table('tabyas')->pluck('name', 'id')->toArray() : $logged_user->tabyas->pluck('name', 'id')->toArray();
        $tabyas_ids=$logged_user->isAdmin()? DB::table('tabyas')->pluck('id')->toArray() : $logged_user->tabyas->pluck('id')->toArray();
      $ኩነታት_መታወቅያ=ኩነታት_መታወቅያ::where('name', '=', 'ኣለዎ')->first();
        $ኩነታት_መታወቅያ_id=$ኩነታት_መታወቅያ!=null? $ኩነታት_መታወቅያ->id: '0';

      $ሓፈሻዊ_ሓበሬታ_ነበርቲ_ጣብያታት=$tabyaId>0 && $tabya!=null? $tabya->ሓፈሻዊ_ሓበሬታ_ነበርቲ_ጣብያታት : $ሓፈሻዊ_ሓበሬታ_ነበርቲ_ጣብያታት=ሓፈሻዊ_ሓበሬታ_ነባሪ_ጣብያ::whereIn('tabyaId', $tabyas_ids)->orderBy('id', 'desc')->get();
      $ኣባላት_ቤተሰብ=ርክብ_ቤተሰብ::where('kunetatMetawekiyaId', '=', $ኩነታት_መታወቅያ_id)->orderBy('id', 'desc')->get();

  if($request->ajax())
      return view('Reports.ዝርዝር_ነበርቲ_መለለይ_መንነት_ዝወሰዱ.ajax.ዝርዝር_ነበርቲ_መለለይ_መንነት_ዝወሰዱ_ajaxBody')->withTabya($tabya)->withTabyas($tabyas)->withሓፈሻዊ_ሓበሬታ_ነበርቲ_ጣብያታት($ሓፈሻዊ_ሓበሬታ_ነበርቲ_ጣብያታት);

      return view('Reports.ዝርዝር_ነበርቲ_መለለይ_መንነት_ዝወሰዱ.http.ዝርዝር_ነበርቲ_መለለይ_መንነት_ዝወሰዱ')->withTabya($tabya)->withTabyas($tabyas)->withሓፈሻዊ_ሓበሬታ_ነበርቲ_ጣብያታት($ሓፈሻዊ_ሓበሬታ_ነበርቲ_ጣብያታት);
    }



}
