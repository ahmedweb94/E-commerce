<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Admin;
use App\Mail\AdminResetPassword;
use DB;
use Carbon\Carbon;
use Mail;
class AdminAuth extends Controller
{
    public function login(){

    	return view('admin.login');

    }
    public function dologin(){
    	$remember=request('remember') ==1?true:false;
    	if(admin()->attempt(['email'=>request('email'),'password'=>request('password')],$remember)){
               return redirect('admin');
    	}
    	else{
    		Session()->flash('error',trans('admin.login_error_message'));
    		return redirect('admin/login');
    	}

    }
    public function logout(){
    	auth()->guard('admin')->logout();
    	return redirect('admin/login');
    }
    public function forgot_password(){
    	return view('admin.forgot_password');
    }
    public function forgot_password_post(){
    	$admin= Admin::where('email',request('email'))->first();
    	if(!empty($admin)){
    		$token=app('auth.password.broker')->createToken($admin);
    		$data=DB::table('password_resets')->insert([
    			'email'=>$admin->email,
    			'token'=>$token ,
    			'created_at'=> Carbon::now(),
    		]);
    		Mail::to($admin->email)->send(new AdminResetPassword(['data'=>$admin, 'token'=>$token]));
    		Session()->flash('success',trans('admin.link_reset_sent'));
    		return back();
    	}
    	return back();
    }
    public function reset_password($token){
    	$check_token=DB::table('password_resets')->where('token',$token)->where('created_at','>',Carbon::now()->subHours(2))->first();
    	if(!empty($check_token)){
    		return view('admin.reset_password',['data'=>$check_token]);
    	}else{
    		return redirect(aurl('forgot/password'));
    	}
    }
    public function reset_password_final($token){
    	request()->validate(['password'=>'required|confirmed',
                              'password_confirmation'=>'required',
                          ]);
    	$check_token=DB::table('password_resets')->where('token',$token)->where('created_at','>',Carbon::now()->subHours(2))->first();
    	if(!empty($check_token)){
    		$admin=Admin::where('email',$check_token->email)->update(['password'=>bcrypt(request('password'))]);
    		DB::table('password_resets')->where('email',request('email'))->delete();
    		admin()->attempt(['email'=>$check_token->email,'password'=>request('password')],true);
            return redirect(aurl());
    	}else{
    		return redirect(aurl('forgot/password'));
    	}
    }
}