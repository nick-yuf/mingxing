<?php
/**
 * @auther --
 * @date 2025-11-23 03:10:08
 */
namespace App\Models;

use App\Models\Common\BaseModel;

class TeamWorkerModel extends BaseModel
{
    /**
     * 表名
     */
    protected $table='mx_team_worker';

    const table_name='劳工数据';
    /*
     * 数据库字段
     */
    const F_id = 'id',F_worker_no = 'worker_no',F_worker_name = 'worker_name',F_worker_contact = 'worker_contact',F_status = 'status',F_created_at = 'created_at',F_updated_at = 'updated_at',F_deleted_at = 'deleted_at';
    const Note = [
        self::F_worker_no => '劳工队编号',
        self::F_worker_name => '劳工名称',
        self::F_worker_contact => '劳工联系方式',
        self::F_status => '状态',
    ];

    //状态：1 活跃，2 不可用
    const status_1 = 1, status_2 =2;
    const StatusArray = [
        self::status_1 => '活跃',
        self::status_2 => '不可用',
    ];
}