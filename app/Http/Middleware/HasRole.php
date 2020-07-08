<?php

namespace App\Http\Middleware;
use App\Model\User;
use App\Model\Role;
use App\Model\Permission;
use Closure;

class HasRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {   
        //1.获取当前请求的路由对应的控制器方法名
        $route = \Route::current()->getActionName();
        // dd($route);
        //2获取当前用户的权限组
        $user = User::find(session()->get('user')->id);
        // dd($user);
        //3获取当前用户角色
        $roles = explode(',', $user->role);

        // dd($roles); 
        //存放权限对应的url字段
        $arr = [];
        // foreach ($roles as $v) {
        //     # code...
        //     $perms = $v->permission;
        //     foreach ($perms as $perm) {
        //         # code...
        //         $arr[] = $perm->per_url;
        //     }

        // }
        // dd($arr);
        //去掉重复的权限
        $arr = array_unique($arr);
        //判断当前请求的路由对应控制器的方法是否在当前用户拥有的权限列表中
        //模仿数据
        $arr = ['App\Http\Controllers\Admin\LoginController@index',
                  'App\Http\Controllers\Admin\LoginController@welcome',
                   'App\Http\Controllers\Admin\LoginController@logout',
                  'App\Http\Controllers\Admin\UserController@index',
                  'App\Http\Controllers\Admin\UserController@create',  
                  'App\Http\Controllers\Admin\UserController@store',
                  'App\Http\Controllers\Admin\UserController@edit',  
                   'App\Http\Controllers\Admin\UserController@update',  
                  'App\Http\Controllers\Admin\UserController@destroy',
                  'App\Http\Controllers\Admin\UserController@delAll',  
                  'App\Http\Controllers\Admin\RoleController@auth',
                  'App\Http\Controllers\Admin\RoleController@index',  
                                    'App\Http\Controllers\Admin\RoleController@create',
                  'App\Http\Controllers\Admin\RoleController@store', 
                              'App\Http\Controllers\Admin\RoleController@edit',  
                                    'App\Http\Controllers\Admin\RoleController@update',
                  'App\Http\Controllers\Admin\RoleController@destroy',  
                  'App\Http\Controllers\Admin\CateController@index',
                  'App\Http\Controllers\Admin\CateController@create',  
                  'App\Http\Controllers\Admin\CateController@store',
                  'App\Http\Controllers\Admin\CateController@edit',  
                   'App\Http\Controllers\Admin\CateController@update',  
                  'App\Http\Controllers\Admin\CateController@destroy',
                  'App\Http\Controllers\Admin\CateController@delAll', 
                  'App\Http\Controllers\Admin\CateController@changeSort', 
                  'App\Http\Controllers\Admin\ArticleController@index',
                  'App\Http\Controllers\Admin\ArticleController@create',  
                  'App\Http\Controllers\Admin\ArticleController@store',
                  'App\Http\Controllers\Admin\ArticleController@edit',  
                   'App\Http\Controllers\Admin\ArticleController@update',  
                  'App\Http\Controllers\Admin\ArticleController@destroy',
                  'App\Http\Controllers\Admin\ArticleController@delAll',  
    ];
        if(in_array($route,$arr))
        {
            return $next($request);
        }
        else
        {
            echo 111;
            return redirect('noaccess');
        }
        
    }
}
