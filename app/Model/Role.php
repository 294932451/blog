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
}
