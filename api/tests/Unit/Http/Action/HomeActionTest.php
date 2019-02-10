<?php

declare(strict_types=1);

namespace Test\Unit\Http\Action;

use PHPUnit\Framework\TestCase;

use Api\Http\Action\HomeAction;
use Zend\Diactoros\ServerRequest;


class HomeActionTest extends TestCase
{
    public function testSuccess()
    {
        $action = new HomeAction();
        $request = new ServerRequest();
        $response = $action->handle($request);

        self::assertEquals(200, $response->getStatusCode());
        self::assertJson($content = $response->getBody()->getContents());

        $data = json_decode($content, true);

        self::assertEquals([
            'name' => 'App Api',
            'version' => '1.0'
        ], $data);
    }


}