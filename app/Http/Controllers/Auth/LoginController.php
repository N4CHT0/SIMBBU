<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function authenticated(Request $request, $user)
    {
        // Check user role and redirect accordingly
        if ($user->hasRole('admin')) {
            return redirect()->route('admin.home');
        }
        if ($user->hasRole('peserta')) {
            return redirect()->route('peserta.home');
        }
        if ($user->hasRole('keuangan')) {
            return redirect()->route('keuangan.home');
        }
        if ($user->hasRole('pegawai')) {
            return redirect()->route('k.home');
        }
        if ($user->hasRole('pesertaujian')) {
            return redirect()->route('peserta_ujian.home');
        }
        if ($user->hasRole('inventory')) {
            return redirect()->route('inventory.home');
        }
        if ($user->hasRole('pengajar')) {
            return redirect()->route('pengajar.home');
        }

        return redirect($this->redirectTo);
    }
}
