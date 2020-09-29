@extends('arayuz.katmanlar.sablon')
@section('title', $makale -> baslik)
@section('resim', asset($makale -> resim))
@section('govde')
  <div class="col-lg-8 col-md-9 mx-auto">
    {!!$makale -> icerik!!}
    <span class="text-muted float-right">Görülme: {{$makale -> tiklanma}}</span>
  </div>
@include('arayuz.katmanlar.menu')
@endsection
