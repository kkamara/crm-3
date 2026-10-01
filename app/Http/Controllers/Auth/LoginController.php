<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    /** @var array to store seeder logins for site users */
    protected $loginEmails = array(
        array(
            'email' => 'admin@example.com',
            'role'  => 'admin',
        ),
        array(
            'email' => 'clientadmin@example.com',
            'role'  => 'client_admin',
        ),
        array(
            'email' => 'clientuser@example.com',
            'role'  => 'client_user',
        ),
    );

    public function create()
    {
        if(Auth::check()) {
            return redirect()->route('Dashboard');
        }

        return view('auth/login')
            ->withTitle('Login')
            ->withLoginEmails($this->loginEmails);
    }

    public function store(Request $request)
    {
        $email = strtolower( trim( request('email') ) );

        if(($email && request('password')) == FALSE)
        {
            return back()->with('errors', ['Missing email and password.']);
        }

        if(!$user = DB::select('select distinct * from users where email = ?', [$email]))
        {
            return back()->with('errors', ['Invalid login credentials provided.']);
        }

        $user = $user[0];

        if(!Auth::attempt(['email' => $user->email, 
            'password' => request('password')], 
            (int) request('remember_me')))
        {
            return back()->with('errors', ['Invalid login credentials provided.']);
        }

        DB::table('users')->update([
            'last_login' => date('Y-m-d H:i:s')
        ]);

        return redirect()
                ->route('Dashboard')
                ->with('flashSuccess', 'You have logged in, '.$user->first_name.' '.$user->last_name.'!');        
    }

    public function logout()
    {
        Auth::logout();

        return redirect('/');
    }
}
