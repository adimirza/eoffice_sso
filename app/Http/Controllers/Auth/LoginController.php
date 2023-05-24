<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Lib\GetLibrary;
use App\Models\LogAuthModel;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login_sso(Request $request)
    {
        Validator::make($request->all(), [
            'nip' => 'required',
            'password' => 'required',
            // 'captcha' => 'required|captcha'
            // 'CaptchaCode' => 'required|captcha_validate'
            // 'g-recaptcha-response' => 'recaptcha',
        ])->validate();

        $lib = new GetLibrary;
        $ceknip = $lib->periksanip($request->nip);
        $res_nip = json_decode($ceknip, true)['data'];

        if ($res_nip) {
            $login = $lib->apiLogin($request->nip, $request->password);
            $result = json_decode($login, true)['data'];

            if ($result) {
                $request->session()->regenerate();
                $data = [
                    'nip' => $request->nip,
                    'status' => 1,
                    'token_eoffice' => Crypt::encryptString($request->nip)
                ];
                $request->session()->put($data);
                $result = $lib->getIP($request->ip());
                LogAuthModel::create([
                    'nip' => $data['nip'],
                    'token' => session()->get('token_eoffice'),
                    'status' => 1,
                    'tanggal' => date('Y-m-d H:i:s'),
                    'ip' => $request->ip(),
                    'latitude' => $result['latitude'],
                    'longitude' => $result['longitude'],
                ]);
                setcookie('token_eoffice', session()->get('token_eoffice'), time() + (86400 * 30), "/");
                setcookie('nip_eoffice', session()->get('nip'), time() + (86400 * 30), "/");

                return redirect()->intended('/home');
            } else {
                return 'Password salah.';
            }
        } else {
            return 'NIP tidak ditemukan.';
        }
        return back()->with('loginError', 'Login Failed!');
    }

    public function periksa_token(Request $request)
    {
        $dt['status'] = 0;
        if($request->nip == Crypt::decryptString($request->token_eoffice)){
            $dt['status'] = 1;
        }
        return json_encode($dt);
    }

    public function logout_sso(Request $request)
    {
        setcookie("token_eoffice", "", time() - 3600, "/");
        setcookie("nip_eoffice", "", time() - 3600, "/");
        $lib = new GetLibrary;
        $result = $lib->getIP($request->ip());
        LogAuthModel::create([
            'nip' => session()->get('nip'),
            'token' => session()->get('token_eoffice'),
            'status' => 0,
            'tanggal' => date('Y-m-d H:i:s'),
            'ip' => $request->ip(),
            'latitude' => $result['latitude'],
            'longitude' => $result['longitude'],
        ]);
        $request->session()->flush();
        return redirect()->intended('/login');
    }

    // public function token_validation(Request $request)
	// {
		
	// }
}
