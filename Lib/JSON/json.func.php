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
}