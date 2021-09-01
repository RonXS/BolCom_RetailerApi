<?php
/**
 * Copyright © Reach Digital (https://www.reachdigital.io/)
 * See LICENSE.txt for license details.
 */
declare(strict_types=1);

namespace BolCom\RetailerApi\Test\Integration\Handler\Offer;

use BolCom\RetailerApi\Client\ClientConfig;
use BolCom\RetailerApi\Infrastructure\ClientPool;
use BolCom\RetailerApi\Model\Offer\Command\CreateOffer;
use BolCom\RetailerApi\Model\Offer\ConditionCategory;
use BolCom\RetailerApi\Model\Offer\Condition;
use BolCom\RetailerApi\Model\Offer\DeliveryCode;
use BolCom\RetailerApi\Model\Offer\RetailerOfferUpsert;
use BolCom\RetailerApi\Model\Offer\FulfilmentMethod;

class CreateOfferHandlerTest extends \PHPUnit\Framework\TestCase
{
    /** @var \BolCom\RetailerApi\Infrastructure\MessageBus $messageBus */
    private $messageBus;

    protected function setUp(): void
    {
        $clientPool = ClientPool::configure(new ClientConfig(BOL_CLIENT_ID, BOL_CLIENT_SECRET, true));
        $this->messageBus = new \BolCom\RetailerApi\Infrastructure\MessageBus($clientPool);
    }

    public function testCreateNewOffer()
    {
        $this->messageBus->dispatch(CreateOffer::with(
            RetailerOfferUpsert::fromArray([
                'ean' => '9781785882364',
                'condition' => [
                    'name' => Condition::IS_NEW,
                    'category' => ConditionCategory::IS_NEW
                ],
                'reference' => 'SKU123',
                'onHoldByRetailer' => false,
                'unknownProductTitle' => 'My Title',
                'pricing' => [
                    'bundlePrices' => [
                        ['quantity' => 1, 'unitPrice' => 10]
                    ]
                ],
                'stock' => [
                    'amount' => 12,
                    'managedByRetailer' => true
                ],
                'fulfilment' => [
                    'method' => FulfilmentMethod::FBR,
                    'deliveryCode' => DeliveryCode::DC12d
                ]
            ])
        ));
    }

    public function testCreateNewOfferWithComment()
    {
        $this->expectException(\RuntimeException::class);
        $this->messageBus->dispatch(CreateOffer::with(
            RetailerOfferUpsert::fromArray([
                'ean' => '9781785882364',
                'condition' => [
                    'name' => Condition::IS_NEW,
                    'category' => ConditionCategory::IS_NEW,
                    'comment' => 'Excellent condition.'
                ],
                'reference' => 'SKU123',
                'onHoldByRetailer' => false,
                'unknownProductTitle' => 'My Title',
                'pricing' => [
                    'bundlePrices' => [
                        ['quantity' => 1, 'unitPrice' => 10]
                    ]
                ],
                'stock' => [
                    'amount' => 12,
                    'managedByRetailer' => true
                ],
                'fulfilment' => [
                    'method' => FulfilmentMethod::FBR,
                    'deliveryCode' => DeliveryCode::DC12d
                ]
            ])
        ));
    }

    public function testCreateNewOfferWithFBBAndDelivery()
    {
        $this->expectException(\RuntimeException::class);
        $this->messageBus->dispatch(CreateOffer::with(
            RetailerOfferUpsert::fromArray([
                'ean' => '9781785882364',
                'condition' => [
                    'name' => Condition::IS_NEW,
                    'category' => ConditionCategory::IS_NEW,
                ],
                'reference' => 'SKU123',
                'onHoldByRetailer' => false,
                'unknownProductTitle' => 'My Title',
                'pricing' => [
                    'bundlePrices' => [
                        ['quantity' => 1, 'unitPrice' => 10]
                    ]
                ],
                'stock' => [
                    'amount' => 12,
                    'managedByRetailer' => true
                ],
                'fulfilment' => [
                    'method' => FulfilmentMethod::FBB,
                    'deliveryCode' => DeliveryCode::DC12d
                ]
            ])
        ));
    }
}
