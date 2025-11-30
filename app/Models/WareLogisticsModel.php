<?php
/**
 * @auther --
 * @date 2025-11-20 07:54:35
 */
namespace App\Models;

use App\Models\Common\BaseModel;
use Illuminate\Database\Eloquent\Relations\HasOne;

class WareLogisticsModel extends BaseModel
{
    /**
     * 表名
     */
    protected $table='mx_ware_logistics';

    /*
     * 数据库字段
     */
    const F_id = 'id',F_goods_id = 'goods_id',F_action = 'action',F_is_save = 'is_save',F_count = 'count',F_contract_id = 'contract_id',F_worker_id = 'worker_id',F_staff_id = 'staff_id',F_user_id = 'user_id',F_remark = 'remark',F_action_date = 'action_date',F_created_at = 'created_at',F_updated_at = 'updated_at',F_deleted_at = 'deleted_at';

    public static $tableComment = '仓库物流信息';
    const Note = [
        self::F_goods_id => '货物',
        self::F_action => '操作行为',
        self::F_is_save => '是否入库',
        self::F_count => '数量',
        self::F_worker_id => '劳工组',
        self::F_staff_id => '核对员工',
        self::F_contract_id => '蕉园合同',
        self::F_user_id => '操作人',
        self::F_remark => '备注',
        self::F_action_date => '操作时间',
    ];
    public function goods(): HasOne
    {
        return $this->hasOne(WareGoodsModel::class, WareGoodsModel::F_id, self::F_goods_id);
    }

    public function worker(): HasOne
    {
        return $this->hasOne(TeamWorkerModel::class, TeamWorkerModel::F_id, self::F_worker_id);
    }

    public function staff(): HasOne
    {
        return $this->hasOne(TeamStaffModel::class, TeamStaffModel::F_id, self::F_staff_id);
    }

    //操作行为：1 提取，2 归还，3 报废，4 采购
    const action_1 = 1, action_2 = 2, action_3 = 3, action_4 = 4;
    const ActionArray = [
        self::action_1 => '提取',
        self::action_2 => '归还',
        self::action_3 => '报废',
        self::action_4 => '采购',
    ];

    //是否保存入库：0 否，1 是
    const is_save_0 = 0, is_save_1 = 1;
    const IsSaveArray = [
        self::is_save_0 => '否',
        self::is_save_1 => '是',
    ];
}