@extends('admin.katmanlar.sablon')
@section('title', 'Tüm Makaleler')
@section('icerik')
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">@yield('title')
        <span class="m-0 font-weight-bold text-primary float-right">{{$makaleler -> count()}} makale bulundu.
        <a href="{{route('admin.makale.silinenler')}}" class="btn btn-warning btn-sm"><i class="fa fa-trash"></i> Geridönüşüm Kutusu</a></span>
      </h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>Resim</th>
              <th>Makale Başlığı</th>
              <th>Kategorisi</th>
              <th>Görüntülenme Sayısı</th>
              <th>Durumu</th>
              <th>Oluşturulma Tarihi</th>
              <th>İşlemler</th>
            </tr>
          </thead>
          <tbody>
            @foreach($makaleler as $makale)
              <tr class="text-center">
                <td><img src="{{asset($makale -> resim)}}" width="200" alt=""></td>
                <td class="text-left align-middle">{{$makale -> baslik}}</td>
                <td class="align-middle">{{$makale -> kategoriGetir -> adi}}</td>
                <td class="align-middle">{{$makale -> tiklanma}}</td>
                <td class="align-middle">{{$makale -> olusturuldu -> diffForHumans()}}</td>
                <td class="align-middle"><input class="anahtar" makale-id="{{$makale -> makale_nu}}" type="checkbox" data-on="Yayında" data-off="Yayında değil" data-offstyle="danger" data-onstyle="success" @if($makale -> durumu == 1) checked @endif data-toggle="toggle"></td>
                <td class="align-middle">
                  <a href="{{route('adresegit', [$makale -> kategoriGetir -> url_adresi, $makale -> url_adresi])}}" title="Görüntüle" class="btn btn-sm btn-success" target="_blank"><i class="fa fa-eye"></i></a>
                  <a href="{{route('admin.makaleler.edit', $makale -> makale_nu)}}" title="Düzenle" class="btn btn-sm btn-primary"><i class="fa fa-pen"></i></a>
                  <a href="{{route('admin.makale.sil', $makale -> makale_nu)}}" title="Sil" class="btn btn-sm btn-danger"><i class="fa fa-trash-alt"></i></a>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection
@section('css')
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
@endsection
@section('js')
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<script>
  $(function(){
    $('.anahtar').change(function(){
      id = $(this)[0].getAttribute('makale-id');
      yayindaMi = $(this).prop('checked');
      $.get("{{route('admin.anahtar')}}", {id:id, yayindaMi:yayindaMi});
    })
  })
</script>
@endsection
