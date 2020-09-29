<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Makaleler extends Migration {
  public function up() {
    Schema::create('makaleler', function (Blueprint $tablo) {
      $tablo -> id('makale_nu');
      $tablo -> string('baslik');
      $tablo -> longText('icerik');
      $tablo -> string('resim');
      $tablo -> string('url_adresi');
      $tablo -> bigInteger('kategorisi') -> unsigned();
      $tablo -> integer('tiklanma') -> default(0);
      $tablo -> integer('durumu') -> default(1) -> comment('0-> Yayında değil, 1-> Yayında');
      $tablo -> softDeletes('silindi');
      $tablo -> dateTime('olusturuldu');
      $tablo -> dateTime('degistirildi');

      $tablo -> foreign('kategorisi')
             -> references('kategori_nu')
             -> on('kategoriler')
             -> onDelete('cascade'); //Kategorilerden biri silindiğinde ona bağlı olan tüm makaleler de silinsin demektir.
    });
  }

  public function down() {
    Schema::dropIfExists('makaleler');
  }
}
