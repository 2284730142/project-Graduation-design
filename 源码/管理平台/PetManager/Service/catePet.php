<?php 
require_once ROOT_PATH."Impl/MenuInterface.php";
require_once ROOT_PATH."Util/DBHelper.php";

class CateService 
{
    /*
         * 获取所有菜单
         * */
    public function getAllcategories()
    {

    	$sql = "select id , name from petcategories";
    	$res = DBHelper::executeQuery($sql);
    	if (!is_bool($res)) {
    		for ($i = 0; $i < count($res); $i++) {
                $arr[$i]['Id'] = $res[$i]['0'];
                $arr[$i]['Name'] = $res[$i]['1'];
            }
            return $arr;
            }
    return false;
    }

}