
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


<form class="layui-form"  id="art_form" action="{{url('/admin/article')}}"" method="post">
  <label class="layui-form-label">分类</label>
      <div class="layui-input-block">
      <select name="pid" lay-verify="required">
        <!-- <option value="0">顶级分类</option> -->
        @foreach($cates as $v)
        <option value="{{$v->id}}">{{$v->name}}</option>
        @endforeach
      </select>
    </div>
  <div class="layui-form-item">
    <label class="layui-form-label">标题</label>
    <div class="layui-input-block">
      <input type="text" name="title" required  lay-verify="required" placeholder="请输入标题" autocomplete="off" class="layui-input">
    </div>
  </div>

  <div class="layui-form-item">
    <label class="layui-form-label">作者</label>
    <div class="layui-input-block">
      <input type="text" name="title" required  lay-verify="required" placeholder="请输入标题" autocomplete="off" class="layui-input">
    </div>
  </div>

    <div class="layui-form-item">
    <label class="layui-form-label">关键词</label>
    <div class="layui-input-block">
      <input type="text" name="title" required  lay-verify="required" placeholder="请输入标题" autocomplete="off" class="layui-input">
    </div>
  </div>

  <div class="layui-form-item">
    <label class="layui-form-label">缩略图</label>
    <div class="layui-input-block">
       <button type="button" class="layui-btn" id="test1">
        <input type="file" name="thumb" id="thumb_upload" style=display:none>
  <i class="layui-icon">&#xe67c;</i>上传图片
</button>
    </div>
  </div>

  <!-- <div class="layui-form-item">
    <label class="layui-form-label">密码框</label>
    <div class="layui-input-inline">
      <input type="password" name="password" required lay-verify="required" placeholder="请输入密码" autocomplete="off" class="layui-input">
    </div>
    <div class="layui-form-mid layui-word-aux">辅助文字</div>
  </div> -->
  <!-- <div class="layui-form-item">
    <label class="layui-form-label">选择框</label>
    <div class="layui-input-block">
      <select name="city" lay-verify="required">
        <option value=""></option>
        <option value="0">北京</option>
        <option value="1">上海</option>
        <option value="2">广州</option>
        <option value="3">深圳</option>
        <option value="4">杭州</option>
      </select>
    </div>
  </div> -->
<!--   <div class="layui-form-item">
    <label class="layui-form-label">复选框</label>
    <div class="layui-input-block">
      <input type="checkbox" name="like[write]" title="写作">
      <input type="checkbox" name="like[read]" title="阅读" checked>
      <input type="checkbox" name="like[dai]" title="发呆">
    </div>
  </div> -->
<!--   <div class="layui-form-item">
    <label class="layui-form-label">开关</label>
    <div class="layui-input-block">
      <input type="checkbox" name="switch" lay-skin="switch">
    </div>
  </div> -->
<!--   <div class="layui-form-item">
    <label class="layui-form-label">单选框</label>
    <div class="layui-input-block">
      <input type="radio" name="sex" value="男" title="男">
      <input type="radio" name="sex" value="女" title="女" checked>
    </div>
  </div> -->
  <div class="layui-form-item layui-form-text">
    <label class="layui-form-label">描述</label>
    <div class="layui-input-block">
      <textarea name="desc" placeholder="请输入内容" class="layui-textarea"></textarea>
    </div>
  </div>
  <div class="layui-form-item">
    <div class="layui-input-block">
      <button class="layui-btn" lay-submit lay-filter="formDemo">立即提交</button>
      <button type="reset" class="layui-btn layui-btn-primary">重置</button>
    </div>
  </div>
</form>
 </body>
<script>
//Demo
layui.use(['form','layer','upload'], function(){
  $ = layui.jquery;
  var form = layui.form,layer = layui.layer;
  var upload = layui.upload;

  $('#test1').on('click',function(){
    $('#thumb_upload').trigger('click');
    $('#thumb_upload').on('change',function(){
      var obj = this;
      var formData = new FormData($('art_form')[0]);
      $.ajax({
        url:'/admin/article/upload',
        type:'post',
        data:formData,
        //因为data值是formdata对象，不需要对数据处理
        processData:false,
        contentType:false,
        success:function(data)
        {
          if(data['ServerNo']=='200')
          {
            //如果成功
            $('#art_thumb_img').attr('src','/upload/'+data['ResultData']);
            $('input[name=art_thumb]').val(data);
            $(obj).off('change');
          }
          else
          {
            alert(data['ResultData']);
          }
        },
      })
    })
  })
  
  //监听提交
  form.on('submit(formDemo)', function(data){
    layer.msg(JSON.stringify(data.field));
    return false;
  });
});
</script>