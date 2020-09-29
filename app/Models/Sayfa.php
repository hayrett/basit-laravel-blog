<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sayfa extends Model {
  protected $table = 'sayfalar';
  protected $primaryKey = 'sayfa_nu';
  const CREATED_AT = 'olusturuldu';
  const UPDATED_AT = 'degistirildi';

  use HasFactory;
}
