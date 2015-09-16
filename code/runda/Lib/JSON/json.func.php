<?php
class Json{
    public static function makeJson($code,$message='',$data=array()){
        $res = array(
            "code" =>$code,
            "message" =>$message,
            "data" =>$data
        );
        return json_encode($res);
    }
    
    
    
    public static function makeJsonIncludeJson($code,$message='',$data=array()){
    	$data2 = json_encode($data);
    	
    	$res = array(
    			"code" =>$code,
    			"message" =>$message,
    			"data" =>$data2
    	);
    	return json_encode($res);
    }
}