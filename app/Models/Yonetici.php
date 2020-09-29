<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;

class Yonetici extends User {
  protected $table = 'yonetici';

  use HasFactory;

  public function getAuthPassword(){
    return $this -> sifre;
  }
}
