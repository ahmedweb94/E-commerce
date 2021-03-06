<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\DataTables\UsersDatatable;
use Illuminate\Http\Request;
use App\User;
class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(UsersDatatable $admin)
    {
        return $admin->render('admin.users.index',['title'=>trans('admin.admin_users')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('admin.users.add_admin',['title'=>trans('admin.add')]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data=request()->validate([
            'name'=>'required',
            'level'=>'required|in:user,vendor,company',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:5',
        ],
        [],[
            'name'=>trans('admin.name'),
            'level'=>trans('admin.level'),
              'email'=>trans('admin.email'),
              'password'=>trans('admin.password'),
               ]);
        $data['password']=bcrypt(request('password'));
        User::create($data);
        Session()->flash('added',trans('admin.record_added'));
        return redirect(aurl('users'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user=User::find($id);
        $title=trans('admin.edit');
        return view('admin.users.edit',compact('user','title'));
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
        $data=request()->validate([
            'name'=>'required',
            'level'=>'required|in:user,vendor,company',
            'email'=>'required|email|unique:users,email,'.$id,
            'password'=>'sometimes|nullable|min:5',
        ],
        [],[
            'name'=>trans('admin.name'),
            'level'=>trans('admin.level'),
              'email'=>trans('admin.email'),
              'password'=>trans('admin.password'),
               ]);
        if (request()->has('password')) {
        $data['password']=bcrypt(request('password'));            
        }
        User::where('id',$id)->update($data);
        Session()->flash('added',trans('admin.record_updated'));
        return redirect(aurl('users'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
         Session()->flash('added',trans('admin.record_deleted'));
        return redirect(aurl('users'));
    }

    /**
     * Multi Remove the specified resource from storage.
     *
     * @param  int array-> $id
     * @return \Illuminate\Http\Response
     */
    public function multi_delete(){
        if (is_array(request('item'))) {
            User::destroy(request('item'));
        }else{
            User::find(request('item'))->delete();
        }
        Session()->flash('added',trans('admin.record_deleted'));
        return redirect(aurl('users'));
    }
}
