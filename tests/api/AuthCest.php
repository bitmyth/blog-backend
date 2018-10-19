<?php

class AuthCest
{
    public function _before(ApiTester $I)
    {
        $token = $I->getToken($I);
        $I->haveHttpHeader('Authorization', 'bearer ' . $token);
    }

    // tests
    public function me(ApiTester $I)
    {
        $I->sendPOST('/me');

        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); // 200
    }

    public function logout(ApiTester $I)
    {
        $I->sendPOST('/logout');

        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK); // 200

    }
}
