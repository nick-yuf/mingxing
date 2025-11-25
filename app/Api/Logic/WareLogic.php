<?php

namespace App\Api\Logic;

use App\Logic\BaseLogic;
use App\Models\WareGoodsModel;

class WareLogic extends BaseLogic
{

    public function goods(): array
    {
        $data = WareGoodsModel::query()->get();

        if (!$data) {
            return [];
        }


        return $data->map(function ($item) {
            return [
                'id' => $item[WareGoodsModel::F_id],
                'text' => $item[WareGoodsModel::F_goods_name],
            ];
        })->toArray();
    }
}
