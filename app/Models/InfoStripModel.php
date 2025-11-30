<?php
/**
 * @auther --
 * @date 2025-11-26 09:09:50
 */
namespace App\Models;

use App\Models\Common\BaseModel;
use Illuminate\Database\Eloquent\Relations\HasOne;

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
    const F_id = 'id',F_strip_no = 'strip_no',F_arrive_date = 'arrive_date',F_close_date = 'close_date',F_leave_date = 'leave_date',F_box_total = 'box_total',F_in_a = 'in_a',F_in_b = 'in_b',F_in_4 = 'in_4',F_in_5 = 'in_5',F_in_6 = 'in_6',F_in_7 = 'in_7',F_in_8 = 'in_8',F_kg = 'kg',F_remark = 'remark',F_staff_id = 'staff_id',F_worker_id = 'worker_id',F_status = 'status',F_created_at = 'created_at',F_updated_at = 'updated_at',F_deleted_at = 'deleted_at';

    public static $tableComment='柜子数据';

    const Note = [
        self::F_strip_no => '柜子编号',
        self::F_arrive_date => '到厂日期',
        self::F_close_date => '关柜日期',
        self::F_leave_date => '离厂日期',
        self::F_box_total => '总件数',
        self::F_in_a => 'A货数',
        self::F_in_b => 'B货数',
        self::F_in_4 => '4把',
        self::F_in_5 => '5把',
        self::F_in_6 => '6把',
        self::F_in_7 => '7把',
        self::F_in_8 => '8把',
        self::F_kg => '单个箱子重量',
        self::F_status => '状态',
        self::F_remark => '备注',
        self::F_worker_id => '装柜组',
        self::F_staff_id => '统计人',
    ];

    public function worker(): HasOne
    {
        return $this->hasOne(TeamWorkerModel::class, TeamWorkerModel::F_id, self::F_worker_id);
    }

    public function staff(): HasOne
    {
        return $this->hasOne(TeamStaffModel::class, TeamStaffModel::F_id, self::F_staff_id);
    }

    //状态：1 等待中，2 已关柜，3 已结算
    const status_1 = 1, status_2 = 2, status_3 = 3;
    const StatusArray = [
        self::status_1 => '等待中',
        self::status_2 => '已关柜',
        self::status_3 => '已结算',
    ];

    public function getOneById($id)
    {
        return self::query()
            ->where(self::F_id, $id)
            ->first();
    }

}