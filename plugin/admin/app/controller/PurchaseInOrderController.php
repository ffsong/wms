<?php

namespace plugin\admin\app\controller;

use plugin\admin\app\model\ProductStock;
use support\Db;
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


    // 报废
    public function scrap(Request $request): Response
    {
        Db::beginTransaction();

        try {
            $purchaseInOrder = PurchaseInOrder::find($request->post('id'));
            if ($purchaseInOrder['unuse_num'] > 0 && $purchaseInOrder['scrap_num'] === 0) {
                $purchaseInOrder->scrap_num = $purchaseInOrder['unuse_num'];
                $purchaseInOrder->unuse_num = 0;
                $purchaseInOrder->scrap_admin_id = admin_id();
                $purchaseInOrder->scraped_at = date("Y-m-d H:i:s");
                $purchaseInOrder->save();

                ProductStock::where('product_id', $purchaseInOrder['product_id'])
                    ->decrement('num', $purchaseInOrder['unuse_num']);
            }

            DB::commit();
        }catch (\Throwable $e){
            DB::rollBack();

            return $this->json(1, '操作失败', ['err_msg' => $e->getMessage()]);
        }

        return $this->json(0);
    }

}
