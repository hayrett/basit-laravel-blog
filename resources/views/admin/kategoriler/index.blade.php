@extends('admin.katmanlar.sablon')
@section('title', 'Tüm Kategoriler')
@section('icerik')
<div class="row">
  <div class="col-md-4">
    <div class="card show mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Yeni Kategori Oluştur</h6>
      </div>
      <div class="card-body">
        <form action="{{route('admin.kategori.ekle')}}" method="post">
          @csrf
          <div class="form-group">
            <label for="kategori">Kategori Adı</label>
            <input type="text" name="kategori" value="" class="form-control">
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block">Ekle</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <div class="col-md-8">
    <div class="card show mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">@yield('title')</h6>
      </div>
      <div class="card-body">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>Kategori Adı</th>
              <th>Makale Sayısı</th>
              <th>Durumu</th>
              <th>İşlemler</th>
            </tr>
          </thead>
          <tbody>
            @foreach($kategoriler as $kategori)
              <tr class="text-center">
                <td class="text-left align-middle">{{$kategori -> adi}}</td>
                <td>{{$kategori -> makaleSay()}}</td>
                <td class="align-middle">
                  <input class="anahtar" kategori-id="{{$kategori -> kategori_nu}}" type="checkbox" data-on="Etkin" data-off="Etkin değil" data-offstyle="danger" data-onstyle="success"
                    @if($kategori -> durumu == 1) checked @endif data-toggle="toggle">
                </td>
                <td class="align-middle">
                  <a duzenle-id="{{$kategori -> kategori_nu}}" title="Düzenle" class="duzenle btn btn-sm btn-primary"><i class="fa fa-edit text-white"></i></a>
                  <a sil-id="{{$kategori -> kategori_nu}}" kategori-say="{{$kategori -> makaleSay()}}" adi="{{$kategori -> adi}}" title="Sil" class="sil btn btn-sm btn-danger"><i class="fa fa-minus-circle text-white"></i></a>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<div id="acilirDegistir" class="modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Kategoriyi Düzenle</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <form class="form-group" action="{{route('admin.kategori.guncelle')}}" method="post">
        @csrf
        <div class="modal-body">
          <label for="kategori_adi">Kategori Adı</label>
          <input type="text" class="form-control" id="kategori_adi" name="kategori_adi">
          <input type="hidden" id="kategori_nu" name="kategori_nu">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">İptal</button>
          <button type="submit" class="btn btn-success">Kaydet</button>
        </div>
      </form>
    </div>
  </div>
</div>
<div id="acilirSil" class="modal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Kategoriyi Sil</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div id="uyari-body" class="modal-body">
        <div id="uyari" class="alert alert-danger">
        </div>
      </div>
      <form class="form-group" action="{{route('admin.kategori.sil')}}" method="post">
        @csrf
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Kapat</button>
          <button id="dugmeSil" type="submit" class="btn btn-success">Sil</button>
          <input type="hidden" name="sil_nu" id="sil_nu">
        </div>
      </form>
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
    $('.sil').click(function(){
      id=$(this)[0].getAttribute('sil-id');
      say=$(this)[0].getAttribute('kategori-say');
      adi=$(this)[0].getAttribute('adi');
      if(id==1){
        $('#uyari').html(adi+' kategorisi sabit kategoridir, silinemez!');
        $('#uyari-body').show();
        $('#dugmeSil').hide();
        $('#acilirSil').modal()
      }else{
        $('#dugmeSil').show();
        $('#sil_nu').val(id);
        if(say>0){
          $('#uyari').html(adi+' kategorisine ait <span style="color:red;font-weight:bold">'+say+'</span> makale bulunmaktadır. Yine de silmek istiyor musunuz?')
          $('#uyari-body').show()
        }else{
          $('#uyari').html('');
          $('#uyari-body').hide()
        }
        $('#acilirSil').modal()
      }
    })

    $('.duzenle').click(function(){
      id = $(this)[0].getAttribute('duzenle-id');
      $.ajax({
        type:'get',
        url:'{{route('admin.kategori.duzenle')}}',
        data:{id:id},
        success:function(gelen){
          console.log(gelen);
          $('#kategori_adi').val(gelen.adi);
          $('#kategori_nu').val(gelen.kategori_nu);
          $('#acilirDegistir').modal();
        }
      })
    })

    $('.anahtar').change(function(){
      id = $(this)[0].getAttribute('kategori-id');
      yayindaMi = $(this).prop('checked');
      $.get("{{route('admin.kategori.anahtar')}}", {id:id, yayindaMi:yayindaMi});
    })
  })
</script>
@endsection
