<?php
/*
 * 通过id获取用户信息
 * */
require "../Service/UserService.php";
require "../Util/ConstHelper.php";
require "../Util/MethodHelper.php";
//设置页面返回形式
header("Content-Type: text/plain;charset=utf-8;");
//设置请求头，解决跨域请求
header("Access-Control-Allow-Origin:*");
header("Access-Control-Allow-Method:GET,POST");
//初始化数据code和message
$code = ConstHelper::REQUEST_CODE_FAIL;
$message = ConstHelper::REQUEST_MESSAGE_FAIL;
$data = [];
$result = "";
$user = new UserService();
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    //GET时进入
    if (!is_bool($result = MethodHelper::check_parameter_request(["id"], $_GET))) {//检测是否存在$_GET数组中
        $code = ConstHelper::REQUEST_CODE_FAIL_BECAUSE_PRIMARYERROR;
        $message = ConstHelper::REQUEST_MESSAGE_FAIL_BECAUSE_PRIMARYERROR;
        $data = $result;
        echo json_encode(array("code" => $code, "message" => $message, "data" => $data));
        exit();
    } else {
        //调用方法返回查询结果
        $id = trim($_GET["id"]);
        //直接登录
        $result = $user->getUerById($id);
        if (!is_bool($result)) {
            $code = ConstHelper::REQUEST_CODE_SUCCESS;
            $message = ConstHelper::REQUEST_MESSAGE_SUCCESS;
            $data = $result;
            echo json_encode(array("code" => $code, "message" => $message, "data" => $data));
            exit();
        }
        $code = ConstHelper::REQUEST_CODE_FAIL_BECAUSE_PRIMARYERROR;
        $message = ConstHelper::REQUEST_MESSAGE_FAIL_BECAUSE_PRIMARYERROR;
        $data = $result;
        echo json_encode(array("code" => $code, "message" => $message, "data" => $data));
        exit();
    }
} elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo json_encode(array("code" => $code, "message" => $message, "data" => $data));
    exit();
}