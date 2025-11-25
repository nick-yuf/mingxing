<?php
/**
 * @auther --
 * @date 2025-11-22 10:27:28
 */
namespace App\Models;

use App\Models\Common\BaseModel;

class WareToolsModel extends BaseModel
{
    /**
     * 表名
     */
    protected $table='mx_ware_tools';

    /*
     * 数据库字段
     */
    const F_id = 'id',F_tools_name = 'tools_name',F_tools_param = 'tools_param',F_tools_total = 'tools_total',F_remark = 'remark',F_created_at = 'created_at',F_updated_at = 'updated_at',F_deleted_at = 'deleted_at';

    static public $tableComment = '仓库工具';
    const Note = [
        self::F_tools_name => '工具名',
        self::F_tools_param => '工具参数',
        self::F_tools_total => '工具总数',
        self::F_remark => '备注',
    ];
}