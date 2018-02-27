<?php
/*
 * 宠物的增删改查后台接口
 * */
require "../Service/PetService.php";
require "../Util/ConstHelper.php";
require "../Util/MethodHelper.php";
//设置页面返回形式
header("Content-Type: text/plain;charset=utf-8;");
//设置请求头，解决跨域请求
header("Access-Control-Allow-Origin:*");
header("Access-Control-Allow-Method:GET,POST");

$pets=new PetService();
$methodList=["getPets","editPets","addPets","deletePets"];

//初始化数据
$result=buildResponseResult(ConstHelper::REQUEST_CODE_FAIL,ConstHelper::REQUEST_MESSAGE_FAIL,null);
if(!is_bool(MethodHelper::check_parameter_request(["method","userId"],$_POST)))
{
    echo 111;
    $result=buildResponseResult(ConstHelper::REQUEST_CODE_FAIL_BECAUSE_PRIMARYERROR,ConstHelper::REQUEST_MESSAGE_FAIL_BECAUSE_PRIMARYERROR,null);
}
else
{
    $userId=$_REQUEST['userId'];
    $method=$_REQUEST['method'];
    if (!in_array($method,$methodList))
    {
        $result=buildResponseResult(ConstHelper::REQUEST_CODE_FAIL_BECAUSE_PRIMARYERROR,ConstHelper::REQUEST_MESSAGE_FAIL_BECAUSE_PRIMARYERROR,null);
    }
    else
    {
        if($method=='getPets')
        {
            $list=$pets->getPets($userId);
            if(!is_bool($list))
            {
                $result=buildResponseResult(ConstHelper::REQUEST_CODE_SUCCESS,ConstHelper::REQUEST_MESSAGE_SUCCESS,$list);
            }
        }
        elseif ($method=='editPets')
        {
            if (!is_bool(MethodHelper::check_parameter_request(["id","name","cateId","sex","age"],$_POST))) 
            {
                $result=buildResponseResult(ConstHelper::REQUEST_CODE_FAIL_BECAUSE_PRIMARYERROR,ConstHelper::REQUEST_MESSAGE_FAIL_BECAUSE_PRIMARYERROR,null);
            }
            else
            {
                $id=$_REQUEST['id'];
                $name=$_REQUEST['name'];
                $cateId=$_REQUEST['cateId'];
                $sex=$_REQUEST['sex'];
                $age=$_REQUEST['age'];

                $num=$pets->editPet($id,$name,$cateId,$sex,$age);
                $result=buildResponseResult(ConstHelper::REQUEST_CODE_SUCCESS,ConstHelper::REQUEST_MESSAGE_SUCCESS,$num);
            }

        }
        elseif ($method=='addPets')
        {
            if (!is_bool(MethodHelper::check_parameter_request(["userId","name","cateId","sex","age"],$_POST)))
            {
                $result=buildResponseResult(ConstHelper::REQUEST_CODE_FAIL_BECAUSE_PRIMARYERROR,ConstHelper::REQUEST_MESSAGE_FAIL_BECAUSE_PRIMARYERROR,1);
            }
            else
            {
                $name=$_REQUEST['name'];
                $cateId=$_REQUEST['cateId'];
                $sex=$_REQUEST['sex'];
                $age=$_REQUEST['age'];
                $userId=$_REQUEST['userId'];
                $num=$pets->addPet($name,$cateId,$sex,$age,$userId);

                $result=buildResponseResult(ConstHelper::REQUEST_CODE_SUCCESS,ConstHelper::REQUEST_MESSAGE_SUCCESS,$num);
            }
        }
        elseif($method=='deletePets')
        {
            if (!is_bool(MethodHelper::check_parameter_request(["id"],$_POST)))
            {
                $result=buildResponseResult(ConstHelper::REQUEST_CODE_FAIL_BECAUSE_PRIMARYERROR,ConstHelper::REQUEST_MESSAGE_FAIL_BECAUSE_PRIMARYERROR,null);
            }
            else
            {
                $id=$_REQUEST['id'];

                $num=$pets->deletePetById($id);

                if ($num>0)
                {
                    $result=buildResponseResult(ConstHelper::REQUEST_CODE_SUCCESS,ConstHelper::REQUEST_MESSAGE_SUCCESS,$num);

                }
                else
                {
                    $result=buildResponseResult(ConstHelper::REQUEST_CODE_FAIL_BECAUSE_NODATA,ConstHelper::REQUEST_MESSAGE_FAIL_BECAUSE_NODATA,$num);
                }

            }
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