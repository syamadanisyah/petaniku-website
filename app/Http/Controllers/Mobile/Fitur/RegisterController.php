<?php
namespace App\Http\Controllers\Mobile\Fitur;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Carbon\Carbon;
class RegisterController extends Controller
{
    public function Register(Request $request){
        $validator = Validator::make($request->only('username','password','password_confirm'), [
            'username'=>'required',
            'password' => [
                'required',
                'string',
                'min:8',
                'max:25',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\p{P}\p{S}])[\p{L}\p{N}\p{P}\p{S}]+$/u',
            ],
            'password_confirm' => [
                'required',
                'string',
                'min:8',
                'max:25',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\p{P}\p{S}])[\p{L}\p{N}\p{P}\p{S}]+$/u',
            ],
        ],[
            'username.required'=>'Email wajib di isi',
            'password.required'=>'Password wajib di isi',
            'password.min'=>'Password minimal 8 karakter',
            'password.max'=>'Password maksimal 25 karakter',
            'password.regex'=>'Password terdiri dari 1 huruf besar, huruf kecil, angka dan karakter unik',
            'password_confirm.required'=>'Password konfirmasi harus di isi',
            'password_confirm.min'=>'Password konfirmasi minimal 8 karakter',
            'password_confirm.max'=>'Password konfirmasi maksimal 25 karakter',
            'password_confirm.regex'=>'Password konfirmasi terdiri dari 1 huruf besar, huruf kecil, angka dan karakter unik',
        ]);
        if ($validator->fails()) {
            $errors = [];
            foreach ($validator->errors()->toArray() as $field => $errorMessages) {
                $errors[$field] = $errorMessages[0];
                break;
            }
            return response()->json(['status' => 'error', 'message' => implode(', ', $errors)], 400);
        }
        $username = $request->input("username");
        $pass = $request->input("password");
        $pass1 = $request->input("password_confirm");
        if (User::select("username")->whereRaw("BINARY username = ?",[$username])->limit(1)->exists()){
            return response()->json(['status'=>'error','message'=>'username sudah digunakan'],400);
        }else if($pass !== $pass1){
            return response()->json(['status'=>'error','message'=>'Password Harus Sama'],400);
        }else{
            $insert = User::insert([
                'nama' => $request->input('nama'),
                'email' => $request->input('email'), 
                'username' => $request->input('username'),
                'password' => Hash::make($request->input('password')),
                'alamat' => $request->input('alamat'),
                'gambar' => $request->input('gambar'),
                // 'created_at' => Carbon::now(),
                // 'updated_at' => Carbon::now(),
            ]);
            if (!$insert) {
                return ['status'=>'error','message'=>'gagal register'];
            }
                return ['status'=>'success','message'=>'register berhasil'];
        }
    }
}
?>