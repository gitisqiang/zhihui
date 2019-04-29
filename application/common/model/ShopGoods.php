<?php

namespace app\common\model;

use think\Model;

class ShopGoods extends Model
{
    // 表名
    protected $name = 'shop_goods';
    
    // 自动写入时间戳字段
    protected $autoWriteTimestamp = 'int';

    // 定义时间戳字段名
    protected $createTime = 'createtime';
    protected $updateTime = false;
    
    // 追加属性
    protected $append = [
        'show_text',
        'is_new_text',
        'hot_text',
    ];
    

    
    public function getShowList()
    {
        return ['0' => __('Show 0'),'1' => __('Show 1')];
    }     

    public function getIsNewList()
    {
        return ['0' => __('Is_new 0'),'1' => __('Is_new 1')];
    }     

    public function getHotList()
    {
        return ['0' => __('Hot 0'),'1' => __('Hot 1')];
    }     


    public function getShowTextAttr($value, $data)
    {        
        $value = $value ? $value : (isset($data['show']) ? $data['show'] : '');
        $list = $this->getShowList();
        return isset($list[$value]) ? $list[$value] : '';
    }


    public function getIsNewTextAttr($value, $data)
    {        
        $value = $value ? $value : (isset($data['is_new']) ? $data['is_new'] : '');
        $list = $this->getIsNewList();
        return isset($list[$value]) ? $list[$value] : '';
    }


    public function getHotTextAttr($value, $data)
    {        
        $value = $value ? $value : (isset($data['hot']) ? $data['hot'] : '');
        $list = $this->getHotList();
        return isset($list[$value]) ? $list[$value] : '';
    }




    public function shopGoodsClassify()
    {
        return $this->belongsTo('ShopGoodsClassify', 'classify_id', 'id', [], 'LEFT')->setEagerlyType(0);
    }

}
