<?php

interface PetInterface
{
    /*
     * 通过主人id获取宠物信息
     * */
    public function getPets($userId);
    /*
     * 添加以新宠物
     * */
    public function addPet($name, $categoryid, $sex, $age, $userid);
    /*
     * 编辑新宠物
     * */
    public function editPet($id,$name, $categoryid, $sex, $age);
    /*
     * 通过id删除宠物信息
     * */
    public function deletePetById($id);

}