<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\DataTables\ShippingDatatable;
use Illuminate\Http\Request;
use App\Model\Shipping;
use Storage;
class ShippingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ShippingDatatable $shipping)
    {
        return $shipping->render('admin.shipping.index',['title'=>trans('admin.shipping')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.shipping.add_shipping',['title'=>trans('admin.shipping')]);
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
            'shipping_name_ar'=>'required',
            'shipping_name_en'=>'required',
            'user_id'=>'required|numeric',
            'lat'=>'sometimes|nullable',
            'lng'=>'sometimes|nullable',
            'logo'=>'sometimes|nullable|'.v_image(),
        ],
        [],[
            'shipping_name_ar'=>trans('admin.shipping_name_ar'),
            'shipping_name_en'=>trans('admin.shipping_name_en'),
            'user_id'=>trans('admin.user_id'),
            'lat'=>trans('admin.lat'),
            'lng'=>trans('admin.lng'),
            'logo'=>trans('admin.shipping_logo'),
        ]);
        if(request()->hasFile('logo')){
            $data['logo']=up()->upload([
                'file'=>'logo',
                'path'=>'shipping',
                'delete_file'=>null,
                'upload_type'=>'single',
            ]);
        }
        Shipping::create($data);
        Session()->flash('added',trans('admin.record_added'));
        return redirect(aurl('shipping'));
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
        $shipping=Shipping::find($id);
        $title=trans('admin.shipping');
        return view('admin.shipping.edit',compact('shipping','title'));
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
            'shipping_name_ar'=>'required',
            'shipping_name_en'=>'required',
            'user_id'=>'required|numeric',
            'lat'=>'sometimes|nullable',
            'lng'=>'sometimes|nullable',
            'logo'=>'sometimes|nullable|'.v_image(),
        ],
        [],[
            'shipping_name_ar'=>trans('admin.shipping_name_ar'),
            'shipping_name_en'=>trans('admin.shipping_name_en'),
            'user_id'=>trans('admin.user_id'),
            'lat'=>trans('admin.lat'),
            'lng'=>trans('admin.lng'),
            'logo'=>trans('admin.shipping_logo'),
        ]);
        if(request()->hasFile('logo')){
            $data['logo']=up()->upload([
                'file'=>'logo',
                'path'=>'shipping',
                'delete_file'=>null,
                'upload_type'=>'single',
            ]);
        }
        Shipping::where('id',$id)->update($data);
        Session()->flash('added',trans('admin.record_updated'));
        return redirect(aurl('shipping'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $shipping=Shipping::find($id);
        Storage::delete($shipping->logo);
        $shipping->delete();
        Session()->flash('added',trans('admin.record_deleted'));
        return redirect(aurl('shipping'));
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
                $shipping=Shipping::find($id);
                Storage::delete($shipping->logo);
                $shipping->delete();
            }
        }else{
            $shipping=Shipping::find(request('item'));
            Storage::delete($shipping->logo);
            $shipping->delete();
        }
        Session()->flash('added',trans('admin.record_deleted'));
        return redirect(aurl('shipping'));
    }
}
