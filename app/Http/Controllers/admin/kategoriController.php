<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kategori;
use App\Models\Makale;
use Illuminate\Support\Str;

class kategoriController extends Controller{
  public function index(){
    $kategoriler = Kategori::orderBy('adi', 'asc') -> get();
    return view('admin.kategoriler.index', compact('kategoriler'));
  }

  public function anahtar(Request $gelenler){
    Kategori::findOrFail($gelenler -> id);
    Kategori::where('kategori_nu', $gelenler -> id) -> update(['durumu' => $gelenler -> yayindaMi == "true" ? 1 : 0]);
  }

  public function duzenle(Request $gelenler){
    $kategori = Kategori::findOrFail($gelenler -> id);
    return response() -> json($kategori);
  }

  public function guncelle(Request $gelenler){
    $varMi = Kategori::where('url_adresi', Str::slug($gelenler -> kategori_adi)) -> whereNotIn('kategori_nu', [$gelenler -> kategori_nu]) -> first();
    if($varMi){
      toastr() -> error($gelenler -> kategori_adi . ' adında bir kategori zaten var!!');
    } else {
      Kategori::where('kategori_nu', $gelenler -> kategori_nu) -> update([
        'adi' => $gelenler -> kategori_adi,
        'url_adresi' => Str::slug($gelenler -> kategori_adi),
        'degistirildi' => now()
      ]);
      toastr() -> success('Kategori başarıyla güncellendi.');
    }
    return redirect() -> back();
  }

  public function ekle(Request $gelenler){
    if(!$gelenler -> kategori){
      toastr() -> error('Herhangi bir kategori adı yazmadınız!');
    }else{
      $varMi = Kategori::where('url_adresi', Str::slug($gelenler -> kategori)) -> first();
      if($varMi){
        toastr() -> error($gelenler -> kategori . ' adında bir kategori zaten var!!');
      }else{
        Kategori::insert([
          'adi' => $gelenler -> kategori,
          'url_adresi' => Str::slug($gelenler -> kategori),
          'olusturuldu' => now(),
          'degistirildi' => now()
        ]);
        toastr() -> success($gelenler -> kategori . ' kategorisi başarıyla oluşturuldu.');
      }
    }
    return redirect() -> back();
  }

  public function sil(Request $gelenler){
    $kategori = Kategori::findOrFail($gelenler -> sil_nu);
    $makaleSay = $kategori -> makaleSay();
    if($kategori -> kategori_nu == 1){
      toastr() -> error('Bu kategori silinemez!');
    }elseif($makaleSay > 0){
      Makale::where('kategorisi', $kategori -> kategori_nu) -> update(['kategorisi' => 1]);
      $silinemezKategori = Kategori::find(1) -> adi;
      toastr() -> success($kategori -> adi . ' kategorisine ait ' . $makaleSay . ' adet makale ' . $silinemezKategori . ' kategorisine taşınmıştır.', 'Kategori başarıyla silindi.');
      $kategori -> delete();
    }else{
      toastr() -> success($kategori -> adi . ' kategorisi başarıyla silindi.');
      $kategori -> delete();
    }
    return redirect() -> back();
  }
}
