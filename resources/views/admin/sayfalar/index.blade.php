@extends('admin.katmanlar.sablon')
@section('title', 'Tüm Sayfalar')
@section('icerik')
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">@yield('title')
        <span class="m-0 font-weight-bold text-primary float-right">{{$sayfalar -> count()}} sayfa bulundu.
      </h6>
    </div>
    <div class="card-body">
      <div id="basarili" class="alert alert-success" style="display:none">
        Sıralama değiştirildi.
      </div>
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>Sıralama</th>
              <th>Resim</th>
              <th>Sayfa Başlığı</th>
              <th>Durumu</th>
              <th>İşlemler</th>
            </tr>
          </thead>
          <tbody id="siralama">
            @foreach($sayfalar as $sayfa)
              <tr id="sayfa_{{$sayfa -> sayfa_nu}}" class="text-center">
                <td class="align-middle" style="width:25px"><i class="fa fa-2x fa-hand-rock tasima-yeri" style="cursor:row-resize"></i></td>
                <td class="align-middle"><img src="{{asset($sayfa -> resim)}}" width="200" alt=""></td>
                <td class="text-left align-middle">{{$sayfa -> adi}}</td>
                <td class="align-middle"><input class="anahtar" sayfa-id="{{$sayfa -> sayfa_nu}}" type="checkbox" data-on="Etkin" data-off="Etkin değil" data-offstyle="danger" data-onstyle="success" @if($sayfa -> durumu == 1) checked @endif data-toggle="toggle"></td>
                <td class="align-middle">
                  <a href="{{route('sayfayagit', $sayfa -> url_adresi)}}" title="Görüntüle" class="btn btn-sm btn-success" target="_blank"><i class="fa fa-eye"></i></a>
                  <a href="{{route('admin.sayfa.guncelle', $sayfa -> sayfa_nu)}}" title="Düzenle" class="btn btn-sm btn-primary"><i class="fa fa-pen"></i></a>
                  <a href="{{route('admin.sayfa.sil', $sayfa -> sayfa_nu)}}" title="Sil" class="btn btn-sm btn-danger"><i class="fa fa-minus-circle"></i></a>
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
<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.12.0/dist/sortable.umd.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<script>
  $('#siralama').sortable({
    'handle':'.tasima-yeri',
    'update':function(){
      var siralama=$('#siralama').sortable('serialize');
      $.get("{{route('admin.sayfa.sirala')}}?"+siralama,function(){
        $("#basarili").show().delay(1000).fadeOut()
      })
    }
  })
</script>
<script>
  $(function(){
    $('.anahtar').change(function(){
      id = $(this)[0].getAttribute('sayfa-id');
      yayindaMi = $(this).prop('checked');
      $.get("{{route('admin.sayfa.anahtar')}}", {id:id, yayindaMi:yayindaMi});
    })
  })
</script>
@endsection
