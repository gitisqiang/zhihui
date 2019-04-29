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
class Ads extends Api
{

    protected $noNeedLogin = '*';
    protected $noNeedRight = '*';

    public function _initialize()
    {
        parent::_initialize();
        $this->model = new \app\common\model\AdminAd;
    }

    public function index(){

        $id = $this->request->request('id');
        $time = time();
        $where = array(
                'category_id' => $id,
                'status' => 2,
                'starttime' => ['<=',$time],
                'endtime' => ['>=',$time]
            );

        $arr = $this->model->where($where)->select();
        foreach ($arr as $key => $val) {
            $arr[$key]['adimage'] = $this->request->domain().$val['adimage'];
        }
        $this->success('获取成功',$arr);
    }

}
