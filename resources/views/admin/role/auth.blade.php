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
    <div class="layui-fluid">
        <div class="layui-row">
            <form action="" method="post" class="layui-form layui-form-pane">
                <div class="layui-form-item">
                    <label for="name" class="layui-form-label">
                        <span class="x-red">*</span>角色名
                    </label>
                    <div class="layui-input-inline">
                        <input type="hidden" name="id" value="{{$role->id}}">
                        <input type="text" id="name" name="name" required="" lay-verify="required"
                        autocomplete="off" class="layui-input" value="{{$role->role_name}}">
                    </div>
                </div>
                <div class="layui-form-item layui-form-text">
                    <label class="layui-form-label">
                        拥有权限
                    </label>
                    <table  class="layui-table layui-input-block">
                        <tbody>
                            <tr>
                               <!--  <td>
                                    <input type="checkbox" name="like1[write]" lay-skin="primary" lay-filter="father" title="用户管理">
                                </td> -->
                                <td>
                                    <div class="layui-input-block">
                                       @foreach($perms as $v)
                                       @if(in_array($v->id,$own_perms))
                                        <input name="permission_id" lay-skin="primary" type="checkbox" checked="" value="{{$v->id}}" title="{{$v->per_name}}"> 
                                        @else
                                        <input name="permission_id" lay-skin="primary" type="checkbox" value="{{$v->id}}" title="{{$v->per_name}}"> 
                                        @endif
                                        @endforeach
                                    </div>
                                </td>
                            </tr>
                            
                        </tbody>
                    </table>
                </div>
                <div class="layui-form-item layui-form-text">
                    <label for="desc" class="layui-form-label">
                        描述
                    </label>
                    <div class="layui-input-block">
                        <textarea placeholder="请输入内容" id="desc" name="desc" class="layui-textarea"></textarea>
                    </div>
                </div>
                <div class="layui-form-item">
                <button class="layui-btn" lay-submit="" lay-filter="add">修改</button>
              </div>
            </form>
        </div>
    </div>
    <script>
        layui.use(['form','layer'], function(){
            $ = layui.jquery;
          var form = layui.form
          ,layer = layui.layer;
        
          //自定义验证规则
          form.verify({
            nikename: function(value){
              if(value.length < 5){
                return '昵称至少得5个字符啊';
              }
            }
            ,pass: [/(.+){6,12}$/, '密码必须6到12位']
            ,repass: function(value){
                if($('#L_pass').val()!=$('#L_repass').val()){
                    return '两次密码不一致';
                }
            }
          });

          //监听提交
          form.on('submit(add)', 
                           function(data) {
                    //异步
                  $.ajax({
                    type:'PUT',
                    url:'/admin/role/{{$role->id}}',
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
                    return false;
                });


        form.on('checkbox(father)', function(data){

            if(data.elem.checked){
                $(data.elem).parent().siblings('td').find('input').prop("checked", true);
                form.render(); 
            }else{
               $(data.elem).parent().siblings('td').find('input').prop("checked", false);
                form.render();  
            }
        });
          
          
        });
    </script>
   
  </body>

</html>