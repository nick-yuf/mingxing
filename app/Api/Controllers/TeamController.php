<?php

namespace App\Api\Controllers;

use App\Api\Logic\TeamLogic;
use App\Api\Validate\WareRequest;
use Dingo\Api\Http\Response;
use App\Http\Controllers\Controller;

class TeamController extends Controller
{

    private $logic;

    public function __construct()
    {
        $this->logic = new TeamLogic();
    }

    /**
     * @param WareRequest $request
     * @return Response
     */
    public function workerList(WareRequest $request): Response
    {
        $request->validate(__FUNCTION__);
        return $this->response->array($this->logic->workerList());
    }

    /**
     * @param WareRequest $request
     * @return Response
     */
    public function staffList(WareRequest $request): Response
    {
        $request->validate(__FUNCTION__);
        return $this->response->array($this->logic->staffList());
    }
}
