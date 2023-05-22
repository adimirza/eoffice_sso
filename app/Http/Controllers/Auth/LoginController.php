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
        $login = $lib->apiLogin($request->nip, $request->password);
        $result = json_decode($login, true)['data'];

        if ($result) {
            $request->session()->regenerate();
            $data = [
                'nip' => $request->nip,
                'status' => 1,
            ];
            $request->session()->put($data);

            // $minutes = 800;
            // $response = new Response('Set Cookie');
            // $response->withCookie(cookie('token_eoffice', session()->get('_token'), $minutes));
            // Cookie::queue('token_eoffice', $token_sso, $minutes);
            // Cookie::queue('nip', $request->nip, $minutes);
            $ip = $request->ip();
            $result  = array('country'=>'Local', 'city'=>'Local', 'latitude'=>'-6.996612', 'longitude'=>'109.1267785');
            $ip_data = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=".$ip));    
            if($ip_data && $ip_data->geoplugin_countryName != null){
                $result['country'] = $ip_data->geoplugin_countryName;
                $result['city'] = $ip_data->geoplugin_city;
                $result['latitude'] = $ip_data->geoplugin_latitude;
                $result['longitude'] = $ip_data->geoplugin_longitude;
            }
            $check = LogAuthModel::where('nip', $data['nip'])->first();
            if(!$check){
                LogAuthModel::create([
                    'nip' => $data['nip'],
                    'token' => session()->get('_token'),
                    'status' => 1,
                    'terakhir_login' => date('Y-m-d H:i:s'),
                    'ip' => $ip,
                    'latitude' => $result['latitude'],
                    'longitude' => $result['longitude'],
                ]);
            }else{
                LogAuthModel::findOrFail($check->id)->update([
                    'token' => session()->get('_token'),
                    'status' => 1,
                    'terakhir_login' => date('Y-m-d H:i:s'),
                    'ip' => $ip,
                    'latitude' => $result['latitude'],
                    'longitude' => $result['longitude'],
                ]);
            }
            
            setcookie('token_eoffice', session()->get('_token'), time() + (86400 * 30), "/");
            // Cookie::queue('token_eoffice', session()->get('_token'), $minutes);
            // cookie('token_eoffice', session()->get('_token'), $minutes);

            return redirect()->intended('/home');
        }

        return back()->with('loginError', 'Login Failed!');
        // $request->session()->regenerate();

    }
}
