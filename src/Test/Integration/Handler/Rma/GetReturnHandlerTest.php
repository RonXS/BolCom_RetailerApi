<?php
/**
 * Copyright © Reach Digital (https://www.reachdigital.io/)
 * See LICENSE.txt for license details.
 */
declare(strict_types=1);

namespace BolCom\RetailerApi\Test\Integration\Handler\Rma;

use BolCom\RetailerApi\Client\ClientConfig;
use BolCom\RetailerApi\Infrastructure\ClientPool;
use BolCom\RetailerApi\Model\Rma\Query\GetReturn;
use BolCom\RetailerApi\Model\Rma\ReturnId;

class GetReturnHandlerTest extends \PHPUnit\Framework\TestCase
{
    public function test__invoke()
    {
        $clientPool = ClientPool::configure(new ClientConfig(BOL_CLIENT_ID, BOL_CLIENT_SECRET, true));
        $messageBus = new \BolCom\RetailerApi\Infrastructure\MessageBus($clientPool);

        $messageBus->dispatch(GetReturn::with(ReturnId::fromScalar('15892026')));
    }
}
