<?php

namespace PG\Wazuh\Response;

use PG\Http\Response;

abstract class BaseResponse
{
    protected $response;

    public function __construct(Response $response)
    {
        $this->response = $response;
    }

    public function setResponse(Response $response)
    {
        $this->response = $response;

        return $this;
    }

    public function getResponse()
    {
        return $this->response;
    }
}