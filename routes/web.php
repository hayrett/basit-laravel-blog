<?php

use Illuminate\Support\Facades\Route;

Route::get('yayinda-degil', function(){
  return view('arayuz.cevrimdisi');
});

// Yönetici Rotaları
Route::prefix('admin') -> name('admin.') -> middleware('girisYapildiMi') -> group(function(){
  Route::get('giris', 'admin\girisController@giris') -> name('giris');
  Route::post('giris', 'admin\girisController@girisPost') -> name ('giris.post');
});

Route::prefix('admin') -> name('admin.') -> middleware('adminMi') -> group(function(){
  Route::get('', 'admin\gostergeController@ana') -> name('gosterge');
  // Makale Rotaları
  Route::get('makaleler/silinenler', 'admin\makaleController@silinenler') -> name('makale.silinenler');
  Route::resource('makaleler', 'admin\makaleController') -> name('*', 'makaleler');
  Route::get('anahtar', 'admin\makaleController@anahtar') -> name('anahtar');
  Route::get('makalesil/{id}', 'admin\makaleController@sil') -> name('makale.sil');
  Route::get('makaletyoket/{id}', 'admin\makaleController@yokEt') -> name('makale.yoket');
  Route::get('makalegerial/{id}', 'admin\makaleController@geriAl') -> name('makale.gerial');
  // Kategori Rotaları
  Route::get('kategoriler', 'admin\kategoriController@index') -> name('kategori.index');
  Route::post('kategoriler/ekle', 'admin\kategoriController@ekle') -> name('kategori.ekle');
  Route::post('kategoriler/guncelle', 'admin\kategoriController@guncelle') -> name('kategori.guncelle');
  Route::post('kategoriler/sil', 'admin\kategoriController@sil') -> name('kategori.sil');
  Route::get('kategori/durum', 'admin\kategoriController@anahtar') -> name('kategori.anahtar');
  Route::get('kategori/duzenle', 'admin\kategoriController@duzenle') -> name('kategori.duzenle');
  // Sayfa Rotaları
  Route::get('sayfalar', 'admin\sayfaController@index') -> name('sayfa.index');
  Route::get('sayfalar/olustur', 'admin\sayfaController@olustur') -> name('sayfa.olustur');
  Route::get('sayfalar/guncelle/{id}', 'admin\sayfaController@guncelle') -> name('sayfa.guncelle');
  Route::post('sayfalar/guncelle/{id}', 'admin\sayfaController@guncellePost') -> name('sayfa.guncelle.post');
  Route::post('sayfalar/olustur', 'admin\sayfaController@kaydet') -> name('sayfa.kaydet');
  Route::get('sayfalar/anahtar', 'admin\sayfaController@anahtar') -> name('sayfa.anahtar');
  Route::get('sayfalar/sil/{id}', 'admin\sayfaController@sil') -> name('sayfa.sil');
  Route::get('sayfalar/sirala', 'admin\sayfaController@sirala') -> name('sayfa.sirala');
  // Ayar Rotaları
  Route::get('ayarlar', 'admin\ayarController@index') -> name('ayar.index');
  Route::post('ayarlar/guncelle', 'admin\ayarController@guncelle') -> name('ayar.guncelle');
  //
  Route::get('cikis', 'admin\girisController@cikis') -> name('cikis');
});

// Kullanıcı Rotaları
Route::get('', 'arayuz\anaController@ana') -> name('anasayfa');
Route::get('iletisim', 'arayuz\anaController@iletisim') -> name('iletisim');
Route::post('iletisim', 'arayuz\anaController@iletisimGonder') -> name('iletisim.gonder');
Route::get('kategori/{kategori}', 'arayuz\anaController@basligaGit') -> name('basligagit');
Route::get('{kategori}/{url}', 'arayuz\anaController@adreseGit') -> name('adresegit');
Route::get('{sayfa}', 'arayuz\anaController@sayfa') -> name('sayfayagit');
