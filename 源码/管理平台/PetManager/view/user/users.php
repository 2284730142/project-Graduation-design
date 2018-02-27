<?php
require ROOT_PATH . "Service/UserService.php";
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $userService = new UserService();
    $userData = $userService->getAllUser();
    $method = "";
    if (array_key_exists("method", $_GET)) {
        $method = trim($_GET["method"]);
        $id = trim($_GET["id"]);
        if ($method == "ban") {
            $res = $userService->banUserById($id);
            if (!is_bool($res)) {
                $userData = $userService->getAllUser();
            }
        }
        if ($method == "recover"){
            $res = $userService->recoverUserById($id);
            if (!is_bool($res)) {
                $userData = $userService->getAllUser();
            }
        }
    }
} else {
    $userService = new UserService();
    if (array_key_exists("searched", $_POST)) {
        $keyword = trim($_POST["searched"]);
        //如果post中有这个方法就进行查询操作
        $userData = [];
        $userData = $userService->searchUserByNT($keyword);
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
<?php include '../../includeTemp/checkLogin.php'; ?>
<?php include '../../includeTemp/header.php'; ?>
<div class="pageBody">
    <?php include '../../includeTemp/left.php'; ?>
    <div class="pageRight">
        <div class="myTitle">当前位置：用户信息管理</div>
        <div style="margin-top: 25px;margin-left: 20px">
            <form method="post">
                <span>关键字：</span>
                <input type="text" name="searched" placeholder="输入用户真实姓名/手机号码搜索" class="input-search" value="">
                <button class="btn btn-default">搜索</button>
                <a href="addUser.php" class="btn btn-default">新增</a>
            </form>
        </div>
        <table class="table table-bordered" style="margin-top: 20px">
            <thead>
            <tr>
                <th>序号</th>
                <th>姓名</th>
                <th>性别</th>
                <th>手机号</th>
                <th>身份证</th>
                <th>住址</th>
                <th>状态</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody id="myTbody">
            <?php
            if ($userData) {
                foreach ($userData as $index => $item) {
                    ?>
                    <tr>
                        <td><?php echo $index + 1; ?></td>
                        <td><?php echo $item["TrueName"]; ?></td>
                        <td><?php echo $item["Sex"]; ?></td>
                        <td><?php echo $item["Phone"]; ?></td>
                        <td><?php echo $item["CardId"]; ?></td>
                        <td><?php echo $item["Address"]; ?></td>
                        <td style="<?php echo $item["State"] == 1 ? "" : "color:red;" ?>"><?php echo $item["State"] == 1 ? "正常" : "禁用" ?></td>
                        <td><a href="editUser.php?id=<?php echo $item["Id"]; ?>" class="btn btn-info">编辑</a><a
                                href="users.php?<?php echo $item["State"] == 1 ? "method=ban&id=" . $item["Id"] : "method=recover&id=" . $item["Id"]; ?>"
                                class="btn btn-danger"><?php echo $item["State"] == 1 ? "禁用" : "启用" ?></a>
                        </td>
                    </tr>
                    <?php
                }
            } else {
                ?>
                <tr>
                    <td colspan="7">暂无数据</td>
                </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
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