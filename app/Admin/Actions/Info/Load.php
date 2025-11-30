<?php

namespace App\Admin\Actions\Info;

use App\Models\InfoLoadModel;
use Encore\Admin\Actions\RowAction;

class Load extends RowAction
{
    public $name = '';

    public function href(): string
    {
        $this->name = __(InfoLoadModel::$tableComment);
        return "/admin/info/load?strip_id={$this->getKey()}";
    }

}
