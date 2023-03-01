<?php

namespace plugin\admin\app\model;

use plugin\admin\app\model\Base;

/**
 * @property integer $id (主键)
 * @property string $order_no 入库单号
 * @property integer $product_id 产品ID
 * @property integer $num 入库数量
 * @property integer $unuse_num 未使用数量
 * @property string $price 单价
 * @property integer $state 状态：1 正常，2 撤销
 * @property integer $admin_id 操作人
 * @property string $deleted_at
 * @property string $created_at
 * @property string $updated_at
 */
class PurchaseInOrder extends Base
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'wms_purchase_in_order';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     *
     * @return void
     */
    protected static function booted()
    {
        static::created(function ($purchaseInOrder) {

            $purchaseInOrder->unuse_num = $purchaseInOrder->num;
            $purchaseInOrder->save();

            // 耗材库存记录
            $productStock = ProductStock::query()
                ->where('product_id', $purchaseInOrder->product_id)
                ->first();

            if ($productStock) {
                // 存在库存记录
                $productStock->increment('num', $purchaseInOrder->num);
                return true;
            }

            // 耗材第一次入库
            ProductStock::create([
                'product_id' => $purchaseInOrder->product_id,
                'num' => $purchaseInOrder->num,
            ]);
        });

        static::updated(function ($purchaseInOrder) {

        });
    }


}
