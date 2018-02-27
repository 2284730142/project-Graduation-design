<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>增加宠物类别</title>
	<?php include ROOT_PATH.'includeTemp/cssTemp.php'; ?>
</head>
<body>

	<?php 
		include ROOT_PATH.'includeTemp/checkLogin.php';
		include ROOT_PATH.'includeTemp/header.php';
	?>

	<div class="pageBody">
    	<?php 
    		include ROOT_PATH.'includeTemp/left.php';
    		include ROOT_PATH.'Service/PetCategoryService.php';
    		$message="";
    		$petname="";
    		$nameErr="请输入您要添加的宠物名称";
    		$category=new PetCategoryService();
			if($_SERVER["REQUEST_METHOD"]=="POST"){
				$petName=trim($_POST["petname"]);
				if($petName==""){
					$message="宠物名称不得为空";
				}
				else{
					$val=$category -> addPet($petName);
					if($val!=1){
						$message="添加失败，请重新添加或者联系客服人员";
						return false;
					}
					else{
						$message="添加成功";
						echo '<script>location.href="petCate.php";</script>';
					}
				}
			}
    	?>
    	<div class="pageRight">
    		<div class="myTitle">当前位置：添加宠物类别信息</div>
    		<div class="addLibClass" style="margin-top: 10px">
        		<div class="div1" >
            		<form method="post" novalidate>
                		<div class="div2">
		                    <span>姓名：</span>
		                    <input type="text" name="petname" required>
		                    <span class="default"><?php echo $nameErr; ?></span>
		                </div>
		           		<?php if($message!==""){?>
							
							<div  style="color: red;margin-left: 150px;"><?php echo $message; ?></div>

		           		<?php } ?>
		                <p align="center" class="addLibsBtn">
		                    <button class="btn btn-info">保存</button>
		                    <a href="petCate.php" class="btn btn-default" type="button">取消</a>
		                </p>
		            </form>
		        </div>
		    </div>
		</div> 
    </div>
</body>
</html>