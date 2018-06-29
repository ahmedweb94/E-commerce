<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Setting;
use Storage;

class Settings extends Controller
{
    public function setting(){
    	return view('admin.setting',['title'=>trans('admin.setting')]);
    }
    public function save_setting(){
    	$data=$this->validate(request(),[
    		'logo'=>v_image(),
    		'icon'=>v_image(),
    		'keyword'=>'',
    		'description'=>'',
    		'status'=>'',
    		'sitename_en'=>'',
    		'sitename_ar'=>'',
    		'email'=>'',
    		'message_maintenance'=>'',
    		'main_lang'=>'',
    	],[],[
    		'logo'=>trans('admin.logo'),
    		'icon'=>trans('admin.icon'),
    	]);
      if(request()->hasFile('logo')){
      	$data['logo']=up()->upload([
      		'file'=>'logo',
      		'path'=>'settings',
      		'delete_file'=>setting()->logo,
      		'upload_type'=>'single',
      	]);
      }
      if(request()->hasFile('icon')){
      	$data['icon']=up()->upload([
      		'file'=>'icon',
      		'path'=>'settings',
      		'delete_file'=>setting()->icon,
      		'upload_type'=>'single',
      	]);
      }
      Setting::orderBy('id','desc')->update($data);
      Session()->flash('added',trans('admin.setting_save'));
      return redirect(aurl('setting'));
    }
}
