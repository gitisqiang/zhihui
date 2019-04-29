<?php

namespace app\api\controller;

use app\common\controller\Api;
use app\common\library\Ems;
use app\common\library\Sms;
use fast\Random;

/**
 * 入驻商户列表
 */

 class Shopgoods extends Api
 {
     
    public function _initialize()
    {
        parent::_initialize();
        $this->model = new \app\common\model\Shop;
    }

    

 }
 