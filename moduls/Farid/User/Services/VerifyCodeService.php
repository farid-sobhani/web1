<?php


namespace Farid\User\Services;


class VerifyCodeService
{
    private static $min = 100000;
    private static $max = 999999;

    public static function generate(){
        return rand(self::$min,self::$max);
    }

    public static function store($id,$code)
    {
        cache()->set('verify_code_'.$id,$code,now()->addDay());

    }

    public static function get($id)
    {
        return cache()->get('verify_code_'.$id);
    }

    public static function delete($id){
        cache()->delete('verify_code_'.$id);
    }

    public static function getRule(){
        return 'required|numeric|between:' . self::$min . ',' . self::$max;
    }
    public static function check($id,$code){


        if (self::get($id) == $code) {
           // self::delete($id);
            return true;
        }
        return false;


    }

}
