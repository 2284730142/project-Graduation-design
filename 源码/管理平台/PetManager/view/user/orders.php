<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>orders</title>
    <?php include ROOT_PATH."includeTemp/cssTemp.php";?>
    <style type="text/css">
        .aa
        {
            width: 100px;
        }
        .table1
        {
            margin-top: 20px;
        }
        .cate
        {
            color: #2bb4e8;
        }
    </style>
</head>
<body>
<?php include ROOT_PATH.'includeTemp/checkLogin.php';?>
<?php include ROOT_PATH.'includeTemp/header.php'; ?>

<?php
    $searchMes="";
    $message="";
    require_once ROOT_PATH."Service/OrderService.php";
    require_once ROOT_PATH."Service/MenuService.php";
    require_once ROOT_PATH."Service/PetCategoryService.php";

    $pageIndex=1;
    $pageSize = 5;
    $thisMenu=5;
    $thisState=5;
    $MenuService=new MenuService();
    $menuRes=$MenuService->getMenuDetail();
    $menus=[];
    if (!is_bool($menuRes))
    {
        $menus=$menuRes;
    }
    else
    {
        $message="查询失败";
    }

    $sRes=[];
    $states=[
        ['val'=>5,'name'=>'全部状态'],
        ['val'=>0,'name'=>'用户预约'],
        ['val'=>1,'name'=>'预约成功'],
        ['val'=>2,'name'=>'订单完成'],
        ['val'=>3,'name'=>'用户已取消']
    ];


    if(array_key_exists("thisPage" , $_REQUEST))
    {
        $pageIndex = intval($_REQUEST["thisPage"]);
    }

    // 按条件查询
    if(array_key_exists("menus" , $_REQUEST))
    {
        $thisMenu=$_REQUEST['menus'];
    }
    if(array_key_exists("state" , $_REQUEST))
    {
        $thisState=$_REQUEST['state'];
    }
    if(array_key_exists("searched" , $_REQUEST))
    {
        $searchMes=$_REQUEST['searched'];
    }
    if(array_key_exists("key" , $_REQUEST))
    {
        $searchMes=$_REQUEST['key'];
    }
    // 总的页数

    $order=new OrderService();
    $result=$order->getAllOrder($searchMes,$thisMenu,$thisState,($pageIndex-1) * $pageSize,$pageSize);
    $list=[];
    if (!is_bool($result))
    {
        $list=$result['orderList'];
        $pageNum=ceil($result["totalRows"] / $pageSize);
    }
    else
    {
        $message="查询失败";
    }


?>
<div class="pageBody">
    <?php include ROOT_PATH.'includeTemp/left.php'; ?>
    <div class="pageRight">
        <div class="myTitle">当前位置：订单信息管理</div>
        <!--从这个DIV开始写内容-->
        <div style="margin-top: 25px;margin-left: 20px">
            <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
                <select class="mySelect" name="menus">
                    <option value="5" selected>全部服务</option>
                    <?php
                    for ($i=0; $i <count($menus); $i++)
                    {
                        $item=$menus[$i];
                        ?>
                        <option value="<?=$item['Id']?>" <?php echo $thisMenu==$item['Id'] ? "selected":""; ?>><?=$item['Name']?></option>                    <?php
                    }
                    ?>
                </select>
                <select class="mySelect" name="state">
                    <?php
                    for ($i=0; $i <count($states); $i++)
                    {
                        $item=$states[$i];
                        ?>
                        <option value="<?=$item['val']?>" <?php echo $thisState==$item['val'] ? "selected":""; ?>><?=$item['name']?></option>
                        <?php
                    }
                    ?>
                </select>
                <span>关键字：</span>
                <input type="text" name="searched" placeholder="输入姓名/手机号码搜索" class="input-search" value="<?=$searchMes?>">
                <button class="btn btn-default">搜索</button>
            </form>
        </div>
        <table class="table table-bordered table1">
            <thead>
            <tr>
                <th>序号</th>
                <th>服务项</th>
                <th>用户姓名</th>
                <th>联系方式</th>
                <th>宠物/类别</th>
                <th>下单时间</th>
                <th>用户备注</th>
                <th>状态</th>
            </tr>
            </thead>
            <tbody>
            <?php
                if (count($list)>0)
                {
                    for ($i = 0; $i < count($list); $i++)
                    {
                        $item=$list[$i];
                        $state=$item['State'];
                        if ($state==0)
                        {
                            $mes='用户预约';
                        }
                        elseif($state==1)
                        {
                            $mes='预约成功';
                        }
                        elseif($state==2)
                        {
                            $mes='订单完成';
                        }
                        elseif($state==3)
                        {
                            $mes='用户已取消';
                        }
            ?>
                <tr>
                    <td><?=$i+1?></td>
                    <td><?=$item['MenuName']?></td>
                    <td><?=$item['UserName']?></td>
                    <td><?=$item['Phone']?></td>
                    <td>
                        <span><?=$item['PetName']?>/</span>
                        <span class="cate"><?=$item['PetCate']?></span>
                    </td>
                    <td><?=$item['Date']?></td>
                    <td><?=$item['Message']?></td>
                    <td>
                        <a href="<?php echo '../../OrderController/order.php';?>?id=<?=$item['Id']?>&state=<?=$state?>" class="btn aa
                        <?php if($state==0){echo "btn-info";}
                            elseif($state==1){echo "btn-danger";}
                            elseif($state==2){echo "btn-success";}
                            elseif($state==3){echo "btn-default";}?>">
                            <?=$mes?>
                        </a>
                    </td>
                </tr>
            <?php
                    }
                }
                else
                {
            ?>
            <tr>
                <td colspan="8">暂无数据</td>
            </tr>
            <?php
                }?>
            </tbody>
        </table>
        <nav aria-label="Page navigation">
            <ul class="pagination">
                <li>
                    <a href="orders.php?thisPage=<?php echo  $pageIndex>1 ?  $pageIndex-1 : 1;?>&key=<?=$searchMes?>&menus=<?=$thisMenu?>&state=<?=$thisState?>" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
                <?php
                if(count($list>0))
                {
                    for ($i=0; $i < $pageNum; $i++)
                    {
                        ?>
                        <li><a href="orders.php?thisPage=<?=$i+1?>&key=<?=$searchMes?>&menus=<?=$thisMenu?>&state=<?=$thisState?>" style="<?php echo $pageIndex==$i+1 ? "background-color:#428BCA;color:white;":"";?>"><?=$i+1?></a></li>
                        <?php
                    }
                }
                ?>
                <li>
                    <a href="orders.php?thisPage=<?php echo  $pageIndex<$pageNum ?  $pageIndex+1:$pageNum;?>&key=<?=$searchMes?>&menus=<?=$thisMenu?>&state=<?=$thisState?>" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</div>
</body>
<script src="../../JS/jquery.js"></script>
<script type="text/javascript">
    $(function(e){
        $('#ordersA').addClass('navActive');
    });
</script>
</html>