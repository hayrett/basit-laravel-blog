@extends('arayuz.katmanlar.sablon')
@section('title', $sayfa -> adi)
@section('resim', $sayfa -> resim)
@section('govde')
  <div class="col-lg-8 col-md-10 mx-auto">
    {!!$sayfa -> icerik!!}
  </div>
@include('arayuz.katmanlar.menu')
@endsection
