<?php

namespace app\common\model;

use think\Model;

class Orders extends Model
{
    // 表名
    protected $name = 'order_info';
    
    // 自动写入时间戳字段
    protected $autoWriteTimestamp = 'int';

    // 定义时间戳字段名
    protected $createTime = 'createtime';
    protected $updateTime = false;
    
    // 追加属性
    protected $append = [
        'pay_time_text',
        'shipping_time_text'
    ];

    public function getPayTimeTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['pay_time']) ? $data['pay_time'] : '');
        return is_numeric($value) ? date("Y-m-d H:i:s", $value) : $value;
    }


    public function getShippingTimeTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['shipping_time']) ? $data['shipping_time'] : '');
        return is_numeric($value) ? date("Y-m-d H:i:s", $value) : $value;
    }

    protected function setPayTimeAttr($value)
    {
        return $value && !is_numeric($value) ? strtotime($value) : $value;
    }

    protected function setShippingTimeAttr($value)
    {
        return $value && !is_numeric($value) ? strtotime($value) : $value;
    }

    public function getOrderList($tabcur,$uid){
        $where = array();
        if (empty($tabcur)) {
            
        }
        $arr = $this->field('id,order_status,shipping_status,pay_status,comment,goods_amount,createtime')
                    ->where($where)
                    ->select();
        foreach ($arr as $key => $val) {
            $num = model('order_goods')->where('order_id',$val['id'])->count();
            $goods = model('order_goods')->where('order_id',$val['id'])->find();
            $goods_img = model('shop_goods')->where('id',$goods['id'])->value('goodsimages');
            $arr[$key]['num'] = $num;
            $arr[$key]['goods_name'] = $goods['goods_name'];
            $arr[$key]['goods_number'] = $goods['goods_number'];
            $arr[$key]['goods_price'] = $goods['goods_price'];
            $arr[$key]['goods_attr'] = $goods['goods_attr'];
            $arr[$key]['goods_img'] = __ROOT__.$goods_img;
        }
        
        return $arr;
    }


}
