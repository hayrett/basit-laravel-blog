@extends('arayuz.katmanlar.sablon')
@php
  if (isset($kategori)) {
    $baslik = $kategori -> adi . ' Kategorisi | ' . count($makaleler) . ' Makale';
  } else {
    $baslik = 'Ana Sayfa';
  }
@endphp
@section('title', $baslik)
@section('govde')
<div class="col-md-9 mx-auto">
  @if(count($makaleler))
    @foreach ($makaleler as $makale)
      <div class="post-preview">
        <a href="{{route('adresegit', [$makale -> kategoriGetir -> url_adresi, $makale -> url_adresi])}}">
          <h2 class="post-title">{{$makale -> baslik}}</h2>
          <img class="col-md-12" src="{{asset($makale -> resim)}}" alt="">
          <h3 class="post-subtitle">{!!Str::limit($makale -> icerik, 133, ' <span style="font-size:15px; color:gray; vertical-align:middle">Devamı...</span>')!!}</h3>
        </a>
        <p class="post-meta">
          Kategori: <a href="{{route('basligagit', $makale -> kategoriGetir -> url_adresi)}}">{{$makale -> kategoriGetir -> adi}}</a>
          <span class="float-right">{{$makale -> olusturuldu -> diffForHumans()}}</span></p>
      </div>
      @if(!$loop -> last) <hr> @endif
    @endforeach
    <div class="col-md-3 text-center">
      {{$makaleler ->  links()}}
    </div>
  @else
    <div class="alert alert-danger text-center"><h3>Bu kategoriye ait makale bulunmamaktadır!</h3></div>
  @endif
</div>
@include('arayuz.katmanlar.menu')
@endsection
