<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Sayfalar extends Migration {
  public function up() {
    Schema::create('sayfalar', function (Blueprint $tablo) {
      $tablo -> id('sayfa_nu');
      $tablo -> string('adi');
      $tablo -> string('resim');
      $tablo -> longText('icerik');
      $tablo -> string('url_adresi');
      $tablo -> bigInteger('sirasi');
      $tablo -> integer('durumu') -> default(1) -> comment('0-> Etkin, 1-> Etkin değil');
      $tablo -> dateTime('olusturuldu');
      $tablo -> dateTime('degistirildi');
    });
  }

  public function down() {
    Schema::dropIfExists('sayfalar');
  }
}
