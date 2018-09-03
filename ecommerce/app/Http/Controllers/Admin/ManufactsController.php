<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\DataTables\ManufactsDatatable;
use Illuminate\Http\Request;
use App\Model\Manufact;
use Storage;
class ManufactsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ManufactsDatatable $manufact)
    {
        return $manufact->render('admin.manufacts.index',['title'=>trans('admin.manufacts')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.manufacts.add_manufact',['title'=>trans('admin.manufacts')]);
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
            'manufact_name_ar'=>'required',
            'manufact_name_en'=>'required',
            'facebook'=>'sometimes|nullable|url',
            'address'=>'sometimes|nullable',
            'twitter'=>'sometimes|nullable|url',
            'website'=>'sometimes|nullable|url',
            'mobile'=>'required|numeric',
            'email'=>'required|email',
            'contact_name'=>'sometimes|nullable|string',
            'lat'=>'sometimes|nullable',
            'lng'=>'sometimes|nullable',
            'logo'=>'sometimes|nullable|'.v_image(),
        ],
        [],[
            'manufact_name_ar'=>trans('admin.manufact_name_ar'),
            'manufact_name_en'=>trans('admin.manufact_name_en'),
            'facebook'=>trans('admin.facebook'),
            'address'=>trans('admin.address'),
            'mobile'=>trans('admin.mobile'),
            'email'=>trans('admin.email'),
            'twitter'=>trans('admin.twitter'),
            'website'=>trans('admin.website'),
            'contact_name'=>trans('admin.contact_name'),
            'lat'=>trans('admin.lat'),
            'lng'=>trans('admin.lng'),
            'logo'=>trans('admin.manufact_logo'),
        ]);
        if(request()->hasFile('logo')){
            $data['logo']=up()->upload([
                'file'=>'logo',
                'path'=>'Manufacts',
                'delete_file'=>null,
                'upload_type'=>'single',
            ]);
        }
        Manufact::create($data);
        Session()->flash('added',trans('admin.record_added'));
        return redirect(aurl('manufacts'));
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
        $manufact=Manufact::find($id);
        $title=trans('admin.manufacts');
        return view('admin.manufacts.edit',compact('manufact','title'));
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
            'manufact_name_ar'=>'required',
            'manufact_name_en'=>'required',
            'facebook'=>'sometimes|nullable|url',
            'address'=>'sometimes|nullable',
            'twitter'=>'sometimes|nullable|url',
            'website'=>'sometimes|nullable|url',
            'mobile'=>'required|numeric',
            'email'=>'required|email',
            'contact_name'=>'sometimes|nullable|string',
            'lat'=>'sometimes|nullable',
            'lng'=>'sometimes|nullable',
            'logo'=>'sometimes|nullable|'.v_image(),
        ],
        [],[
            'manufact_name_ar'=>trans('admin.manufact_name_ar'),
            'manufact_name_en'=>trans('admin.manufact_name_en'),
            'facebook'=>trans('admin.facebook'),
            'address'=>trans('admin.address'),
            'mobile'=>trans('admin.mobile'),
            'email'=>trans('admin.email'),
            'twitter'=>trans('admin.twitter'),
            'website'=>trans('admin.website'),
            'contact_name'=>trans('admin.contact_name'),
            'lat'=>trans('admin.lat'),
            'lng'=>trans('admin.lng'),
            'logo'=>trans('admin.manufact_logo'),
        ]);
        if(request()->hasFile('logo')){
            $data['logo']=up()->upload([
                'file'=>'logo',
                'path'=>'Manufacts',
                'delete_file'=>Manufact::find($id)->logo,
                'upload_type'=>'single',
            ]);
        }
        Manufact::where('id',$id)->update($data);
        Session()->flash('added',trans('admin.record_updated'));
        return redirect(aurl('manufacts'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $manufact=Manufact::find($id);
        Storage::delete($manufact->logo);
        $manufact->delete();
        Session()->flash('added',trans('admin.record_deleted'));
        return redirect(aurl('manufacts'));
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
                $manufact=Manufact::find($id);
                Storage::delete($manufact->logo);
                $manufact->delete();
            }
        }else{
            $manufact=Manufact::find(request('item'));
            Storage::delete($manufact->logo);
            $manufact->delete();
        }
        Session()->flash('added',trans('admin.record_deleted'));
        return redirect(aurl('manufacts'));
    }
}
