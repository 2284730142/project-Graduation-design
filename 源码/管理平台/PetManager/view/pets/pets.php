<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>pets</title>
    <?php include ROOT_PATH."includeTemp/cssTemp.php";?>
</head>
<body>
<?php include ROOT_PATH.'includeTemp/checkLogin.php';?>
<?php include ROOT_PATH.'includeTemp/header.php'; ?>
<?php 
    require_once(ROOT_PATH . 'Service/PetService.php');

    $class = new PetService();
    $petList = [];
    $pageIndex = 0;
    $pageSize = 3;
    $totalPageCount = 1;
    $message="";
    $list=[];
    $searchMes="";
    if(array_key_exists("currentPage" , $_REQUEST)){
            $pageIndex = intval($_REQUEST["currentPage"]);
        }
        if(array_key_exists("searched" , $_REQUEST)){
            $searchMes = $_REQUEST["searched"];
        }       
        $list=$class -> getPets($searchMes,$pageIndex * $pageSize , $pageSize);
        // 总的页数
        $totalPageCount = ceil($list["totalRows"] / $pageSize);
    
        
 ?>
<div class="pageBody">
    <?php include ROOT_PATH.'includeTemp/left.php'; ?>
    <div class="pageRight">
        <div class="myTitle">当前位置：宠物信息管理</div>
        <!--从这个DIV开始写内容-->
      <div style="margin-top: 25px;margin-left: 20px">
                <form method="post">
                <span>关键字：</span>
                <input type="text" name="searched" placeholder="输入宠物名搜索" class="input-search" value="<?=$searchMes?>">
                <button class="btn btn-default">搜索</button>
                </form>
            </div>
            <table class="table table-bordered" style="margin-top: 20px">
                <thead>
                    <tr>
                        <th>序号</th>
                        <th>宠物名</th>
                        <th>宠物类别</th>
                        <th>宠物性别</th>
                        <th>宠物年龄</th>
                        <th>宠物主人</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody id="myPet">
            <?php 
            if (is_bool($list)) {
                ?>
             <tr style="text-align:center">
                <td colspan="7"><h3>暂时没有信息</h3></td>
             </tr>
            <?php 
            }
            else {
            foreach ($list["petsList"] as $key => $value) {
                ?>
                    <tr>
                        <td><?=$key+1?></td>
                        <td><?=$value["Name"]?></td>
                        <td><?=$value["CateName"]?></td>
                        <td><?=$value["Sex"]?></td>
                        <td><?=$value["Age"]?></td>
                        <td><?=$value["userName"]?></td>
                        <td>
                            <a href="editPet.php?id=<?=$value['Id']?>" class="btn btn-info">编辑</a>
                        </td>
                    </tr>
                    <?php 
                            }
                        }
                       
                     ?>
                    
                </tbody>
             </table>
             <div>
        <?php for($i = 0 ; $i < $totalPageCount; $i++) {?>
            
            <a class="btn btn-default" href="pets.php?currentPage=<?php echo $i; ?>&searched=<?php echo $searchMes; ?>"><?php echo $i + 1; ?></a>
            
        <?php } ?>
     </div>
     <!--<div style="font-size:20px">每页 <span style="color:blue"><?php /*echo $pageSize; */?></span> 条 ,  <?php /*echo $pageIndex + 1; */?> /<?php
/*     if( $totalPageCount!=0){
      echo $totalPageCount;
      }
      else
        {
            echo "1";
            }; */?></div>-->
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