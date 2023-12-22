<?php

declare(strict_types=1);

namespace Yansongda\Pay\Plugin\Alipay\Member\Certification;

use Closure;
use Yansongda\Pay\Contract\PluginInterface;
use Yansongda\Pay\Logger;
use Yansongda\Pay\Rocket;

/**
 * @see https://opendocs.alipay.com/open/02ahjy?pathHash=ed72e8ea&ref=api&scene=common
 */
class InitPlugin implements PluginInterface
{
    public function assembly(Rocket $rocket, Closure $next): Rocket
    {
        Logger::debug('[Alipay][Member][Certification][AppInitPlugin] 插件开始装载', ['rocket' => $rocket]);

        $rocket->mergePayload([
            'method' => 'alipay.user.certify.open.initialize',
            'biz_content' => array_merge(
                [
                    'product_code' => 'FACE',
                ],
                $rocket->getParams(),
            ),
        ]);

        Logger::info('[Alipay][Member][Certification][AppInitPlugin] 插件装载完毕', ['rocket' => $rocket]);

        return $next($rocket);
    }
}
