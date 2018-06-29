@extends('admin.index')
@section('content')
<div class="box">
            <div class="box-header">
              <h3 class="box-title">{{ $title }}</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              {!! Form::open(['route'=>'trademarks.store','files'=>true]) !!}
              <div class="form-group">
                {!! Form::label('trademark_name_ar',trans('admin.trademark_name_ar')) !!}
                {!! Form::text('trademark_name_ar',old('trademark_name_ar'),['class'=>'form-control']) !!}
              </div>
              <div class="form-group">
                {!! Form::label('trademark_name_en',trans('admin.trademark_name_en')) !!}
                {!! Form::text('trademark_name_en',old('trademark_name_en'),['class'=>'form-control']) !!}
              </div>
              <div class="form-group">
                {!! Form::label('logo',trans('admin.trademark_logo')) !!}
                {!! Form::file('logo',['class'=>'form-control']) !!}
              </div>
              {!! Form::submit(trans('admin.add'),['class'=>'btn btn-primary']) !!}
              {!! Form::close() !!}
 
            </div>

          </div>

@endsection