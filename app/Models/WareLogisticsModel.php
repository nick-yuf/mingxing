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
    const F_id = 'id',F_goods_id = 'goods_id',F_action = 'action',F_count = 'count',F_relation_staff_id = 'relation_staff_id',F_staff_id = 'staff_id',F_user_id = 'user_id',F_remark = 'remark',F_created_at = 'created_at',F_updated_at = 'updated_at',F_deleted_at = 'deleted_at';

    public function goods(): HasOne
    {
        return $this->hasOne(WareGoodsModel::class, WareGoodsModel::F_id, self::F_goods_id);
    }

    //操作行为：1 入库，2 消耗，3 报废
    const action_1 = 1, action_2 = 2, action_3 = 3;
    const ActionArray = [
        self::action_1 => '入库',
        self::action_2 => '消耗',
        self::action_3 => '报废',
    ];
}