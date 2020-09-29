<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Faker\Factory as Sahte;

class makaleSeeder extends Seeder {
  public function run() {
    $sahte = Sahte::create();
    for($i = 0; $i < 4; $i++) {
      $baslik = $sahte -> sentence(rand(3, 6));
      DB::table('makaleler') -> insert([
        'baslik' => $baslik,
        'icerik' => $sahte -> paragraph(rand(7, 17)),
        'resim' => $sahte -> imageUrl(800, 300, 'nature', true),
        'url_adresi' => Str::slug($baslik),
        'kategorisi' => rand(1, 7),
        'olusturuldu' => $sahte -> dateTime('now'),
        'degistirildi' => now()
      ]);
    }
  }
}
