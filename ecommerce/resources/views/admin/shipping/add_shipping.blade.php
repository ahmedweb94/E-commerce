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
        //locationNameInput: $('#address')
    },
    enableAutocomplete: true,
    onchanged: function (currentLocation, radius, isMarkerDropped) {
      alert("Location changed. New location (" + currentLocation.latitude + ", " + currentLocation.longitude + ")");
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
    {!! Form::open(['route'=>'shipping.store','files'=>true]) !!}
    <input type="hidden" value="{{ $lat }}" name="lat" id="lat">
    <input type="hidden" value="{{ $lng }}" name="lng" id="lng">
    <div class="form-group">
      {!! Form::label('shipping_name_ar',trans('admin.shipping_name_ar')) !!}
      {!! Form::text('shipping_name_ar',old('shipping_name_ar'),['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
      {!! Form::label('shipping_name_en',trans('admin.shipping_name_en')) !!}
      {!! Form::text('shipping_name_en',old('shipping_name_en'),['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
      {!! Form::label('user_id',trans('admin.owner_id')) !!}
      {!! Form::select('user_id',\App\User::where('level','company')->pluck('name','id'),old('user_id'),['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
       <div id="us1" style="width: 100%; height: 400px;"></div>
    </div>
    <div class="form-group">
      {!! Form::label('logo',trans('admin.shipping_logo')) !!}
      {!! Form::file('logo',['class'=>'form-control']) !!}
    </div>
    {!! Form::submit(trans('admin.add'),['class'=>'btn btn-primary']) !!}
    {!! Form::close() !!}

  </div>

</div>

@endsection