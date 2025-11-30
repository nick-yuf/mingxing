<?php
/**
 * @auther --
 * @date 2025-11-24 10:21:14
 */
namespace App\Models;

use App\Models\Common\BaseModel;

class InfoLoadModel extends BaseModel
{
    use SingletonTrait;
    /**
     * 表名
     */
    protected $table='mx_info_load';

    /*
     * 数据库字段
     */
    const F_id = 'id',F_pack_no = 'pack_no',F_strip_id = 'strip_id',F_action = 'action',F_box_total = 'box_total',F_created_at = 'created_at',F_updated_at = 'updated_at',F_deleted_at = 'deleted_at';

    public static $tableComment='装柜数据';
    const Note = [
        self::F_pack_no => '物流号',
        self::F_strip_id => '柜子号',
        self::F_action => '行为',
        self::F_box_total => '件数',
    ];

    //行为：1 上柜，2 下柜
    const action_1 = 1, action_2 = 2;
    const ActionArray = [
        self::action_1 => '上柜',
        self::action_2 => '下柜',
    ];

    public function getOneById($id)
    {
        return self::query()
            ->where(self::F_id, $id)
            ->first();
    }


}