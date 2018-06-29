<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\DataTables\AdminDatatable;
use Illuminate\Http\Request;
use App\Admin;
class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(AdminDatatable $admin)
    {
        return $admin->render('admin.admins.index',['title'=>trans('admin.admin_admins')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('admin.admins.add_admin',['title'=>trans('admin.add_admin')]);
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
            'email'=>'required|email|unique:admins',
            'password'=>'required|min:5',
        ],
        [],[
            'name'=>trans('admin.admin_name'),
            'email'=>trans('admin.admin_email'),
            'password'=>trans('admin.admin_password'),
        ]);
        $data['password']=bcrypt(request('password'));
        Admin::create($data);
        Session()->flash('added',trans('admin.record_added'));
        return redirect(aurl('admin'));
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
        $admin=Admin::find($id);
        $title=trans('admin.edit_admin');
        return view('admin.admins.edit',compact('admin','title'));
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
            'email'=>'required|email|unique:admins,email,'.$id,
            'password'=>'sometimes|nullable|min:5',
        ],
        [],[
            'name'=>trans('admin.admin_name'),
            'email'=>trans('admin.admin_email'),
            'password'=>trans('admin.admin_password'),
        ]);
        if (request()->has('password')) {
            $data['password']=bcrypt(request('password'));            
        }
        Admin::where('id',$id)->update($data);
        Session()->flash('added',trans('admin.record_updated'));
        return redirect(aurl('admin'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Admin::find($id)->delete();
        Session()->flash('added',trans('admin.record_deleted'));
        return redirect(aurl('admin'));
    }

    /**
     * Multi Remove the specified resource from storage.
     *
     * @param  int array-> $id
     * @return \Illuminate\Http\Response
     */
    public function multi_delete(){
        if (is_array(request('item'))) {
            Admin::destroy(request('item'));
        }else{
            Admin::find(request('item'))->delete();
        }
        Session()->flash('added',trans('admin.record_deleted'));
        return redirect(aurl('admin'));
    }
}
