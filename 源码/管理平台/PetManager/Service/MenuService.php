<?php
require_once ROOT_PATH . "Impl/MenuInterface.php";
require_once ROOT_PATH . "Util/DBHelper.php";

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
    public function getMenuDetail($id = "")
    {
        $sql = "SELECT id,name,price,image,content FROM menudetail";
        if ($id != "") {
            $sql .= " WHERE menuid='{$id}'";
        }
        $res = DBHelper::executeQuery($sql);
        if (!is_bool($res)) {
            $arr = [];
            for ($i = 0; $i < count($res); $i++) {
                $arr[$i]['Id'] = $res[$i]['0'];
                $arr[$i]['Name'] = $res[$i]['1'];
                $arr[$i]['Price'] = $res[$i]['2'];
                $arr[$i]['Image'] = 'http://localhost:7070/Pet/Source/img/' . $res[$i]['3'];
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
                $arr[$i]['Image'] = 'http://localhost:7070/Pet/Source/img/' . $res[$i]['3'];
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

    /*
     * 获取和筛选服务信息
     **/
    public function getAllMenuDetail($key, $cates, $indexStart, $pageSize)
    {
        $sql = "SELECT t1.id,t1.name,t1.price,t1.image,t1.content,t2.name FROM menudetail t1 inner join menus t2 on t1.menuid=t2.Id where 1=1";
        $sql2 = "SELECT count(1) from menudetail t1 inner join menus t2 on t1.menuid=t2.Id where 1=1";
        if ($cates != '') {
            $sql .= " and t1.menuid='{$cates}'";
            $sql2 .= " and t1.menuid='{$cates}'";
        }
        if ($key != '') {
            $sql .= " and t1.name like '%{$key}%'";
            $sql2 .= " and t1.name like '%{$key}%'";
        }
        $sql .= " limit {$indexStart} , {$pageSize};";
        $sql3 = $sql . $sql2;
        $result = DBHelper::executeMultiQuery($sql3);

        if (!is_null($result)) {
            $arr = [];
            //重组第一个数组
            $list = [];
            foreach ($result[0] as $key => $value) {
                $list[] = [
                    "Id" => $value[0],
                    "Name" => $value[1],
                    "Price" => $value[2],
                    "Image" => $value[3],
                    "Content" => $value[4],
                    "menusName" => $value[5]
                ];
            }
            $arr["menuList"] = $list;
            //重组第二个数组
            $arr["count"] = $result[1][0][0];
            return $arr;
        }
        return false;
    }

}