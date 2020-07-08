<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Role;
use App\Model\Permission;
class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //获取授权页面
    public function auth($id)
    {
        //获取当前角色
        $role = Role::find($id);
        //获取所有的权限列表
        $perms = Permission::get();
        //获取当前角色拥有权限
        $own_perms = $role->permission;
        //角色拥有的权限ID
        $own_perms = [];
        foreach ($own_perms as $value) {
            # code...
            $own_perms[] = $v->id;
        }
        // dd($own_perms);
        return view('admin.role.auth',compact('role','perms','own_perms'));
        
    }
    public function index(Request $request)
    {
        $input = $request->all();
        // dd($input);
        $role = Role::orderBy('id','asc')->where(function($query) use($request)
        {
            $name = $request->input['name'];
            // $email = $request->input['email'];
            if(!empty($name))
            {
                $query->where('role_name','like','%'.$name.'%');
            }
            //  if(!empty($email))
            // {
            //     $query->where('email','like','%'.$email.'%');
            // }
        })->paginate($request->input('num')?$request->input['num']:5);
        // $user = User::paginate(3);
        return view('admin.role.list',compact('role','request'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.role.add');
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
         $input = $request->all();  
        // dd($input);
        // if($input['pass']!=$input['repass'])
        // {
        //     return ['status'=>-1,'message'=>'两次密码输入不一致'];
        // }
        $isExitUser = Role::where('role_name', $input['name'])->first();
        if(!$isExitUser)
        {
            $res = Role::create(['role_name'=>$input['name']]);
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
            return ['status'=>0,'message'=>'存在角色'];
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
        $role = Role::find($id);
        return view('admin.role.edit',compact('role'));
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

  
            $role = Role::find($id);
            // $user->password = md5($input['pass']);
            // $user->phone = $input['phone'];
            $role->role_name = $input['name'];

            $res = $role->save();
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
         $res =  Role::destroy($id);
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
