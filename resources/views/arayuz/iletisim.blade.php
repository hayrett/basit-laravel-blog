@extends('arayuz.katmanlar.sablon')
@section('title', 'İletişim')
@section('resim', 'https://choiceticketing.com/wp-content/uploads/2015/05/Contact-Us.jpg')
@section('govde')
<div class="col-md-8">
  @if(session('basarili'))
    <div class="alert alert-success">
      {{session('basarili')}}
    </div>
  @endif
  @if($errors -> any())
    <div class="alert alert-danger">
      <ul>
        @foreach ($errors -> all() as $hata)
          <li>{{$hata}}</li>
        @endforeach
      </ul>
    </div>
  @endif
  <p>Bizimle iletişime geçebilirsiniz.</p>
  <form method="post" action="{{route('iletisim.gonder')}}">
    @csrf
    <div class="control-group">
      <div class="form-group controls">
        <label>Adınız Soyadınız</label>
        <input type="text" name="adi" class="form-control" value="{{old('adi')}}" placeholder="Adınız Soyadınız" id="name">
        <p class="help-block text-danger"></p>
      </div>
    </div>
    <div class="control-group">
      <div class="form-group controls">
        <label>E-Posta Adresiniz</label>
        <input type="email" name="eposta" class="form-control" value="{{old('eposta')}}" placeholder="E-Posta Adresiniz" id="email">
        <p class="help-block text-danger"></p>
      </div>
    </div>
    <div class="control-group">
      <div class="form-group col-xs-12 controls">
        <label>Konu</label>
        <select class="form-control" name="konu">
          <option @if(old('konu')=='Bilgi') selected @endif>Bilgi</option>
          <option @if(old('konu')=='Destek') selected @endif>Destek</option>
          <option @if(old('konu')=='Konu') selected @endif>Konu</option>
        </select>
      </div>
    </div>
    <div class="control-group">
      <div class="form-group controls">
        <label>İletiniz</label>
        <textarea rows="5" name="ileti" class="form-control" placeholder="İletiniz" id="message">{{old('ileti')}}</textarea>
        <p class="help-block text-danger"></p>
      </div>
    </div>
    <br>
    <div id="success"></div>
    <button type="submit" class="btn btn-primary" id="sendMessageButton">Gönder</button>
  </form>
</div>
<div class="col-md-4">
  <div class="card-group">
    <div class="card card-default">
      <div class="card-body">
        Adres: Mah. Sk.
      </div>
    </div>
  </div>
</div>
@endsection
