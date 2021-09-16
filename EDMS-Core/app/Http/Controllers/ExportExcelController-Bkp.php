<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ksi_mezgeb;
use App\kesesti_ksi_mezgeb;
use App\tekesesti_ksi_mezgeb;
use App\archive_ksi_mezgeb;
use App\archive_kesesti_ksi_mezgeb;
use App\archive_tekesesti_ksi_mezgeb;
use App\Global_var;
use App\ksi_mezgeb_brki;
use App\User;
use App\kesesti_tekesasi;
use App\Document;
use Auth;
use DB;
use Excel;
use Session;
use Illuminate\Support\Collection;

class ExportExcelController extends Controller
{
  protected $currentUser;
  protected $cell_width_array=['A'=>5, 'B'=>5, 'C'=>5, 'D'=>5, 'E'=>5, 'F'=>5, 'G'=>5, 'H'=>5, 'I'=>5, 'J'=>5, 'K'=>5, 'L'=>5, 'M'=>5, 'N'=>5, 'O'=>5, 'P'=>5, 'Q'=>5, 'R'=>5, 'S'=>5, 'T'=>5, 'U'=>5, 'V'=>5, 'W'=>5, 'X'=>5, 'Y'=>5, 'Z'=>5, 'AA'=>5, 'AB'=>5, 'AC'=>5, 'AD'=>5, 'AE'=>5, 'AF'=>5, 'AG'=>5, 'AH'=>5, 'AI'=>5];
  protected $language_strings=null, $zones=null;
 
 public function __construct(){
        $this->middleware('auth:web');
    
     $this->paginationSize=DB::table('settings')->first()!=null? DB::table('settings')->first()->paginationSize: 10;        
    }

public function reports_index(Request $request){
  if($request->ajax())
        return view("Reports.ajax.index");

       return view("Reports.http.index");
}

  function index(Request $request)
  {
   $language_strings = DB::table('language_strings')->get();
   if($request->ajax())
    return view('excel.ajax.export_excel')->with('language_strings', $language_strings);
   return view('excel.http.export_excel')->with('language_strings', $language_strings);
  }

  function excel($type)
  {
   $language_strings = DB::table('language_strings')->get()->toArray();
   $strings_array[] = array('key_word', 'tigrigna', 'amharic', 'english');
   foreach($language_strings as $string)
   {
    $strings_array[] = array(
     'keyWord'   => $string->keyWord,
     'tig'    => $string->tig,
     'amh'  => $string->amh,
     'eng'   => $string->eng
    );
   }
   Excel::create('Language Strings Data', function($excel) use ($strings_array){
    $excel->setTitle('Language Strings Data');
    $excel->sheet('Strings Sheet 1', function($sheet) use ($strings_array){
     $sheet->fromArray($strings_array, null, 'A1', false, false);
    });
   })->download($type);
  }

public function importExcel(Request $request)
    {
    $this->validate($request, [
    'file_input' => 'required'
    ]);
    return $request->file('file_input');
    $path = $request->file('file_input')->getRealPath();
    $data = Excel::load($path)->get();
    if($data->count()){
    foreach ($data as $key => $value) {
    $arr[] = ['title' => $value->title, 'description' => $value->description];
    }
    if(!empty($arr)){
      foreach ($arr as $key => $value) {
        echo $key."=".$value."<br>";
      }
    //Item::insert($arr);
    }
    }
    return back()->with('success', 'Insert Record successfully.');
    }

 public function Total_documents_report($type='html', Request $request)
  {
    $language_strings=\App\language_string::orderBy('id', 'desc')->get();
   $all_documents = Document::where('isDeleted', 'false');
   $documents=collect($all_documents->get())->filter(function($document){
      if(\Session::get('category')!=null && $document->category!=\Session::get('category'))
        return false;
      return Global_var::isWithIn_DateInterval($document->uploadedDateTime);
    });
   $strings_array[] = array(Global_var::getLangString('Title', $language_strings), Global_var::getLangString('Category', $language_strings), Global_var::getLangString('Sub_category', $language_strings), Global_var::getLangString('Summery', $language_strings), Global_var::getLangString('Location', $language_strings), Global_var::getLangString('Uploaded_Date', $language_strings), Global_var::getLangString('Author', $language_strings), Global_var::getLangString('Views', $language_strings), Global_var::getLangString('Shares', $language_strings), Global_var::getLangString('Editions', $language_strings));
   foreach($documents as $document)
   {
$editions_data="No of Editions: ".count($document->editions);
foreach ($document->editions as $edition) {
  $editions_data=$editions_data."| Edition: ".$edition->edition." Publisher: ".$edition->publisher->name.' '.$edition->publisher->email.", Size: ".$edition->sizeInfo().", Views: ".$edition->views_count();

}

    $strings_array[] = array(
     'title'   => $document->title,
     'category'   => Global_var::getLangString($document->category, $language_strings),
     'subCategory'   => Global_var::getLangString($document->subCategory, $language_strings),
     'summery'   => $document->summery,
     'location'   => $document->location,
     'uploadedDateTime'   => $document->uploadedDateTime,
     'authorId'   => $document->author!=null? ($document->author->firstName.' '.$document->author->lastName.' '.$document->author->middleName):'',
     'views'   => $document->views(),
     'shares'   => count($document->shares),
     'Editions'   => $editions_data,
    );
   }

   if($type=="html"){
        $document_categories=\App\Global_var::documentCategories();
     if($request->ajax())
        return view("Reports.civil_cases.ajax.Show_Excel_Data")->with('excel_title', 'Total_documents_report')->with('strings_array', $strings_array)->with('document_categories', $document_categories);
      return view("Reports.civil_cases.http.Show_Excel_Data")->with('excel_title', 'Total_documents_report')->with('strings_array', $strings_array)->with('document_categories', $document_categories);
    }
   Excel::create('Documents Data', function($Total_documents_report) use ($strings_array){
    $Total_documents_report->setTitle('Documents Data');
    $Total_documents_report->sheet('Documents Sheet 1', function($sheet) use ($strings_array){
     $sheet->fromArray($strings_array, null, 'A1', false, false);
    });
   })->download($type);
  }


}

?>
