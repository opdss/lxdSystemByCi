<?php
/**
 * Created by PhpStorm.
 * @author wuxin
 * @date 2015 15/5/17 下午7:57
 * @copyright 7659.com
 */
class Process{

    private $CI;
    public $errProcess=null;
    public $sucProcess=null;

    public function __construct(){
        $this->CI =& get_instance();
    }
    //表单post 过来的工序组装插入
    public function createProcess(array $process){
        if(empty($process)){
            return false;
        }
        $data = array();
        foreach($process['process_name'] as $k=>$v){
            $data[$k]['process_desc'] = isset($process['process_desc']) ? trim($process['process_desc'][$k]) : '';
            $data[$k]['process_name'] = trim($v);
            $data[$k]['process_price'] = (float)$process['process_price'][$k];
            if(empty($data[$k]['process_name']) || $data[$k]['process_price']<=0){
                $this->errProcess[] = $k+1;
                continue;
            }
            $data[$k]['create_time'] = TIMESTAMP;
            $data[$k]['sign'] = md5($data[$k]['process_name'].$data[$k]['process_price']);
            $data[$k]['process_isdel'] = 0;
            if(!$process_id = $this->addProcess($data[$k])) {
                $this->errProcess[] = $k + 1;
            }else{
                $this->sucProcess[] = $process_id;
            }
        }
        return count($process);
    }
    //插入工序
    public function addProcess(array $process){
        $this->CI->load->model('process_model');
        $where = "sign='".$process['sign']."'";
        $info = $this->CI->process_model->getRow($where);
        if(empty($info)){
            return $this->CI->process_model->add($process);
        }else{
            return ($info['process_isdel']==0 || $this->process_model->edit($info['id'],array('process_isdel'=>0,'process_desc'=>$process['process_desc']))) ? $info['id'] : 0;
        }
    }
    //工序跟订单关联插入表并且
}