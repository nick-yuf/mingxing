<?php

namespace App\Api\Logic;

use App\Logic\BaseLogic;
use App\Models\CarModel;
use App\Models\PayeesModel;
use App\Models\WareGoodsModel;

class WareLogic extends BaseLogic
{

    /**
     * @desc list
     * @return array
     */
    public function list(): array
    {
        $data = PayeesModel::query()->get();

        if (!$data) {
            return [];
        }


        return $data->map(function ($item) {
            return [
                'id' => $item[PayeesModel::F_id],
                'text' => $item[PayeesModel::F_name],
            ];
        })->toArray();
    }

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
