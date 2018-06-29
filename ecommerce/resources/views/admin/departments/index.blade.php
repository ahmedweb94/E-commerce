@extends('admin.index')
@section('content')
@push('js')

<div id="delete_department" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">{{ trans('admin.delete') }}</h4>
      </div>
      {!! Form::open(['url'=>'','method'=>'delete' ,'id'=>'delete_dep']) !!}
      <div class="modal-body">
        <h4>{{ trans('admin.delete_this_dep')}} <span id="dep_name"></span> </h4>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-info" data-dismiss="modal">{{ trans('admin.close') }}</button>
        {!! Form::submit(trans('admin.delete'),['class'=>'btn btn-danger']) !!}
        {!! Form::close() !!}
      </div>
    </div>

  </div>
</div>
<script type="text/javascript">
  $(document).ready(function(){
    $('#jstree').jstree({
      "core" : {
        'data' : {!! load_dep() !!},
        "themes" : {
          "variant" : "large"
        }
      },
      "checkbox" : {
        "keep_selected_style" : true
      },
      "plugins" : [ "wholerow" ]
    });
  });
  $('#jstree').on('changed.jstree', function (e, data) {
    var i , j ,r =[];
    var name =[];
    for (i = 0, j=data.selected.length;i < j; i++){
      r.push(data.instance.get_node(data.selected[i]).id);
      name.push(data.instance.get_node(data.selected[i]).text);
    }
    $('#delete_dep').attr('action','{{ aurl('departments') }}/'+r.join(', '));
    $('#dep_name').text(name.join(', '));
    $('.parent_id').val(r.join(', '));
    if(r.join(', ') !=''){
      $('.showbtn_control').removeClass('hidden');
      $('.edit_dep').attr('href','{{ aurl('departments') }}/'+r.join(', ')+'/edit');
    }else{
      $('.showbtn_control').addClass('hidden');
    }

  });
</script>
@endpush
<div class="box">
  <div class="box-header">
    <h3 class="box-title">{{ $title }}</h3>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    <a href="" class="btn btn-info edit_dep showbtn_control hidden"><i class="fa fa-edit"></i> {{ trans('admin.edit') }} </a>
    <a href="" class="btn btn-danger delete_dep showbtn_control hidden" data-toggle="modal" data-target="#delete_department"><i class="fa fa-trash"></i> {{ trans('admin.delete') }} </a>
    <div id="jstree"></div>
    <input type="hidden" name="parent" class="parent_id" value="">
  </div>

</div>
@endsection