<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ayar;
use Illuminate\Support\Str;
use File;

class ayarController extends Controller{
  public function index(){
    $ayar = Ayar::find(1);
    return view('admin.ayar.index', compact('ayar'));
  }

  public function guncelle(Request $gelenler){
    $eskiAmblem = Ayar::find(1) -> amblem;
    $eskiSimge = Ayar::find(1) -> simge;
    Ayar::where('id', 1) -> update([
      'site_adi' => $gelenler -> site_adi,
      'yayinda' => $gelenler -> yayinda,
      'facebook' => $gelenler -> facebook,
      'twitter' => $gelenler -> twitter,
      'github' => $gelenler -> github,
      'linkedin' => $gelenler -> linkedin,
      'youtube' => $gelenler -> youtube,
      'instagram' => $gelenler -> instagram,
      'degistirildi' => now()
    ]);

    if($gelenler -> hasFile('amblem')){
      if(File::exists($eskiAmblem)){
        File::delete($eskiAmblem);
      }
      $amblem = Str::slug($gelenler -> site_adi) . '-amblem.' . $gelenler -> amblem -> getClientOriginalExtension();
      $gelenler -> amblem -> move(public_path('yuklenenler'), $amblem);
      Ayar::where('id', 1) -> update(['amblem' => 'yuklenenler/' . $amblem]);
    }

    if($gelenler -> hasFile('simge')){
      if(File::exists($eskiSimge)){
        File::delete($eskiSimge);
      }
      $amblem = Str::slug($gelenler -> site_adi) . '-simge.' . $gelenler -> simge -> getClientOriginalExtension();
      $gelenler -> simge -> move(public_path('yuklenenler'), $amblem);
      Ayar::where('id', 1) -> update(['simge' => 'yuklenenler/' . $amblem]);
    }

    toastr() -> success('Ayarlarınız başarıyla güncellendi.');
    return redirect() -> back();
  }
}
