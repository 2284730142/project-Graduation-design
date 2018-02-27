<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>category</title>
    <?php include ROOT_PATH."includeTemp/cssTemp.php";?>
</head>
<body>
<?php include ROOT_PATH.'includeTemp/checkLogin.php';?>
<?php include ROOT_PATH.'includeTemp/header.php'; ?>
<div class="pageBody">
    <?php 

        include ROOT_PATH.'includeTemp/left.php'; 
        include ROOT_PATH.'Service/PetCategoryService.php';
        $category=new PetCategoryService();
        $result=$category->getAllPetCategory();
        if($_SERVER["REQUEST_METHOD"]=="POST"){
            $searchName=$_POST["searched"];
            $result=$category->getPetCategoryByName($searchName);
        }

    ?>
    <div class="pageRight">
        <div class="myTitle">当前位置：宠物类别管理</div>
        <!--从这个DIV开始写内容-->
        <div style="margin-top: 25px;margin-left: 20px">
            <form method="post">
                <span>关键字：</span>
                <input type="text" name="searched" placeholder="输入宠物类别名称搜索" class="input-search">
                <button class="btn btn-default">搜索</button>
                <a href="addPetCate.php" class="btn btn-default">新增</a>
            </form>
        </div>
            <table class="table table-bordered" style="margin-top: 20px">
                <thead>
                    <tr>
                        <th>序号</th>
                        <th>宠物名称</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($result as $idx => $item) {?>
                   <tr>
                        <td><?php echo $idx+1 ;?></td>
                        <td><?php echo $item["Name"]; ?></td>
                        <td><a href="deletePetCate.php?id=<?php echo $item["Id"]; ?>" class="btn btn-danger">删除</a></td>
                    </tr>
                <?php } ?>   
                </tbody>
            <table>
        </div>
    </div>
</div>
</body>
<script src="../../JS/jquery.js"></script>
<script type="text/javascript">
    $(function(e){
        $('#categoryA').addClass('navActive');
    });
</script>
</html>