<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class yoneticiSeeder extends Seeder {
  public function run() {
    DB::table('yonetici') -> insert([
      'adi' => 'Hayrettin KK',
      'eposta' => 'hayrett@yaani.com',
      'sifre' => bcrypt(112233)
    ]);
  }
}
