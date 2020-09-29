<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Kategoriler extends Migration {
  public function up() {
    Schema::create('kategoriler', function (Blueprint $tablo) {
      $tablo -> id('kategori_nu');
      $tablo -> string('adi');
      $tablo -> string('url_adresi');
      $tablo -> integer('durumu') -> default(1) -> comment('0-> Etkin değil, 1-> Etkin');
      $tablo -> dateTime('olusturuldu');
      $tablo -> dateTime('degistirildi');
    });
  }

  public function down() {
    Schema::dropIfExists('kategoriler');
  }
}
