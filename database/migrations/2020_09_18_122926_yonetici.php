<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Yonetici extends Migration
{
  public function up() {
    Schema::create('yonetici', function (Blueprint $tablo) {
      $tablo -> id();
      $tablo -> string('adi');
      $tablo -> string('eposta');
      $tablo -> string('sifre');
    });
  }

  public function down() {
      Schema::dropIfExists('yonetici');
  }
}
