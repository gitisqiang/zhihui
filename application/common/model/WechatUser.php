<?php

namespace app\common\model;

use think\Model;

class WechatUser extends Model
{
    // 表名
    protected $name = 'wechat_user';
    
    // 自动写入时间戳字段
    protected $autoWriteTimestamp = 'int';

    // 定义时间戳字段名
    protected $createTime = 'createtime';
    protected $updateTime = false;
    
    // 追加属性
    protected $append = [
        'sexdata_text'
    ];
    

    
    public function getSexdataList()
    {
        return ['1' => __('Sexdata 1'),'2' => __('Sexdata 2')];
    }     


    public function getSexdataTextAttr($value, $data)
    {        
        $value = $value ? $value : (isset($data['sexdata']) ? $data['sexdata'] : '');
        $list = $this->getSexdataList();
        return isset($list[$value]) ? $list[$value] : '';
    }




}
