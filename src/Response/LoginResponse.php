<?php

namespace PG\Wazuh\Response;

class LoginResponse extends BaseResponse
{
    public function getToken()
    {
        return $this->getResponse()
            ->getValue('data.token');
    }
}