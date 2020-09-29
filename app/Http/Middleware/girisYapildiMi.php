<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class girisYapildiMi{
  public function handle(Request $request, Closure $next){
    if(Auth::check()){
      return redirect() -> route('admin.gosterge');
    }
    return $next($request);
  }
}
