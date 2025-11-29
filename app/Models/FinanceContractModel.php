<?php
/**
 * @auther --
 * @date 2025-11-24 10:56:32
 */
namespace App\Models;

use App\Models\Common\BaseModel;
use Illuminate\Database\Eloquent\Relations\HasOne;

class FinanceContractModel extends BaseModel
{
    use SingletonTrait;

    /**
     * 表名
     */
    protected $table='mx_finance_contract';

    /*
     * 数据库字段
     */
    const F_id = 'id',F_contract_no = 'contract_no',F_supplier_name = 'supplier_name',F_supplier_id = 'supplier_id',F_supplier_address = 'supplier_address',F_supplier_phone = 'supplier_phone',F_remark = 'remark',F_tonnage = 'tonnage',F_total_box = 'total_box',F_box_weight = 'box_weight',F_deposit = 'deposit',F_priceA = 'priceA',F_priceB = 'priceB',F_worker_price = 'worker_price',F_worker_id = 'worker_id',F_sign_date = 'sign_date',F_start_date = 'start_date',F_status = 'status',F_staff_id = 'staff_id',F_created_at = 'created_at',F_updated_at = 'updated_at',F_deleted_at = 'deleted_at';

    public static $tableComment='合同数据';
    const Note = [
        self::F_contract_no => '合同编号',
        self::F_supplier_name => '供应商',
        self::F_supplier_id => '供应商ID',
        self::F_supplier_address => '供应商地址',
        self::F_supplier_phone => '供应商电话',
        self::F_remark => '备注',
        self::F_box_weight => '单箱重量(KG)',
        self::F_tonnage => '预估吨数',
        self::F_deposit => '押金',
        self::F_priceA => '价格A',
        self::F_priceB => '价格B',
        self::F_worker_id => '劳工组',
        self::F_worker_price => '工人采蕉价格',
        self::F_sign_date => '签署日期',
        self::F_staff_id => '负责人',
        self::F_status => '状态',
    ];

    //状态：1 生效，2 作废，3 结清
    const status_1 = 1, status_2 = 2, status_3 = 3;
    const StatusArray = [
        self::status_1 => '生效',
        self::status_2 => '作废',
        self::status_3 => '结清',
    ];
    public function staff(): HasOne
    {
        return $this->hasOne(TeamStaffModel::class, TeamStaffModel::F_id, self::F_staff_id);
    }
    public function worker(): HasOne
    {
        return $this->hasOne(TeamWorkerModel::class, TeamWorkerModel::F_id, self::F_worker_id);
    }
}