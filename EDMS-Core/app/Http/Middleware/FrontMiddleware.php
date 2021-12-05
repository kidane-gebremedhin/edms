<?php

namespace App\Http\Middleware;

use Closure;
use Cookie;
use App\User;
use App\Role;
use App\Resource;
use App\Action_index_data;
use App\Setting;
use Carbon\Carbon;
use App\General;
use App\Logo;
use App\department;
use App\country;
use App\kebelle;
use App\tabya;
use App\wereda;
use App\zone;
use App\region;
use Auth;
use Session;

class FrontMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        $this->insertSystemEntities();
        $ip=$request->ip();
        if($ip=='127.0.0.1'){
            //return $next($request);
        }
        else{
            //echo "Ip is not allowed!";
        }

        $loggedUser=\App\Global_var::currentUser();
        
        if(!$loggedUser->isPublic() && $loggedUser->changedPassword!='true'){
                Session::flash('danger', 'You have to change your default password.');
                return redirect()->route('users.manageAccounts', $loggedUser->id);
        }

        if($loggedUser!=null && !$loggedUser->isAllowed_ToAccess($request)){
                //write unauthorized access attempt by $loggedUser->id log here
                \Session::flash('danger', 'Attempt for unauthorized access!');
                return redirect()->route('403');
            }

            Session::put('selectedLang', \Cookie::get('selectedLang')!=null && \Cookie::get('selectedLang')!=''? \Cookie::get('selectedLang'):'eng');

        return $next($request);

    }
    
    function insertSystemEntities(){
          //inserts all resources and routes in to resources table to be managed
        if(Resource::all()->first()==null && Resource::all()->last()==null){
        $this->insertResources();
        }
  /*role creation preceeds user creation*/
        $this->setSystemElementsIfNotExisted();

        $setting=Setting::first();
        if($setting==null){  
        $setting=new Setting;
        $setting->save();
        }

        $logo=Logo::first();
        if($logo==null){  
        $logo=new Logo;
        $logo->save();
        $configured='true';
        }

$admin_structure = array('ኢትዮጵያ' => [
                                        'ትግራይ'=>[
                                              'መቐለ'=>[
                                                'ሓድነት'=>[
                                                    'ኣይናለም'=>[
                                                      'ሓርጉሸ', 'ዳግያ', 'ሻፋት',
                                                    ],
                                                ],
                                                ],
                                                'ምብራቕ'=>[
                                                  'ጋንታ ኣፈሹም'=>[
                                                      'ብኮት'=>[
                                                        'ንሕቢ', 'ማይ ኣብኣ', 'ብኮት',
                                                      ],
                                                      'ሓጓ ኣረጋ'=>[
                                                        'ኣረጋ', 'ሓጓ', 'ቆላ ኣረጋ',
                                                      ],
                                                  ],
                                                ],
                                            ],
                                          ]);
      $country=country::first();
      if($country==null){  
        foreach($admin_structure as $countryName=>$regions){
          $country=$this->insert_country($countryName);
        foreach($regions as $regionName=>$zones){
          $region=$this->insert_region($country, $regionName); 
        foreach($zones as $zoneName=>$weredas){
          $zone=$this->insert_zone($region, $zoneName); 
        foreach($weredas as $weredaName=>$tabyas){
          $wereda=$this->insert_wereda($zone, $weredaName); 
        foreach($tabyas as $tabyaName=>$kebelles){
          $tabya=$this->insert_tabya($wereda, $tabyaName); 
        foreach($kebelles as $kebelleName){
          $kebelle=$this->insert_kebelle($tabya, $kebelleName);           
        }
        }
        }
        }
        }
        }
      }

/*--department*/
      $department=department::first();
      if($department==null){  
      /*uses default department defined in migration*/      
       $departments=array('Dept 1', 'Dept 2', 'Dept 3');
         $id=1;
         foreach($departments as $name){
          $department=new department;
          $department->id=$id++;
          $department->name=$name;
          $department->createdByUserId='0';
          $department->save();
        }
      }

        $this->createRolesIfNotExisted();
        $this->createUsersIfNotExisted();
    }

public function insert_kebelle($tabya, $name){
          $kebelle=new kebelle;
          $kebelle->regionId=$tabya->wereda!=null && $tabya->wereda->zone!=null && $tabya->wereda->zone->region!=null? $tabya->wereda->zone->region->id:0;
          $kebelle->zoneId=$tabya->wereda!=null && $tabya->wereda->zone!=null? $tabya->wereda->zone->id:0;
          $kebelle->weredaId=$tabya->wereda!=null? $tabya->wereda->id:0;
          $kebelle->tabyaId=$tabya->id;
          $kebelle->name=$name;
          $kebelle->createdByUserId='0';
          $kebelle->save();
}
public function insert_tabya($wereda, $name){
          $tabya=new tabya;
          $tabya->regionId=$wereda->zone!=null && $wereda->zone->region!=null? $wereda->zone->region->id:0;
          $tabya->zoneId=$wereda->zone!=null? $wereda->zone->id:0;
          $tabya->weredaId=$wereda->id;
          $tabya->name=$name;
          $tabya->createdByUserId='0';
          $tabya->save();
          return $tabya;
}
public function insert_wereda($zone, $name){
          $wereda=new wereda;
          $wereda->regionId=$zone->region!=null? $zone->region->id:0;
          $wereda->zoneId=$zone->id;
          $wereda->name=$name;
          $wereda->createdByUserId='0';
          $wereda->save();
          return $wereda;
}
public function insert_zone($region, $name){
          $zone=new zone;
          $zone->regionId=$region->id;
          $zone->name=$name;
          $zone->createdByUserId='0';
          $zone->save();
          return $zone;
}
public function insert_region($country, $name){
          $region=new region;
          $region->countryId=$country->id;
          $region->name=$name;
          $region->createdByUserId='0';
          $region->save();
          return $region;
}
public function insert_country($name){
          $country=new country;
          $country->name=$name;
          $country->createdByUserId='0';
          $country->save();

          return $country;
}

public function createUsersIfNotExisted(){
        $user=User::first();
        if($user==null){
          $user=new User;
        $user->id=1;
        $user->firstName="admin";
        $user->lastName="admin";
        $user->middleName="admin";

        $user->roleId=Role::orderBy('id')->first()!=null? Role::orderBy('id')->first()->id: 1;//grants highest privilages
        $user->departmentId=department::orderBy('id', 'desc')->first()!=null? department::orderBy('id', 'desc')->first()->id: 0;
        $user->createdByUserId=0;
        $user->email="admin@gmail.com";
        $user->userName="admin12";
        $user->phoneNumber='0919054098';
        $user->password=bcrypt('aA#12345');
        $user->status='active';
        $user->isApproved='true';
        $user->save();
    }
}
public function createRolesIfNotExisted(){
        
$role=Role::first();
if($role==null){
    $roles = array(
        'superadmin'=>'System Admin',
        'ICT Head'=>'ICT Head',
        'Library Head'=>'Head of Library',
        'Data Entry'=>'Data Entry Personnel',
        'User'=>'End Users',
        'Public'=>'Guests',
        );
    $id=1;
    foreach ($roles as $roleName => $remark) {
        $role=new Role;
            $role->id=$id++;
            $role->roleName=$roleName;
            $role->remark=$remark;
            $role->createdByUserId=0;
            $role->save();
        }
      }
    }


    public function setSystemElementsIfNotExisted(){
        /*--General*/
        $general=General::first();
        if($general==null){  
      /*uses default general defined in migration*/      
        $general=new General;
        $general->save();
        $configured='true';
      }  
  }

  public function insertResources(){
        /*NB: the number in the array refers 1 to Main-Menu and 2 for Sub-Menu*/
        $resources = array(
          //CRUD
          'users' => array('true', 2, 'users'),           
          'roles' => array('true', 2, 'roles'),           
          'documents' => array('true', 2, 'documents'),           
          'language_strings' => array('true', 2, 'language_strings'),           
          'settings' => array('true', 2, 'settings'),           
            
            //ACTION        
          'approve_new_user' => array('false', 2, 'users.approveNewUser'), 
          'approve_new_document' => array('false', 2, 'documents.approveNewDocument'), 
          'change_user_status' => array('false', 2, 'users.changeStatus'), 
          'permissions_save' => array('false', 2, 'permissions.save'), 
          'logs_all' => array('false', 2, 'logs.logsAll'), 
          //'clear_logs' => array('false', 2, 'logs.clearLogs'), 
          'logo_update' => array('false', 2, 'logo.logo_update'), 
          'Total_documents_report' => array('false', 2, 'Total_documents_report'), 
          'Take_Backup' => array('false', 2, 'backup'), 

            /*UI Therms*/
          /*'Back-End Logo' => 'backEndLogo.index',
          'Moto' => 'logo.index',
          'Logo Image' => 'logoImage.index'*/
           );
        $id=1;
        foreach ($resources as $entityName => $arr) {
          $resource=new Resource;
          $resource->id=$id++;
          $resource->entityName=$entityName;
          $resource->is_crud=$arr[0];
          $resource->menuLevel=$arr[1];
          $resource->routeName=$arr[2];
          $resource->save();
        }
      }

}
