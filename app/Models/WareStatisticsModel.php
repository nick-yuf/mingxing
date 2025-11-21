<?php
/**
 * @auther --
 * @date 2025-11-20 07:52:48
 */
namespace App\Models;

use App\Models\Common\BaseModel;

class WareStatisticsModel extends BaseModel
{
    /**
     * 表名
     */
    protected $table='mx_ware_statistics';

    /*
     * 数据库字段
     */
    const F_id = 'id',F_goods_id = 'goods_id',F_sum = 'sum',F_created_at = 'created_at',F_updated_at = 'updated_at',F_deleted_at = 'deleted_at';


}