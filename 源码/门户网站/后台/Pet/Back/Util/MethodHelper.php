<?php

class MethodHelper
{
    /*
     * 验证传递的参数是否存在
     * 正确返回true，如果参数没有或不是arr的话返回一句话，另：如果有没有存在的就返回那个参数不存在
     * */
    public static function check_parameter_request($arr, $method)
    {
        $flag = 0;
        //优先判断存在的数组长度是否大于0
        if (is_array($arr) > 0) {
            //循环计算存在数量，存在就+1，不存在就直接返回
            for ($i = 0; $i < count($arr); $i++) {
                if (array_key_exists($arr[$i], $method)) {
                    $flag++;
                } else {
                    return $arr[$i] . ' is not exist';
                }
            }
            //如果数量和存在数（$flag）相同就返回真
            if ($flag == count($arr)) {
                return true;
            }
        }
        return 'Not into the array!';
    }

    /*
     * 验证服务器参数规则是否正确
     * 返回值：正确返回true，否则返回false
     * */
    public static function check_parameter_rule($rules, $para)
    {
        $flag = 0;
        if (is_array($rules) && is_array($para)) {
            if (@count($rules) == @count($para)) {
                for ($i = 0; $i < count($rules); $i++) {
                    if (@preg_match($rules[$i], $para[$i])) {
                        $flag++;
                    } else {
                        return $para[$i] . ' is not right';
                    }
                }
                if ($flag == count($rules)) {
                    return true;
                }
            } else {
                return 'Not into the right array!';
            }
        }
        return 'Not into the array!';

    }

    private function getFirstCharter($str)
    {
        if (empty($str)) {
            return '';
        }
        $fchar = ord($str{0});
        if ($fchar >= ord('A') && $fchar <= ord('z')) return strtoupper($str{0});
        $s1 = iconv('UTF-8', 'gb2312', $str);
        $s2 = iconv('gb2312', 'UTF-8', $s1);
        $s = $s2 == $str ? $s1 : $str;
        $asc = ord($s{0}) * 256 + ord($s{1}) - 65536;
        if ($asc >= -20319 && $asc <= -20284) return 'A';
        if ($asc >= -20283 && $asc <= -19776) return 'B';
        if ($asc >= -19775 && $asc <= -19219) return 'C';
        if ($asc >= -19218 && $asc <= -18711) return 'D';
        if ($asc >= -18710 && $asc <= -18527) return 'E';
        if ($asc >= -18526 && $asc <= -18240) return 'F';
        if ($asc >= -18239 && $asc <= -17923) return 'G';
        if ($asc >= -17922 && $asc <= -17418) return 'H';
        if ($asc >= -17417 && $asc <= -16475) return 'J';
        if ($asc >= -16474 && $asc <= -16213) return 'K';
        if ($asc >= -16212 && $asc <= -15641) return 'L';
        if ($asc >= -15640 && $asc <= -15166) return 'M';
        if ($asc >= -15165 && $asc <= -14923) return 'N';
        if ($asc >= -14922 && $asc <= -14915) return 'O';
        if ($asc >= -14914 && $asc <= -14631) return 'P';
        if ($asc >= -14630 && $asc <= -14150) return 'Q';
        if ($asc >= -14149 && $asc <= -14091) return 'R';
        if ($asc >= -14090 && $asc <= -13319) return 'S';
        if ($asc >= -13318 && $asc <= -12839) return 'T';
        if ($asc >= -12838 && $asc <= -12557) return 'W';
        if ($asc >= -12556 && $asc <= -11848) return 'X';
        if ($asc >= -11847 && $asc <= -11056) return 'Y';
        if ($asc >= -11055 && $asc <= -10247) return 'Z';
        return null;
    }

    /*
     * 获取中文名字转换为首字母英文大写
     * */
    public static function getHeadChar($name)
    {
        $py = '';
        $arr = [];
        for ($i = 0; $i < mb_strlen($name); $i++) {
            $arr[] = mb_substr($name, $i, 1, 'utf-8');
        }

        print_r($arr);
        for ($i = 0; $i < count($arr); $i++) {
            $py .= self::getFirstCharter($arr[$i]);

        }
        return $py;
    }
}