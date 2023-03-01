<?php

namespace plugin\admin\app\controller;

use support\Request;
use support\Response;
use plugin\admin\app\model\PurchaseInOrder;
use plugin\admin\app\controller\Crud;
use support\exception\BusinessException;

/**
 * 耗材入库 
 */
class PurchaseInOrderController extends Crud
{
    
    /**
     * @var PurchaseInOrder
     */
    protected $model = null;

    /**
     * 构造函数
     * @return void
     */
    public function __construct()
    {
        $this->model = new PurchaseInOrder;
    }
    
    /**
     * 浏览
     * @return Response
     */
    public function index(): Response
    {
        return view('purchase-in-order/index');
    }

    /**
     * 插入
     * @param Request $request
     * @return Response
     * @throws BusinessException
     */
    public function insert(Request $request): Response
    {
        if ($request->method() === 'POST') {
            return parent::insert($request);
        }
        return view('purchase-in-order/insert', ['admin_id' => admin_id(), 'order_no' => 'RK' . date('YmdHis')]);
    }

    /**
     * 更新
     * @param Request $request
     * @return Response
     * @throws BusinessException
    */
    public function update(Request $request): Response
    {
        if ($request->method() === 'POST') {
            return parent::update($request);
        }
        return view('purchase-in-order/update');
    }

}