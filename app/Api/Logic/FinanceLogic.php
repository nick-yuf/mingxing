<?php

namespace App\Api\Logic;

use App\Logic\BaseLogic;
use App\Models\FinanceContractModel;
use App\Models\TeamStaffModel;
use App\Models\TeamWorkerModel;

class FinanceLogic extends BaseLogic
{

    public function contract(): array
    {
        $data = FinanceContractModel::query()
            ->where(FinanceContractModel::F_status,FinanceContractModel::status_1)
            ->limit(10)
            ->get();

        if (!$data) {
            return [];
        }

        return $data->map(function ($item) {
            return [
                'id' => $item[FinanceContractModel::F_id],
                'text' => $item[FinanceContractModel::F_contract_no]."[{$item[FinanceContractModel::F_supplier_name]}]",
            ];
        })->toArray();
    }

}
