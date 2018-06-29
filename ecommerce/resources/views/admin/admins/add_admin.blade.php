@extends('admin.index')
@section('content')
<div class="box">
            <div class="box-header">
              <h3 class="box-title">{{ $title }}</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              {!! Form::open(['route'=>'admin.store']) !!}
              <div class="form-group">
                {!! Form::label('name',trans('admin.admin_name')) !!}
                {!! Form::text('name',old('name'),['class'=>'form-control']) !!}
              </div>
              <div class="form-group">
                {!! Form::label('email',trans('admin.admin_email')) !!}
                {!! Form::email('email',old('email'),['class'=>'form-control']) !!}
              </div>
              <div class="form-group">
                {!! Form::label('password',trans('admin.admin_password')) !!}
                {!! Form::password('password',['class'=>'form-control']) !!}
              </div>
              {!! Form::submit(trans('admin.add_admin'),['class'=>'btn btn-primary']) !!}
              {!! Form::close() !!}
 
            </div>

          </div>

@endsection