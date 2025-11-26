<?php

namespace App\Admin\Actions\Load;

use Encore\Admin\Actions\RowAction;

class Load extends RowAction
{
    public $name = '';

    public function href(): string
    {
        $this->name = __('Load');

        return "/admin/info/load?carId={$this->getKey()}";
    }

}
