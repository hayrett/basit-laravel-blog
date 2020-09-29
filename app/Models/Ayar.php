<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ayar extends Model{
  protected $table = 'ayarlar';
  const CREATED_AT = 'olusturuldu';
  const UPDATED_AT = 'degistirildi';
  
  use HasFactory;
}
