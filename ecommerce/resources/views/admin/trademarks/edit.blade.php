@extends('admin.index')
@section('content')
<div class="box">
            <div class="box-header">
              <h3 class="box-title">{{ $title }}</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              {!! Form::open(['route'=>['trademarks.update',$trademark->id],'files'=>true,'method'=>'put']) !!}
              <div class="form-group">
                {!! Form::label('trademark_name_ar',trans('admin.trademark_name_ar')) !!}
                {!! Form::text('trademark_name_ar',$trademark->trademark_name_ar,['class'=>'form-control']) !!}
              </div>
              <div class="form-group">
                {!! Form::label('trademark_name_en',trans('admin.trademark_name_en')) !!}
                {!! Form::text('trademark_name_en',$trademark->trademark_name_en,['class'=>'form-control']) !!}
              </div>
              <div class="form-group">
                {!! Form::label('logo',trans('admin.trademark_logo')) !!}
                {!! Form::file('logo',['class'=>'form-control']) !!}
              @if (!empty($trademark->logo))
                <img src="{{ Storage::url($trademark->logo) }}" width="80px" height="80px"> 
              @endif
              </div>
              {!! Form::submit(trans('admin.save'),['class'=>'btn btn-primary']) !!}
              {!! Form::close() !!}
 
            </div>

          </div>

@endsection