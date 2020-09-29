<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class sayfaSeeder extends Seeder {
  public function run() {
    $i = 0;
    $sayfalar = ['HAKKIMIZDA', 'KARİYER', 'HEDEFİMİZ', 'GÖREVİMİZ'];
    foreach ($sayfalar as $sayfa) {
      $i++;
      DB::table('sayfalar') -> insert([
        'adi' => $sayfa,
        'resim' => 'https://external-content.duckduckgo.com/iu/?u=http%3A%2F%2Fmarketingland.com%2Fwp-content%2Fml-loads%2F2015%2F01%2Fanalytics-technology-ss-1920.jpg&f=1&nofb=1',
        'icerik' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
                    Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor
                    in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident,
                    sunt in culpa qui officia deserunt mollit anim id est laborum.',
        'url_adresi' => Str::slug($sayfa),
        'sirasi' => $i,
        'olusturuldu' => now(),
        'degistirildi' => now()
      ]);
    }
  }
}
