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
class Cart extends Api
{

    protected $noNeedLogin = '*';
    protected $noNeedRight = '*';
    protected $relationSearch = true;

    public function _initialize()
    {
        parent::_initialize();
        $this->model = new \app\common\model\Shop;
    }

    public function index(){
        $uid = $this->request->request('uid');
        
        $cart = $this->getUserCart($uid);
        if (!empty($cart)) {
        	$this->success('加载成功',$cart);
        }else{
        	$this->error();
        }
        
    }

    public function cartOrder(){
        $uid = $this->request->request('uid');
        $ids = $this->request->request('ids');
        $arr = $this->getUserCart($uid,$ids);
        $arr['score'] = model('user')->where('id',$uid)->value('score');
        if (!empty($arr)) {
            $this->success('加载成功',$arr);
        }else{
            $this->error();
        }
    }

    function getUserCart($uid,$ids=''){
        $arr = model('shop')->field('id,shop_name')->where('is_self',1)->find();
        $where = '';

        if (!empty($ids)) {
            $where = 'FIND_IN_SET(c.id,"'.$ids.'")';
        }
        $goods = Db::name('cart c')
                ->field('c.*,g.goodsimages,g.goods_name,g.integral')
                ->join('shop_goods g','g.id = c.goods_id')
                ->where($where)
                ->select();

        foreach ($goods as $key => $val) {
            $goodsImges = explode(',', $val['goodsimages']);
            $goods[$key]['goodsimages'] = $this->request->domain().$goodsImges[0];
        }

        $arr['goods_list'] = $goods;

        return $arr;
    }

}
