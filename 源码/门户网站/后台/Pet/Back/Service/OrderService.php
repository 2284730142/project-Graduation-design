<?php
require "../Impl/OrderInterface.php";
require "../Util/DBHelper.php";

class OrderService implements OrderInterface
{
    /*
     * 获取所有订单信息
     * */
    public function getAllOrder()
    {

    }

    /*
     * 获取个人订单信息
     * */
    public function getOneOrder($id)
    {
        $sql = " SELECT t1.`Id` AS Id ,t1.`Message` AS Message ,t2.`Name` AS MenuName ,t3.`Name` AS PetName ,t1.`State` AS State ," .
            " t1.`Date` AS Date ,t2.`Price` AS Price ,t4.`Name` AS PetCategory,t5.Name AS Menus" .
            " FROM orders t1 INNER JOIN menudetail t2 ON t1.`MenuId`=t2.`Id`" .
            " INNER JOIN pets t3 ON t1.`PetId`=t3.`Id`" .
            " INNER JOIN petcategories t4 ON t3.`CategoryId` = t4.`Id`" .
            "INNER JOIN menus t5 ON t5.Id=t2.MenuId" .
            " WHERE t1.UserId='{$id}' ORDER BY t1.`State` DESC, t1.`Date` DESC";
        $res = DBHelper::executeQuery($sql);
        $list = [];
        if (!is_bool($res)) {
            for ($i = 0; $i < count($res); $i++) {
                $list[] = [
                    "Id" => $res[$i][0],
                    "Message" => $res[$i][1],
                    "MenuName" => $res[$i][2],
                    "PetName" => $res[$i][3],
                    "State" => $res[$i][4],
                    "Date" => $res[$i][5],
                    "Price" => $res[$i][6],
                    "PetCategory" => $res[$i][7],
                    "Menus" => $res[$i][8]
                ];
            }
            return $list;
        }
        return false;
    }

    /*
     * 通过order的id取消个人订单
     * $id是用户id
     * */
    public function changeOneOrder($id, $orderid)
    {
        $sql = "UPDATE orders SET State='3' WHERE `Id`='{$orderid}' AND `UserId`='{$id}'";
        $res = DBHelper::executeNonQuery($sql);
        if (!is_bool($res)) {
            return $res;
        }
        return false;
    }

    /*
     * 改变订单状态
     * */
    public function changeOrderSate($id)
    {

    }

    /*
     * 用户新建订单接口
     * */
    public function createOrder($userid, $message, $menuid, $petid, $date)
    {
        $sql = "INSERT INTO orders (`Id`,`Message`,`UserId`,`MenuId`,`PetId`,`State`,`Date`) " .
            " VALUES (UUID(),'{$message}','{$userid}','{$menuid}','{$petid}','0','{$date}');";
        $res = DBHelper::executeNonQuery($sql);
        if (!is_bool($res)){
            return $res;
        }
        return false;
    }
}