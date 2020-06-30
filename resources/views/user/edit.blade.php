<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>

<body>
	<form action="{{url('/user/update')}}" method="post" >
	<table>
		<tr>
			{{csrf_field()}}
			<input type="hidden" name="id" value="{{$user->id}}" >
			<td>用户名</td>
			<td>
				<input type="text" name="username" value="{{$user->username}}" disabled="disabled">
			</td>
		</tr>
		<tr>
			<td>密码</td>
			<td>
				<input type="password" name="password" value="{{$user->password}}">
			</td>
		</tr>
		<tr>
			<td>提交</td>
			<td>
				<input type="submit" value="提交">
			</td>
		</tr>
	</table>
</form>
</body>
</html>