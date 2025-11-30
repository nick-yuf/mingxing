<?php

namespace App\Api\Controllers;

use App\Api\Logic\InfoLogic;
use App\Api\Validate\WareRequest;
use Dingo\Api\Http\Response;
use App\Http\Controllers\Controller;

class InfoController extends Controller
{

    private $logic;

    public function __construct()
    {
        $this->logic = new InfoLogic();
    }

    /**
     * @param WareRequest $request
     * @return Response
     */
    public function packNo(WareRequest $request): Response
    {
        $request->validate(__FUNCTION__);
        return $this->response->array($this->logic->packNo(
            $request->get('q',0)
        ));
    }

}
