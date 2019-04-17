<?php

namespace app\admin\model;
use think\Model;

class User extends Model
{
    //不存在字段自动过滤
    protected $field = true;
    //自动更新时间
    protected $autoWriteTimestamp = 'datetime';

    //添加用户
    public function addUser($insert)
    {
        $insert = $this->deal_with_pwd($insert);
        if ($this->where(array('name'=>$insert['name']))->find()) {
            return return_value(-1,$insert['name'].' 已经存在');
        }
        if (!$this->allowField(true)->save($insert)) {
            return return_value(-1,'添加失败');
        }
        return return_value(1,'添加成功');
    }

    //对密码字段进行处理
    public function deal_with_pwd($params)
    {
        if (isset($params['pwd']) && !empty($params['pwd'])) {
            $params['pwd'] = encryption_pwd($params['pwd']);
        } else {
            unset($params['pwd']);
        }
        return $params;
    }

    //返回性别值
    protected function getGenderNameAttr($value,$data)
    {
        return empty($data['gender']) ? '保密' : ($data['gender'] == 1 ?'男':'女');
    }

    //获取列表
    public function get_list($params=array(),$page=1)
    {
        $where = array();
        $params = trim_space($params);
        if (!empty($params)) {
            if (isset($params) && !empty($params['start_time'])) {
                $where[] = array('create_time','>=',$params['start_time'].' 00:00:00');
            }
            if (isset($params) && !empty($params['end_time'])) {
                $where[] = array('create_time','<=',$params['end_time'].' 23:59:59');
            }
            if (isset($params) && !empty($params['name'])) {
                $where[] = array('name','like',"%{$params['name']}%");
            }
            if (isset($params['status'])) {
                $where[] = array('status','=',$params['status']);
            }
        }
        $that = $where ? $this->where($where) : $this;
        $res = $that->order('id desc')->paginate(10,false,array('page'=>$page))->each(function($item, $key){
            if (1) {

            }
        })->append(['gender_name'])->toArray();
        if (isset($res['data']) && empty($res['data'])) {
            //当前页数没有数据 默认取第一页
            $res = $that->paginate(10,false,array('page'=>1))->each(function($item, $key){
                if (1) {

                }
            })->append(['gender_name'])->toArray();
        }
        return $res;
    }

    //更新一条数目
    public function update_item($item,$where)
    {
        if (isset($item['name'])) {
            if ($this->get_item(array(
                array('name','=',$item['name']),
                array('id','<>',$where['id'])
            ))) {
                return return_value(-1,$item['name'].'已经存在');
            }
        }
        if (isset($item['province']) && isset($item['city']) && isset($item['area']) && isset($item['detail'])) {
            $item['address'] = $item['province'].' '.$item['city'].' '.$item['area'].' '.$item['detail'];
        }
        $item = $this->deal_with_pwd($item);
        if (isset($item['id'])) unset($item['id']);
        if ($this->save($item,$where)) {
            return return_value(1,'操作成功');
        }
    }

    //查找一条数据
    public function get_item($where)
    {
        $res = $this->where($where)->find();
        if (!empty($res)) {
            $res = $res->toArray();
        }
        if (!empty($res)) {
            $address_list = explode(' ',$res['address']);
            $res['province'] = isset($address_list[0]) ? $address_list[0] :'';
            $res['city'] = isset($address_list[1]) ? $address_list[1] :'';
            $res['area'] = isset($address_list[2]) ? $address_list[2] :'';
            $res['detail'] = isset($address_list[3]) ? $address_list[3] :'';
        }
        return $res;
    }
}

