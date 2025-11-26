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
    const F_id = 'id',F_pack_id = 'pack_id',F_container_id = 'container_id',F_action = 'action',F_count = 'count',F_created_at = 'created_at',F_updated_at = 'updated_at',F_deleted_at = 'deleted_at';

    public static $tableComment='装柜数据';
    const Note = [
        self::F_pack_id => '采集号',
        self::F_container_id => '柜子号',
        self::F_action => '行为',
        self::F_count => '件数',
    ];

    //行为：1 上柜，2 下柜
    const action_1 = 1, action_2 = 2;
    const ActionArray = [
        self::action_1 => '上柜',
        self::action_2 => '下柜',
    ];
}