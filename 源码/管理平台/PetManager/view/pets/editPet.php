<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
 <?php include ROOT_PATH."includeTemp/cssTemp.php";?>
</head>
<body>
<?php include ROOT_PATH.'includeTemp/checkLogin.php';?>
<?php include ROOT_PATH.'includeTemp/header.php'; ?>
	
	<?php 
		require_once(ROOT_PATH . 'Service/PetService.php');
		require_once(ROOT_PATH . 'Service/CatePet.php');
		if (!filter_has_var(INPUT_GET,"id")) {
	 		header("index.php");
	 		exit();
	 	}
	 	$id=$_REQUEST["id"];

    	$class = new PetService();

    	$petList = $class -> getPetsById($id);

    	$cate =new CateService();
    	$cateList = $cate -> getAllcategories();
    	var_dump($cateList);
    	if ($_SERVER["REQUEST_METHOD"]=="POST") {
			$name=trim($_POST["name"]);
			$categoryid=trim($_POST["categoryid"]);
			$sex=trim($_POST["sex"]);
			$age=trim($_POST["age"]);
			
			$val =$class->editPet($id, $name, $categoryid, $sex, $age);
           	
			if($val === false){
				$msg = "失败";
			}

			if(is_int($val)){
				header("location:pets.php");
				exit();
			}

	 	}

	 ?>

	<div class="pageBody">
    <?php include ROOT_PATH.'includeTemp/left.php'; ?>
    <div class="pageRight">
        <div class="myTitle">当前位置：宠物信息编辑管理</div>
        <!--从这个DIV开始写内容-->
      <div class="form-group" style="width:300px;margin:auto">
	 <form method="post" enctype="multipart/form-data">
	 <?php 
			foreach ($petList as $item) {
				
		?>
			<div class="form-group">
				<input type="hidden" name="id" value="<?php echo $item["Id"]; ?>">
			</div>
			<div class="form-group">
				<label>宠物名：</label><input class="form-control" style="width:300px" type="text" name="name" value="<?php echo $item['Name'] ?>">
			</div>
			<div class="form-group">
				<label>宠物类别：</label><select class="form-control" style="width:300px" name="categoryid">
				<option value="">请选择宠物类别</option>
                   <?php if(!is_bool($cateList)&&count($cateList)>0){
                       foreach ($cateList as $iTem) { ?>
                     	  <option <?php echo  $iTem["Id"] == $item["cateId"] ? "selected" : ""; ?> value="<?=$item['cateId'] ?>"><?=$iTem['Name'] ?></option>
                    <?php } 
                      }?> 
			</select>
			</div>
			<div class="form-group">
				<label>宠物性别：</label>
               <!--  <select class="form-control" style="width:300px" name="sex">
                  <option value="雄" >雄</option>
                  <option value="雌">雌</option>
                </select> -->
                <input type="radio" value="雌" name="sex" <?php echo $item['Sex']=='雌' ? 'checked':'';?>>雌
                <input type="radio" value="雄" name="sex" <?php echo $item['Sex']=='雄' ? 'checked':'';?>>雄
				
			</div>
			<div class="form-group">
				<label>宠物年龄：</label><input class="form-control" style="width:300px" type="text" name="age" value="<?php echo $item['Age'] ?>">
			</div>
			<div class="form-group">
				<label>宠物主人：</label><input readonly class="form-control" style="width:300px" type="text" name="master" value="<?php echo $item['userName'] ?>">
			</div>
			<?php
			}
		 ?>
			<br>
				<button class="btn btn-success" style="margin-left:120px">确认</button>
				<a class="btn btn-warning" href="pets.php" style="margin-left:20px">返回</a>
		</form>

    </div>
    </div>
</div>
</body>
<script src="../../JS/jquery.js"></script>
<script type="text/javascript">
    $(function(e){
        $('#petsA').addClass('navActive');
    });
</script>
</html>