<?php

class TermCest
{
    public function _before(ApiTester $I)
    {
        $token = $I->getToken($I);
        $I->haveHttpHeader('Authorization', 'bearer ' . $token);
        $I->haveHttpHeader('Accept', 'application/json');
    }

    // tests
    public function store(ApiTester $I)
    {

        $I->sendPOST('/terms', ['name' => 'name', 'slug' => 'slug']);

        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::UNPROCESSABLE_ENTITY); // 422

        $I->sendPOST('/terms', ['name' => 'name', 'slug' => 'slug', 'taxonomy' => 'tag']);

        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::CREATED); // 200
    }
}
