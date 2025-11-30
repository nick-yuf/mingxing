<?php

namespace App\Admin\Actions\Info;

use Encore\Admin\Actions\RowAction;

class PackLogisticsEdit extends RowAction
{
    public $name = '';

    public $id = '';

    public $pk = '';

    public function __construct($id,$pk)
    {
        $this->id = $id;
        $this->pk = $pk;
    }

    public function href(): string
    {
        $this->name = trans('admin.edit');

        return "/admin/info/pack_logistics/".$this->pk."/edit?orchard_id=".$this->id;
    }

}
