<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class AppServiceProvider extends ServiceProvider{
  public function register(){

  }

  public function boot(){
    Route::resourceVerbs([
      'create' => 'olustur',
      'edit' => 'duzenle'
    ]);
  }
}
