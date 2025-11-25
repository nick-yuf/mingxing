<?php

namespace App\Api\Controllers;

use App\Api\Logic\WareLogic;
use App\Api\Validate\WareRequest;
use Dingo\Api\Http\Response;
use App\Http\Controllers\Controller;

class WareController extends Controller
{

    private $logic;

    public function __construct()
    {
        $this->logic = new WareLogic();
    }


    /**
     * @param WareRequest $request
     * @return Response
     */
    public function goods(WareRequest $request): Response
    {
        $request->validate(__FUNCTION__);
        return $this->response->array($this->logic->goods());
    }

}
