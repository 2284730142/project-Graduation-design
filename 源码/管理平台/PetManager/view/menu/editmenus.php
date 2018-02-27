<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>menus</title>
    <?php include ROOT_PATH . "includeTemp/cssTemp.php";?>
</head>
<body>
<!-- 导入模板 -->
<?php include ROOT_PATH . 'includeTemp/checkLogin.php';?>
<?php include ROOT_PATH . 'includeTemp/header.php'; ?>
<!-- 数据操作 -->
<?php  
    require_once (ROOT_PATH . "Service/MenuService.php");
    $menus = new MenuService();
    //获取服务详细
    $id = $_GET['Id'];
    $menusList = $menus -> getAllMenu();
    //echo($id);
    $menuList = $menus -> getMenuDetail($id);
    /*var_dump($menuList[0]["Image"]);*/
    @$imgName = $menuList[0]["Image"];
    if (array_key_exists("imgname",$_GET)) {
    	// 删除文件
    	$dir = "../../images/";
    	@unlink($dir.$_GET["imgname"]);
    	// 设置$imgName为空
    	$imgName = "";
    }

?>
<!-- 元素界面 -->
<div class="pageBody">
    <?php include'../../includeTemp/left.php'; ?>
    <div class="pageRight">
        <div class="myTitle">当前位置：服务信息管理 / 添加服务</div>
        <div class="menus-wrapper" style="border:0;margin-top:20px;">
        	<form method="post">
			  <div class="form-group">
			    <label for="name">服务名称</label>
			    <input type="text" class="form-control" name="name" value="<?=$menuList[0]['Name']?>">
			  </div>
			  <div class="form-group">
			    <label for="price">价格</label>
			    <input type="text" class="form-control" name="price" value="<?=$menuList[0]['Price']?>">
			  </div>
			  <div class="form-group">
			    <label for="price">服务类型</label>
			    <select class="form-control" name="menuId">
                	<option value="">选择类别</option>
                	<?php 
	                    for ($i=0; $i <count($menusList); $i++) { 
	                        $item = $menusList[$i];
                	?>
                    <option value="<?=$item['Id']?>" <?php echo $item['Id'] == $menuList[0]['menuid'] ? 'selected':'' ?>><?=$item['Name']?></option>      
                	<?php } ?>
            	</select>
			  </div>
			  <div class="form-group">
				    <label for="price">详情</label>
				    <textarea class="form-control" rows="4" name="content"><?=$menuList[0]['Content']?></textarea>
			  </div>
			  <div class="form-group">
				    <label for="exampleInputFile">上传图片</label>
				    <input type="file" id="menusFile" multiple>
				    <p class="help-block">请先删除图片,再添加新图片</p>
				    <div class="imgWrapper">
				    <?php
				    if ($imgName!="") {
				    ?>
				    	<a href="editmenus.php?imgname=<?php echo $imgName; ?>">
					    	<img src="<?php echo "../../images/".$imgName; ?>" width="210" height="140">
					    	<input type="hidden" name="images" value="<?php echo "../../images/".$imgName; ?>">
				    	</a>
				    <?php
				    } else {
				    ?>
				    <div>暂时没有图片信息</div>
				    <?php
				    }
				    ?>
				    	
				    </div>
			  </div>
			  <button type="submit" class="btn btn-primary">提交</button>
			  <a href="menus.php" type="button" class="btn btn-warning">返回</a>
			</form>
        </div>	
    </div>
</div>
</body>
<script src="../../JS/jquery.js"></script>
<script type="text/javascript">
    $(function(e){
        $('#menusA').addClass('navActive');
    });
    //上传图片
    window.onload = function(e){

    	var fileUpload = document.querySelector("input[type=file]");
	    var imgWrapper = document.querySelector(".imgWrapper");
	    fileUpload.onchange = function(){
	    	var fileArr = this.files;
	      	if(fileArr.length > 0){
	      	//使用formData方法提交文件
	      		for(var i=0;i<fileArr.length;i++){
		      		var file = fileArr[i];
			        var formData = new FormData();
			        formData.append("file",file);
			        //ajax操作
			        var xhr = new XMLHttpRequest();
			        xhr.open("post","fileuploadService.php",true);
			        xhr.onreadystatechange = function(){
			          	if(this.readyState == 4 && this.status == 200){
			          		//console.log(JSON.parse(this.responseText));
				            var result = JSON.parse(this.responseText);
				            if(result.code == 100){
				            //进行文件预览
				              var wrapper = createImg(result.data);

				              imgWrapper.appendChild(wrapper);
				            }
			          	}
			        }
			        xhr.send(formData);
			    }
	      	}  
	    }
	    function createImg(item){
	      var wrapper = document.createElement('div');

	      var image01 = document.createElement('img');
	      image01.width = 120;
	      image01.src = '../../images/' + item;
	      image01.className = 'imagePic';
	      wrapper.appendChild(image01);

	      var imgHidden = document.createElement('input');
	      imgHidden.type = 'hidden';
	      imgHidden.value = item;
	      imgHidden.name = 'images[]';
	      imgHidden.className = 'hiddenInput';
	      wrapper.appendChild(imgHidden);
	      //删除图片
	      image01.onclick = function(){
	      	//console.log(item);
	      	//1.向服务器发起删除请求
            var formdate = new FormData();
            formdate.append('file', item);
            //2.上传文件(ajax操作)
            var xhr = new XMLHttpRequest();
            xhr.open('post', 'filedeleteSrvice.php', true);
            xhr.onreadystatechange = function () {
                if (this.readyState === 4 && this.status === 200) {
                    //console.log(JSON.parse(this.responseText));
                    if (JSON.parse(this.responseText).code == 100) {
                        if (JSON.parse(this.responseText).data == true) {
                            alert('删除成功');
                            var name = JSON.parse(this.responseText).name;
                            var imagePic = document.querySelectorAll('.imagePic');
                            var hiddenInput = document.querySelectorAll('.hiddenInput');
                            for (var i = 0; i < imagePic.length; i++) {
                                if (name == hiddenInput[i].value) {
                                    hiddenInput[i].parentNode.removeChild(imagePic[i]);
                                    hiddenInput[i].parentNode.removeChild(hiddenInput[i])
                                }
                            }
                        }
                    }
                }
            };
            xhr.send(formdate);
	      };
	      return wrapper;
	    }
    }
</script>
</html>
