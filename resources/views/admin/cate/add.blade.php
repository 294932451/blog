
<!DOCTYPE html>
<html class="x-admin-sm">
    <head>
        <meta charset="UTF-8">
        <title>欢迎页面-X-admin2.2</title>
        <meta name="renderer" content="webkit">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
         <meta name="csrf-token" content="{{ csrf_token() }}">

        <link rel="stylesheet" href="{{asset('admin/css/font.css')}}">
        <link rel="stylesheet" href="{{asset('admin/css/login.css')}}">
        <link rel="stylesheet" href="{{asset('admin/css/xadmin.css')}}">
        <script type="text/javascript" src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
        <script src="{{asset('admin/lib/layui/layui.js')}}" charset="utf-8"></script>
        <script type="text/javascript" src="{{asset('admin/js/xadmin.js')}}"></script>
    </head>
        <body>
    <form class="layui-form" >
 
  <div class="layui-form-item">
    <label class="layui-form-label">父级分类</label>
    <div class="layui-input-block">
      <select name="pid" lay-verify="required">
        <option value="0">顶级分类</option>
        @foreach($cate as $v)
        <option value="{{$v->id}}">{{$v->name}}</option>
        @endforeach
      </select>
    </div>
  </div>
    <div class="layui-form-item">
    <label class="layui-form-label">分类名称</label>
    <div class="layui-input-block">
      <input type="text" name="name" required  lay-verify="required" placeholder="请输入" autocomplete="off" class="layui-input">
    </div>
  </div>
      <div class="layui-form-item">
    <label class="layui-form-label">排序</label>
    <div class="layui-input-block">
      <input type="text" name="sort" required  lay-verify="required" placeholder="请输入" autocomplete="off" class="layui-input">
    </div>
  </div>
<!--     <div class="layui-form-item">
    <label class="layui-form-label">分类标题</label>
    <div class="layui-input-block">
      <input type="text" name="title" required  lay-verify="required" placeholder="请输入标题" autocomplete="off" class="layui-input">
    </div>
  </div>
    <div class="layui-form-item">
    <label class="layui-form-label">排序</label>
    <div class="layui-input-block">
      <input type="text" name="title" required  lay-verify="required" placeholder="请输入标题" autocomplete="off" class="layui-input">
    </div>
  </div> -->
 


  <div class="layui-form-item">
    <div class="layui-input-block">
      <button class="layui-btn" lay-submit lay-filter="add">增加</button>
    </div>
  </div>
</form>
     </body>
<script>
//Demo
layui.use('form', function(){
  var form = layui.form;
 //监听提交
                form.on('submit(add)',
                function(data) {
                  //异步
                  $.ajax({
                    type:'POST',
                    url:'/admin/cate',
                    dataType:'json',
                    headers: {
                              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                             },
                    data:data.field,
                    success:function(data)
                    {
                      if(data.status==1)
                      {
                        layer.alert(data.message,{icon:1},function(){
                          parent.location.reload(true);
                        }); 
                      }
                      // console.log(data);
                    },
                    error:function()
                    {
                      layer.alert(data.message,{icon:5});
                    }
                  });
                    // console.log(data);
                    // //发异步，把数据提交给php
                    // layer.alert("增加成功", {
                    //     icon: 6
                    // },
                    // function() {
                    //     //关闭当前frame
                    //     xadmin.close();

                    //     // 可以对父窗口进行刷新 
                    //     xadmin.father_reload();
                    // });
                    return false;
                });
});
</script>