<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
class UserController extends Controller
{
    //添加方法
    /**
	* 获取一个添加页面
		@param null
		@return 返回添加页面
    **/
    public function index()
    {
        $user = User::get();

        return view('user.list',compact('user'));
    }
    public function add()
    {
    	return view('user/add');
    }

    public function store(Request $request)
    {
    	$input = $request->except('_token');
    	$input['password'] = md5($input['password']);
    	$res = User::create($input);
    	if($res)
        {
            return redirect('user/index');
//            echo '添加成功';
        }
    	else
        {
            return back();
//            echo '添加失败';
        }

    }

    public function edit($id)
    {
    	$user = User::find($id);
        return view('user.edit',compact('user'));
    }


    public function update(Request $request)
    {
    	$input = $request->except('_token');
    	$user = User::find($input['id']);
    	$user->password = md5($input['password']);
    	$res = $user->save();
    	if($res)
        {
            return redirect('user/index');
//            echo '添加成功';
        }
    	else
        {
            return back();
//            echo '添加失败';
        }
    }


    public function del($id)
    {
    	$res = User::destroy($id);
        if($res)
        {
            return redirect('user/index');
//            echo '添加成功';
        }
    	else
        {
            return back();
//            echo '添加失败';
        }
    }
}
