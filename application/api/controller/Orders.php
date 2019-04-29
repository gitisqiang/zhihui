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
class Orders extends Api
{

    protected $noNeedLogin = '*';
    protected $noNeedRight = '*';

    public function _initialize()
    {
        parent::_initialize();
        $this->model = new \app\common\model\Orders;
    }

    public function index(){
        $uid = $this->request->request('uid');
        $tabcur = $this->request->request('tabcur');
        if (empty($tabcur)) {
            
        }
        
        $arr = $this->model->getOrderList($tabcur,$uid);

        $this->success(__('Sign up successful'), $arr);
    }

    public function done(){
    	$uid = $this->request->request('uid');
    	$ids = $this->request->request('ids');
    	$ids = explode(',', $ids);
    	$order = $this->request->request('order');
    	$order = json_decode($order,true);

    	// 生成订单号
    	$nowTime = time();
    	$order_sn = $this->foundOrderSn($nowTime);
    	//处理订单
    	$order_info = array(
    			'order_sn' => $order_sn,
    			'user_id' => $uid,
    			'order_status' => 0,
    			'shipping_status' => 0,
    			'pay_status' => 0,
    			'consignee' => $order['address']['name'],
    			'country' => '中国',
    			'province' => $order['address']['province'],
    			'city' => $order['address']['city'],
    			'district' => $order['address']['district'],
    			'address' => $order['address']['address'],
    			'mobile' => $order['address']['mobile'],
    			'postscript' => $order['postscript'],
    			'shipping_id' => $order['shipping_id'],
    			'shipping_name' => $order['shipping_name'],
    			'shipping_fee' => $order['shipping_fee'],
    			'pay_id' => 1,
    			'pay_name' => '微信支付',
    			'goods_amount' => $order['goods_amount'],
    			'money_paid' => 0,
    			'score' => $order['score'],
    			'order_amount' => $order['order_amount']
    		);
    	//插入订单
    	$order_id = $this->model->insertGetId($order_info);
    	

    	//处理订单商品
    	$order_goods = array();
    	foreach ($ids as $key => $val) {
    		$goods = Db::name('cart c')
	                ->field('c.*,g.goods_name,g.goods_sn')
	                ->join('shop_goods g','g.id = c.goods_id')
	                ->where('c.id',$val)
	                ->find();
    		$order_goods[$key]['order_id'] = $order_id;
    		$order_goods[$key]['goods_id'] = $goods['goods_id'];
    		$order_goods[$key]['goods_name'] = $goods['goods_name'];
    		$order_goods[$key]['goods_sn'] = $goods['goods_sn'];
    		$order_goods[$key]['goods_number'] = $goods['goods_num'];
    		$order_goods[$key]['goods_price'] = $goods['goods_price'];
    		$order_goods[$key]['goods_attr'] = $goods['goods_attr'];

    		//插入订单商品
    		Db::name('order_goods')->insert($order_goods[$key]);
    	}
		
		
		$this->success('订单已生成');
    }

    //随机生成订单号
    function foundOrderSn($nowTime = ''){
    	$sn = date('Ymdhi',$nowTime);
        
        do{
            $sn = 'SN'.$sn.mt_rand(1111,9999);
            $is_sn = $this->model->where('order_sn',$sn)->find();
            if (!empty($is_sn)) {
                $err = 1;
            }else{
                $err = 0;
            }
        }while($err == 1);

        return $sn;
    }


}
