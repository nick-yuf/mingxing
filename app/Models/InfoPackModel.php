<?php
/**
 * @auther --
 * @date 2025-11-24 10:20:20
 */
namespace App\Models;

use App\Models\Common\BaseModel;

class InfoPackModel extends BaseModel
{
    use SingletonTrait;
    /**
     * 表名
     */
    protected $table='mx_info_pack';

    /*
     * 数据库字段
     */
    const F_id = 'id',F_contract_id = 'contract_id',F_worker_id = 'worker_id',F_pack_no = 'pack_no',F_transport_no = 'transport_no',F_box_count = 'box_count',F_product_level = 'product_level',F_in_3 = 'in_3',F_in_4 = 'in_4',F_in_5 = 'in_5',F_in_6 = 'in_6',F_in_7 = 'in_7',F_in_8 = 'in_8',F_in_cl = 'in_cl',F_staff_id = 'staff_id',F_user_id = 'user_id',F_created_at = 'created_at',F_updated_at = 'updated_at',F_deleted_at = 'deleted_at';

    public static $tableComment='装箱数据';

    const Note = [
        self::F_contract_id => '合同',
        self::F_worker_id => '劳工队',
        self::F_pack_no => '物流号',
        self::F_transport_no => '运送班次',
        self::F_box_count => '装箱数',
        self::F_product_level => '品级',
        self::F_in_3 => '3把',
        self::F_in_4 => '4把',
        self::F_in_5 => '5把',
        self::F_in_6 => '6把',
        self::F_in_7 => '7把',
        self::F_in_8 => '8把',
        self::F_in_cl => 'cl',
        self::F_staff_id => '统计人',
    ];


    //level：1 A，2 B
    const product_level_1 = 1, product_level_2 = 2;
    const LevelArray = [
        self::product_level_1 => 'A级',
        self::product_level_2 => 'B级',
    ];
}