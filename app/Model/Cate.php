<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Cate extends Model
{
    	//1.关联表
    public $table = 'blog_cate';
    //主键
    public $primaryKey = 'id';
    //3.允许被批量操作得字段
    // protected $fillable = [
    //     'username','password','created_at','updated_at'
    // ];
    protected $guarded = [];
    public $timestamps = false;

    //格式化分类数据
    public function tree()
    {
        //获取所有的分类
        $cates = $this->orderBy('sort','asc')->get();
        return $this->getTree($cates);
        //格式化(排序，二级类缩进

    }

    public function getTree($cates)
    {
        //排序
        //存放最终排完序的分类数据
        $arr=[];
        
        foreach ($cates as $key => $value) {
            # code...
            //先获取第一级类
                if($value->pid==0)
                {
                    $arr[] = $value;
                    //获取一级类下面的二级
                    foreach ($cates as $m => $n) {
                        # code...
                        if($value->id==$n->pid)
                        {
                            //给分类名称添加缩进
                            $n->name = '!---'.$n->name;
                            $arr[] = $n;
                        }
                    }
                }

        }
      return $arr;
    }
}
