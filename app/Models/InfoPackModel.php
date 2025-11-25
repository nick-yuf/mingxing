<?php
/**
 * @auther --
 * @date 2025-11-24 10:20:20
 */
namespace App\Models;

use App\Models\Common\BaseModel;

class InfoPackModel extends BaseModel
{
    /**
     * 表名
     */
    protected $table='mx_info_pack';

    /*
     * 数据库字段
     */
    const F_id = 'id',F_contract_id = 'contract_id',F_worker_id = 'worker_id',F_transport_no = 'transport_no',F_box_count = 'box_count',F_product_level = 'product_level',F_in_3 = 'in_3',F_in_4 = 'in_4',F_in_5 = 'in_5',F_in_6 = 'in_6',F_in_7 = 'in_7',F_in_8 = 'in_8',F_in_cl = 'in_cl',F_staff_id = 'staff_id',F_user_id = 'user_id',F_created_at = 'created_at',F_updated_at = 'updated_at',F_deleted_at = 'deleted_at';


}