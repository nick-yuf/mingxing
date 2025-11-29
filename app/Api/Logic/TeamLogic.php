<?php

namespace App\Api\Logic;

use App\Logic\BaseLogic;
use App\Models\TeamStaffModel;
use App\Models\TeamWorkerModel;

class TeamLogic extends BaseLogic
{

    public function workerList($type): array
    {
        $query = TeamWorkerModel::query();

        if($type) {
            $query->where(TeamWorkerModel::F_type,$type);
        }
        $data = $query
            ->where(TeamWorkerModel::F_status,TeamWorkerModel::status_1)
            ->get();

        if (!$data) {
            return [];
        }

        return $data->map(function ($item) {
            return [
                'id' => $item[TeamWorkerModel::F_id],
                'text' => $item[TeamWorkerModel::F_worker_no],
            ];
        })->toArray();

    }

    public function staffList(): array
    {
        $data = TeamStaffModel::query()
            ->where(TeamStaffModel::F_staff_status,TeamStaffModel::staff_status_1)
            ->get();

        if (!$data) {
            return [];
        }

        return $data->map(function ($item) {
            return [
                'id' => $item[TeamStaffModel::F_id],
                'text' => $item[TeamStaffModel::F_staff_name],
            ];
        })->toArray();
    }
}
