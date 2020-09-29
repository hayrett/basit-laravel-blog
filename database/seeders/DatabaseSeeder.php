<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use File;

class DatabaseSeeder extends Seeder {
  public function run() {
    $this -> call(kategoriSeeder::class);
    $this -> call(makaleSeeder::class);
    $this -> call(sayfaSeeder::class);
    $this -> call(yoneticiSeeder::class);
    $this -> call(ayarSeeder::class);

    File::deleteDirectory(public_path('yuklenenler/'));
  }
}
