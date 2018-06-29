
<!-- Trigger the modal with a button -->
<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#del_admin{{ $id }}"><i class="fa fa-trash-o"></i></button>

<!-- Modal -->
<div id="del_admin{{ $id }}" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">{{ trans('admin.delete') }}</h4>
      </div>
      {!! Form::open(['route'=>['cities.destroy',$id],'method'=>'delete']) !!}
      <div class="modal-body">
        <h4>{{ trans('admin.delete_this_record',['name'=>Session('lang')=='en'? $city_name_en: $city_name_ar]) }}</h4>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-info" data-dismiss="modal">{{ trans('admin.close') }}</button>
        {!! Form::submit(trans('admin.delete'),['class'=>'btn btn-danger']) !!}
        {!! Form::close() !!}
      </div>
    </div>

  </div>
</div>