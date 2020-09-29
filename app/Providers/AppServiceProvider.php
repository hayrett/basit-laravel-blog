<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use App\Models\Ayar;

class AppServiceProvider extends ServiceProvider{
  public function register(){

  }

  public function boot(){
    view() -> share('siteBilgileri', Ayar::find(1));
    Route::resourceVerbs([
      'create' => 'olustur',
      'edit' => 'duzenle'
    ]);
  }
}
