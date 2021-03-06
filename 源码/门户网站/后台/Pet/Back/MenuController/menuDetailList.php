<?php
/*
 * 获取相应菜单项的子菜单项的后台接口
 * */
require "../Service/MenuService.php";
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
$menu=new MenuService();
$result=buildResponseResult(ConstHelper::REQUEST_CODE_FAIL_BECAUSE_PRIMARYERROR,ConstHelper::REQUEST_MESSAGE_FAIL_BECAUSE_PRIMARYERROR,null);
if(!is_bool(MethodHelper::check_parameter_request(["id"],$_GET)))
{
    $result=buildResponseResult(ConstHelper::REQUEST_CODE_FAIL_BECAUSE_PRIMARYERROR,ConstHelper::REQUEST_MESSAGE_FAIL_BECAUSE_PRIMARYERROR,null);
}
else
{
    $id=$_REQUEST['id'];
    if($id!="")
    {
        $list=$menu->getMenuDetail($id);
        if (!is_bool($list))
        {
            $result=buildResponseResult(ConstHelper::REQUEST_CODE_SUCCESS,ConstHelper::REQUEST_MESSAGE_SUCCESS,$list);
        }
    }
    else
    {
        $result=buildResponseResult(ConstHelper::REQUEST_CODE_FAIL_BECAUSE_PRIMARYERROR,ConstHelper::REQUEST_MESSAGE_FAIL_BECAUSE_PRIMARYERROR,null);
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
