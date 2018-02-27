<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>change psw</title>
	<link rel="stylesheet" type="text/css" href="../../CSS/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="../../CSS/index.css">
	<link rel="stylesheet" type="text/css" href="../../CSS/homePage.css">
	<link rel="stylesheet" type="text/css" href="../../CSS/changePsw.css">
</head>
<body>
	<?php include '../../includeTemp/checkLogin.php';?>

	<?php 
		include '../../services/petService.php';
		$message='';
		$name=$_SESSION["uName"];
		$userId=$_SESSION["Id"];
		$oldPsw="";
		$newPsw="";
		if($_SERVER["REQUEST_METHOD"]=="POST") 
		{
			$oldPsw=$_POST['oldPsw'];
			$newPsw=$_POST['newPsw'];
			if ($oldPsw!="" && $newPsw!="") 
			{
				$result=updatePsw($name,$oldPsw,$newPsw);
				if (is_bool($result)) 
				{
					$message="修改失败，请联系管理员！";
				}
				else
				{
					if ($result==1) 
					{
						$message="当前密码已修改成功！";
					}
					else
					{
						$message="请确认您的信息是否有误！";
					}
				}
			}
			else
			{
				$message="密码不能为空！";
			}
		}
	?>
	<?php include '../../includeTemp/header.php'; ?>
	<div class="pageBody">
    	<?php include'../../includeTemp/left.php'; ?>
    	<div class="pageRight">
    		<div class="myTitle">当前位置：修改密码</div>
    		<div class="changeBody">
    			<form method="post">
    				<div>
    					<span>用户名：</span>
    					<input type="text" disabled value="<?=$name?>">
    				</div>
    				<div>
    					<span>旧密码：</span>
    					<input type="password" value="<?=$oldPsw?>" name="oldPsw">
    				</div>
    				<div>
    					<span>新密码：</span>
    					<input type="password" value="<?=$newPsw?>" name="newPsw">
    				</div>
    				<div style="color: red;"><?=$message?></div>
    				<div>
    					<button class="btn btn-info">确认修改</button>
    				</div>
    			</form>
    		</div>
    		
    	</div>
	</div>
</body>
<script src="../../JS/jquery.js"></script>
<script type="text/javascript">
	$(function(e){
	    $('#changePsw').addClass('navActive');
	});
</script>
</html>