<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Makale;
use App\Models\Kategori;
use App\Models\Sayfa;

class gostergeController extends Controller {
  public function ana() {
    $makaleSay = Makale::where('durumu', 1) -> count();
    $goruntulenmeSay = Makale::where('durumu', 1) -> sum('tiklanma');
    $kategoriSay = Kategori::where('durumu', 1) -> count();
    $sayfaSay = Sayfa::where('durumu', 1) -> count();
    return view('admin.gosterge', compact('makaleSay', 'goruntulenmeSay', 'kategoriSay', 'sayfaSay'));
  }
}
