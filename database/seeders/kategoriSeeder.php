<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class kategoriSeeder extends Seeder {
  public function run() {
    $kategoriler = ['Genel', 'Eğlence', 'Bilişim', 'Gezi', 'Teknoloji', 'Sağlık', 'Spor', 'Günlük Yaşam'];
    foreach ($kategoriler as $kategori) {
      DB::table('kategoriler') -> insert([
        'adi' => $kategori,
        'url_adresi' => Str::slug($kategori),
        'olusturuldu' => now(),
        'degistirildi' => now()
      ]);
    }
  }
}
