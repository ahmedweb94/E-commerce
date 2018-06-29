<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\DataTables\CountriesDatatable;
use Illuminate\Http\Request;
use App\Model\Country;
use Storage;
class CountriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CountriesDatatable $country)
    {
        return $country->render('admin.countries.index',['title'=>trans('admin.country')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.countries.add_country',['title'=>trans('admin.add_country')]);
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
            'country_name_ar'=>'required',
            'country_name_en'=>'required',
            'mob'=>'required',
            'code'=>'required',
            'logo'=>'required|'.v_image(),
        ],
        [],[
            'country_name_ar'=>trans('admin.country_name_ar'),
            'country_name_en'=>trans('admin.country_name_en'),
            'mob'=>trans('admin.mob'),
            'code'=>trans('admin.code'),
            'logo'=>trans('admin.country_logo'),
        ]);
        if(request()->hasFile('logo')){
            $data['logo']=up()->upload([
                'file'=>'logo',
                'path'=>'Countries',
                'delete_file'=>null,
                'upload_type'=>'single',
            ]);
        }
        Country::create($data);
        Session()->flash('added',trans('admin.record_added'));
        return redirect(aurl('countries'));
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
        $country=Country::find($id);
        $title=trans('admin.edit_country');
        return view('admin.countries.edit',compact('country','title'));
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
            'country_name_ar'=>'required',
            'country_name_en'=>'required',
            'mob'=>'required',
            'code'=>'required',
            'logo'=>'sometimes|nullable|'.v_image(),
        ],
        [],[
            'country_name_ar'=>trans('admin.country_name_ar'),
            'country_name_en'=>trans('admin.country_name_en'),
            'mob'=>trans('admin.mob'),
            'code'=>trans('admin.code'),
            'logo'=>trans('admin.country_logo'),
        ]);
        if(request()->hasFile('logo')){
            $data['logo']=up()->upload([
                'file'=>'logo',
                'path'=>'Countries',
                'delete_file'=>Country::find($id)->logo,
                'upload_type'=>'single',
            ]);
        }
        Country::where('id',$id)->update($data);
        Session()->flash('added',trans('admin.record_updated'));
        return redirect(aurl('countries'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $country=Country::find($id);
        Storage::delete($country->logo);
        $country->delete();
        Session()->flash('added',trans('admin.record_deleted'));
        return redirect(aurl('countries'));
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
                $country=Country::find($id);
                Storage::delete($country->logo);
                $country->delete();
            }
        }else{
            $country=Country::find(request('item'));
            Storage::delete($country->logo);
            $country->delete();
        }
        Session()->flash('added',trans('admin.record_deleted'));
        return redirect(aurl('countries'));
    }
}
