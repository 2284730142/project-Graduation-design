<?php

interface PetCategoryInterface
{
    /*
     * 获取所有宠物类别信息
     * */
    public function getAllPetCategory();

    /*
     * 添加新宠物类别
     * */
    public function addPet($name);

    /*
     * 通过id删除宠物类别
     * */
    public function deletePetById($id);

}