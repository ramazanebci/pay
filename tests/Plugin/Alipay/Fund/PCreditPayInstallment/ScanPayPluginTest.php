<?php

namespace Yansongda\Pay\Tests\Plugin\Alipay\Fund\PCreditPayInstallment;

use Yansongda\Pay\Direction\ResponseDirection;
use Yansongda\Pay\Plugin\Alipay\Fund\PCreditPayInstallment\ScanPayPlugin;
use Yansongda\Pay\Rocket;
use Yansongda\Pay\Tests\TestCase;

class ScanPayPluginTest extends TestCase
{
    protected ScanPayPlugin $plugin;

    protected function setUp(): void
    {
        parent::setUp();

        $this->plugin = new ScanPayPlugin();
    }

    public function testNormal()
    {
        $rocket = (new Rocket())
            ->setParams([]);

        $result = $this->plugin->assembly($rocket, function ($rocket) { return $rocket; });

        $payload = $result->getPayload()->toJson();

        self::assertNotEquals(ResponseDirection::class, $result->getDirection());
        self::assertStringContainsString('alipay.trade.precreate', $payload);
    }
}
