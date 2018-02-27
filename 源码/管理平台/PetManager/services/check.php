<?php 
    function check($arr,$method)
    {
    	for ($i=0; $i < count($arr); $i++) 
    	{ 
    		if (!array_key_exists($arr[$i],$method)) 
    		{
    			return $arr[$i].'error';
    		}
    	}
    	return true;
    }