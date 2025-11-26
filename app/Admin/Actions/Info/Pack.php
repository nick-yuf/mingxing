<?php

namespace App\Admin\Actions\Info;

use App\Models\InfoPackModel;
use Encore\Admin\Actions\RowAction;

class Pack extends RowAction
{
    public $name = '';

    public function href(): string
    {
        $this->name = __(InfoPackModel::$tableComment);
        return "/admin/info/pack?orchard_id={$this->getKey()}";
    }

}
