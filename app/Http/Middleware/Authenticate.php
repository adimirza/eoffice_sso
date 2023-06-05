<?php

namespace App\Http\Middleware;

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
        if($token){
            if ($nip == Crypt::decryptString($token)) {
                if(!session()->get('nip')){
                    $request->session()->regenerate();
                    $data = [
                        'nip' => $request->nip,
                        'status' => 1,
                        'token_eoffice' => Crypt::encryptString($request->nip)
                    ];
                    $request->session()->put($data);
                }
                return route('home');
            }
        }
        // return $request->expectsJson() ? null : route('login');
        return route('login');
    }
}
