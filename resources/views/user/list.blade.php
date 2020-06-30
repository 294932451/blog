<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>

<body>

    <table>
        <tr>

            <td>id</td>
            <td>用户名</td>
            <td>密码</td>
            <td>添加时间</td>
            <td>更新时间</td>
            <td>操作</td>
        </tr>
        @foreach($user as $v)
        <tr>
            <td>{{$v->id}}</td>
            <td>{{$v->username}}</td>
            <td>{{$v->password}}</td>
            <td>{{$v->created_at}}</td>
            <td>{{$v->updated_at}}</td>
            <td><a href="/user/edit/{{$v->id}}">修改</a> <a href="/user/del/{{$v->id}}">删除</a></td>
        </tr>
            @endforeach
    </table>

</body>
</html>