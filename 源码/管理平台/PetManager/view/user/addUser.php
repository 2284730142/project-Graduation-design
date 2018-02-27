<?php
require ROOT_PATH . "Service/UserService.php";
if ($_SERVER["REQUEST_METHOD"] == "GET") {

} else {

}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>users</title>
    <?php include "../../includeTemp/cssTemp.php"; ?>
</head>
<body>
<?php include "../../includeTemp/checkLogin.php"; ?>
<?php include "../../includeTemp/header.php"; ?>
<div class="pageBody">
    <?php include '../../includeTemp/left.php'; ?>
    <div class="pageRight">
        <div class="myTitle">当前位置：新增用户</div>
        <a href="users.php" class="btn btn-info backBtn">返回</a>
        <div class="addLibClass">
            <div class="div1">
                <form method="post" novalidate="">
                    <div class="div2">
                        <span>姓名：</span>
                        <input type="text" name="name" required value="">
                        <span class="default">名称必须为4-12位的字符</span>
                    </div>
                    <div class="div2">
                        <span>身份证号码：</span>
                        <input type="text" name="card" required value="">
                        <span class="default">身份证号为18位数字或者末尾为字母</span>
                    </div>
                    <div class="div2">
                        <span>地址：</span>
                        <input type="text" name="address" required value="">
                        <span class="default">请输入您的地址</span>
                    </div>
                    <div class="div2">
                        <span>电话号码：</span>
                        <input type="text" name="phone" required value="">
                        <span class="default">请输入有效的手机号码</span>
                    </div>
                    <p align="center" class="addLibsBtn">
                        <button class="btn btn-info" type="submit">保存</button>
                        <a href="users.php" class="btn btn-default" type="button">取消</a>
                    </p>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
<script src="../../JS/jquery.js"></script>
<script type="text/javascript">
    $(function (e) {
        $('#usersA').addClass('navActive');
    });
</script>
</html>