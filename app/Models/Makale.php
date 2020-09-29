<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Makale extends Model {
  use HasFactory;
  use SoftDeletes;
  protected $table = 'makaleler';
  protected $primaryKey = 'makale_nu';
  const CREATED_AT = 'olusturuldu';
  const UPDATED_AT = 'degistirildi';
  const DELETED_AT = 'silindi';

  public function kategoriGetir() {
    return $this -> hasOne('App\Models\Kategori', 'kategori_nu', 'kategorisi');
  }
}
