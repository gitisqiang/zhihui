<?php

namespace app\common\model;

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
        'do_start_time_text',
        'is_receiving_text',
        'status_text',
        'showdata_text',
        'is_bestdata_text',
        'do_end_time_text'
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


    public function getDoStartTimeTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['do_start_time']) ? $data['do_start_time'] : '');
        return is_numeric($value) ? date("Y-m-d H:i:s", $value) : $value;
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


    public function getDoEndTimeTextAttr($value, $data)
    {
        $value = $value ? $value : (isset($data['do_end_time']) ? $data['do_end_time'] : '');
        return is_numeric($value) ? date("Y-m-d H:i:s", $value) : $value;
    }

    protected function setDoStartTimeAttr($value)
    {
        return $value && !is_numeric($value) ? strtotime($value) : $value;
    }

    protected function setDoEndTimeAttr($value)
    {
        return $value && !is_numeric($value) ? strtotime($value) : $value;
    }


}
