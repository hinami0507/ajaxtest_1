<meta http-equiv="Content-Type" content="text/html" charset="utf8">
<?php
session_start();

if(isset($_POST['submitted']))
{
	$host = "localhost"; //服务器名称
    $db_user = "root"; //用户名
    $db_password = "TlQXnN8CN37t7niD"; //密码
    $db = "qnxg_connect"; //所要连接的数据库
    $link_id = @ mysql_connect($host,$db_user,$db_password) or die("连接服务器失败".mysql_error());
    $db_selected = mysql_select_db($db,$link_id);  
    if(!$db_selected){
        die("未找到指定的数据库".mysql_error());
    }

    $user = $_POST['user'];
    $pwd = $_POST['pwd'];
    $sql = " SELECT * FROM qnxg_admin WHERE user = '".$user."' and pwd = '".$pwd."' ";
    echo $sql;
    $result = @ mysql_query($sql,$link_id) or die("SQL语句出错");
    print $result;
    if($flag=@mysql_fetch_array($result))

    { //用从数据库取出的密码和提交的密码比较
        setcookie("user",$user,time()+300); //设置COOKIE
        echo "<script language=javascript>alert('登录成功');</script>";
        Header("Location:perinfo.php"); //跳转到指定页面

    }
    else
    {
        echo "<script language=javascript>alert('用户名或密码错误');</script>";
        Header("Location:index.php"); //重新载入页面

    }
}
else
{ 
	Header("Location:index.php"); //若没有输入则回到登陆页面
}
?>