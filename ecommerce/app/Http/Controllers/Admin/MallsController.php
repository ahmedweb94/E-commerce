<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\DataTables\MallsDatatable;
use Illuminate\Http\Request;
use App\Model\Mall;
use Storage;
class MallsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(MallsDatatable $mall)
    {
        return $mall->render('admin.mall.index',['title'=>trans('admin.mall')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.mall.add_mall',['title'=>trans('admin.mall')]);
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
            'mall_name_ar'=>'required',
            'mall_name_en'=>'required',
            'facebook'=>'sometimes|nullable|url',
            'address'=>'sometimes|nullable',
            'twitter'=>'sometimes|nullable|url',
            'website'=>'sometimes|nullable|url',
            'mobile'=>'required|numeric',
            'email'=>'required|email',
            'country_id'=>'required|numeric',
            'contact_name'=>'sometimes|nullable|string',
            'lat'=>'sometimes|nullable',
            'lng'=>'sometimes|nullable',
            'logo'=>'sometimes|nullable|'.v_image(),
        ],
        [],[
            'mall_name_ar'=>trans('admin.mall_name_ar'),
            'mall_name_en'=>trans('admin.mall_name_en'),
            'facebook'=>trans('admin.facebook'),
            'address'=>trans('admin.address'),
            'mobile'=>trans('admin.mobile'),
            'email'=>trans('admin.email'),
            'country_id'=>trans('admin.country_id'),
            'twitter'=>trans('admin.twitter'),
            'website'=>trans('admin.website'),
            'contact_name'=>trans('admin.contact_name'),
            'lat'=>trans('admin.lat'),
            'lng'=>trans('admin.lng'),
            'logo'=>trans('admin.mall_logo'),
        ]);
        if(request()->hasFile('logo')){
            $data['logo']=up()->upload([
                'file'=>'logo',
                'path'=>'mall',
                'delete_file'=>null,
                'upload_type'=>'single',
            ]);
        }
        Mall::create($data);
        Session()->flash('added',trans('admin.record_added'));
        return redirect(aurl('mall'));
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
        $mall=Mall::find($id);
        $title=trans('admin.mall');
        return view('admin.mall.edit',compact('mall','title'));
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
            'mall_name_ar'=>'required',
            'mall_name_en'=>'required',
            'facebook'=>'sometimes|nullable|url',
            'address'=>'sometimes|nullable',
            'twitter'=>'sometimes|nullable|url',
            'website'=>'sometimes|nullable|url',
            'mobile'=>'required|numeric',
            'email'=>'required|email',
            'country_id'=>'required|numeric',
            'contact_name'=>'sometimes|nullable|string',
            'lat'=>'sometimes|nullable',
            'lng'=>'sometimes|nullable',
            'logo'=>'sometimes|nullable|'.v_image(),
        ],
        [],[
            'mall_name_ar'=>trans('admin.mall_name_ar'),
            'mall_name_en'=>trans('admin.mall_name_en'),
            'facebook'=>trans('admin.facebook'),
            'address'=>trans('admin.address'),
            'mobile'=>trans('admin.mobile'),
            'email'=>trans('admin.email'),
            'country_id'=>trans('admin.country_id'),
            'twitter'=>trans('admin.twitter'),
            'website'=>trans('admin.website'),
            'contact_name'=>trans('admin.contact_name'),
            'lat'=>trans('admin.lat'),
            'lng'=>trans('admin.lng'),
            'logo'=>trans('admin.mall_logo'),
        ]);
        if(request()->hasFile('logo')){
            $data['logo']=up()->upload([
                'file'=>'logo',
                'path'=>'mall',
                'delete_file'=>Mall::find($id)->logo,
                'upload_type'=>'single',
            ]);
        }
        Mall::where('id',$id)->update($data);
        Session()->flash('added',trans('admin.record_updated'));
        return redirect(aurl('mall'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $mall=Mall::find($id);
        Storage::delete($mall->logo);
        $mall->delete();
        Session()->flash('added',trans('admin.record_deleted'));
        return redirect(aurl('mall'));
    }

    /**
     * Multi Remove the specified resource from storage.
     *
     * @param  int array-> $id
     * @return \Illuminate\Http\Response
     */
    public function multi_delete(){
        if (is_array(request('item'))) {
            foreach (request('item') as $id) {
                $mall=Mall::find($id);
                Storage::delete($mall->logo);
                $mall->delete();
            }
        }else{
            $mall=Mall::find(request('item'));
            Storage::delete($mall->logo);
            $mall->delete();
        }
        Session()->flash('added',trans('admin.record_deleted'));
        return redirect(aurl('mall'));
    }
}
