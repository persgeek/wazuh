<?php

namespace PG\Wazuh\Response;

class AssignResponse extends BaseResponse
{
    public function getItems()
    {
        return $this->getResponse()
            ->getValue('data.affected_items');
    }

    public function getMessage()
    {
        return $this->getResponse()
            ->getValue('message');
    }
}