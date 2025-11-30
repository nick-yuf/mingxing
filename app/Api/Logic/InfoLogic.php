<?php

namespace App\Api\Logic;

use App\Logic\BaseLogic;
use App\Models\InfoPackModel;

class InfoLogic extends BaseLogic
{

    public function packNo($pack_no): array
    {
        $data = InfoPackModel::query()
            ->where(InfoPackModel::F_pack_no,$pack_no)
            ->limit(10)
            ->get();

        if (!$data) {
            return [];
        }

        return $data->map(function ($item) {
            return [
                'id' => $item[InfoPackModel::F_id],
                'text' => __(InfoPackModel::F_pack_no).':'.$item[InfoPackModel::F_pack_no].','.__(InfoPackModel::F_box_count).':'.$item[InfoPackModel::F_box_count],
            ];
        })->toArray();
    }
}
