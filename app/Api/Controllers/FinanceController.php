<?php

namespace App\Api\Controllers;

use App\Api\Logic\FinanceLogic;
use App\Api\Validate\WareRequest;
use Dingo\Api\Http\Response;
use App\Http\Controllers\Controller;

class FinanceController extends Controller
{

    private $logic;

    public function __construct()
    {
        $this->logic = new FinanceLogic();
    }

    /**
     * @param WareRequest $request
     * @return Response
     */
    public function contract(WareRequest $request): Response
    {
        $request->validate(__FUNCTION__);
        return $this->response->array($this->logic->contract());
    }

}
