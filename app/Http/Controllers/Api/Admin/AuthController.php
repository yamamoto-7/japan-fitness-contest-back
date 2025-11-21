<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
  // POST /api/admin/login
  public function login(Request $req)
  {
      $cred = $req->validate([
          'login_id' => 'required|string',
          'password' => 'required|string',
      ]);

      /** @var \Tymon\JWTAuth\JWTGuard $guard */
      $guard = auth('admin');

      if (! $token = $guard->attempt($cred)) {
          return response()->json(['message' => 'invalid credentials'], 401);
      }

      return $this->respondWithToken($token);
  }

  // POST /api/admin/refresh
  public function refresh() {
    /** @var \Tymon\JWTAuth\JWTGuard $guard */
    $guard = auth('admin');

    return $this->respondWithToken($guard->refresh());
  }

  public function me() {
    return response()->json(auth('admin')->user());
  }

  public function logout() {
    /** @var \Tymon\JWTAuth\JWTGuard $guard */
    $guard = auth('admin');
    $guard->logout(true); // invalidate refresh chain

    return response()->json(['ok'=>true]);
  }

  private function respondWithToken(string $token) {
    /** @var \Tymon\JWTAuth\JWTGuard $guard */
    $guard = auth('admin');
    $refresh = $guard->claims(['typ'=>'refresh'])->setTTL(60*24*7)->tokenById(auth('admin')->id());
    return response()
      ->json([
        'access_token' => $token,
        'token_type'   => 'Bearer',
        'expires_in'   => $guard->factory()->getTTL() * 60,
      ])
      ->cookie('admin_refresh', $refresh, 60*24*7, '/', null, false, true, false, 'Lax'); // HttpOnly
  }
}
