<?php
/*
 * 编辑用户信息
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
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //POST时进入
    if (!is_bool($result = MethodHelper::check_parameter_request(["id", "address", "truename", "cardid", "sex", "phone"], $_POST))) {//检测是否存在$_PSOT数组中
        $code = ConstHelper::REQUEST_CODE_FAIL_BECAUSE_PRIMARYERROR;
        $message = ConstHelper::REQUEST_MESSAGE_FAIL_BECAUSE_PRIMARYERROR;
        $data = $result;
        echo json_encode(array("code" => $code, "message" => $message, "data" => $data));
        exit();
    } else {
        //调用方法返回查询结果
        $id = trim($_POST["id"]);
        $address = trim($_POST["address"]);
        $truename = trim($_POST["truename"]);
        $cardid = trim($_POST["cardid"]);
        $sex = trim($_POST["sex"]);
        $phone = trim($_POST["phone"]);
        //做规则判断(格式验证未完成)
        if (is_bool($result = MethodHelper::check_parameter_rule([ConstHelper::MATCH_MOBILEPHONE], [$phone]))) {
            $result = $user->editUser($id, $address, $truename, $cardid, $sex, $phone);
            if (!is_bool($result)) {
                //判断数值是否大于0
                if ($result > 0) {
                    $result = $user->getUerById($id);
                    $code = ConstHelper::REQUEST_CODE_SUCCESS;
                    $message = ConstHelper::REQUEST_MESSAGE_SUCCESS;
                    $data = $result;
                    echo json_encode(array("code" => $code, "message" => $message, "data" => $data));
                    exit();
                }
                $code = 103;
                $message = "信息修改有误";
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
        $code = 104;
        $message = "参数格式不正确";
        $data = $result;
        echo json_encode(array("code" => $code, "message" => $message, "data" => $data));
        exit();
    }
} elseif ($_SERVER["REQUEST_METHOD"] == "GET") {
    echo json_encode(array("code" => $code, "message" => $message, "data" => $data));
    exit();
}