<?php
/**
 * @auther --
 * @date 2025-11-21 09:34:41
 */
namespace App\Models;

use App\Models\Common\BaseModel;

class StaffModel extends BaseModel
{
    /**
     * 表名
     */
    protected $table='mx_staff';

    /*
     * 数据库字段
     */
    const F_id = 'id',F_staff_name = 'staff_name',F_staff_job = 'staff_job',F_staff_type = 'staff_type',F_staff_status = 'staff_status',F_remark = 'remark',F_start_time = 'start_time',F_end_time = 'end_time',F_created_at = 'created_at',F_updated_at = 'updated_at',F_deleted_at = 'deleted_at';


}