@extends('admin.katmanlar.sablon')
@section('title', 'Yeni Makale')
@section('icerik')
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">@yield('title')</h6>
    </div>
    <div class="card-body">
      @if($errors -> any())
        <div class="alert alert-danger">
          <ul>
            @foreach ($errors -> all() as $hata)
              <li>{{$hata}}</li>
            @endforeach
          </ul>
        </div>
      @endif
      <form action="{{route('admin.makaleler.store')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
          <label for="kategori">Makale Başlığı</label>
          <input name="baslik" type="text" value="" class="form-control" required></input>
        </div>
        <div class="form-group">
          <label for="kategori">Kategorisi</label>
          <select name="kategori" class="form-control" required>
            <option value="">Seçim Yapınız..</option>
            @foreach($kategoriler as $kategori)
              <option value="{{$kategori -> kategori_nu}}">{{$kategori -> adi}}</option>
            @endforeach
          </select>
        </div>
        <div class="form-group">
          <label for="resmi">Makale Resmi</label>
          <input name="resim" type="file" accept="image/*" class="form-control" required></input>
        </div>
        <div class="form-group">
          <label for="resmi">Makale İçeriği</label>
          <textarea name="icerik" id="editor" class="form-control" required></textarea>
        </div>
        <div class="form-group">
          <button type="submit" class="btn btn-primary btn-block">Makaleyi Kaydet</button>
        </div>
      </form>
    </div>
  </div>
@endsection
@section('css')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
@endsection
@section('js')
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script>
  $(document).ready(function() {
    $('#editor').summernote(
      {height:277}
    );
  });
</script>
@endsection
