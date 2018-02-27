<?php

class DBHelper
{
    /*
     * 定义后台数据库及服务器常量
     * */
    const DB_HOST = "localhost";
    const DB_USER_NAME = "root";
    const DB_PASSWORD = "root";
    const DB_DATABASE_NAME = "petdb";

    /*
     * 执行增删改的方法
     * */
    public static function executeNonQuery($sql)
    {
        $con = new mysqli(self::DB_HOST, self::DB_USER_NAME, self::DB_PASSWORD, self::DB_DATABASE_NAME);
        if ($con->connect_errno) {
            return false;
        }

        $result = $con->query($sql);
        if ($result) {
            $val = $con->affected_rows;
            $con->close();
            return $val;
        } else {
            $con->close();
            return false;
        }
    }

    // 执行DQL
    /*
     * 执行查询的方法
     * */
    public static function executeQuery($sql)
    {
        $con = new mysqli(self::DB_HOST, self::DB_USER_NAME, self::DB_PASSWORD, self::DB_DATABASE_NAME);
        if ($con->connect_errno) {
            return false;
        }

        $result = $con->query($sql);

        if ($result) {
            $list = [];
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_row()) {
                    $list[] = $row;
                }
            }
            $result->close();
            $con->close();
            return $list;
        } else {
            $con->close();
            return false;
        }

    }


    // 执行批量查询
    /*
     * 执行多语句查询的方法
     * */
    public static function executeMultiQuery($sql)
    {
        $con = new mysqli(self::DB_HOST, self::DB_USER_NAME, self::DB_PASSWORD, self::DB_DATABASE_NAME);
        if ($con->connect_errno) {
            return null;
        }
        $list = null;
        $result = $con->multi_query($sql);

        if ($result) {
            $list = [];

            do {
                $item = null;

                $rs = $con->store_result();

                if ($rs) {
                    $item = [];
                    while ($row = $rs->fetch_row()) {
                        $item[] = $row;
                    }

                    $rs->close();
                }
                $list[] = $item;
            } while ($con->more_results() && $con->next_result());

        }

        $con->close();
        return $list;
    }
}