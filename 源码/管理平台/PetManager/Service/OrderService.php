<?php
require_once ROOT_PATH."Impl/OrderInterface.php";
require_once ROOT_PATH."Util/DBHelper.php";

class OrderService implements OrderInterface
{
    /*
     * 获取所有订单信息
     * */
    public function getAllOrder($searchMes="",$menu=5,$state=5,$startIndex =0 ,$pageSize = 5)
    {

        $sql1="SELECT t1.Id Id,t4.`Name` MenuName,t3.TrueName UserName,t3.Phone Phone,
              t5.`Name` PetName,t6.`Name` PetCate,t1.Date Date,t1.Message Message,t1.State State
              FROM orders t1
              INNER JOIN users t2 ON t1.UserId=t2.Id
              INNER JOIN userdetils t3 ON t2.Id=t3.Id
              INNER JOIN menudetail t4 ON t1.MenuId=t4.Id
              INNER JOIN pets t5 ON t1.PetId=t5.Id
              INNER JOIN petcategories t6 ON t5.CategoryId=t6.Id WHERE 1=1";
        $sql2 = "select count(1) as num
              FROM orders t1
              INNER JOIN users t2 ON t1.UserId=t2.Id
              INNER JOIN userdetils t3 ON t2.Id=t3.Id
              INNER JOIN menudetail t4 ON t1.MenuId=t4.Id
              INNER JOIN pets t5 ON t1.PetId=t5.Id
              INNER JOIN petcategories t6 ON t5.CategoryId=t6.Id WHERE 1=1";
        if ($searchMes!="")
        {
            $sql1.=" and t3.TrueName like '%{$searchMes}%'";
            $sql2.=" and t3.TrueName like '%{$searchMes}%'";
        }

        if ($menu!=5)
        {
            $sql1.=" and t1.MenuId='{$menu}'";
            $sql2.=" and t1.MenuId='{$menu}'";
        }

        if ($state!=5)
        {
            $sql1.=" and t1.State='{$state}'";
            $sql2.=" and t1.State='{$state}'";
        }
        $sql1.=" ORDER BY t1.State DESC";
        $sql1.=" limit {$startIndex},{$pageSize};";
        $sql=$sql1.$sql2;
        $res = DBHelper::executeMultiQuery($sql);
        $list=[];
        if(!is_null($res))
        {
            // 重组第一个结果

            for ($i=0;$i<count($res[0]);$i++)
            {
                $item=$res[0];
                $list[]=[
                    "Id"=>$item[$i][0],
                    "MenuName"=>$item[$i][1],
                    "UserName"=>$item[$i][2],
                    "Phone"=>$item[$i][3],
                    "PetName"=>$item[$i][4],
                    "PetCate"=>$item[$i][5],
                    "Date"=>$item[$i][6],
                    "Message"=>$item[$i][7],
                    "State"=>$item[$i][8]
                ];
            }
            $result["orderList"] = $list;
            // 重组第二个结果
            $result["totalRows"] = $res[1][0][0];

            return $result;
        }
        return false;
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
    public function changeOrderSate($id,$state)
    {
        if ($state==0)
        {
            $sql="UPDATE orders SET State='1' WHERE Id='{$id}'";
        }
        elseif($state==1)
        {
            $sql="UPDATE orders SET State='2' WHERE Id='{$id}'";
        }
        else
        {
            return null;
        }
        $res=DBHelper::executeNonQuery($sql);
        if (!is_bool($res))
        {
            return $res;
        }
        return false;
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
//$a = new OrderService();
//$res = $a->getAllOrder();
//var_dump($res);