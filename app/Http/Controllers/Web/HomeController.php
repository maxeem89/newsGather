<?php

namespace App\Http\Controllers\Web;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use jcobhams\NewsApi\NewsApi;
use GuzzleHttp\Client;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    private $client;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->client = new Client();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {

        if(!isset(Auth::user()->roles[0]) || Auth::user()->roles[0]->name == env("ROLE_READER")){
            return redirect(route('out.home'));
        }

        return view('home');
    }

    function callAPI($method, $url, $data = false)
    {

      $curl = curl_init();

        switch ($method)
        {
            case "POST":
               curl_setopt($curl, CURLOPT_POST, 1);

               if ($data)
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                break;
            case "PUT":
                curl_setopt($curl, CURLOPT_PUT, 1);
                break;
            default:
                if ($data)
                   $url = sprintf("%s?%s", $url, http_build_query($data));
        }

       // Optional Authentication:
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($curl, CURLOPT_USERPWD, "username:password");

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

        $result = curl_exec($curl);

       curl_close($curl);

        return $result;
   }
}
