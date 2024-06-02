<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Http\Client\Response;

class AcumaticaController extends Controller
{
    public function login(){
        $acumaticaUrl = 'http://18.141.54.219:89/entity/auth/login';
        $requestBody = [
            'name' => env('ACUMATICA_USERNAME'),
            'password' => env('ACUMATICA_PASSWORD'),
            'tenant' =>env('ACUMATICA_TENANT'),
            'branch' => env('ACUMATICA_BRANCH'),
            'locale' => env('ACUMATICA_LOCALE')
        ];
        $response = Http::post($acumaticaUrl, $requestBody);

        if($response->successful()){
            if ($response instanceof Response) {
                $responseHeaders = $response->headers();
                if (isset($responseHeaders['Set-Cookie'])) {
                    $cookies = $responseHeaders['Set-Cookie'];
                    foreach ($cookies as $cookie) {                    
                        preg_match('/^([^=]+)=([^;]+)/', $cookie, $matches);
                        if (count($matches) === 3) {
                            $cookieName = $matches[1];
                            $cookieValue = $matches[2];
                            Cookie::queue($cookieName, $cookieValue, 400);
                        }
                    }
                return response()->json(['message' => 'Login successful']);
                }
            }
        }
        else{
            return response()->json(['message' => 'Unsuccessful Login']);
        }   
    }

    public function products(Request $request){

        $laravelCookies = Cookie::get();
        $acumaticaUrl = 'http://18.141.54.219:89/entity/Default/22.200.001/StockItem';

        // $response = Http::get($acumaticaUrl);
        // $response = Http::withCookies($laravelCookies)->get($acumaticaUrl);
        $response = Http::withHeaders($laravelCookies)->get($acumaticaUrl);

       if($response->successful()){
            dd($response);
        }else{
            dd('an error occured for products');
        }
    }
}
