<?php
require_once ROOT_PATH . "/Impl/UserInterface.php";
require_once ROOT_PATH . "/Util/DBHelper.php";

class PetService
{
    /*
     * 通过主人id获取宠物信息
     * */
    public function getPets($searchMes = "", $startIndex = 0, $pageSize = 3)
    {
        $sql1 = " SELECT t1.id,t1.name,t2.`Name` as CategoryName,t1.sex,t1.Age,t2.`Id` as cateId,t3.LoginName as userName  FROM pets t1
              INNER JOIN petcategories t2 ON t1.CategoryId=t2.Id
              INNER JOIN users t3 ON t1.UserId=t3.Id";
        $sql2 = "select count(1) from pets where 1=1";
        if ($searchMes != "") {
            $sql1 .= " and t1.name like '%{$searchMes}%'";
            $sql2 .= " and t1.name like '%{$searchMes}%'";
        }
        $sql1 .= " limit {$startIndex} , {$pageSize};";
        $sql = $sql1 . $sql2;
        $res = DBHelper::executeMultiQuery($sql);

        $list = null;
        if (!is_bool($res)) {
            if (count($res) > 0) {
                $pets = [];
                foreach ($res[0] as $item) {
                    $pets[] = [
                        "Id" => $item[0],
                        "Name" => $item[1],
                        "CateName" => $item[2],
                        "Sex" => $item[3],
                        "Age" => $item[4],
                        "cateId" => $item[5],
                        "userName" => $item[6],
                    ];
                }
                $list["petsList"] = $pets;

                // 重组第二个结果
                $list["totalRows"] = $res[1][0][0];

            }
            return $list;

        }
        return false;
    }

    public function getPetsById($id)
    {
        $sql = " SELECT t1.id,t1.name,t2.`Name` as CategoryName,t1.sex,t1.Age,t2.`Id` as cateId,t3.LoginName as userName  FROM pets t1
              INNER JOIN petcategories t2 ON t1.CategoryId=t2.Id
              INNER JOIN users t3 ON t1.UserId=t3.Id where 1=1 and t1.id='{$id}'";
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
                    $arr[$i]['userName'] = $res[$i]['6'];
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