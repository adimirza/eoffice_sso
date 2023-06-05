<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Lib\GetLibrary;
use App\Models\LogAuthModel;
use App\Models\PengumumanModel;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth_api');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        print_r($request->header('User-Agent'));
        echo '<br>';
        print_r(request()->userAgent());
        die;
        $data['pengumuman'] = PengumumanModel::orderBy('updated_at', 'DESC')->get();
        return view('home', $data);
    }

    public function cekApi(Request $request)
    {
        // $check = LogAuthModel::where('token', $request->token)->first();
        // echo $request->nip;
        echo "===".session()->get('nip')."===";
        if(session()->get('nip')){
            return json_encode(session()->get('nip'));
        }
        return 'tidak ada';
        // return json_encode(session()->all());
    }
}
