<?php

namespace Helper;

// here you can define custom actions
// all public methods declared in helper class will be available in $I

class Api extends \Codeception\Module
{

    public function getToken(\ApiTester $I)
    {
        $I->sendPOST('/login', ['password' => '123', 'email' => 'admin@163.com']);
        $response = $I->grabResponse();
        $token = (json_decode($response))->access_token;
        return $token;

    }
}
