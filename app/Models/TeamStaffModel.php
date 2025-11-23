<?php
/**
 * @auther --
 * @date 2025-11-23 03:08:39
 */
namespace App\Models;

use App\Models\Common\BaseModel;

class TeamStaffModel extends BaseModel
{
    /**
     * 表名
     */
    protected $table='mx_team_staff';
    const table_name='员工数据';

    /*
     * 数据库字段
     */
    const F_id = 'id',F_staff_name = 'staff_name',F_staff_job = 'staff_job',F_staff_type = 'staff_type',F_staff_status = 'staff_status',F_contact = 'contact',F_created_at = 'created_at',F_updated_at = 'updated_at',F_deleted_at = 'deleted_at';

    const Note = [
        self::F_staff_name => '员工名称',
        self::F_staff_job => '工作职责',
        self::F_staff_type => '类型',
        self::F_staff_status => '状态',
        self::F_contact => '联系方式',
    ];

    //类型：1 正式，2 兼职
    const staff_type_1 = 1, staff_type_2 =2;
    const StaffTypeArray = [
        self::staff_type_1 => '正式',
        self::staff_type_2 => '兼职',
    ];

    //状态：1 在职，2 离职
    const staff_status_1 = 1, staff_status_2 =2;
    const StaffStatusArray = [
        self::staff_status_1 => '在职',
        self::staff_status_2 => '离职',
    ];
}