<?php
Route::group(['prefix'=>'admin','namespace'=>'Admin'], function(){

Config::set('auth.default','admin') ;

    Route::get('login','AdminAuth@login') ;
    Route::post('login','AdminAuth@dologin') ;
    Route::get('forgot/password','AdminAuth@forgot_password') ;
    Route::post('forgot/password','AdminAuth@forgot_password_post') ;
    Route::get('reset/password/{token}','AdminAuth@reset_password') ;
    Route::post('reset/password/{token}','AdminAuth@reset_password_final') ;
	Route::group(['middleware'=>'admin:admin'],function(){

			 Route::get('/', function(){
		 	 return view('admin.home');
		 	});
			 Route::any('logout','AdminAuth@logout');

			 Route::get('lang/{lang}',function($lang){
			 Session()->has('lang')?Session()->forget('lang'):'';
			 	$lang=='en'?Session()->put('lang','ar'): Session()->put('lang','ar');
			 	return back();
			 });
			 ////admins/////
			 Route::resource('admin','AdminController');
			 Route::delete('admin/destroy/all','AdminController@multi_delete');
			 ///users//////
			 Route::resource('users','UsersController');
			 Route::delete('users/destroy/all','UsersController@multi_delete');
			 /////////country//////
			 Route::resource('countries','CountriesController');
			 Route::delete('countries/destroy/all','CountriesController@multi_delete');
			 /////////cities//////
			 Route::resource('cities','CitiesController');
			 Route::delete('cities/destroy/all','CitiesController@multi_delete');
			 //////states//////////
			 Route::resource('states','StatesController');
			 Route::delete('states/destroy/all','StatesController@multi_delete');
			 //////departments///////////
 			 Route::resource('departments','DepartmentsController');
 			 /////////trademark//////
			 Route::resource('trademarks','TrademarksController');
			 Route::delete('trademarks/destroy/all','TrademarksController@multi_delete');
 			 
			 Route::get('setting','Settings@setting');
			 Route::post('setting','Settings@save_setting');

	});

});
