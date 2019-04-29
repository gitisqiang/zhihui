<?php

namespace app\admin\model;

use think\Model;

class ShopUser extends Model
{
    // 表名
    protected $name = 'shop_user';
    
    // 自动写入时间戳字段
    protected $autoWriteTimestamp = 'int';

    // 定义时间戳字段名
    protected $createTime = 'createtime';
    protected $updateTime = false;
    
    // 追加属性
    protected $append = [
        'statusdata_text'
    ];
    

    
    public function getStatusdataList()
    {
        return ['0' => __('Statusdata 0'),'1' => __('Statusdata 1')];
    }     


    public function getStatusdataTextAttr($value, $data)
    {        
        $value = $value ? $value : (isset($data['statusdata']) ? $data['statusdata'] : '');
        $list = $this->getStatusdataList();
        return isset($list[$value]) ? $list[$value] : '';
    }




    public function shop()
    {
        return $this->belongsTo('Shop', 'shop_id', 'id', [], 'LEFT')->setEagerlyType(0);
    }
}
