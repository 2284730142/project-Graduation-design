<?php
require_once('execute.php');
function getUser($name,$psw)
{
    $sql="select id,TrueName,password from manager where TrueName='{$name}' and password='{$psw}'";
    return executeQuery($sql);
}

function updatePsw($name,$oldPsw,$newPsw)
{

    $sql="update manager set Password='{$newPsw}' where TrueName='{$name}' and password='{$oldPsw}'";
    return executeNonQuery($sql);
}
function getManagerById($userId)
{
    $sql="select TrueName from manager where Id='{$userId}'";
    return executeQuery($sql);
}