<?php

interface OrderInterface
{
    /*
     * 获取所有订单信息
     * */
    public function getAllOrder($searchMes,$menu,$state,$startIndex,$pageSize);

    /*
     * 获取个人订单信息
     * */
    public function getOneOrder($id);

    /*
     * 通过order的id取消个人订单
     * $id是用户id
     * */
    public function changeOneOrder($id, $orderid);

    /*
     * 修改订单状态（后台）
     * */
    public function changeOrderSate($id,$state);

    /*
     * 用户新建订单接口
     * */
    public function createOrder($userid, $message, $menuid, $petid, $date);
}