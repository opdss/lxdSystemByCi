<?php
/**
 * Created by PhpStorm.
 * @author wuxin
 * @date 2015 15/5/9 下午1:13
 * @copyright 7659.com
 */
class MY_Model extends CI_Model{

    public function __construct(){
        parent::__construct();
    }
    //根据数组平接where串
    protected function getWhereStr($data,$t='and'){
        if(is_array($data) && !empty($data)){
            $str = $and = '';
            foreach($data as $k=>$v){
                $str .= $and.' `'.$k.'`="'.$v.'" ';
                $and = $t;
            }
            return $str;
        }
        return (string)$data;
    }

}