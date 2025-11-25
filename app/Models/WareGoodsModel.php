<?php
/**
 * @auther --
 * @date 2025-11-20 07:55:25
 */
namespace App\Models;

use App\Models\Common\BaseModel;

class WareGoodsModel extends BaseModel
{
    use SingletonTrait;

    public $timestamps = false;
    /**
     * 表名
     */
    protected $table='mx_ware_goods';

    /*
     * 数据库字段
     */
    const F_id = 'id',F_goods_name = 'goods_name',F_goods_spec = 'goods_spec',F_remark = 'remark',F_created_at = 'created_at',F_updated_at = 'updated_at',F_deleted_at = 'deleted_at';

    static public $tableComment = '仓库货物';
    const Note = [
        self::F_goods_name => '货物名',
        self::F_goods_spec => '货物规格',
        self::F_remark => '备注',
    ];

    public function getOneById($id): array
    {
        return self::query()
            ->where(self::F_id, $id)
            ->first()->toArray();
    }
}