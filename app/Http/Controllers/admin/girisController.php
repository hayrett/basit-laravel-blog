<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Yonetici;
use Illuminate\Support\Facades\Auth;

class girisController extends Controller {
  public function giris() {
    return view('admin.dogrulama.giris');
  }

  public function girisPost(Request $gelenler) {
    //dd($gelenler -> post());
    if(Auth::attempt(['eposta' => $gelenler -> eposta, 'password' => $gelenler -> sifre])) {
      toastr() -> success('', 'Tekrar Hoşgeldin ' . Auth::user() -> adi);
      return redirect() -> route('admin.gosterge');
    } else {
      return redirect() -> route('admin.giris') -> withErrors('Giriş bilgilerinizde hata var');
    }
  }

  public function cikis() {
    Auth::logout();
    return redirect() -> route('admin.giris');
  }
}
