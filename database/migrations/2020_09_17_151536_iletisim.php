<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class iletisim extends Migration {
  public function up() {
    Schema::create('iletisim', function (Blueprint $tablo) {
      $tablo -> id('iletisim_nu');
      $tablo -> string('adi');
      $tablo -> string('eposta');
      $tablo -> string('konu');
      $tablo -> longText('ileti');
      $tablo -> dateTime('olusturuldu');
      $tablo -> dateTime('degistirildi');
    });
  }

  public function down() {
    Schema::dropIfExists('iletisim');
  }
}
