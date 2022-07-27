<?php

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('{any}', function () {
    return view('app'); // or wherever your React app is bootstrapped.
})->where('any', '.*');

//Route::get('/', function () {
//    return view('app'); // or wherever your React app is bootstrapped.
//});


Route::get('/verify/verify',function (\Illuminate\Http\Request $request){
    $code = $request->code;
   $user = \App\Models\User::where('verify_code','=',$code)->first();
    $user->is_verify = 1;
    $user->email_verify_at = now();
    $user->save();
    echo "Your account is verify";
});

