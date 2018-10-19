<?php

class CommentCest
{
    public function _before(ApiTester $I)
    {
        $token = $I->getToken($I);
        $I->haveHttpHeader('Authorization', 'bearer ' . $token);
        $I->haveHttpHeader('Accept', 'application/json');
    }

    // tests
    public function delete(ApiTester $I)
    {

        $I->sendDELETE('/comments/12');

        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::NO_CONTENT);
    }

    public function show(ApiTester $I)
    {

        $I->sendGET('/comments/12');

        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK);
    }

    public function store(ApiTester $I)
    {
        $faker = \Faker\Factory::create();
        $I->sendPOST('/comments', [
            'post_id' => 1,
            'content' => $faker->text
        ]);

        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::CREATED);
    }
}
