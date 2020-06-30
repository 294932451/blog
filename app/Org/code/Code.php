<?php
namespace App\Org\code;
class Code
{
    //属性
    private $width;
    private $height;
    private $codeNum;
    private  $image;
    private $disturbColorNum;  //干扰元素数目
    private  $checkCode;
    function __construct($width=80,$height=20,$codeNum=4)
    {
        $this->width=$width;
        $this->height=$height;
        $this->codeNum=$codeNum;
        $number=floor($width*$height/15);
        if($number>240-$codeNum)
        {
            $this->disturbColorNum=240-$codeNum;
        }else
        {
            $this->disturbColorNum=$number;
        }
        $this->checkCode=$this->createCheckcode();
    }
    function getCheckCode()
    {
        return $this->checkCode;
    }
    private function createImage(){
        $this->image=imagecreatetruecolor($this->width,$this->height);
        $backcolor=imagecolorallocate($this->image,rand(225,255),rand(225,255),rand(255,255));
        imagefill($this->image,0,0,$backcolor);
        $border=imagecolorallocate($this->image,0,0,0);
        imagerectangle($this->image,0,0,$this->width-1,$this->height-1,$border);
    }
    private function setDisturbColor(){
        for($i=0;$i<$this->disturbColorNum;$i++){
            $color=imagecolorallocate($this->image,rand(0,255),rand(0,255),rand(0,255));
            imagesetpixel($this->image,rand(1,$this->width-2),rand(1,$this->height-2),$color);
        }
        for($i=0;$i<10;$i++)
        {
            $color=imagecolorallocate($this->image,rand(0,255),rand(0,255),rand(0,255));
            imagearc($this->image,rand(-10,$this->width),rand(-10,$this->height),rand(30,300),rand(20,300),55,44,$color);
        }
    }
    private function outputText($fontFace=""){
        for($i=0;$i<$this->codeNum;$i++)
        {
            $fontcolor=imagecolorallocate($this->image,rand(0,128),rand(0,128),rand(0,128));
            if($fontFace=="")
            {
                $fontsize=rand(3,5);
                $x=floor($this->width/$this->codeNum)*$i+5;
                $y=rand(0,$this->height-15);
                imagechar($this->image,$fontsize,$x,$y,$this->checkCode{$i},$fontcolor);
            }
            else
            {
                $fontsize=rand(12,16);
                $x=floor(($this->width-8)/$this->codeNum)*$i+8;
                $y=rand($fontsize,$this->height-8);
                imagettftext($this->image,$fontsize,rand(-45,45),$x,$y,$fontcolor,$fontFace,$this->checkCode{$i});
            }
        }
    }

    private function createCheckCode(){
        $code="23456789abcdefghijkmnpqrstuvwrst";
        $str="";
        for($i=0;$i<$this->codeNum;$i++)
        {
            $char=$code{rand(0,strlen($code)-1)};
            $str.=$char;
        }
        return $str;
    }
    private function outputImage()
    {
        if(imagetypes()&IMG_GIF)
        {
            header("Content-Type:image/gif");
            imagepng($this->image);
        }else if(imagetypes()&IMG_JPG)
        {
            header("Content-Type:image/jpeg");
            imagepng($this->image);
        }else if(imagetypes()&IMG_PNG)
        {
            header("Content-Type:image/png");
            imagepng($this->image);
        }else if(imagetypes()&IMG_WBMP){
            header("Content-Type:image/vnd.wap.wbmp");
            imagepng($this->image);
        }else
        {
            die("PHP不支持图片验证码");
        }
    }
    //通过该方法向浏览器输出图像
    public function  showImage($fontFace="")
    {
        //创建图像背景
        $this->createImage();
        //设置干扰元素
        $this->setDisturbColor();
        //向图像中随机画出文本
        $this->outputText($fontFace);
        //输出图像
        $this->outputImage();
    }

    function __destruct()
    {
        imagedestroy($this->image);
    }
}
// function checklogin(){
//     if(empty($_POST['name']))
//         die( '用户名不能为空');
//     if(empty($_POST['password']))
//         die("密码不能为空");
//     if($_SESSION['code']!=$_POST['vertify'])
//         die("验证码输入不正确".$_SESSION['code']);

//     $username=$_POST['name'];
//     $password=md5($_POST['password']);
//     //检查是否存在
//     conndb($username,$password);
// }
// function conndb($name="",$ps=""){
//     $conn=mysql_connect('localhost','root','123456');
//     if(!$conn) die("数据库连接失败".mysql_error());
//     mysql_select_db('5kan',$conn) or die('选择数据库失败'.mysql_error());
//     mysql_set_charset('utf8',$conn);
//     $sql="select id from k_user where  username='{$name}' and password='{$ps}'";
//     $result=mysql_query($sql) or die("SQL语句错误".mysql_error());
//     if(mysql_num_rows($result)>0)  die("登录成功");
//     else  die("用户名或者密码错误");
//     mysql_close($conn);
// }
// session_start();
// if(!isset($_POST['randnum']))
// {
//     $code=new ValidationCode(120,20,4);
//     $code->showImage("comicbd.ttf");  //显示在页面
//     $_SESSION['code']=$code->getCheckCode();//保存在服务器中
// }
// else
// {
//     checklogin();
// }
?>
