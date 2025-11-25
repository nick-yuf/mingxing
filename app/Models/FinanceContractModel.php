<?php
/**
 * @auther --
 * @date 2025-11-24 10:56:32
 */
namespace App\Models;

use App\Models\Common\BaseModel;

class FinanceContractModel extends BaseModel
{
    /**
     * 表名
     */
    protected $table='mx_finance_contract';

    /*
     * 数据库字段
     */
    const F_id = 'id',F_contract_no = 'contract_no',F_contract_dec = 'contract_dec',F_priceA = 'priceA',F_priceB = 'priceB',F_sign_date = 'sign_date',F_start_date = 'start_date',F_staff_id = 'staff_id',F_created_at = 'created_at',F_updated_at = 'updated_at',F_deleted_at = 'deleted_at';


}