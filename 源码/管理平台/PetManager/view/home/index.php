<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>home</title>
    <?php include '../../includeTemp/cssTemp.php'; ?>
</head>
<body>
<?php include '../../includeTemp/checkLogin.php'; ?>
<?php include '../../includeTemp/header.php'; ?>
<div class="pageBody">
    <?php include '../../includeTemp/left.php'; ?>
    <div class="pageRight">
        <div class="myTitle">当前位置：控制面板</div>
        <div class="mainBody">
            <div>
                <a href="../user/users.php">
                    <span>用户信息管理</span>
                    <span>点击进入</span>
                </a>
                <a href="../pets/petCate.php">
                    <span>宠物类别管理</span>
                    <span>点击进入</span>
                </a>
                <a href="../pets/pets.php">
                    <span>宠物信息管理</span>
                    <span>点击进入</span>
                </a>
                <a href="../menu/menus.php">
                    <span>服务信息管理</span>
                    <span>点击进入</span>
                </a>
                <a href="../user/orders.php">
                    <span>订单信息管理</span>
                    <span>点击进入</span>
                </a>
            </div>
        </div>
    </div>
</div>
<script src="../../JS/jquery.js"></script>
<script type="text/javascript">
    $(function (e) {
        $('#homeA').addClass('navActive');
    });
</script>
</body>
</html>