<?php
class ApiCest 
{    
    public function tryApi(ApiTester $I)
    {
        $I->sendGet('/');
        $I->seeResponseCodeIs(404);
        $I->seeResponseIsJson();
    }

    // TODO add more tests
}
