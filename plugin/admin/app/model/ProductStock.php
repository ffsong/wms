<?php

namespace plugin\admin\app\model;

use plugin\admin\app\model\Base;

/**
 * @property integer $id (主键)
 * @property integer $product_id 产品ID
 * @property integer $num 产品库存
 * @property mixed $created_at 
 * @property mixed $updated_at
 */
class ProductStock extends Base
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'wms_product_stock';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    protected $fillable = ['product_id', 'num'];
    
    
}
