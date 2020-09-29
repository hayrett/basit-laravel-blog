@extends('admin.katmanlar.sablon')
@section('title', 'Silinen Makaleler')
@section('icerik')
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">@yield('title')
        <span class="m-0 font-weight-bold text-primary float-right">{{$makaleler -> count()}} makale bulundu.
        <a href="{{route('admin.makaleler.index')}}" class="btn btn-primary btn-sm">Etkin Makaleler</a></span>
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
              <th>Silinme Tarihi</th>
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
                <td class="align-middle">{{$makale -> silindi -> diffForHumans()}}</td>
                <td class="align-middle">
                  <a href="{{route('admin.makale.gerial', $makale -> makale_nu)}}" title="Geri Al" class="btn btn-sm btn-primary"><i class="fa fa-undo"></i></a>
                  <a href="{{route('admin.makale.yoket', $makale -> makale_nu)}}" title="Tamamen Sil" class="btn btn-sm btn-danger"><i class="fa fa-minus-circle"></i></a>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection
