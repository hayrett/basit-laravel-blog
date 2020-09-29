<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Makale;
use App\Models\Kategori;
use Illuminate\Support\Str;
use File;

class makaleController extends Controller{
  public function index(){
    $makaleler = Makale::orderBy('olusturuldu', 'desc') -> get();
    return view('admin.makaleler.index', compact('makaleler'));
  }

  public function create(){
    $kategoriler = Kategori::orderBy('adi', 'asc') -> get();
    return view('admin.makaleler.olustur', compact('kategoriler'));
  }

  public function store(Request $gelenler){
    $gelenler -> validate([
      'baslik' => 'min:3',
      'resim' => 'required | image | mimes: jpeg,png,jpg | max:2048'
    ]);
    if($gelenler -> hasFile('resim')){
      $resim = Str::slug($gelenler -> baslik) . '.' . $gelenler -> resim -> getClientOriginalExtension();
      $gelenler -> resim -> move(public_path('yuklenenler'), $resim);
      Makale::insert([
        'baslik' => $gelenler -> baslik,
        'kategorisi' => $gelenler -> kategori,
        'icerik' => $gelenler -> icerik,
        'url_adresi' => Str::slug($gelenler -> baslik),
        'olusturuldu' => now(),
        'degistirildi' => now(),
        'resim' => 'yuklenenler/' . $resim
      ]);
      toastr() -> success('Makaleniz başarılı ile oluşturulmuştur..');
    } else {
      return 'Resim Seçmediniz..';
    }
    return redirect() -> route('admin.makaleler.index');
  }

  public function show($id){
    return $id . " Makale Görüntüleme";
  }

  public function edit($id){
    $makale = Makale::findOrFail($id);
    $kategoriler = Kategori::orderBy('adi', 'asc') -> get();
    return view('admin.makaleler.guncelle', compact('kategoriler', 'makale'));
  }

  public function update(Request $gelenler, $id){
    $gelenler -> validate([
      'baslik' => 'min:3',
      'resim' => 'image | mimes: jpeg,png,jpg | max:2048'
    ]);

    if($gelenler -> hasFile('resim')){
      $resim = Makale::find($id) -> resim;
      if(File::exists($resim)){
        File::delete(public_path($resim));
      }
      $resim = Str::slug($gelenler -> baslik) . '.' . $gelenler -> resim -> getClientOriginalExtension();
      $gelenler -> resim -> move(public_path('yuklenenler'), $resim);
      Makale::where('makale_nu', $id) -> update(['resim' => 'yuklenenler/' . $resim]);
    }

    Makale::where('makale_nu', $id) -> update([
      'baslik' => $gelenler -> baslik,
      'kategorisi' => $gelenler -> kategori,
      'icerik' => $gelenler -> icerik,
      'url_adresi' => Str::slug($gelenler -> baslik),
      'degistirildi' => now()
    ]);
    toastr() -> success('Makaleniz başarı ile güncellenmiştir..');
    return redirect() -> route('admin.makaleler.index');
  }

  public function sil($id){
    Makale::find($id) -> delete();
    toastr() -> success('Makale başarılı ile silindi');
    return redirect() -> route('admin.makaleler.index');
  }

  public function silinenler(){
    $makaleler = Makale::onlyTrashed() -> orderBy('silindi', 'desc') -> get();
    return view('admin.makaleler.silinenler', compact('makaleler'));
  }

  public function geriAl($id){
    Makale::onlyTrashed() -> find($id) -> restore();
    // Makale::where('makale_nu', $id) -> update(['durumu' => 0]);
    toastr() -> success('Makale başarı ile geri yüklendi.');
    return redirect() -> back();
  }

  public function yokEt($id){
    $resim = Makale::onlyTrashed() -> find($id) -> resim;
    if(File::exists($resim)){
      File::delete(public_path($resim));
    }
    Makale::onlyTrashed() -> find($id) -> forceDelete();
    toastr() -> success('Makale başarı ile yok edildi.');
    return redirect() -> back();
  }

  public function anahtar(Request $gelenler){
    Makale::findOrFail($gelenler -> id);
    Makale::where('makale_nu', $gelenler -> id) -> update(['durumu' => $gelenler -> yayindaMi == "true" ? 1 : 0]);
  }
}
