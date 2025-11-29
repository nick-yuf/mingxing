<?php
/**
 * @auther --
 * @date 2025-11-26 09:09:04
 */
namespace App\Models;

use App\Models\Common\BaseModel;
use Illuminate\Database\Eloquent\Relations\HasOne;

class InfoOrchardModel extends BaseModel
{
    use SingletonTrait;

    /**
     * 表名
     */
    protected $table='mx_info_orchard';

    /*
     * 数据库字段
     */
    const F_id = 'id',F_orchard_name = 'orchard_name',F_contract_id = 'contract_id',F_start_date = 'start_date',F_shipment_total = 'shipment_total',F_box_total = 'box_total',F_in_a = 'in_a',F_in_b = 'in_b',F_in_4 = 'in_4',F_in_5 = 'in_5',F_in_6 = 'in_6',F_in_7 = 'in_7',F_in_8 = 'in_8',F_in_cl = 'in_cl',F_remark = 'remark',F_user_id = 'user_id',F_created_at = 'created_at',F_updated_at = 'updated_at',F_deleted_at = 'deleted_at';

    public static $tableComment='蕉园数据';
    const Note = [
        self::F_contract_id => '合同',
        self::F_orchard_name => '蕉园名',
        self::F_start_date => '开工时间',
        self::F_shipment_total => '装运总次数',
        self::F_box_total => '总件数',
        self::F_remark => '备注',
        self::F_in_a => 'A类',
        self::F_in_b => 'B类',
        self::F_in_4 => '4把',
        self::F_in_5 => '5把',
        self::F_in_6 => '6把',
        self::F_in_7 => '7把',
        self::F_in_8 => '8把',
        self::F_in_cl => 'CL',
        self::F_user_id => '操作人',
    ];

    public function user(): HasOne
    {
        return $this->hasOne(AdminUsersModel::class, AdminUsersModel::F_id, self::F_user_id);
    }

    public function contract(): HasOne
    {
        return $this->hasOne(FinanceContractModel::class, FinanceContractModel::F_id, self::F_contract_id);
    }

    public function getOneById($id)
    {
        return self::query()
            ->where(self::F_id, $id)
            ->first();
    }
}