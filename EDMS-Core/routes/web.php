<?php
//to serve files frm storage_path
//Artisan::call('storage:link', [] );

Route::get('/read_log', function () {
    // Read File

    $jsonString = file_get_contents(storage_path('/logs/app_log.log'));
    $logsArr=explode(',|', $jsonString);
    $sliced=substr($jsonString, 0, strpos($jsonString, '}}{')+2);
    $data = json_decode(($sliced), true);

foreach ($logsArr as $log) {
	$data = json_decode(($log), true);
}
// dd($logsArr);
// dd(($data['created_at']));

/*    // Update Key

    $data['country.title'] = "Change Manage Country";



    // Write File

    $newJsonString = json_encode($data, JSON_PRETTY_PRINT);

    file_put_contents(storage_path('/logs/app_log.log'), stripslashes($newJsonString));



    // Get Key Value

    dd(__('country.title'));*/

});

/*Route::get('/linkstorage', function () { $targetFolder = base_path().'/storage/app/public'; $linkFolder = $_SERVER['DOCUMENT_ROOT'].'/storage'; symlink($targetFolder, $linkFolder); });*/

Route::get('/public-login', 'Auth\LoginController@public_login_form')->name('public_login');
Route::post('/public-login', 'Auth\LoginController@public_login')->name('public_login');
Route::post('/sign_up', 'UserController@sign_up')->name('sign_up');
Route::get('language_interpreter/{keyWord?}', 'Language_stringController@language_interpreter')->name('language_interpreter');

Route::get('/users_manageAccounts/{id?}', 'UserController@manageAccountsPage')->name('users.manageAccounts');
Route::post('/users_manageAccounts/{id?}', 'UserController@manageAccounts')->name('users.manageAccounts');
Route::post('/user_mannual/{selectedLang?}', 'UserController@user_mannual')->name('users.user_mannual');

Route::middleware(['Front'])->group(function () {


//documents 
Route::get('stream_media/{editionId}', 'documentController@streamMedia')->name('stream_media');
Route::get('stream_text_image/{editionId}', 'documentController@streamText_Image')->name('stream_text_image');
Route::get('stream_text_image_base64/{editionId}', 'documentController@streamText_Image_Base64')->name('stream_text_image_base64');

Route::get('read_user_mannual/{lang?}', 'documentController@read_user_mannual')->name('read_user_mannual');
Route::get('streamUser_Mannual/{lang?}', 'documentController@streamUser_Mannual')->name('streamUser_Mannual');

Route::get('/new_documents', 'documentController@newDocuments')->name('documents.newDocuments');
Route::get('/rejected_documents', 'documentController@rejectedDocuments')->name('documents.rejectedDocuments');
Route::get('/documents-play/{editionId}', 'documentController@play')->name('documents.play');
Route::get('/documents-playlist/{category?}', 'documentController@playlist')->name('documents.playlist');
Route::get('/playlist_categories/{category?}', 'documentController@playlist_categories')->name('documents.playlist_categories');

Route::get( '/documents-download/{editionId}', 'documentController@download')->name('documents.download');
Route::get('/documents-create', 'documentController@create')->name('documents.create');
Route::get('/documents-show/{id}', 'documentController@show')->name('documents.show');
Route::get('/documents-edit/{id}', 'documentController@edit')->name('documents.edit');
Route::post('/documents-update/{id}', 'documentController@update')->name('documents.update');
Route::get('/documents-index/{category?}', 'documentController@index')->name('documents.index');
Route::post('/documents-store', 'documentController@store')->name('documents.store');
Route::get('/documents-confirm_delete/{id}', 'documentController@delete')->name('documents.delete');
Route::get('/documents-destroy/{id}', 'documentController@destroy')->name('documents.destroy');
Route::get('/documents-share/{id}', 'documentController@share')->name('documents.share');
Route::post('/documents-share/{id}', 'documentController@sharePost')->name('documents.share');

Route::get('/documents-create_edition/{documentId}', 'documentController@create_edition')->name('documents.create_edition');
Route::post('/documents-store_edition/{documentId}', 'documentController@store_edition')->name('documents.store_edition');
Route::get('/documents-edit_edition/{id}', 'documentController@edit_edition')->name('documents.edit_edition');
Route::post('/documents-update_edition/{id}', 'documentController@update_edition')->name('documents.update_edition');
Route::get('/documents-confirm_delete_edition/{id}', 'documentController@delete_edition')->name('documents.delete_edition');
Route::get('/documents-destroy_edition/{id}', 'documentController@destroy_edition')->name('documents.destroy_edition');

Route::get('/make_shared_documents_viewed/{id}', 'documentController@make_shared_documents_viewed')->name('documents.make_shared_documents_viewed');

/*
//medias 
Route::get('/medias-create', 'mediaController@create')->name('medias.create');
Route::get('/medias-show/{id}', 'mediaController@show')->name('medias.show');
Route::get('/medias-edit/{id}', 'mediaController@edit')->name('medias.edit');
Route::post('/medias-update/{id}', 'mediaController@update')->name('medias.update');
Route::get('/medias-index', 'mediaController@index')->name('medias.index');
Route::post('/medias-store', 'mediaController@store')->name('medias.store');
Route::get('/medias-confirm_delete/{id}', 'mediaController@delete')->name('medias.delete');
Route::get('/medias-destroy/{id}', 'mediaController@destroy')->name('medias.destroy');*/

Route::post('upload', 'mediaController@upload')->name('upload');
Route::get('stream_video', 'mediaController@streamVideo')->name('stream_video');
Route::get('stream_audio', 'mediaController@streamAudio')->name('stream_audio');
/*
Route::get('stream_media/{editionId}', 'mediaController@streamMedia')->name('stream_media');
Route::get('stream_text_image/{editionId}', 'mediaController@streamText_Image')->name('stream_text_image');
*/
/*  new routes*/



Route::get('/medias-create', 'mediaController@create')->name('medias.create');


Route::get('/403', 'Controller@error_403')->name('403');
Route::get('/generateReportByDateInterval', 'HomeController@generateReportByDateInterval')->name('generateReportByDateInterval');

Route::get('/backup', 'BackupController@backup')->name('backup');

/*---Excel Reports--------*/

Route::post('/importExcel', 'ExportExcelController@importExcel')->name('importExcel');
Route::get('/reports_index', 'ExportExcelController@reports_index')->name('reports_index');

Route::get('/export_excel/', 'ExportExcelController@index')->name('export_excel');
Route::get('/export_excel/{type}', 'ExportExcelController@excel')->name('export_excel.excel');
Route::get('/Total_documents_report/{type?}', 'ExportExcelController@Total_documents_report')->name('Total_documents_report');
/*---end of Reports ---*/

Route::get('/language_strings-create', 'Language_stringController@create')->name('language_strings.create');
Route::post('/language_strings-store', 'Language_stringController@store')->name('language_strings.store');
Route::get('/language_strings-edit', 'Language_stringController@edit')->name('language_strings.edit');
Route::post('/language_strings-update', 'Language_stringController@update')->name('language_strings.update');


Route::get('/changeLanguage/{lang}', 'Language_stringController@changeLanguage')->name('language_strings.changeLanguage');

//logs 
Route::get('/clearLogs_confirmation', 'logsController@clearLogs_confirmation')->name('logs.clearLogs_confirmation');
Route::get('/clearLogs', 'logsController@clearLogs')->name('logs.clearLogs');
Route::get('/logsAll', 'logsController@logsAll')->name('logs.logsAll');

//departments 
Route::get('/departments-create', 'departmentController@create')->name('departments.create');
Route::get('/departments-show/{id}', 'departmentController@show')->name('departments.show');
Route::get('/departments-edit/{id}', 'departmentController@edit')->name('departments.edit');
Route::post('/departments-update/{id}', 'departmentController@update')->name('departments.update');
Route::get('/departments-index', 'departmentController@index')->name('departments.index');
Route::post('/departments-store', 'departmentController@store')->name('departments.store');
Route::get('/departments-confirm_delete/{id}', 'departmentController@delete')->name('departments.delete');
Route::get('/departments-destroy/{id}', 'departmentController@destroy')->name('departments.destroy');

//messages 
Route::get('/messages-create', 'messageController@create')->name('messages.create');
Route::get('/messages-show_inbox/{id}', 'messageController@show_inbox')->name('messages.show_inbox');
Route::get('/messages-show_outbox/{id}', 'messageController@show_outbox')->name('messages.show_outbox');
Route::get('/messages-edit/{id}', 'messageController@edit')->name('messages.edit');
Route::post('/messages-update/{id}', 'messageController@update')->name('messages.update');
Route::get('/messages-inbox/{userId}', 'messageController@inbox')->name('messages.inbox');
Route::get('/messages-outbox/{userId}', 'messageController@outbox')->name('messages.outbox');
Route::post('/messages-store', 'messageController@store')->name('messages.store');
Route::get('/messages-confirm_delete/{id}', 'messageController@delete')->name('messages.delete');
Route::get('/messages-destroy/{id}', 'messageController@destroy')->name('messages.destroy');

//roles 
Route::get('/roles-create', 'roleController@create')->name('roles.create');
Route::get('/roles-show/{id}', 'roleController@show')->name('roles.show');
Route::get('/roles-edit/{id}', 'roleController@edit')->name('roles.edit');
Route::post('/roles-update/{id}', 'roleController@update')->name('roles.update');
Route::get('/roles-index', 'roleController@index')->name('roles.index');
Route::post('/roles-store', 'roleController@store')->name('roles.store');
Route::get('/roles-confirm_delete/{id}', 'roleController@delete')->name('roles.delete');
Route::get('/roles-destroy/{id}', 'roleController@destroy')->name('roles.destroy');

Auth::routes();

Route::get('/', 'HomeController@showWelcomePage')->name('welcome');
Route::get('/setSystemElementsIfNotExisted', 'Auth\LoginController@setSystemElementsIfNotExisted');
Route::post('/user/logout', 'Auth\LoginController@logout')->name('user.logout');

/*blog Route*/
Route::get('/blogs-index', 'blogController@index')->name('blogs.index');
Route::get('/blogs-create', 'blogController@create')->name('blogs.create');
Route::get('/blogs-edit/{id}', 'blogController@edit')->name('blogs.edit');
Route::get('/blogs-show/{id}', 'blogController@show')->name('blogs.show');
Route::post('/blogs-store', 'blogController@store')->name('blogs.store');
Route::post('/blogs-update/{id}', 'blogController@update')->name('blogs.update');
Route::get('/blogs-confirm_delete/{id}', 'blogController@delete')->name('blogs.delete');
Route::get('/blogs-destroy/{id}', 'blogController@destroy')->name('blogs.destroy');

/*Route::get('/externalBlogsIndex', 'ShopController@externalBlogsIndex')->name('blogs.externalBlogsIndex');
Route::get('/externalBlogPage/{blogId}', 'ShopController@externalBlogPage')->name('blogs.externalBlogPage');
Route::get('/searchByKey/{key}', 'ShopController@searchByKey')->name('shop.searchByKey');


//About Route
Route::get('/abouts_externalAboutPage', 'ShopController@externalAboutPage')->name('abouts.externalAboutPage');
*/
Route::get('/abouts-index', 'aboutController@index')->name('abouts.index');
Route::get('/abouts-create', 'aboutController@create')->name('abouts.create');
Route::get('/abouts-edit/{id}', 'aboutController@edit')->name('abouts.edit');
Route::get('/abouts-show/{id}', 'aboutController@show')->name('abouts.show');
Route::post('/abouts-store', 'aboutController@store')->name('abouts.store');
Route::post('/abouts-update/{id}', 'aboutController@update')->name('abouts.update');
Route::get('/abouts-confirm_delete/{id}', 'aboutController@delete')->name('abouts.delete');
Route::get('/abouts-destroy/{id}', 'aboutController@destroy')->name('abouts.destroy');

/*----------OLD ROUTES-----------------------*/

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/resources/manage-more', 'HomeController@manageMore')->name('resources.manageMore');
Route::get('/resources/manageMore_3rdLevel', 'HomeController@manageMore_3rdLevel')->name('resources.manageMore_3rdLevel');

/*------------------USERS----------------------------------------------*/
Route::get('/new_users', 'UserController@newUsers')->name('users.newUsers');
Route::get('/rejected_users', 'UserController@rejectedUsers')->name('users.rejectedUsers');
Route::get('/users-index', 'UserController@index')->name('users.index');
Route::get('/users-create', 'UserController@create')->name('users.create');
Route::get('/users-edit/{id}', 'UserController@edit')->name('users.edit');
Route::get('/users-show/{id}', 'UserController@show')->name('users.show');
Route::post('/users-store', 'UserController@store')->name('users.store');
Route::post('/users-update/{id}', 'UserController@update')->name('users.update');
Route::get('/users-confirm_delete/{id}', 'UserController@delete')->name('users.delete');
Route::get('/users-destroy/{id}', 'UserController@destroy')->name('users.destroy');

Route::get('/users_getUser/{id}', 'UserController@getUser')->name('users.getUser');

Route::get('/approvals_intro', 'HomeController@approvals_intro')->name('approvals_intro');
Route::get('/approve_new_user/{id}/{approvalStatus}', 'UserController@approveNewUser')->name('users.approveNewUser');
Route::get('/approve_new_document/{id}/{approvalStatus}', 'documentController@approveNewDocument')->name('documents.approveNewDocument');
Route::get('/change_user_status/{id}', 'UserController@changeStatus')->name('users.changeStatus');
Route::get('/users_import', 'UserController@usersImport')->name('users.import');
Route::post('/users_import_post', 'UserController@usersImportPost')->name('users.import.post');


/*------------------permissionS----------------*/
Route::get('/approveDocumentPermissions/{id}', 'documentController@approveDocumentPermissions')->name('permissions.approveDocumentPermissions');
Route::get('/permissions_save/step1', 'permissionController@step1')->name('permissions.step1');
Route::get('/permissions_save/step2/{id}', 'permissionController@step2')->name('permissions.step2');
Route::get('/permissions_save/{actionType}', 'permissionController@savePermission')->name('permissions.save');
Route::get('/permissions_save/checkAll/{actionType}', 'permissionController@checkAllPermissions')->name('permissions.checkAll');
/*--document permissions--*/
Route::get('/document_role_permissions/{id}', 'permissionController@document_role_permissions')->name('permissions.document_role_permissions');
Route::get('/document_permissions_save/{actionType}', 'permissionController@saveDocumentPermission')->name('document_permissions_save.save');
Route::get('/document_permissions_save/checkAll/{actionType}', 'permissionController@checkAllDocumentPermissions')->name('document_permissions_save.checkAll');
/*--end of document permissions*/

/*---POPULATES SIDEBAR ----*/
Route::get('/list-permitted-resources', 'permissionController@listPermittedResources')->name('list.permitted.resources');

/*-------------------LOGO and IMAGE-------------*/
Route::post('/logo_update', 'logoController@update')->name('logo.logo_update');
Route::get('/logo_edit', 'logoController@edit')->name('logo.edit');
Route::get('/logo_show/{id}', 'logoController@show')->name('logo.show');

Route::get('/getLiveCount', 'HomeController@getLiveCount');
/*-------------------END OF COUNTERS-------------*/

Route::get('/settings-index', 'SettingController@index')->name('settings.index');
Route::post('/settings-update/{id}', 'SettingController@update')->name('settings.update');

//countries 
Route::get('/countries-create', 'countriesController@create')->name('countries.create');
Route::get('/countries-show/{id}', 'countriesController@show')->name('countries.show');
Route::get('/countries-edit/{id}', 'countriesController@edit')->name('countries.edit');
Route::post('/countries-update/{id}', 'countriesController@update')->name('countries.update');
Route::get('/countries-index', 'countriesController@index')->name('countries.index');
Route::post('/countries-store', 'countriesController@store')->name('countries.store');
Route::get('/countries-confirm_delete/{id}', 'countriesController@delete')->name('countries.delete');
Route::get('/countries-destroy/{id}', 'countriesController@destroy')->name('countries.destroy');

//regions 
Route::get('/regions-create', 'regionController@create')->name('regions.create');
Route::get('/regions-show/{id}', 'regionController@show')->name('regions.show');
Route::get('/regions-edit/{id}', 'regionController@edit')->name('regions.edit');
Route::post('/regions-update/{id}', 'regionController@update')->name('regions.update');
Route::get('/regions-index', 'regionController@index')->name('regions.index');
Route::post('/regions-store', 'regionController@store')->name('regions.store');
Route::get('/regions-confirm_delete/{id}', 'regionController@delete')->name('regions.delete');
Route::get('/regions-destroy/{id}', 'regionController@destroy')->name('regions.destroy');

//zones 
Route::get('/zones-create', 'zoneController@create')->name('zones.create');
Route::get('/zones-show/{id}', 'zoneController@show')->name('zones.show');
Route::get('/zones-edit/{id}', 'zoneController@edit')->name('zones.edit');
Route::post('/zones-update/{id}', 'zoneController@update')->name('zones.update');
Route::get('/zones-index', 'zoneController@index')->name('zones.index');
Route::post('/zones-store', 'zoneController@store')->name('zones.store');
Route::get('/zones-confirm_delete/{id}', 'zoneController@delete')->name('zones.delete');
Route::get('/zones-destroy/{id}', 'zoneController@destroy')->name('zones.destroy');

//weredas 
Route::get('/weredas-create', 'weredaController@create')->name('weredas.create');
Route::get('/weredas-show/{id}', 'weredaController@show')->name('weredas.show');
Route::get('/weredas-edit/{id}', 'weredaController@edit')->name('weredas.edit');
Route::post('/weredas-update/{id}', 'weredaController@update')->name('weredas.update');
Route::get('/weredas-index', 'weredaController@index')->name('weredas.index');
Route::post('/weredas-store', 'weredaController@store')->name('weredas.store');
Route::get('/weredas-confirm_delete/{id}', 'weredaController@delete')->name('weredas.delete');
Route::get('/weredas-destroy/{id}', 'weredaController@destroy')->name('weredas.destroy');

// Tabyas
Route::get('/tabyas-create', 'tabyaController@create')->name('tabyas.create');
Route::get('/tabyas-show/{id}', 'tabyaController@show')->name('tabyas.show');
Route::get('/tabyas-edit/{id}', 'tabyaController@edit')->name('tabyas.edit');
Route::post('/tabyas-update/{id}', 'tabyaController@update')->name('tabyas.update');
Route::get('/tabyas-index', 'tabyaController@index')->name('tabyas.index');
Route::post('/tabyas-store', 'tabyaController@store')->name('tabyas.store');
Route::get('/tabyas-confirm_delete/{id}', 'tabyaController@delete')->name('tabyas.delete');
Route::get('/tabyas-destroy/{id}', 'tabyaController@destroy')->name('tabyas.destroy');

// Kebelles
Route::get('/kebelles-create', 'KebelleController@create')->name('kebelles.create');
Route::get('/kebelles-show/{id}', 'KebelleController@show')->name('kebelles.show');
Route::get('/kebelles-edit/{id}', 'KebelleController@edit')->name('kebelles.edit');
Route::post('/kebelles-update/{id}', 'KebelleController@update')->name('kebelles.update');
Route::get('/kebelles-index', 'KebelleController@index')->name('kebelles.index');
Route::post('/kebelles-store', 'KebelleController@store')->name('kebelles.store');
Route::get('/kebelles-confirm_delete/{id}', 'KebelleController@delete')->name('kebelles.delete');
Route::get('/kebelles-destroy/{id}', 'KebelleController@destroy')->name('kebelles.destroy');
// filter
Route::get("/tabya_kebelles/{tabyaId}", "KebelleController@tabya_kebelles")->name("tabya_kebelles");
Route::get("/wereda_tabyas/{weredaId}", "KebelleController@wereda_tabyas")->name("wereda_tabyas");
Route::get("/wereda_subWeredas/{weredaId}", "KebelleController@wereda_subWeredas")->name("wereda_subWeredas");

Route::get("/region_zones/{regionId}", "KebelleController@region_zones")->name("region_zones");
Route::get("/zone_weredas/{zoneId}", "KebelleController@zone_weredas")->name("zone_weredas");
// UnAssigned user filter 
Route::get("/unAssigned_zone_weredas/{zoneId}", "KebelleController@unAssigned_zone_weredas")->name("unAssigned_zone_weredas");
Route::get("/unAssigned_wereda_tabyas/{weredaId}", "KebelleController@unAssigned_wereda_tabyas")->name("unAssigned_wereda_tabyas");
Route::get("/unAssigned_tabya_kebelles/{tabyaId}", "KebelleController@unAssigned_tabya_kebelles")->name("unAssigned_tabya_kebelles");


});