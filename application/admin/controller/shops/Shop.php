<?php

namespace app\admin\controller\shops;

use app\common\controller\Backend;

/**
 * shop
 *
 * @icon fa fa-circle-o
 */
class Shop extends Backend
{
    
    /**
     * Shop模型对象
     * @var \app\common\model\Shop
     */
    protected $model = null;

    public function _initialize()
    {
        parent::_initialize();
        $this->model = new \app\admin\model\Shop;
        $this->view->assign("isReceivingList", $this->model->getIsReceivingList());
        $this->view->assign("statusList", $this->model->getStatusList());
        $this->view->assign("showdataList", $this->model->getShowdataList());
        $this->view->assign("isBestdataList", $this->model->getIsBestdataList());
    }
    
    /**
     * 默认生成的控制器所继承的父类中有index/add/edit/del/multi五个基础方法、destroy/restore/recyclebin三个回收站方法
     * 因此在当前控制器中可不用编写增删改查的代码,除非需要自己控制这部分逻辑
     * 需要将application/admin/library/traits/Backend.php中对应的方法复制到当前控制器,然后进行修改
     */
    

    /**
     * 查看
     */
    public function index()
    {
        //当前是否为关联查询
        $this->relationSearch = true;
        //设置过滤方法
        $this->request->filter(['strip_tags']);
        if ($this->request->isAjax())
        {
            //如果发送的来源是Selectpage，则转发到Selectpage
            if ($this->request->request('keyField'))
            {
                return $this->selectpage();
            }
            list($where, $sort, $order, $offset, $limit) = $this->buildparams();
            $mywhere = [];
            $mywhere['is_self'] = 0;
            $total = $this->model
                    ->with(['shop_classify'])
                    ->where($where)
                    ->where($mywhere)
                    ->order($sort, $order)
                    ->count();

            $list = $this->model
                    ->with(['shop_classify'])
                    ->where($where)
                    ->where($mywhere)
                    ->order($sort, $order)
                    ->limit($offset, $limit)
                    ->select();

            foreach ($list as $row) {
                $row->visible(['id','shop_name','shop_img','shop_logo','city','address','location_name','shop_brief','do_start_time',"do_end_time",'is_receiving','status','classify_id','showdata','is_bestdata','integral_num','fee_price','send_price']);
                $row->visible(['shop_classify']);
            }
            $list = collection($list)->toArray();
            $result = array("total" => $total, "rows" => $list);

            return json($result);
        }
        return $this->view->fetch();
    }
}
