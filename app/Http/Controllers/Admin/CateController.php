<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Cate;
class CateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        //$cates = Cate::get();
        $cate = new Cate;
        $cates = $cate->tree();
        return view('admin.cate.list',compact('cates'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //获取一级
        $cate = Cate::where('pid',0)->get();

        return view('admin.cate.add',compact('cate'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

         $input = $request->all();  
         $isExitCate = Cate::where('name', $input['name'])->first();
        if(!$isExitCate)
        {
            $res = Cate::create(['pid'=>$input['pid'],'name'=>$input['name'],'sort'=>$input['sort']]);
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
            return ['status'=>0,'message'=>'存在分类'];
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
    }

    //修改排序
    public function changeSort(Request $request)
    {
        $input = $request->except('_token');

        $cate = Cate::find($input['id']);
        $res = $cate->update(['sort'=>$input['sort']]);
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
}
