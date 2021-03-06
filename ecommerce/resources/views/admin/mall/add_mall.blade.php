@extends('admin.index')
@section('content')
@push('js')
<script type="text/javascript" src='https://maps.google.com/maps/api/js?sensor=false&libraries=places&key=AIzaSyBwxuW2cdXbL38w9dcPOXfGLmi1J7AVVB8'></script>
<script type="text/javascript" src='{{ url('desgin/adminlte/dist/js/locationpicker.jquery.js')}}'></script>
<?php
$lat=!empty(old('lat'))?old('lat'):30.04546710125749 ;
$lng=!empty(old('lng'))?old('lng'):31.23487663269043 ;
?>
<script>
  $('#us1').locationpicker({
    location: {
      latitude: {{ $lat }},
      longitude: {{ $lng }}
    },
    radius: 300,
    markerIcon: '{{ url('desgin/adminlte/dist/img/map-marker-2-xl.png')}}',
    inputBinding: {
        latitudeInput: $('#lat'),
        longitudeInput: $('#lng'),
        //radiusInput: $('#us2-radius'),
        locationNameInput: $('#address')
    },
    enableAutocomplete: true

  });
</script>
@endpush
<div class="box">
  <div class="box-header">
    <h3 class="box-title">{{ $title }}</h3>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    {!! Form::open(['route'=>'mall.store','files'=>true]) !!}
    <input type="hidden" value="{{ $lat }}" name="lat" id="lat">
    <input type="hidden" value="{{ $lng }}" name="lng" id="lng">
    <div class="form-group">
      {!! Form::label('mall_name_ar',trans('admin.mall_name_ar')) !!}
      {!! Form::text('mall_name_ar',old('mall_name_ar'),['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
      {!! Form::label('mall_name_en',trans('admin.mall_name_en')) !!}
      {!! Form::text('mall_name_en',old('mall_name_en'),['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
      {!! Form::label('contact_name',trans('admin.contact_name')) !!}
      {!! Form::text('contact_name',old('contact_name'),['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
      {!! Form::label('mobile',trans('admin.mobile')) !!}
      {!! Form::text('mobile',old('mobile'),['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
      {!! Form::label('email',trans('admin.email')) !!}
      {!! Form::text('email',old('email'),['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
      {!! Form::label('address',trans('admin.address')) !!}
      {!! Form::text('address',old('address'),['class'=>'form-control address']) !!}
    </div>
    <div class="form-group">
      {!! Form::label('country_id',trans('admin.country_id')) !!}
      {!! Form::select('country_id',App\Model\Country::pluck('country_name_'.Session('lang'),'id') ,old('country_id'),['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
       <div id="us1" style="width: 100%; height: 400px;"></div>
    </div>
    <div class="form-group">
      {!! Form::label('facebook',trans('admin.facebook')) !!}
      {!! Form::text('facebook',old('facebook'),['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
      {!! Form::label('twitter',trans('admin.twitter')) !!}
      {!! Form::text('twitter',old('twitter'),['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
      {!! Form::label('website',trans('admin.website')) !!}
      {!! Form::text('website',old('website'),['class'=>'form-control']) !!}
    </div>

    <div class="form-group">
      {!! Form::label('logo',trans('admin.mall_logo')) !!}
      {!! Form::file('logo',['class'=>'form-control']) !!}
    </div>
    {!! Form::submit(trans('admin.add'),['class'=>'btn btn-primary']) !!}
    {!! Form::close() !!}

  </div>

</div>

@endsection