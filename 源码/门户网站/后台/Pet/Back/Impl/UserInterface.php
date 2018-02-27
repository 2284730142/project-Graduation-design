<?php

interface UserInterface
{
    /*
     * 登录用户
     * */
    public function userLogin($loginname, $password);

    /*
     * 获取所有用户信息
     * */
    public function getAllUser();

    /*
     * 通过id获取单个用户信息
     * */
    public function getUerById($id);

    /*
     * 注册添加用户
     * */
    public function addUser($loginname, $password, $phone);

    /*
     * 编辑用户详细信息
     * */
    public function editUser($id, $address, $truename, $cardid, $sex, $phone);

    /*
     * 修改密码
     * */
    public function editUserPassword($id, $newpassword, $oldpassword);

    /*
     * 禁用用户
     * */
    public function banUserById($id);

}