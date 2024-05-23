<?php

namespace PG\Wazuh;

use PG\Wazuh\Response\AssignResponse;
use PG\Wazuh\Response\LoginResponse;
use PG\Wazuh\Response\AgentResponse;
use PG\Http\Tools\Translator;
use PG\Http\Tools\Convertor;
use PG\Http\Request;

class Wazuh
{
    protected $address;

    protected $username;

    protected $password;

    protected $token;

    public function __construct($address)
    {
        $this->address = $address;
    }
    
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setToken($token)
    {
        $this->token = $token;

        return $this;
    }

    public function getToken()
    {
        return $this->token;
    }

    public function login()
    {
        $segments = ['security', 'user', 'authenticate'];

        $address = $this->createAddress($segments);

        $response = $this->getDefaultRequest()
            ->setUsername($this->username)
            ->setPassword($this->password)
            ->setAddress($address)
            ->setMethod('POST')
            ->getResponse();

        return new LoginResponse($response);
    }

    public function getAgents()
    {
        $fields = ['token' => $this->token];

        $headers = [
            'Authorization' => 'Bearer @token'
        ];

        $address = $this->createAddress(['agents']);

        $response = $this->getDefaultRequest($fields)
            ->setHeaders($headers)
            ->setAddress($address)
            ->setMethod('GET')
            ->getResponse();

        return new AgentResponse($response);
    }

    public function assignGroup($agentId, $groupId)
    {
        $fields = ['token' => $this->token];

        $headers = [
            'Authorization' => 'Bearer @token'
        ];

        $segments = [
            'agents', $agentId, 'group', $groupId
        ];

        $address = $this->createAddress($segments);

        $response = $this->getDefaultRequest($fields)
            ->setHeaders($headers)
            ->setAddress($address)
            ->setMethod('PUT')
            ->getResponse();

        return new AssignResponse($response);
    }

    public function createAddress($segments)
    {
        $segments = [$this->address, ...$segments];

        return implode('/', $segments);
    }

    protected function getDefaultRequest($fields = [], $algos = [])
    {
        $translator = new Translator($fields);

        $convertor = new Convertor($algos);

        $request = new Request();

        $request->setTranslator($translator)
            ->setConvertor($convertor);

        return $request;
    }
}