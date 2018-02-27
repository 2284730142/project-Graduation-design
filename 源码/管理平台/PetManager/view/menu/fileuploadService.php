<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/26
 * Time: 14:00
 */
/*
 * 该service只进行图片保存
 * 接收文件并保存到服务器，不保存到数据库
 * */
header("content-type:application/json;charset=utf-8");
// 获取文件
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $file = $_FILES["file"];
    $code = 101;
    $message = "上传失败";
    $data = "";

    if ($file["error"] == UPLOAD_ERR_OK) {
        // 检查文件的有效性
        $ext = pathinfo($file["name"], PATHINFO_EXTENSION);
        // 判断文件大小以及类型
        $fileName = md5(uniqid() . microtime(true)) . '.' . $ext;
        // 保存
        if (move_uploaded_file($file["tmp_name"], ROOT_PATH.'images/' . $fileName)) {
            $data = $fileName;
            $code = 100;
            $message = "上传成功";
        }
    }

    // 响应
    echo json_encode(array('code' => $code, 'message' => $message, 'data' => $data));
}
