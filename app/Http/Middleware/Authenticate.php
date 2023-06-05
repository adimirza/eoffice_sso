<?php

namespace App\Http\Middleware;

use App\Lib\GetLibrary;
use App\Models\LogAuthModel;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        $token = $request->cookie('token_eoffice');
        $nip = $request->cookie('nip_eoffice');
        if ($token) {
            if ($nip == Crypt::decryptString($token)) {
                if (!session()->get('nip')) {
                    $request->session()->regenerate();
                    $data = [
                        'nip' => $request->nip,
                        'status' => 1,
                        'token_eoffice' => Crypt::encryptString($request->nip)
                    ];
                    $request->session()->put($data);
                    $lib = new GetLibrary;
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
                }
                return route('home');
            }
        }
        // return $request->expectsJson() ? null : route('login');
        return route('login');
    }
}
