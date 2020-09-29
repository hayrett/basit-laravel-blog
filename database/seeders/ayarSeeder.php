<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ayarSeeder extends Seeder{
  public function run(){
    DB::table('ayarlar') -> insert([
      'site_adi' => 'Blog Sitesi',
      'olusturuldu' => now(),
      'degistirildi' => now()
    ]);
  }
}
