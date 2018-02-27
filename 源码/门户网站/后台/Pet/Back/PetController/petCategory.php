<?php
/*
 * 获取宠物类别的后台接口
 * */
require "../Service/PetCategoryService.php";
require "../Util/ConstHelper.php";
require "../Util/MethodHelper.php";
//设置页面返回形式
header("Content-Type: text/plain;charset=utf-8;");
//设置请求头，解决跨域请求
header("Access-Control-Allow-Origin:*");
header("Access-Control-Allow-Method:GET,POST");

//创建一个PetCategoryService对象
$cate=new PetCategoryService();

$methodList=["getPetCategory"];

//初始化返回的数据
$result=buildResponseResult(ConstHelper::REQUEST_CODE_FAIL,ConstHelper::REQUEST_MESSAGE_FAIL,null);
if(!is_bool(MethodHelper::check_parameter_request(["method"],$_GET)))
{
    $result=buildResponseResult(ConstHelper::REQUEST_CODE_FAIL_BECAUSE_PRIMARYERROR,ConstHelper::REQUEST_MESSAGE_FAIL_BECAUSE_PRIMARYERROR,null);
}
else
{
    $method=$_REQUEST['method'];
    if (!in_array($method,$methodList))
    {
        $result=buildResponseResult(ConstHelper::REQUEST_CODE_FAIL_BECAUSE_PRIMARYERROR,ConstHelper::REQUEST_MESSAGE_FAIL_BECAUSE_PRIMARYERROR,null);
    }

    if ($method=="getPetCategory")
    {
        $list=$cate->getAllPetCategory();
        if (!is_bool($list))
        {
            $result=buildResponseResult(ConstHelper::REQUEST_CODE_SUCCESS,ConstHelper::REQUEST_MESSAGE_SUCCESS,$list);
        }
    }
}

function buildResponseResult($code , $msg , $data = null)
{

    return[
        "code" => $code,
        "message" => $msg,
        "data" => $data
    ];
}

echo json_encode($result);
