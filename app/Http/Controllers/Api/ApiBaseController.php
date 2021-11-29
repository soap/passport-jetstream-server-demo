<?php

namespace App\Http\Controllers\Api;


use Illuminate\Support\Str;
use Illuminate\Foundation\Bus\DispatchesJobs;
use MarcinOrlowski\ResponseBuilder\ResponseBuilder;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ApiBaseController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function respond($data, $message = null)
    {
        return ResponseBuilder::asSuccess()->withData($data)->withMessage($message)->build();
    }

    public function respondWithMessage($message)
    {
        return ResponseBuilder::asSuccess()->withMessage($message)->build();
    }

    public function respondWithError($apiCode, $httpCode)
    {
        return ResponseBuilder::asError($apiCode)->withHttpCode($httpCode)->build();
    }

    public function respondBadRequest($apiCode)
    {
        return $this->respondWithError($apiCode, 400);
    }

    public function respondUnAuthorizedRequest($apiCode)
    {
        return $this->respondWithError($apiCode, 401);
    }

    public function respondNotFound($apiCode)
    {
        return $this->respondWithError($apiCode, 404);
    }
}
