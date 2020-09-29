<?php

namespace App\Http\Controllers\arayuz;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Validator;
use Mail;

//Modeller
use App\Models\Kategori;
use App\Models\Makale;
use App\Models\Sayfa;
use App\Models\Iletisim;
use App\Models\Ayar;

class anaController extends Controller {
  public function __construct(){ // Tüm fonksiyonlarda ortak çalışacak komutlar..
    if(Ayar::find(1) -> yayinda == 0){
      return redirect() -> to('yayinda-degil') -> send();
    }
    view() -> share('sayfalar', Sayfa::where('durumu', 1) -> orderBy('sirasi', 'ASC') -> get());
    view() -> share('kategoriler', Kategori::where('durumu', 1) -> orderBy('adi', 'ASC') -> get());
  }

  public function ana(){
    $veriler['makaleler'] = Makale::with('kategoriGetir') -> where('durumu', 1) -> whereHas('kategoriGetir', function($sorgu){
      $sorgu -> where('durumu', 1);
    }) -> orderBy('olusturuldu', 'DESC') -> paginate(2);
    // $veriler['makaleler'] -> withPath(url('sayfa'));
    return view('arayuz.anasayfa', $veriler);
  }

  public function adreseGit($kategori, $url){
    $kategori = Kategori::where('url_adresi', $kategori) -> where('durumu', 1) -> first() ?? abort(403, 'Sistemimizde böyle bir başlık bulunamamıştır!');
    $makale = Makale::where('url_adresi', trim($url, '-')) -> where('kategorisi', $kategori -> kategori_nu) -> where('durumu', 1) -> first() ?? abort(403, 'Sistemimizde böyle bir makale bulunamamıştır!');
    $makale -> increment('tiklanma');
    $veriler['makale'] = $makale;
    return view('arayuz.makale', $veriler);
  }

  public function basligaGit($url){
    $kategori = Kategori::where('url_adresi', $url) -> where('durumu', 1) -> first() ?? abort(403, 'Sistemimizde böyle bir başlık bulunamamıştır!');
    $veriler['kategori'] = $kategori;
    $veriler['makaleler'] = Makale::where('kategorisi', $kategori -> kategori_nu) -> where('durumu', 1) -> orderBy('olusturuldu', 'DESC') -> paginate(1);
    return view('arayuz.anasayfa', $veriler);
  }

  public function sayfa($url){
    $sayfa = Sayfa::where('url_adresi', $url) -> where('durumu', 1) -> first() ?? abort(403, 'Böyle bir sayfa bulunamadı!');
    $veriler['sayfalar'] = Sayfa::orderBy('sirasi', 'ASC') -> get();
    $veriler['sayfa'] = $sayfa;
    return view('arayuz.sayfa', $veriler);
  }

  public function iletisim(){
    return view('arayuz.iletisim');
  }

  public function iletisimGonder(Request $gelenler){
    $kontrol = Validator::make($gelenler -> post(), [
      'adi' => 'required | min:5',
      'eposta' => 'required | email',
      'konu' => 'required',
      'ileti' => 'required | min:10'
    ]);
    if ($kontrol -> fails()) {
      return redirect() -> route('iletisim') -> withErrors($kontrol) -> withInput();
    }else{
      // Iletisim::insert([
      //   'adi' => $gelenler -> adi,
      //   'eposta' => $gelenler -> eposta,
      //   'konu' => $gelenler -> konu,
      //   'ileti' => $gelenler -> ileti,
      //   'olusturuldu' => now(),
      //   'degistirildi' => now()
      // ]);
      Mail::send([], [], function($ileti) use($gelenler){
          $ileti -> from('iletisim@blogsitesi.com', 'Blog Sitesi');
          $ileti -> to('iletisim@blogsitesi.com');
          $ileti -> setBody('Gönderen Adı: ' . $gelenler -> adi . '<br>
                             Gönderen E-Posta: ' . $gelenler -> eposta . '<br>
                             Konusu: ' . $gelenler -> konu . '<br>
                             İleti: ' . $gelenler -> ileti . '<br><br>
                             Gönderilme Tarihi: ' . now(), 'text/html');
          $ileti -> subject($gelenler -> adi . ' iletişimden ileti gönderdi.');
      });
      return redirect() -> route('iletisim') -> with('basarili', 'İletişim bilgileriniz başarıyla alındı. En kısa sürede sizinle iletişime geçilecektir.');
    }
  }
}
