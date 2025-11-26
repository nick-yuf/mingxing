<?php
/**
 * @auther --
 * @date 2025-11-26 09:10:47
 */
namespace App\Models;

use App\Models\Common\BaseModel;

class InfoAppendModel extends BaseModel
{
    use SingletonTrait;
    /**
     * 表名
     */
    protected $table='mx_info_append';

    /*
     * 数据库字段
     */
    const F_id = 'id',F_content = 'content',F_append_price = 'append_price',F_strip_id = 'strip_id',F_contract_id = 'contract_id',F_staff_id = 'staff_id',F_append_date = 'append_date',F_created_at = 'created_at',F_updated_at = 'updated_at',F_deleted_at = 'deleted_at';


}