<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Cate;
use Image;
class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('admin.article.list');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $cates = (new Cate)->tree();
        // dd($cates);
        return view('admin.article.add',compact('cates'));
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


    public function upload(Request $request)
    {
        $file = $request->file('thumb');
        if(!$file->isValid)
        {
            return response()->json(['ServerNo'=>'400','ResultData'=>'无效的上传文件']);
        }
        //获取源文件扩展名
        $ext = $file->getClientOriginalExtension();//文件扩展名
        //新文件名
        $newfile = md5(time(),rand(1000,9999)).','.$ext;
        //文件上传指定路径
        $path = public_path('upload');

        //将文件从临时目录移到指定目录
        // if(!$file->move($path,$newfile))
        // {
        //     return response()->json(['ServerNo'=>'400','ResultData'=>'保存文件失败']);
 
        // }
        //控制图像大小扩展  intervention image
        // open an image file
    // $img = Image::make('public/foo.jpg'); 

    // // resize image instance
    // $img->resize(320, 240); //缩放

    // // insert a watermark
    // $img->insert('public/watermark.png'); 加水印

    // // save image in desired format
    // $img->save('public/bar.jpg');
        $res = Image::make($file)->resize(100,100)->save($path,''.$newfile);
        if($res)
        {
              //成功
            return response()->json(['ServerNo'=>'200','ResultData'=>$newfile]);
        }
        else
        {
                         return response()->json(['ServerNo'=>'400','ResultData'=>'保存文件失败']);

        }
      
 
    }
}
