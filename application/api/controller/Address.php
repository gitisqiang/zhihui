<?php

namespace app\api\controller;

use app\common\controller\Api;
use app\common\library\Ems;
use app\common\library\Sms;
use fast\Random;
use think\Validate;

/**
 * 会员接口
 */
class Address extends Api
{

    protected $noNeedLogin = '*';
    protected $noNeedRight = '*';

    public function _initialize()
    {
        parent::_initialize();
        $this->model = new \app\common\model\UserAddress;
    }

    public function index(){
        $uid = $this->request->request('uid');
        
        $address = $this->getUserArea($uid);
        if (!empty($address)) {
        	$this->success('加载成功',$address);
        }else{
        	$this->error();
        }
        
    }

    public function add(){
        $arr1 = model('address')->where('parent_id',0)->select();
        
    }

    public function addpost(){
        $uid = $this->request->request('uid');
        $arr = $this->request->request('postdata');
        $arr = json_decode($arr,true);
        $arr['tag'] = $arr['tag'] == -1 ? 0 : $arr['tag'];
        $data = array(
                'user_id' => $uid,
                'name' => $arr['name'],
                'mobile' => $arr['mobile'],
                'province' => $arr['area'][0],
                'city' => $arr['area'][1],
                'district' => $arr['area'][2],
                'address' => $arr['address'],
                'tag' => $arr['tag'],
                'is_default' => $arr['is_default']
            );
        if ($arr['is_default'] == 1) {
            $def['is_default'] = 0;
            $this->model->where('user_id',$uid)->where('is_default',1)->update($def);
        }
        if($this->model->insert($data)){
            $this->success('添加成功');
        }
    }

    public function edit(){
        $uid = $this->request->request('uid');
        $id = $this->request->request('id');
        $arr = $this->model->where('id',$id)->where('user_id',$uid)->find();
        $this->success('获取成功',$arr);
    }

    public function editpost(){
        $uid = $this->request->request('uid');
        $id = $this->request->request('id');
        $arr = $this->request->request('postdata');
        $arr = json_decode($arr,true);
        $arr['tag'] = $arr['tag'] == -1 ? 0 : $arr['tag'];
        $data = array(
                'user_id' => $uid,
                'name' => $arr['name'],
                'mobile' => $arr['mobile'],
                'province' => $arr['area'][0],
                'city' => $arr['area'][1],
                'district' => $arr['area'][2],
                'address' => $arr['address'],
                'tag' => $arr['tag'],
                'is_default' => $arr['is_default']
            );
        if ($arr['is_default'] == 1) {
            $def['is_default'] = 0;
            $this->model->where('user_id',$uid)->where('is_default',1)->update($def);
        }
        if($this->model->where('id',$id)->update($data)){
            $this->success('修改成功');
        }
    }

    public function del(){
    	$uid = $this->request->request('uid');
    	$id = $this->request->request('id');
    	if ($this->model->where('id',$id)->where('user_id',$uid)->delete()) {
            $address = $this->getUserArea($uid);
    		$this->success('删除成功',$address);
    	}else{
    		$this->error('删除失败');
    	}
    }

    public function getUserAddress(){
    	$uid = $this->request->request('uid');
    	$arr = $this->model->where('user_id',$uid)->where('is_default',1)->find();
        if (!empty($arr)) {
        	$this->success('默认收货地址加载成功',$arr);
        }else{
        	$this->error('暂无默认收货地址');
        }
    }

    function getUserArea($uid){
    	$arr = $this->model->where('user_id',$uid)->select();
        
        return $arr;
    }


}
