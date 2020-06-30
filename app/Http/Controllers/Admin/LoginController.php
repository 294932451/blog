<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Org\code\Code;
class LoginController extends Controller
{
    //登录
    public function login()
    {
    	return view('admin.login');
    }

    //验证码
    public function code()
    {
    	$code = new Code();
        // $image->config('')
    	var_dump($code->showImage());
    }
}
