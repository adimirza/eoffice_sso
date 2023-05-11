<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Lib\GetLibrary;
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
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function cekApi(Request $request)
    {
        $lib = new GetLibrary;
        $login = $lib->apiLogin($request->nip, $request->password);
        // $response = json_decode($login, true);
        return json_decode($login, true)['data'][0]['id_pegawai'];
        // return $response = Http::withOptions([
        //     'verify' => false,
        // ])->get('https://jsonplaceholder.typicode.com/todos/1');
    }
}
