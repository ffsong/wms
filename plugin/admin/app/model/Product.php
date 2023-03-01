<?php

namespace plugin\admin\app\model;

use plugin\admin\app\model\Base;

/**
 * @property integer $id (主键)
 * @property string $name 耗材名称
 * @property string $py_code 拼音码
 * @property string $item_no 耗材编号
 * @property integer $unit_id 单位
 * @property integer $danger 危险品
 * @property string $deleted_at 
 * @property string $created_at 
 * @property string $updated_at
 */
class Product extends Base
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'wms_products';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';
    
    
    
    
}
