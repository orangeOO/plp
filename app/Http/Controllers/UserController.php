<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function profile(Request $request) {
        $user = $request->user();
        echo $user['name'].'登录成功!'.'    <a href="/auth/logout">退出登录</a>';
    }
}
