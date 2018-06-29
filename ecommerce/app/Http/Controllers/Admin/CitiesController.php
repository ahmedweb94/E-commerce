<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\DataTables\CitiesDatatable;
use Illuminate\Http\Request;
use App\Model\City;
use Storage;
class CitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CitiesDatatable $city)
    {
        return $city->render('admin.cities.index',['title'=>trans('admin.city')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.cities.add_city',['title'=>trans('admin.add_city')]);
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
            'city_name_ar'=>'required',
            'city_name_en'=>'required',
            'country_id'=>'required|numeric',
            
        ],
        [],[
            'city_name_ar'=>trans('admin.city_name_ar'),
            'city_name_en'=>trans('admin.city_name_en'),
            'country_id'=>trans('admin.country_id'),
        ]);
        City::create($data);
        Session()->flash('added',trans('admin.record_added'));
        return redirect(aurl('cities'));
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
        $city=City::find($id);
        $title=trans('admin.edit_city');
        return view('admin.cities.edit',compact('city','title'));
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
            'city_name_ar'=>'required',
            'city_name_en'=>'required',
            'country_id'=>'required|numeric',
        ],
        [],[
            'city_name_ar'=>trans('admin.city_name_ar'),
            'city_name_en'=>trans('admin.city_name_en'),
            'country_id'=>trans('admin.country_id'),
            
        ]);
       
        City::where('id',$id)->update($data);
        Session()->flash('added',trans('admin.record_updated'));
        return redirect(aurl('cities'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $country=City::find($id);
        Storage::delete($country->logo);
        $country->delete();
        Session()->flash('added',trans('admin.record_deleted'));
        return redirect(aurl('cities'));
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
                $city=City::find($id);
                $city->delete();
            }
        }else{
            $city=City::find(request('item'));
            $city->delete();
        }
        Session()->flash('added',trans('admin.record_deleted'));
        return redirect(aurl('cities'));
    }
}
