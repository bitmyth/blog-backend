<?php 

class LoginCest
{
    // tests
    public function login(ApiTester $I)
    {
        $I->sendPOST('/login', ['password' => '123', 'email' => 'admin@163.com']);

        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); // 200
    }
}
