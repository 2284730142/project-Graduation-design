<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/26
 * Time: 15:01
 */
header("content-type:application/json;charset=utf-8");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $dir = '../../images/';
    $code = 101;
    $message = "删除失败";
    $data = "";
    if (array_key_exists('file', $_POST)) {
        $fileName = $_POST["file"];
        $code = 100;
        $message = "删除成功";
        $data = unlink($dir . $fileName);
    }
    echo json_encode(array('code' => $code, 'message' => $message, 'data' => $data, 'name' => $fileName));
}