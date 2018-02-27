<?php 
	include ROOT_PATH.'Service/PetCategoryService.php';
	include ROOT_PATH.'includeTemp/cssTemp.php';

	$id=$_GET["id"];
	$category=new PetCategoryService();
	$result=$category->deletePetById($id);
	if(is_bool($result)){
		echo '<script>alert("没有连接到数据库");location.href="petCate.php";</script>';
	}
	elseif ($result==0) {
		echo '<script>alert("没有查询到数据");</script>';
		echo '<script>location.href="petCate.php";</script>';
	}
	elseif ($result==1) {
		echo '<script>location.href="petCate.php";</script>';
	}
	
?>