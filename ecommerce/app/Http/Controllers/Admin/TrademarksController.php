<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\DataTables\TrademarksDatatable;
use Illuminate\Http\Request;
use App\Model\Trademark;
use Storage;
class TrademarksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(TrademarksDatatable $trademark)
    {
        return $trademark->render('admin.trademarks.index',['title'=>trans('admin.trademarks')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.trademarks.add_trademark',['title'=>trans('admin.trademarks')]);
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
            'trademark_name_ar'=>'required',
            'trademark_name_en'=>'required',
            'logo'=>'required|'.v_image(),
        ],
        [],[
            'trademark_name_ar'=>trans('admin.trademark_name_ar'),
            'trademark_name_en'=>trans('admin.trademark_name_en'),
            'logo'=>trans('admin.trademark_logo'),
        ]);
        if(request()->hasFile('logo')){
            $data['logo']=up()->upload([
                'file'=>'logo',
                'path'=>'Trademarks',
                'delete_file'=>null,
                'upload_type'=>'single',
            ]);
        }
        Trademark::create($data);
        Session()->flash('added',trans('admin.record_added'));
        return redirect(aurl('trademarks'));
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
        $trademark=Trademark::find($id);
        $title=trans('admin.edit_trademark');
        return view('admin.trademarks.edit',compact('trademark','title'));
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
            'trademark_name_ar'=>'required',
            'trademark_name_en'=>'required',
            'logo'=>'sometimes|nullable|'.v_image(),
        ],
        [],[
            'trademark_name_ar'=>trans('admin.trademark_name_ar'),
            'trademark_name_en'=>trans('admin.trademark_name_en'),
            'logo'=>trans('admin.trademark_logo'),
        ]);
        if(request()->hasFile('logo')){
            $data['logo']=up()->upload([
                'file'=>'logo',
                'path'=>'Trademarks',
                'delete_file'=>Trademark::find($id)->logo,
                'upload_type'=>'single',
            ]);
        }
        Trademark::where('id',$id)->update($data);
        Session()->flash('added',trans('admin.record_updated'));
        return redirect(aurl('trademarks'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $trademark=Trademark::find($id);
        Storage::delete($trademark->logo);
        $trademark->delete();
        Session()->flash('added',trans('admin.record_deleted'));
        return redirect(aurl('trademarks'));
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
                $trademark=Trademark::find($id);
                Storage::delete($trademark->logo);
                $trademark->delete();
            }
        }else{
            $trademark=Trademark::find(request('item'));
            Storage::delete($trademark->logo);
            $trademark->delete();
        }
        Session()->flash('added',trans('admin.record_deleted'));
        return redirect(aurl('trademarks'));
    }
}
