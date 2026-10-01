<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;

class ResetPasswordController extends Controller
{
    public function create()
    {

        return view('auth.forgot')->withTitle('Reset Password');
    }
}
