<?php

namespace App\Admin\Actions\Info;

use App\Models\InfoPackModel;
use Encore\Admin\Actions\RowAction;

class PackLogistics extends RowAction
{
    public $name = '';

    public function href(): string
    {
        $this->name = __('物流数据');
        return "/admin/info/pack_logistics?orchard_id={$this->getKey()}";
    }

}
