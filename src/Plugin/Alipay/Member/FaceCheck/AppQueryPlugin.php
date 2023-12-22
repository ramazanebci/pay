<?php

declare(strict_types=1);

namespace Yansongda\Pay\Plugin\Alipay\Member\FaceCheck;

use Closure;
use Yansongda\Pay\Contract\PluginInterface;
use Yansongda\Pay\Logger;
use Yansongda\Pay\Rocket;

/**
 * @see https://opendocs.alipay.com/open/03nisv?pathHash=3f259e83&ref=api&scene=common
 */
class AppQueryPlugin implements PluginInterface
{
    public function assembly(Rocket $rocket, Closure $next): Rocket
    {
        Logger::debug('[Alipay][Member][FaceCheck][AppQueryPlugin] 插件开始装载', ['rocket' => $rocket]);

        $rocket->mergePayload([
            'method' => 'datadigital.fincloud.generalsaas.face.check.query',
            'biz_content' => $rocket->getParams(),
        ]);

        Logger::info('[Alipay][Member][FaceCheck][AppQueryPlugin] 插件装载完毕', ['rocket' => $rocket]);

        return $next($rocket);
    }
}
