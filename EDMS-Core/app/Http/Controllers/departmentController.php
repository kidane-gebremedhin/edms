<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\department;
use Auth;
use DB;

class departmentController extends Controller
{
    public $paginationSize;

    public function __construct(){
        $this->middleware('auth:web');
    
     $this->paginationSize=DB::table('settings')->first()!=null? DB::table('settings')->first()->paginationSize: 10;        

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
       
       $departments=department::orderBy("id", "desc")->paginate($this->paginationSize);

    \App\Global_var::logAction($request, 'Viewed department ID '.$department->id.' details');
    if($request->ajax())
        return view("departments.ajax.index")->with('departments', $departments);

       return view("departments.http.index")->with('departments', $departments);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
public function create(Request $request){
    
        
    if($request->ajax())
        return view('departments.ajax.create');

        return view('departments.http.create');
    }


    /**
     * Stock a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'=>'required'
            ]);
 $department=department::where('name', '=', $request->name)->first();
        if($department!=null){
            if($request->ajax())
                return ['error', "Duplicate_Entry"];
            return back();
        }
        $department=new department;
        $department->name=$request->name;
        $department->remark=$request->remark;
        $department->createdByUserId=Auth::guard('web')->user()->id;
        $department->save();
    \App\Global_var::logAction($request, 'Created new department ID '.$department->id);
        return redirect()->route("departments.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
        $department=department::find($id);
    \App\Global_var::logAction($request, 'Viewed department ID '.$department->id.' details');
        if($request->ajax())
            return view("departments.ajax.show")->with('department', $department);
        return view("departments.http.show")->with('department', $department);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
    $department=department::find($id);
        
    if($request->ajax())
        return view('departments.ajax.edit')->with('department', $department);

        return view('departments.http.edit')->with('department', $department);
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
        $department=department::where('name', '=', $request->name)->first();
        if($department!=null && $department->id!=$id){
            if($request->ajax())
                return ['error', "Duplicate_Entry"];
            return back();
        }

       $this->validate($request, [
            'name'=>'required'
            ]);
        $department=department::find($id);
        $department->name=$request->name;
        $department->remark=$request->remark;
        $department->updatedByUserId=Auth::guard('web')->user()->id;
        $department->save();

    \App\Global_var::logAction($request, 'Updated department ID '.$department->id.'');
   return redirect()->route("departments.show", $id);
   }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id, Request $request)
    {
       $department=department::find($id);
       if($request->ajax())
        return view('departments.ajax.delete-confirm')->with('department', $department);
        
        return view('departments.http.delete-confirm')->with('department', $department);
    }
    public function destroy($id)
    {
        $department=department::find($id);
        $department->delete();

    \App\Global_var::logAction($request, 'Deleted department ID '.$department->id);
        return redirect()->route('departments.index');
    }

}
