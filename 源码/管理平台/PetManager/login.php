<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

    <title>login</title>

    <!-- Bootstrap core CSS -->
    <link href="CSS/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet"/>

    <!-- Custom styles for this template -->
    <link href="CSS/style.css" rel="stylesheet">
    <link href="CSS/style-responsive.css" rel="stylesheet">

</head>
<body>
<?php 
    require("services/petService.php");
    session_start();
    if (!@is_null($_SESSION["Id"])) 
    {
        header('location:view/home/index.php');
    }
    $name="";
    $psw="";
    $message='欢迎登录宠物管理平台';
    if ($_SERVER["REQUEST_METHOD"]=="POST") 
    {
        $name=$_POST['userName'];
        $psw=$_POST['userPsw'];
        if($name!="" && $psw!="") 
        {
            $result=getUser($name,$psw);
            if(is_bool($result)) 
            {
                $message='登录失败，请联系管理员！';
            }
            else
            {
                if ($result!=null) 
                {
                    $_SESSION["uName"]=$result[0]["TrueName"];
                    $_SESSION["Id"]=$result[0]["Id"];
                    header('location:view/home/index.php');
                }
                else
                {
                    $message="信息有误，请重新输入！";
                }
                
            }
           
        }
        else
        {
            $message="用户名或密码不能为空！";
        }
    }
 ?>
<div id="login-page">
    <div class="container">
        <form class="form-login" method="post">
            <h2 class="form-login-heading">登录</h2>
            <div class="login-wrap">
                <input type="text" class="form-control" placeholder="用户名" autofocus name="userName" value="<?=$name?>">
                <br>
                <input type="password" class="form-control" placeholder="密码" name="userPsw">
                <button class="btn btn-theme btn-block" href="index.html" type="submit"><i class="fa fa-lock"></i> 登录
                </button>
                <hr>
                <div class="registration" style="color: red">
                    <?=$message?>
                </div>

            </div>
        </form>
    </div>
</div>

<!-- js placed at the end of the document so the pages load faster -->
<script src="JS/jquery.js"></script>
<script src="JS/bootstrap.min.js"></script>
<!--BACKSTRETCH-->
<!-- You can use an image of whatever size. This script will stretch to fit in any screen size.-->
<script type="text/javascript" src="JS/jquery.backstretch.min.js"></script>
<script>
    window.addEventListener('load', function (e)
    {
        (function (e)
        {
            $.backstretch("images/timg.jpg", {speed: 500});
        })();
    })
</script>

</body>
</html>
