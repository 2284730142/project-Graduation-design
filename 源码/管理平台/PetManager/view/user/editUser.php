<?php
require ROOT_PATH . "Service/UserService.php";
$id = '';
$userData = [];
$res = [];
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $userService = new UserService();
    if (array_key_exists('id', $_GET)) {
        $id = trim($_GET["id"]);
        $res = $userService->getUerById($id);
        if (!is_bool($res)) {
            $userData = $res;
        }
    }
} else {
    $userService = new UserService();
    $id = trim($_GET["id"]);
    $address = trim($_GET["address"]);;
    $truename = trim($_GET["truename"]);;
    $cardid = trim($_GET["cardid"]);;
    $sex = trim($_GET["sex"]);;
    $phone = trim($_GET["phone"]);;
    $res = $userService->editUser($id, $address, $truename, $cardid, $sex, $phone);
    if (!is_bool($res)) {
        echo "<script>
                alert('修改成功');
                location.href = '../user/users.php';
                </script>";
    }
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
        <div class="myTitle">当前位置：编辑用户信息</div>
        <a href="users.php" class="btn btn-info backBtn">返回</a>
        <?php
        if ($id && !is_bool($res)) {
            ?>
            <div class="addLibClass">
                <div class="div1">
                    <form method="post" novalidate="" action="editUser.php">
                        <div class="div2">
                            <span>姓名：</span>
                            <input type="text" name="truename" required value="<?php echo $userData[0]["TrueName"]; ?>">
                            <span class="default">名称必须为4-12位的字符</span>
                        </div>
                        <div class="div2">
                            <span>性别：</span>
                            <label for="man">男</label>
                            <input style="width: 15px;height: 15px;" id="man" type="radio" name="sex"
                                   value="男" <?php echo $userData[0]["Sex"] == "男" ? "checked" : ""; ?>
                                   align="center">
                            <label for="woman">女</label>
                            <input style="width: 15px;height: 15px;" id="woman" type="radio" name="sex"
                                   value="女" <?php echo $userData[0]["Sex"] == "女" ? "checked" : ""; ?>
                                   align="center">
                        </div>
                        <div class="div2">
                            <span>身份证号码：</span>
                            <input type="text" name="cardid" required value="<?php echo $userData[0]["CardId"]; ?>">
                            <span class="default">身份证号为18位数字或者末尾为字母</span>
                        </div>
                        <div class="div2">
                            <span>地址：</span>
                            <input type="text" name="address" required value="<?php echo $userData[0]["Address"]; ?>">
                            <span class="default">请输入您的地址</span>
                        </div>
                        <div class="div2">
                            <span>电话号码：</span>
                            <input type="text" name="phone" required value="<?php echo $userData[0]["Phone"]; ?>">
                            <span class="default">请输入有效的手机号码</span>
                        </div>
                        <p align="center" class="addLibsBtn">
                            <button class="btn btn-info" type="submit">保存</button>
                            <a href="users.php" class="btn btn-default" type="button">取消</a>
                        </p>
                    </form>
                </div>
            </div>
            <?php
        } else {
            ?>
            <div class="addLibClass">
                <div class="div1">信息显示错误,请刷新后重试</div>
            </div>
            <?php
        }
        ?>
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