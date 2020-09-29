<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model {
  use HasFactory;
  protected $table = 'kategoriler';
  protected $primaryKey = 'kategori_nu';
  const CREATED_AT = 'olusturuldu';
  const UPDATED_AT = 'degistirildi';

  public function makaleSay() {
    return $this -> hasMany('App\Models\Makale', 'kategorisi', 'kategori_nu') -> where('durumu', 1) -> count();
  }
}
