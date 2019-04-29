<?php

namespace app\common\model;

use think\Model;

class ShopGoodsAttr extends Model
{
    // 表名
    protected $name = 'shop_goods_attr';
    
    // 自动写入时间戳字段
    protected $autoWriteTimestamp = false;

    // 定义时间戳字段名
    protected $createTime = false;
    protected $updateTime = false;
    
    // 追加属性
    protected $append = [

    ];
    

    







    public function attr()
    {
        return $this->belongsTo('Attr', 'attr_id', 'id', [], 'LEFT')->setEagerlyType(0);
    }
}
