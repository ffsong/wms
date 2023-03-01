<?php

namespace plugin\admin\app\controller;

use support\Request;
use support\Response;
use plugin\admin\app\model\ProductStock;
use plugin\admin\app\controller\Crud;
use support\exception\BusinessException;

/**
 * 耗材库存 
 */
class ProductStockController extends Crud
{
    
    /**
     * @var ProductStock
     */
    protected $model = null;

    /**
     * 构造函数
     * @return void
     */
    public function __construct()
    {
        $this->model = new ProductStock;
    }
    
    /**
     * 浏览
     * @return Response
     */
    public function index(): Response
    {
        return view('product-stock/index');
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
        return view('product-stock/insert');
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
        return view('product-stock/update');
    }

}
