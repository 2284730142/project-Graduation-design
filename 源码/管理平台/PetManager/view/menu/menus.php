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
    //获取服务类菜单
    $menusList = $menus -> getAllMenu();
    //获取服务类下的子菜单
    //按关键字和服务类查询
    $menusDetail = '';
    $keyWord = '';
    $cates = '';
    //分页变量
    $pageIndex = 0;
    $pageSize = 3;
    $totalPageCount = 0;
    if(array_key_exists("currentPage" , $_REQUEST)){
        $pageIndex = intval($_REQUEST["currentPage"]);
    }
    if(array_key_exists("keyWord" , $_REQUEST)){
        $keyWord = $_REQUEST["keyWord"];
    }
    if(array_key_exists("cates" , $_REQUEST)){
        $cates = $_REQUEST["cates"];
    }
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $keyWord = $_POST["keyWord"];
        $cates = $_POST["cates"];  
        echo $keyWord,$cates;     
    } 
    $menusDetail = $menus -> getAllMenuDetail($keyWord,$cates,$pageIndex*$pageSize,$pageSize); 
    $totalPageCount = ceil($menusDetail["count"]/$pageSize);
?>
<!-- 元素界面 -->
<div class="pageBody">
    <?php include'../../includeTemp/left.php'; ?>
    <div class="pageRight">
        <div class="myTitle">当前位置：服务信息管理</div>
        <div class="bookSearch">
            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <select class="mySelect" name="cates">
                <option value="">全部分类</option>
                <?php 
                    for ($i=0; $i <count($menusList); $i++) 
                    { 
                        $item=$menusList[$i];
                ?>
                    <option value="<?=$item['Id']?>" <?php echo $item['Id'] == $cates ? 'selected':'' ?>><?=$item['Name']?></option>      
                <?php 
                    }
                ?>
            </select>
            <span>关键字：</span>
            <input type="text" name="keyWord" placeholder="输入服务名" class="input-search" value="<?php echo $keyWord; ?>">
            <button type="submit" class="btn btn-default">搜索</button>
            <a href="addMenu.php" class="btn btn-default">新增</a>
            </form>
        </div>
        <?php 
            if(is_bool($menusDetail)){
                echo "连接数据库失败.";
                exit();
            }
            if(count($menusDetail) == 0){
                echo "没有数据.";
                exit();
            }    
            else{
                foreach ($menusDetail['menuList'] as $key => $value) { 
        ?>
        <div class="menus-wrapper">
            <div>
                <img src="../../images/<?=$value['Image']; ?>">
            </div>
            <div>
                <p class="menus-Name"><?=$value['Name']; ?></p>
                <p>价格：<span class="menus-price">￥<?=$value['Price']; ?>.00</span></p>
                <p>服务类型：<span class="menus-content" style="font-size:16px;"><b><?=$value['menusName']; ?></b></span></p>
                <p>服务详情：<span class="menus-content"><?=$value['Content']; ?></span></p>
                <div class="menus-op">
                    <a href="editmenus.php?Id=<?=$value['Id']?>" class="btn btn-primary" style="padding:5px 30px;">编辑</a>
                </div>
            </div>
        </div>          
        <?php   }
            }
        ?>
        <!-- 分页 -->
        <div class="menus-page">
            <?php for($i=0;$i<$totalPageCount;$i++){ ?>
            <a class="btn btn-default" href="menus.php?currentPage=<?php echo $i; ?>&keyWord=<?php echo $keyWord ?>&cates=<?php echo $cates ?>"><?=$i+1; ?></a>
            <?php } ?>
        </div>
    </div>
</div>
</body>
<script src="../../JS/jquery.js"></script>
<script type="text/javascript">
    $(function(e){
        $('#menusA').addClass('navActive');
    });
</script>
</html>