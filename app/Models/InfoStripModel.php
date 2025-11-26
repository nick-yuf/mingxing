<?php
/**
 * @auther --
 * @date 2025-11-26 09:09:50
 */
namespace App\Models;

use App\Models\Common\BaseModel;

class InfoStripModel extends BaseModel
{
    use SingletonTrait;
    /**
     * 表名
     */
    protected $table='mx_info_strip';

    /*
     * 数据库字段
     */
    const F_id = 'id',F_strip_no = 'strip_no',F_arrive_date = 'arrive_date',F_close_date = 'close_date',F_leave_date = 'leave_date',F_box_total = 'box_total',F_boxA_total = 'boxA_total',F_boxB_total = 'boxB_total',F_staff_id = 'staff_id',F_worker_id = 'worker_id',F_created_at = 'created_at',F_updated_at = 'updated_at',F_deleted_at = 'deleted_at';

    public static $tableComment='柜子列表';

    const Note = [
        self::F_strip_no => '柜子编号',
        self::F_worker_id => '劳工队',
        self::F_arrive_date => '到厂日期',
        self::F_close_date => '关柜日期',
        self::F_leave_date => '离厂日期',
        self::F_box_total => '总件数',
        self::F_boxA_total => 'A货数',
        self::F_boxB_total => 'B货数',
        self::F_staff_id => '统计人',
    ];
}