<?php
require_once "../Impl/MenuInterface.php";
require_once "../Util/DBHelper.php";

class MenuService implements MenuInterface
{
    /*
         * 获取所有菜单
         * */
    public function getAllMenu()
    {
        $sql = "SELECT Id,Name FROM menus;";
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

    /*
     * 通过菜单id获取菜单的子菜单
     * */
    public function getMenuDetail($id)
    {
        $sql = "SELECT id,name,price,image,content FROM menudetail WHERE menuid='{$id}'";
        $res = DBHelper::executeQuery($sql);
        if (!is_bool($res)) {
            $arr = [];
            for ($i = 0; $i < count($res); $i++) {
                $arr[$i]['Id'] = $res[$i]['0'];
                $arr[$i]['Name'] = $res[$i]['1'];
                $arr[$i]['Price'] = $res[$i]['2'];
                $arr[$i]['Image'] = 'http://192.168.9.27:7070/Pet/Source/img/' . $res[$i]['3'];
                $arr[$i]['Content'] = $res[$i]['4'];
            }
            return $arr;
        }
        return false;
    }

    /*
     * 通过id获取子菜单
     * */
    public function getMenuDetailById($id)
    {

        $sql = "SELECT Id,Name FROM menus menudetail WHERE Id='{$id}';";
        $res = DBHelper::executeQuery($sql);
        if (!is_bool($res)) {
            for ($i = 0; $i < count($res); $i++) {
                $arr[$i]['Id'] = $res[$i]['0'];
                $arr[$i]['Name'] = $res[$i]['1'];
                $arr[$i]['Price'] = $res[$i]['2'];
                $arr[$i]['Image'] = 'http://192.168.9.27:7070/Pet/Source/img/' . $res[$i]['3'];
                $arr[$i]['Content'] = $res[$i]['4'];
            }
            return $arr;
        }
        return false;
    }

    /*
     * 通过id删除菜单的子菜单
     * */
    public function deleteMenuById($id)
    {
        $sql = "DELETE FROM menudetail WHERE Id='{$id}';";
        $res = DBHelper::executeNonQuery($sql);
        return $res;
    }

    /*
     * 添加菜单的子菜单
     * */
    public function addMenuDetail($name, $menuId, $price, $image, $content)
    {
        $sql = "INSERT INTO menudetail(id,name,menuId,price,image,content)
              VALUES(uuid(),'{$name}','{$menuId}',{$price},'{$image}','{$content}');";
        $res = DBHelper::executeNonQuery($sql);
        return $res;

    }

    /*
     * 修改子菜单
     */
    public function editMenuDetail($id, $name, $menuId, $price, $image, $content)
    {
        $sql = "UPDATE menudetail SET name='{$name}',menuId='{$menuId}',price='{$price}',
              image='{$image}',content='{$content}' WHERE id='{$id}';";

        $res = DBHelper::executeNonQuery($sql);
        return $res;
    }

    /*
     * 用户创建订单时通过当前服务项目的id获取具体的服务项
     * */
    public function getServiceById($id)
    {
        $sql = "SELECT `Id`,`Name` FROM menudetail WHERE Id='{$id}';";
        $res = DBHelper::executeQuery($sql);
        $list = [];
        if (!is_bool($res)) {
            $list[] = [
                'Id' => $res[0][0],
                'Name' => $res[0][1]
            ];
            return $list;
        }
        return false;
    }
}