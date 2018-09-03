@extends('admin.index')
@section('content')
@push('js')
<script type="text/javascript" src='https://maps.google.com/maps/api/js?sensor=false&libraries=places&key=AIzaSyBwxuW2cdXbL38w9dcPOXfGLmi1J7AVVB8'></script>
<script type="text/javascript" src='{{ url('desgin/adminlte/dist/js/locationpicker.jquery.js')}}'></script>
<?php
$lat=!empty($manufact->lat)?$manufact->lat:30.04546710125749 ;
$lng=!empty($manufact->lng)?$manufact->lng:31.23487663269043 ;
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
    {!! Form::open(['route'=>['manufacts.update',$manufact->id],'files'=>true,'method'=>'put']) !!}
    <input type="hidden" value="{{ $lat }}" name="lat" id="lat">
    <input type="hidden" value="{{ $lng }}" name="lng" id="lng">
    <div class="form-group">
      {!! Form::label('manufact_name_ar',trans('admin.manufact_name_ar')) !!}
      {!! Form::text('manufact_name_ar',$manufact->manufact_name_ar,['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
      {!! Form::label('manufact_name_en',trans('admin.manufact_name_en')) !!}
      {!! Form::text('manufact_name_en',$manufact->manufact_name_en,['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
      {!! Form::label('contact_name',trans('admin.contact_name')) !!}
      {!! Form::text('contact_name',$manufact->contact_name,['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
      {!! Form::label('email',trans('admin.email')) !!}
      {!! Form::text('email',$manufact->email,['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
      {!! Form::label('mobile',trans('admin.mobile')) !!}
      {!! Form::text('mobile',$manufact->mobile,['class'=>'form-control']) !!}
    </div>
    <div class="form-group">
      {!! Form::label('address',trans('admin.address')) !!}
      {!! Form::text('address',$manufact->address,['class'=>'form-control address']) !!}
    </div>
    <div class="form-group">
     <div id="us1" style="width: 100%; height: 400px;"></div>
   </div>
   <div class="form-group">
    {!! Form::label('facebook',trans('admin.facebook')) !!}
    {!! Form::text('facebook',$manufact->facebook,['class'=>'form-control']) !!}
  </div>
  <div class="form-group">
    {!! Form::label('twitter',trans('admin.twitter')) !!}
    {!! Form::text('twitter',$manufact->twitter,['class'=>'form-control']) !!}
  </div>
  <div class="form-group">
    {!! Form::label('website',trans('admin.website')) !!}
    {!! Form::text('website',$manufact->website,['class'=>'form-control']) !!}
  </div>
  <div class="form-group">
    {!! Form::label('logo',trans('admin.manufact_logo')) !!}
    {!! Form::file('logo',['class'=>'form-control']) !!}
    @if (!empty($manufact->logo))
    <img src="{{ Storage::url($manufact->logo) }}" width="80px" height="80px"> 
    @endif
  </div>
  {!! Form::submit(trans('admin.save'),['class'=>'btn btn-primary']) !!}
  {!! Form::close() !!}

</div>

</div>

@endsection