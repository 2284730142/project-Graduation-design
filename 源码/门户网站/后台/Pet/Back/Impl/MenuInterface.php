<?php

interface MenuInterface
{
    /*
     * 获取所有菜单
     * */
    public function getAllMenu();

    /*
     * 通过id获取菜单
     * */
    public function getMenuDetail($id);

    /*
     * 通过id获取子菜单
     */
    public function getMenuDetailById($id);

    /*
     * 删除子菜单
     */
    public function deleteMenuById($id);
    /*
     *编辑子菜单
     */
    public function editMenuDetail($id,$name,$menuId,$price,$image,$content);
    /*
     * 添加菜单的子菜单项
     * */
    public function addMenuDetail($name,$menuId, $price,$image,$content);

    /*
     * 用户创建订单时通过当前服务项目的id获取具体的服务项
     * */
    public function getServiceById($id);
}