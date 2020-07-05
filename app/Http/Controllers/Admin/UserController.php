<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\User;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        $input = $request->all();
        // dd($input);
        $user = User::orderBy('id','asc')->where(function($query) use($request)
        {
            $username = $request->input['username'];
            $email = $request->input['email'];
            if(!empty($username))
            {
                $query->where('username','like','%'.$username.'%');
            }
             if(!empty($email))
            {
                $query->where('email','like','%'.$email.'%');
            }
        })->paginate($request->input('num')?$request->input['num']:5);
        // $user = User::paginate(3);
        return view('admin.user.list',compact('user','request'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        return view('admin.user.add');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        // return 123;
        $input = $request->all();  
        // dd($input);
        // if($input['pass']!=$input['repass'])
        // {
        //     return ['status'=>-1,'message'=>'两次密码输入不一致'];
        // }
        $input['pass'] = md5($input['pass']);
        $isExitUser = User::where('username', $input['username'])->first();
        if(!$isExitUser)
        {
            $res = User::create(['username'=>$input['username'],'phone'=>$input['phone'],'email'=>$input['email'],'password'=>$input['pass']]);
            if($res)
            {
                $data = [
                    'status'=>1,
                    'message'=>'添加成功'
                ];
            }
            else
            {
                $data = [
                    'status'=>0,
                    'message'=>'添加失败'
                ];
                
            }
            return $data;
        }
        else
        {
            return ['status'=>0,'message'=>'存在账号'];
        }
        
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $user = User::find($id);
        return view('admin.user.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $input = $request->except('_token');

  
            $user = User::find($id);
            $user->password = md5($input['pass']);
            $user->phone = $input['phone'];
            $user->email = $input['email'];

            $res = $user->save();
            if($res)
            {
                $data = [
                    'status'=>1,
                    'message'=>'修改成功'
                ];
            }
            else
            {
                $data = [
                    'status'=>0,
                    'message'=>'修改失败'
                ];
                
            }
            return $data;
        

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        // $user = User::find($id);
        $res =  User::destroy($id);
        if($res)
        {

             $data = [
                    'status'=>1,
                    'message'=>'删除成功'
                ];
        }
        else
        {
            $data = [
                    'status'=>0,
                    'message'=>'删除失败'
                ];
        }
        return $data;
    }


    public function delAll(Request $request)
    {
        $input = $request->all();
        dd($input);
        $res = User::destroy($input);
        if($res)
        {

             $data = [
                    'status'=>1,
                    'message'=>'删除成功'
                ];
        }
        else
        {
            $data = [
                    'status'=>0,
                    'message'=>'删除失败'
                ];
        }
        return $data;

    }
}
