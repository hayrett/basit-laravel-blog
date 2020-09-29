<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sayfa;
use Illuminate\Support\Str;
use File;

class sayfaController extends Controller{
  public function index(){
    $sayfalar = Sayfa::all();
    return view('admin.sayfalar.index', compact('sayfalar'));
  }

  public function olustur(){
    return view('admin.sayfalar.olustur');
  }

  public function sil($id){
    $resim = Sayfa::find($id) -> resim;
    if(File::exists($resim)){
      File::delete(public_path($resim));
    }
    Sayfa::find($id) -> delete();
    toastr() -> success('Sayfa başarı ile yok edildi.');
    return redirect() -> back();
  }

  public function guncelle($gelen){
    $sayfa = Sayfa::findOrFail($gelen);
    return view('admin.sayfalar.guncelle', compact('sayfa'));
  }

  public function sirala(Request $gelenler){
    foreach ($gelenler -> get('sayfa') as $anahtar => $deger){
      Sayfa::where('sayfa_nu', $deger) -> update(['sirasi' => $anahtar]);
    }
  }

  public function guncellePost(Request $gelenler, $id){
    $gelenler -> validate([
      'baslik' => 'min:3',
      'resim' => 'image | mimes: jpeg,png,jpg | max:2048'
    ]);

    $resim = Sayfa::find($id) -> resim;
    if($gelenler -> hasFile('resim')){
      if(File::exists($resim)){
        File::delete(public_path($resim));
      }
      $resim = Str::slug($gelenler -> adi) . '.' . $gelenler -> resim -> getClientOriginalExtension();
      $gelenler -> resim -> move(public_path('yuklenenler'), $resim);
      Sayfa::where('sayfa_nu', $id) -> update(['resim' => 'yuklenenler/' . $resim]);
    }/*else{
      if(File::exists($resim)){
        File::move(public_path('yuklenenler/') . Sayfa::find($id) -> resim, public_path('yuklenenler/') . Str::slug($gelenler -> adi) . '.' . Str::after(Sayfa::find($id) -> resim, '.'));
      }
    }*/

    Sayfa::where('sayfa_nu', $id) -> update([
      'adi' => $gelenler -> adi,
      'icerik' => $gelenler -> icerik,
      'url_adresi' => Str::slug($gelenler -> adi),
      'degistirildi' => now()
    ]);
    toastr() -> success('Sayfa başarı ile güncellenmiştir..');
    return redirect() -> route('admin.sayfa.index');
  }

  public function anahtar(Request $gelenler){
    Sayfa::findOrFail($gelenler -> id);
    Sayfa::where('sayfa_nu', $gelenler -> id) -> update(['durumu' => $gelenler -> yayindaMi == "true" ? 1 : 0]);
  }

  public function kaydet(Request $gelenler){
    $gelenler -> validate([
      'baslik' => 'min:3',
      'resim' => 'required | image | mimes: jpeg,png,jpg | max:2048'
    ]);
    $sirasi = Sayfa::orderBy('sirasi', 'desc') -> first() -> sirasi;
    if($gelenler -> hasFile('resim')){
      $resim = Str::slug($gelenler -> baslik) . '.' . $gelenler -> resim -> getClientOriginalExtension();
      $gelenler -> resim -> move(public_path('yuklenenler'), $resim);
      Sayfa::insert([
        'adi' => $gelenler -> baslik,
        'icerik' => $gelenler -> icerik,
        'url_adresi' => Str::slug($gelenler -> baslik),
        'olusturuldu' => now(),
        'degistirildi' => now(),
        'resim' => 'yuklenenler/' . $resim,
        'sirasi' => $sirasi + 1
      ]);
      toastr() -> success('Sayfa başarılı ile oluşturulmuştur..');
    } else {
      return 'Resim Seçmediniz..';
    }
    return redirect() -> route('admin.sayfa.index');
  }
}
