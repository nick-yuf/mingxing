<?php
/**
 * @auther --
 * @date 2025-11-24 10:21:14
 */
namespace App\Models;

use App\Models\Common\BaseModel;

class InfoLoadModel extends BaseModel
{
    /**
     * 表名
     */
    protected $table='mx_info_load';

    /*
     * 数据库字段
     */
    const F_id = 'id',F_pack_id = 'pack_id',F_container_id = 'container_id',F_action = 'action',F_count = 'count',F_created_at = 'created_at',F_updated_at = 'updated_at',F_deleted_at = 'deleted_at';


}