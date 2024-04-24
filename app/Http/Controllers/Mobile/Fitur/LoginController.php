<?php

namespace App\Http\Controllers\Mobile\Fitur;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class LoginController extends Controller
{
    
    public function Login(Request $request){
        $validator = Validator::make($request->only('username','password'), [
            'username' => 'required',
            'password' => 'required',
        ], [
            'username.required' => 'Username wajib di isi',
            'password.required' => 'Password wajib di isi',
        ]);
        if ($validator->fails()) {
            $errors = [];
            foreach ($validator->errors()->toArray() as $field => $errorMessages) {
                $errors[$field] = $errorMessages[0];
                break;
            }
            return ['status' => 'error', 'message' => implode(', ', $errors),'code'=>400];
        }
        $pass = $request->input("password");
        // $pass = "";
        //check username
        $user = User::select()->whereRaw("BINARY username = ?",[$request->input('username')])->first();
        if (is_null($user)) {
            return response()->json(['status' => 'error', 'message' => 'Username salah'], 400);
        }
        // return response()->json(['status'=>'success','message'=>'login sukses silahkan masuk', 'data' => $user]);
        if(!password_verify($pass, $user['password'])){
            return response()->json(['status'=>'error','message'=>'Password salah'],400);
        }
        return response()->json(['status'=>'success','message'=>'login sukses silahkan masuk', 'data' => $user]);
    }


}