<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\DataTables\StatesDatatable;
use Illuminate\Http\Request;
use App\Model\State;
use App\Model\City;
use Storage;
use Form;
class StatesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(StatesDatatable $state)
    {
        return $state->render('admin.states.index',['title'=>trans('admin.state')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (request()->ajax()) {
            if(request()->has('country_id')){
                $select=request()->has('select')?request('select'):'';
                return  Form::select('city_id',City::where('country_id',request('country_id'))->pluck('city_name_'.Session('lang'),'id') ,$select,['class'=>'form-control ','placeholder'=>'.........']) ;
            }
        }
        return view('admin.states.add_state',['title'=>trans('admin.add_state')]);
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
            'state_name_ar'=>'required',
            'state_name_en'=>'required',
            'country_id'=>'required|numeric',
            'city_id'=>'required|numeric',
            
        ],
        [],[
            'state_name_ar'=>trans('admin.state_name_ar'),
            'state_name_en'=>trans('admin.state_name_en'),
            'country_id'=>trans('admin.country_id'),
            'city_id'=>trans('admin.city_id'),
        ]);
        State::create($data);
        Session()->flash('added',trans('admin.record_added'));
        return redirect(aurl('states'));
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
        $state=State::find($id);
        $title=trans('admin.edit_state');
        return view('admin.states.edit',compact('state','title'));
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
            'state_name_ar'=>'required',
            'state_name_en'=>'required',
            'country_id'=>'required|numeric',
            'city_id'=>'required|numeric',

        ],
        [],[
            'state_name_ar'=>trans('admin.state_name_ar'),
            'state_name_en'=>trans('admin.state_name_en'),
            'country_id'=>trans('admin.country_id'),
            'city_id'=>trans('admin.city_id'),
            
        ]);

        State::where('id',$id)->update($data);
        Session()->flash('added',trans('admin.record_updated'));
        return redirect(aurl('states'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $state=State::find($id);
        Storage::delete($state->logo);
        $state->delete();
        Session()->flash('added',trans('admin.record_deleted'));
        return redirect(aurl('states'));
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
                $state=State::find($id);
                $state->delete();
            }
        }else{
            $state=State::find(request('item'));
            $state->delete();
        }
        Session()->flash('added',trans('admin.record_deleted'));
        return redirect(aurl('states'));
    }
}
