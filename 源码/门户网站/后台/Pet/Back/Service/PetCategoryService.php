<?php
require "../Impl/UserInterface.php";
require "../Util/DBHelper.php";

class PetCategoryService
{
    /*
     * 获取所有宠物类别信息
     * */
    public function getAllPetCategory()
    {
        $sql = "SELECT Id,Name FROM petcategories;";
        $res = DBHelper::executeQuery($sql);
        if (!is_bool($res))
        {
            for ($i=0; $i < count($res) ; $i++)
            {
                $arr[$i]['Id']=$res[$i]['0'];
                $arr[$i]['Name']=$res[$i]['1'];
            }
            return $arr;
        }
        return false;
    }

    /*
     * 添加新宠物类别
     * */
    public function addPet($name)
    {
        $sql="INSERT INTO petcategories(Id,Name) VALUES(uuid(),'{$name}');";
        $res=DBHelper::executeNonQuery($sql);
        return $res;
    }

    /*
     * 通过id删除宠物类别
     * */
    public function deletePetById($id)
    {
        $sql="DELETE FROM petcategories WHERE id='{$id}'";
        $res=DBHelper::executeNonQuery($sql);
        return $res;
    }
}