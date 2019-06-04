<?php

class PostCest
{
    public function _before(ApiTester $I)
    {
        $token = $I->getToken($I);
        $I->haveHttpHeader('Authorization', 'bearer '.$token);
        $I->haveHttpHeader('Accept', 'application/json');
    }

    public function index(ApiTester $I)
    {
        $I->sendGET('/posts');
        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::OK);
    }

    public function store(ApiTester $I)
    {
        $faker = \Faker\Factory::create();
        $sentence = $faker->sentence;
        $I->sendPOST('/posts', [
            'title'   => $sentence,
            'user_id' => 1,
            'excerpt' => $faker->text,
            'content' => $faker->text,
        ]);

        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::CREATED); // 201
    }

    public function update(ApiTester $I)
    {
        $faker = \Faker\Factory::create();
        $sentence = $faker->sentence;
        $I->sendPOST('/posts/1', [
            'title' => $sentence,
            'name'  => str_slug($sentence),
        ]);

        $I->seeResponseCodeIs(\Codeception\Util\HttpCode::CREATED); // 201
    }
}
