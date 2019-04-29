<?php

namespace app\api\controller;

use app\common\controller\Api;
use app\common\library\Ems;
use app\common\library\Sms;
use fast\Random;
use think\Validate;
use think\Db;

/**
 * 会员接口
 */
class Me extends Api
{

    protected $noNeedLogin = '*';
    protected $noNeedRight = '*';

    public function _initialize()
    {
        parent::_initialize();
        $this->model = new \app\common\model\Me;
    }

    public function index(){
        $uid = $this->request->request('uid');
        
        $user = $this->getUserInfo($uid);
        $arr = array(
                'user' => $this->getUserInfo($uid),
                'orderStatus' => $this->getOrderNum($uid)
            );
        $this->success('加载成功',$arr);
    }

    public function meinfo(){
        $uid = $this->request->request('uid');

        $this->success('加载成功', $this->getUserInfo($uid));   
    }

    function getUserInfo($uid){
        $arr = $this->model->where('id',$uid)->find();
        if ($arr['parent_id']) {
            $arr['parent'] = model('WechatUser')->where('user_id',$arr['parent_id'])->value('nickname');
        }
        

        return $arr;
    }

    function getOrderNum($uid){
        $order = array();
        
        // 未付款
        $order['no_pay'] = model('Orders')
                            ->where('user_id',$uid)
                            ->where('order_status',0)
                            ->where('pay_status',0)
                            ->count();

        // 未发货
        $order['no_shipping'] = model('Orders')
                            ->where('user_id',$uid)
                            ->where('order_status',1)
                            ->where('pay_status',1)
                            ->where('shipping_status',0)
                            ->count();
        
        // 未收货
        $order['ok_shipping'] = model('Orders')
                            ->where('user_id',$uid)
                            ->where('order_status',1)
                            ->where('pay_status',1)
                            ->where('shipping_status',1)
                            ->count();

        return $order;
    }

}
