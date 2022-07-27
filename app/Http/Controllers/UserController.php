<?php

namespace App\Http\Controllers;

use App\Mail\RegisterMail;
use App\Models\User;
use App\Rules\address_check;
use App\Rules\phoneVietNamCheck;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use function PHPUnit\Framework\isFalse;

class UserController extends Controller
{
    public  function register(Request $request){



        $value = Validator::make($request->all(),[
            'username'=>'required|unique:users|max:20|alpha',
            'name'=>'required|min:3|max:40',
            'email'=>'required|unique:users|email',
            'password'=>'required|min:6|max:20',
            'phone'=>['required',new phoneVietNamCheck()],
            'address'=>['required',new address_check()],

        ]);
        if ($value->fails()){
            return response(['message'=>'Có lỗi xảy ra với dữ liệu','error'=>$value->errors()], 401);

        }
        $verify_code = hash('sha256',time());


        $name = $value->validated()['name'];
        $user = new User();
        $user->username = $value->validate()['username'];
        $user->name  = $name;
        $user->password = Hash::make($value->validate()['password']);
        $user->email = $value->validate()['email'];
        $user->phone = $value->validate()['phone'];
        $user->address = $value->validate()['address'];
        $user->verify_code = $verify_code ;
        $user->role = "user";
        $user->save();
           Mail::to($value->validated()['email'])->send(new RegisterMail($name,$verify_code));
        return response(['message'=>'Đăng ký thành công , vui lòng kiểm tra email để hoàn thành'], 200);
    }

    public function login(Request $request){
     $username = $request->username;
     $password = $request->password;
     $check_pass = Auth::attempt(['username'=>$username,'password'=>$password]);
        if ($check_pass){
            $account = User::where('username','=',$username)->first();
            if ($account->is_verify == null){
                return response(['message'=>'Vui lòng kiểm kiểm tra email xác thực ở email'], 401);

            }
            $token = $account->createToken($account->id)->plainTextToken;
            return response(['message'=>'Đăng nhập thành công','token'=>$token], 200);

        }
        else{
            return response(['message'=>'Đăng nhập thất bại'], 401);

        }
    }

    public function logout(Request $request){
// Get user who requested the logout
        $user = Auth::user(); //or Auth::user()
// Revoke current user token
       $result = $user->tokens()->where('id', $user->currentAccessToken()->id)->delete();
        if ($result){
            return response(['message'=>'Logout Success'], 200);
        }
        else{
            return response(['message'=>'Logout Failed'], 401);
        }
    }

}
