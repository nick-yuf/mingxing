<?php
/**
 * @auther --
 * @date 2025-11-23 03:10:08
 */
namespace App\Models;

use App\Models\Common\BaseModel;

class TeamWorkerModel extends BaseModel
{
    use SingletonTrait;

    /**
     * 表名
     */
    protected $table='mx_team_worker';

    /*
     * 数据库字段
     */
    const F_id = 'id',F_worker_no = 'worker_no',F_worker_name = 'worker_name',F_worker_contact = 'worker_contact',F_remark = 'remark',F_status = 'status',F_type = 'type',F_created_at = 'created_at',F_updated_at = 'updated_at',F_deleted_at = 'deleted_at';

    public static $tableComment = '劳工数据';
    const Note = [
        self::F_worker_no => '劳工组编号',
        self::F_worker_name => '劳工负责人',
        self::F_worker_contact => '劳工联系方式',
        self::F_status => '状态',
        self::F_type => '类型',
        self::F_remark => '备注',
    ];

    //状态：1 活跃，2 不可用
    const status_1 = 1, status_2 = 2;
    const StatusArray = [
        self::status_1 => '活跃',
        self::status_2 => '不可用',
    ];

    //类型：1 装箱组，2 装柜组，3 压箱组
    const type_1 = 1, type_2 = 2, type_3 = 3;
    const TypeArray = [
        self::type_1 => '装箱组',
        self::type_2 => '装柜组',
        self::type_3 => '压箱组',
    ];

    public function getOneById($id)
    {
        return self::query()
            ->where(self::F_id, $id)
            ->first();
    }
}