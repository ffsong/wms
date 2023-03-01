<?php

namespace plugin\admin\app\model;

use plugin\admin\app\model\Base;

/**
 * @property integer $id (主键)
 * @property string $name 单位名称
 * @property string $deleted_at 
 * @property string $created_at 
 * @property string $updated_at
 */
class Unit extends Base
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'wms_unit';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';
    
    
    
    
}
