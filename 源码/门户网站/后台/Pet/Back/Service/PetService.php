<?php
require "../Impl/UserInterface.php";
require "../Util/DBHelper.php";

class PetService
{
    /*
     * 通过主人id获取宠物信息
     * */
    public function getPets($userId)
    {
        $sql = "SELECT t1.id,t1.name,t2.`Name` as CategoryName,t1.sex,t1.Age,t2.`Id` as cateId FROM pets t1
              INNER JOIN petcategories t2 ON t1.CategoryId=t2.Id
              INNER JOIN users t3 ON t1.UserId=t3.Id WHERE t1.userId='{$userId}';";
        $res = DBHelper::executeQuery($sql);
        if (!is_bool($res)) {
            if (count($res) > 0) {
                for ($i = 0; $i < count($res); $i++) {
                    $arr[$i]['Id'] = $res[$i]['0'];
                    $arr[$i]['Name'] = $res[$i]['1'];
                    $arr[$i]['CateName'] = $res[$i]['2'];
                    $arr[$i]['Sex'] = $res[$i]['3'];
                    $arr[$i]['Age'] = $res[$i]['4'];
                    $arr[$i]['cateId'] = $res[$i]['5'];
                }
                return $arr;
            }
            return false;
        }
        return false;
    }

    /*
     * 添加新宠物
     * */
    public function addPet($name, $categoryid, $sex, $age, $userid)
    {
        $sql = "INSERT INTO pets(id,name,categoryid,sex,age,userid)
              VALUES(UUID(),'{$name}',{$categoryid},'{$sex}',{$age},'{$userid}')";
        $res = DBHelper::executeNonQuery($sql);
        return $res;
    }

    /*
    * 编辑宠物
    * */
    public function editPet($id, $name, $categoryid, $sex, $age)
    {
        $sql = "UPDATE pets SET name='{$name}',categoryId={$categoryid},sex='{$sex}',age={$age}
              WHERE id='{$id}'";

        $res = DBHelper::executeNonQuery($sql);
        return $res;

    }

    /*
     * 通过id删除宠物信息
     * */
    public function deletePetById($id)
    {
        $sql = "DELETE FROM pets WHERE id='{$id}'";
        $res = DBHelper::executeNonQuery($sql);
        if (!is_bool($res)) {
            return $res;
        }
        return false;
    }
}