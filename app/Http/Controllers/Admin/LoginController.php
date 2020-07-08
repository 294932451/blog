<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Org\code\Code;
use Validator;
use App\Model\User;
use Illuminate\Contracts\Encryption\DecryptException;
use Crypt;
class LoginController extends Controller
{
    //登录
    public function login()
    {
        // $str = 'qweqwe';
        // $pass = md5($str);
        // dd($pass);
    	return view('admin.login');
    }

    public function doLogin(Request $request)
    {   
        // echo 123;
        $input =  $request->except('_token'); 
        // dd($input);
        // exit;
        // $validator = Validator::make('需要验证得表单数据','验证规则','错误信息');
        $msg = [
                    'username.required'=>'用户名不为空',
                    'username.between'=>'用户名长度在4到18之间',
                    'password.required'=>'密码不为空',
                    'password.between'=>'密码长度在4到18之间',
                    'password.alpha_dash'=>'密码必为字母数组下划线',
                    'captcha.required'=>'验证码不能为空'
                ];
         $validator = Validator::make($input , [
             'username'=>'required|between:4,18',
             'password'=>'required|between:6,18|alpha_dash',
             'captcha'=>'required|captcha'
        ],$msg);
        if ($validator->fails()) {
            return redirect('admin/login')
                        ->withErrors($validator)
                        ->withInput();
        }
        // $this->validate($request, [
        // 'code' => 'required|captcha'
        //     ]);
        $user = User::where('username',$input['username'])->first();
        // dd($user);
        if(!$user)
        {
            return redirect('admin/login')->with('errors','用户名异常');
        }
        // dd($input['password']);
        if(md5($input['password'])!=$user['password'])
        {
            return redirect('admin/login')->with('errors','密码异常');
        }
        // dd(decrypt($user['password']));
        // try {
        //         $input['password'] = decrypt($user['password']);
        //     } 
        //     catch (DecryptException $e) 
        //     {
        //     return redirect('admin/login')->with('errors','密码异常');

        //     }
            session()->put('user',$user);
            return redirect('admin/index');
    }


    //验证码
    // public function code()
    // {
    // 	$code = new Code();
    //     // $image->config('')
    // 	var_dump($code->showImage());
    // }

     public function index()
    {
        return view('admin.index');
    }

    public function welcome()
    {
        return view('admin.welcome');
    }

    public function logout()
    {
        session()->flush();
        return redirect('admin/login');
    }

    public function noaccess()
    {
        echo "无权限";
    }
}
