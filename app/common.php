<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件
function test(){
    if (func_num_args() < 0) {
        echo '';
        exit;
    }
    foreach (func_get_args() as $item) {
        echo '<pre>';
        print_r($item);
        echo '</pre>';
    }
    exit;
}

//返回值定义
function return_value($status=1,$msg='',$data=array()){
    return array('status'=>$status,'msg'=>$msg,'data'=>$data);
}

//去除字符串中的空格
function trim_space($params)
{
    if (is_array($params)) {
        foreach ($params as $k=>$v) {
            if (is_array($v)) {
                $params[$k] = trim_space($v);
            } else if (is_string($v)) {
                $params[$k] = trim($v);
            } else {
                $params[$k] = $v;
            }
        }
    } else if (is_string($params)) {
        $params = trim($params);
    }
    return $params;
}

//获取提交数据
function get_request()
{
    return array_merge(request()->post(),request()->get());
}

//加密密码
function encryption_pwd($pwd)
{
    $salt = 'tp_app';
    return md5($salt.$pwd);
}