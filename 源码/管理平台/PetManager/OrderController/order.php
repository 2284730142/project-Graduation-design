<?php
    $id=$_GET['id'];
    $state=$_GET['state'];
    require_once ROOT_PATH."Service/OrderService.php";
    $order=new OrderService();
    $result=$order->changeOrderSate($id,$state);
    if(!is_bool($result) || $result==null)
    {
        header('location:../view/user/orders.php');
    }
    else
    {
        echo $result;
    }


