@isset($kategoriler)
<div class="col-md-3">
  <div class="card">
    <div class="card-header">
      Kategoriler
    </div>
    <div class="list-group">
      @foreach ($kategoriler as $kategori)
        <li class="list-group-item @if(Request::segment(2) == $kategori -> url_adresi) active disabled @endif">
          <a href="{{route('basligagit', $kategori -> url_adresi)}}">{{$kategori -> adi}}</a><span class="badge bg-danger float-right text-white">{{$kategori -> makaleSay()}}</span>
        </li>
      @endforeach
    </div>
  </div>
</div>
@endisset
