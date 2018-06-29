<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Department;
use Storage;
class DepartmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return view('admin.departments.index',['title'=>trans('admin.departments')]);
   }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.departments.add_department',['title'=>trans('admin.add_department')]);
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
            'dep_name_ar'=>'required',
            'dep_name_en'=>'required',
            'parent'=>'sometimes|nullable|numeric',
            'icon'=>'sometimes|nullable|'.v_image(),
            'keyword'=>'sometimes|nullable',
            'description'=>'sometimes|nullable',
            
        ],
        [],[
            'dep_name_ar'=>trans('admin.dep_name_ar'),
            'dep_name_en'=>trans('admin.dep_name_en'),
            'parent'=>trans('admin.parent'),
            'keyword'=>trans('admin.keyword'),
            'description'=>trans('admin.description'),
            'icon'=>trans('admin.icon'),
        ]);
        if(request()->hasFile('icon')){
            $data['icon']=up()->upload([
                'file'=>'icon',
                'path'=>'Departments',
                'delete_file'=>null,
                'upload_type'=>'single',
            ]);
        }
        Department::create($data);
        Session()->flash('added',trans('admin.record_added'));
        return redirect(aurl('departments'));
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
        $department=Department::find($id);
        $title=trans('admin.departments');
        return view('admin.departments.edit',compact('department','title'));
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
            'dep_name_ar'=>'required',
            'dep_name_en'=>'required',
            'parent'=>'sometimes|nullable|numeric',
            'icon'=>'sometimes|nullable|'.v_image(),
            'keyword'=>'sometimes|nullable',
            'description'=>'sometimes|nullable',
            
        ],
        [],[
            'dep_name_ar'=>trans('admin.dep_name_ar'),
            'dep_name_en'=>trans('admin.dep_name_en'),
            'parent'=>trans('admin.parent'),
            'keyword'=>trans('admin.keyword'),
            'description'=>trans('admin.description'),
            'icon'=>trans('admin.icon'),
            
        ]);
        if(request()->hasFile('icon')){
            $data['icon']=up()->upload([
                'file'=>'icon',
                'path'=>'Departments',
                'delete_file'=>Department::find($id)->icon,
                'upload_type'=>'single',
            ]);
        }

        Department::where('id',$id)->update($data);
        Session()->flash('added',trans('admin.record_updated'));
        return redirect(aurl('departments'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public static function delete_parent($id){
        $department_parent=Department::where('parent',$id)->get();
        foreach ($department_parent as $sub) {
            self::delete_parent($sub->id);
            if(!empty($sub->icon)){
                Storage::has($sub->icon)?Storage::delete($sub->icon):'';
            }
            $sub_dep=Department::find($sub->id);
            if(!empty($sub_dep)){
                $sub_dep->delete();
            }
        }
        $dep= Department::find($id);
        if(!empty($dep->icon)){
            Storage::has($dep->icon)?Storage::delete($dep->icon):'';
        }
        $dep->delete();
    }
    public function destroy($id)
    {
        self::delete_parent($id);
        Session()->flash('added',trans('admin.record_deleted'));
        return redirect(aurl('departments'));
    }

}
