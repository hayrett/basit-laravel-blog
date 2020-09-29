<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Ayarlar extends Migration{
  public function up(){
    Schema::create('ayarlar', function (Blueprint $tablo) {
      $tablo -> id();
      $tablo -> string('site_adi');
      $tablo -> string('amblem') -> nullable();
      $tablo -> string('simge') -> nullable();
      $tablo -> integer('yayinda') -> default(1);
      $tablo -> string('facebook') -> nullable();
      $tablo -> string('twitter') -> nullable();
      $tablo -> string('github') -> nullable();
      $tablo -> string('linkedin') -> nullable();
      $tablo -> string('youtube') -> nullable();
      $tablo -> string('instagram') -> nullable();
      $tablo -> dateTime('olusturuldu');
      $tablo -> dateTime('degistirildi');
    });
  }

  public function down(){
      Schema::dropIfExists('ayarlar');
  }
}
