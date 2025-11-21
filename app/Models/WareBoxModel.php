<?php
/**
 * @auther --
 * @date 2025-11-21 09:35:54
 */
namespace App\Models;

use App\Models\Common\BaseModel;

class WareBoxModel extends BaseModel
{
    /**
     * 表名
     */
    protected $table='mx_ware_box';

    /*
     * 数据库字段
     */
    const F_id = 'id',F_goods_id = 'goods_id',F_count = 'count',F_action = 'action',F_created_at = 'created_at',F_updated_at = 'updated_at',F_deleted_at = 'deleted_at';


}