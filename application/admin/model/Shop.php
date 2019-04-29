<?php

namespace app\admin\model;

use think\Model;

class Shop extends Model
{
    // 表名
    protected $name = 'shop';
    
    // 自动写入时间戳字段
    protected $autoWriteTimestamp = false;

    // 定义时间戳字段名
    protected $createTime = false;
    protected $updateTime = false;
    
    // 追加属性
    protected $append = [
        'is_receiving_text',
        'status_text',
        'showdata_text',
        'is_bestdata_text'
    ];
    

    
    public function getIsReceivingList()
    {
        return ['0' => __('Is_receiving 0'),'1' => __('Is_receiving 1')];
    }     

    public function getStatusList()
    {
        return ['0' => __('Status 0'),'1' => __('Status 1')];
    }     

    public function getShowdataList()
    {
        return ['0' => __('Showdata 0'),'1' => __('Showdata 1')];
    }     

    public function getIsBestdataList()
    {
        return ['0' => __('Is_bestdata 0'),'1' => __('Is_bestdata 1')];
    }     



    public function getIsReceivingTextAttr($value, $data)
    {        
        $value = $value ? $value : (isset($data['is_receiving']) ? $data['is_receiving'] : '');
        $list = $this->getIsReceivingList();
        return isset($list[$value]) ? $list[$value] : '';
    }


    public function getStatusTextAttr($value, $data)
    {        
        $value = $value ? $value : (isset($data['status']) ? $data['status'] : '');
        $list = $this->getStatusList();
        return isset($list[$value]) ? $list[$value] : '';
    }


    public function getShowdataTextAttr($value, $data)
    {        
        $value = $value ? $value : (isset($data['showdata']) ? $data['showdata'] : '');
        $list = $this->getShowdataList();
        return isset($list[$value]) ? $list[$value] : '';
    }


    public function getIsBestdataTextAttr($value, $data)
    {        
        $value = $value ? $value : (isset($data['is_bestdata']) ? $data['is_bestdata'] : '');
        $list = $this->getIsBestdataList();
        return isset($list[$value]) ? $list[$value] : '';
    }


    public function shopUser()
    {
        return $this->hasOne('ShopUser', 'shop_id', 'id', [], 'LEFT')->setEagerlyType(0);
    }

    public function shopClassify()
    {
        return $this->belongsTo('ShopClassify', 'classify_id', 'id', [], 'LEFT')->setEagerlyType(0);
    }
}
