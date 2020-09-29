<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Iletisim extends Model {
  protected $table = 'iletisim';
  protected $primaryKey = 'iletisim_nu';
  const CREATED_AT = 'olusturuldu';
  const UPDATED_AT = 'degistirildi';
  use HasFactory;
}
