<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    //1.关联表
    public $table = 'blog_user';
    //主键
    public $primaryKey = 'id';
    //3.允许被批量操作得字段
    protected $fillable = [
        'username','password','created_at','updated_at'
    ];
//    protected $dateFormat = 'U';
    //4.时间戳
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
//    protected  $fillable = [
//        'username', 'password',
//    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
//
//    public function  curd()
//    {
//
//    }
}
