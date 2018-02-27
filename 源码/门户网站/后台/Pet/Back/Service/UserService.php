<?php
require "../Impl/UserInterface.php";
require "../Util/DBHelper.php";
require "../Modal/UserInfo.php";

class UserService implements UserInterface
{
    /*
     * 登录用户
     * */
    public function userLogin($loginname, $password)
    {
        $sql = "SELECT t1.`Id` AS Id,t1.`LoginName` AS LoginName,t1.`Password` AS `Password`,t1.`State`AS `State`," .
            " t2.`TrueName` AS TrueName, t2.Address AS Address,t2.CardId AS CardId,t2.Phone AS Phone, t2.Sex AS Sex" .
            " FROM users t1" .
            " INNER JOIN userdetils t2 ON t1.`Id` = t2.`Id`" .
            " WHERE (`LoginName`='{$loginname}'  AND `Password`='{$password}') OR (`Phone`='{$loginname}' AND `Password`='{$password}');";
        $res = DBHelper::executeQuery($sql);
        $list = [];
        if (count($res) > 0) {
            $list[] = [
                "Id" => $res[0][0],
                "LoginName" => $res[0][1],
                "Password" => $res[0][2],
                "State" => $res[0][3],
                "TrueName" => $res[0][4],
                "Address" => $res[0][5],
                "CardId" => $res[0][6],
                "Phone" => $res[0][7],
                "Sex" => $res[0][8]
            ];
            return $list;
        }
        return false;
    }

    /*
     * 获取所有用户信息
     * */
    public function getAllUser()
    {
        return [];
    }

    /*
     * 通过id获取单个用户信息
     * */
    public function getUerById($id)
    {
        $sql = "SELECT t1.`Id` AS Id,t1.`LoginName` AS LoginName,t1.`Password` AS `Password`,t1.`State`AS `State`," .
            " t2.`TrueName` AS TrueName, t2.Address AS Address,t2.CardId AS CardId,t2.Phone AS Phone, t2.Sex AS Sex" .
            " FROM users t1" .
            " INNER JOIN userdetils t2 ON t1.`Id` = t2.`Id`" .
            " WHERE t1.`Id`='{$id}';";
        $res = DBHelper::executeQuery($sql);
        $list = [];
        if (!is_bool($res)) {
            $list[] = [
                "Id" => $res[0][0],
                "LoginName" => $res[0][1],
                "Password" => $res[0][2],
                "State" => $res[0][3],
                "TrueName" => $res[0][4],
                "Address" => $res[0][5],
                "CardId" => $res[0][6],
                "Phone" => $res[0][7],
                "Sex" => $res[0][8]
            ];
            return $list;
        }
        return false;
    }

    /*
     * 注册&添加用户
     * */
    public function addUser($loginname, $password, $phone)
    {
        $sql = "INSERT INTO users(`Id`,`Password`,`LoginName`,`State`)VALUES(UUID(),'{$password}','{$loginname}',1);";
        $sql2 = "SELECT Id FROM users WHERE `LoginName`='{$loginname}' AND `Password`='{$password}';";

        $res = DBHelper::executeNonQuery($sql);
        if (!is_bool($res)) {
            $id = DBHelper::executeQuery($sql2)[0][0];
            $sql3 = "INSERT INTO userdetils(`Id`,`Phone`,`Address`,`TrueName`,`CardId`,`Sex`)VALUES('{$id}','{$phone}','','','','男');";
            $result = DBHelper::executeNonQuery($sql3);
            if (!is_bool($result)) {
                return $result;
            }
            return false;
        }
        return false;
    }

    /*
     * 编辑用户详细信息
     * */
    public function editUser($id, $address, $truename, $cardid, $sex, $phone)
    {
        $sql = "UPDATE userdetils SET `Address`='{$address}',`TrueName`='{$truename}',`CardId`='{$cardid}',`Sex`='{$sex}',`Phone`='{$phone}' WHERE `Id`='{$id}'";
        $res = DBHelper::executeNonQuery($sql);
        if (!is_bool($res)) {
            return $res;
        }
        return false;
    }

    /*
     * 修改密码
     * */
    public function editUserPassword($id, $newpassword, $oldpassword)
    {
        if ($newpassword != $oldpassword) {
            $sql = "UPDATE users SET `Password`='{$newpassword}' WHERE `Id`='{$id}' AND `Password`='{$oldpassword}'";
            $res = DBHelper::executeNonQuery($sql);
            if (!is_bool($res)) {
                return $res;
            }
            return false;
        }
        return -1;
    }

    /*
     * 禁用用户
     * */
    public function banUserById($id)
    {

    }
}