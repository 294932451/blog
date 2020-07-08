<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //   	//1.关联表
    public $table = 'blog_role';
    //主键
    public $primaryKey = 'id';
    //3.允许被批量操作得字段
    // protected $fillable = [
    //     'username','password','created_at','updated_at'
    // ];
    protected $guarded = [];
    public $timestamps = false;

    //添加动态熟悉，
    public function permission()
    {
        return $this->belongsToMany('App\Model\Permission','blog_role_permission','role_id','permission_id');
    }
}
