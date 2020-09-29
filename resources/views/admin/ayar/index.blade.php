@extends('admin.katmanlar.sablon')
@section('title', 'Ayarlar')
@section('icerik')
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">@yield('title')</h6>
    </div>
    <div class="card-body">
      <form action="{{route('admin.ayar.guncelle')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="site_adi">Site Başlığı</label>
              <input type="text" name="site_adi" required class="form-control" value="{{$ayar -> site_adi}}">
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="yayinda">Site Yayında mı?</label>
              <select class="form-control" name="yayinda">
                <option @if($ayar -> yayinda == 1) selected @endif value="1">Açık</option>
                <option @if($ayar -> yayinda == 0) selected @endif value="0">Kapalı</option>
              </select>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="amblem">Site Amblem</label>
              <input type="file" name="amblem" class="form-control" accept="image/*">
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="simge">Site Simge</label>
              <input type="file" name="simge" class="form-control" accept="image/*">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="facebook"><i class="fab fa-facebook"></i> Facebook</label>
              <input type="text" name="facebook" class="form-control" value="{{$ayar -> facebook}}">
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="twitter"><i class="fab fa-twitter"></i> Twitter</label>
              <input type="text" name="twitter" class="form-control" value="{{$ayar -> twitter}}">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="github"><i class="fab fa-github"></i> GitHub</label>
              <input type="text" name="github" class="form-control" value="{{$ayar -> github}}">
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="linkedin"><i class="fab fa-linkedin"></i> LinkedIn</label>
              <input type="text" name="linkedin" class="form-control" value="{{$ayar -> linkedin}}">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label for="youtube"><i class="fab fa-youtube"></i> YouTube</label>
              <input type="text" name="youtube" class="form-control" value="{{$ayar -> youtube}}">
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label for="instagram"><i class="fab fa-instagram"></i> Instagram</label>
              <input type="text" name="instagram" class="form-control" value="{{$ayar -> instagram}}">
            </div>
          </div>
        </div>
        <div class="form-group">
          <button type="submit" class="btn btn-block btn-md btn-success">Güncelle</button>
        </div>
      </form>
    </div>
  </div>
@endsection
