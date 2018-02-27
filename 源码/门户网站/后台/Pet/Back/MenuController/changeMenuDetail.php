<?php
/*
 * 相应菜单项的子菜单项的添加编辑修改的后台接口
 * */
require "../Service/MenuService.php";
require "../Util/ConstHelper.php";
require "../Util/MethodHelper.php";
//设置页面返回形式
header("Content-Type: text/plain;charset=utf-8;");
//设置请求头，解决跨域请求
header("Access-Control-Allow-Origin:*");
header("Access-Control-Allow-Method:GET,POST");

$methodList=['editMenuDetail','addMenuDetail','delMenuDetail'];
$menu=new MenuService();
$result=buildResponseResult(ConstHelper::REQUEST_CODE_FAIL_BECAUSE_PRIMARYERROR,ConstHelper::REQUEST_MESSAGE_FAIL_BECAUSE_PRIMARYERROR,null);
if(!is_bool(MethodHelper::check_parameter_request(["method","menuId"],$_POST)))
{
    $result=buildResponseResult(ConstHelper::REQUEST_CODE_FAIL_BECAUSE_PRIMARYERROR,ConstHelper::REQUEST_MESSAGE_FAIL_BECAUSE_PRIMARYERROR,null);
}
else
{
    $method=$_REQUEST['method'];
    $menuId=$_REQUEST['menuId'];
    if (!in_array($method,$methodList))
    {
        $result=buildResponseResult(ConstHelper::REQUEST_CODE_FAIL_BECAUSE_PRIMARYERROR,ConstHelper::REQUEST_MESSAGE_FAIL_BECAUSE_PRIMARYERROR,null);
    }
    else
    {
        if($method=='editMenuDetail')
        {
            //$name,$menuId, $price,$image,$content

            if (!is_bool(MethodHelper::check_parameter_request(["id","name","menuId","price","content","image"],$_POST)))
            {
                $result=buildResponseResult(ConstHelper::REQUEST_CODE_FAIL_BECAUSE_PRIMARYERROR,ConstHelper::REQUEST_MESSAGE_FAIL_BECAUSE_PRIMARYERROR,null);
            }
            else
            {
                $id=$_REQUEST['id'];
                $name=$_REQUEST['name'];
                $menuId=$_REQUEST['menuId'];
                $price=$_REQUEST['price'];
                $content=$_REQUEST['content'];
                $file=$_FILES['image'];
                if (!is_null($file))
                {
                    if ($file["error"] == UPLOAD_ERR_OK)
                    {
                        // 检查文件的有效性
                        $ext = pathinfo($file["name"], PATHINFO_EXTENSION);
                        // 判断文件大小以及类型
                        $mimeList=['image/jpeg','image/png','image/gif'];
                        $mime=$file['type'];
                        if (!in_array($mime,$mimeList))
                        {
                            $result=buildResponseResult(ConstHelper::IMAGE_MIME_ERROR_CODE,ConstHelper::IMAGE_MIME_ERROR_MESSAGE,null);
                        }
                        elseif($file['size']>2*1024*1024)
                        {
                            $result=buildResponseResult(ConstHelper::IMAGE_SIZE_ERROR_CODE,ConstHelper::IMAGE_SIZE_ERROR_MESSAGE,null);
                        }
                        else
                        {
                            $image = md5(uniqid() . microtime(true)) . '.' . $ext;
                            // 保存
                            move_uploaded_file($file["tmp_name"], '../Source/img/' . $image);
                        }
                    }
                }
                else
                {
                    $getThisDetail=$menu->getMenuDetailById($id);
                    $image=$getThisDetail[0]['Image'];
                }

                $num=$menu->editMenuDetail($id,$name,$menuId,$price,$image,$content);

                if($num>0)
                {
                    $result=buildResponseResult(ConstHelper::REQUEST_CODE_SUCCESS,ConstHelper::REQUEST_MESSAGE_SUCCESS,$num);
                }

            }


        }
        elseif($method=='addMenuDetail')
        {
            //$name,$menuId, $price,$image,$content

            if (!is_bool(MethodHelper::check_parameter_request(["name","menuId","price","content","image"],$_POST)))
            {
                $result=buildResponseResult(ConstHelper::REQUEST_CODE_FAIL_BECAUSE_PRIMARYERROR,ConstHelper::REQUEST_MESSAGE_FAIL_BECAUSE_PRIMARYERROR,null);
            }
            else
            {
                $name=$_REQUEST['name'];
                $menuId=$_REQUEST['menuId'];
                $price=$_REQUEST['price'];
                $content=$_REQUEST['content'];
                $file=$_FILES['image'];

                if ($file["error"] == UPLOAD_ERR_OK)
                {
                    // 检查文件的有效性
                    $ext = pathinfo($file["name"], PATHINFO_EXTENSION);
                    // 判断文件大小以及类型
                    $mimeList=['image/jpeg','image/png','image/gif'];
                    $mime=$file['type'];
                    if (!in_array($mime,$mimeList))
                    {
                        $result=buildResponseResult(ConstHelper::IMAGE_MIME_ERROR_CODE,ConstHelper::IMAGE_MIME_ERROR_MESSAGE,null);
                    }
                    elseif($file['size']>2*1024*1024)
                    {
                        $result=buildResponseResult(ConstHelper::IMAGE_SIZE_ERROR_CODE,ConstHelper::IMAGE_SIZE_ERROR_MESSAGE,null);
                    }
                    else
                    {
                        $image = md5(uniqid() . microtime(true)) . '.' . $ext;
                    }
                }
                $num=$menu->addMenuDetail($id,$name,$menuId,$price,$image,$content);

                if($num>0)
                {
                    // 保存
                    if (move_uploaded_file($file["tmp_name"], '../Source/img/' . $image))
                    {
                        $result=buildResponseResult(ConstHelper::REQUEST_CODE_SUCCESS,ConstHelper::REQUEST_MESSAGE_SUCCESS,$num);
                    }

                }
            }

        }
        elseif($method=='delMenuDetail')
        {
            if (!is_bool(MethodHelper::check_parameter_request(["id"],$_POST)))
            {
                $result=buildResponseResult(ConstHelper::REQUEST_CODE_FAIL_BECAUSE_PRIMARYERROR,ConstHelper::REQUEST_MESSAGE_FAIL_BECAUSE_PRIMARYERROR,null);
            }
            else
            {
                $id=$_REQUEST['id'];
                $num=$menu->deleteMenuById($id);
                if (!is_bool($num))
                {
                    $result=buildResponseResult(ConstHelper::REQUEST_CODE_SUCCESS,ConstHelper::REQUEST_MESSAGE_SUCCESS,$num);
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
