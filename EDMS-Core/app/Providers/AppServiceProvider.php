<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
 use Illuminate\Contracts\View\View;
use Auth;
use Session;
use DB;

class AppServiceProvider extends ServiceProvider
{
    public static $language_strings=null;
    public function boot()
    {
        Schema::defaultStringLength(191);

        // Fetch the Language Settings object
        view()->composer('*', function(View $view) {
            if(true/*Session::get('strings_loaded')!='true'*/){
                Session::put('strings_loaded', 'true');
                AppServiceProvider::$language_strings=\App\language_string::orderBy('id', 'desc')->get();
            
            Session::put('language_strings', AppServiceProvider::$language_strings);
            }

            $currentUser=\App\Global_var::currentUser(); 
            $selectedLang=Session::get('selectedLang');
            $logo=\App\Logo::orderBy('id', 'desc')->first();
            $document_categories=\App\Global_var::documentCategories();
            $document_sub_categories=\App\Global_var::documentSub_categories();


       $years=\App\Global_var::years();
       $authors=\App\Global_var::authors();
       $publishers=\App\Global_var::publishers();

        // \Cookie::queue('language_strings', $language_strings->where('keyWord', '=', 'english')->first(), \App\Global_var::$cookieLifeTime);
            $view->with('language_strings', /*AppServiceProvider::$language_strings*/Session::get('language_strings'))->with('selectedLang', $selectedLang)->with('global_var', new \App\Global_var)->with('currentUser', $currentUser)->with('logo', $logo)->with('categories', $document_categories)->with('sub_categories', $document_sub_categories)->with('years', $years)->with('authors', $authors)->with('publishers', $publishers);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
