<?php
    include 'define.php';
    function executeNonQuery($sql)
    {
        $link = new mysqli(DB_LOCAL,DB_HOST,DB_PASSWORD,DB_TABLE);
        if($link -> connect_errno)
        {
            return false;
        }

        $result = $link -> query($sql);
        if($result)
        {
            $val = $link -> affected_rows;
            $link -> close();
            return $val;
        }
        else
        {
            $link -> close();
            return false;
        }
    }

// 执行DQL

    function executeQuery($sql)
    {
        $link = new mysqli(DB_LOCAL,DB_HOST,DB_PASSWORD,DB_TABLE);
        if($link -> connect_errno)
        {
            return false;
        }

        $result = $link -> query($sql);

        if($result)
        {
            $list = [];
            if($result -> num_rows > 0)
            {
                while($row = $result -> fetch_assoc())
                {
                    $list[] = $row;
                }
            }
            $result -> close();
            $link -> close();
            return $list;
        }
        else
        {
            $link -> close();
            return false;
        }

    }

    // 执行批量查询
    function executeMultiQuery($sql){
        $link = new mysqli(DB_LOCAL,DB_HOST,DB_PASSWORD,DB_TABLE);
        if($link -> connect_errno){
            return null;
        }
        $list = null;
        $result = $link -> multi_query($sql);

        if($result){
            $list = [];

            do{
                $item = null;

                $rs = $link -> store_result();
                
                if($rs){
                    $item = [];
                    while($row = $rs -> fetch_assoc()){
                        $item[] = $row;
                    }   

                    $rs -> close();     
                }
                $list[] = $item;
            }while($link -> more_results() && $link -> next_result());

        }
        
        $link -> close();
        return $list;
    }
