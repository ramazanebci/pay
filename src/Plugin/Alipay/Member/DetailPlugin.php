<?php

declare(strict_types=1);

namespace Yansongda\Pay\Plugin\Alipay\Member;

use Closure;
use Yansongda\Pay\Contract\PluginInterface;
use Yansongda\Pay\Logger;
use Yansongda\Pay\Rocket;

/**
 * @see https://opendocs.alipay.com/open/a74a7068_alipay.user.info.share?pathHash=af2476d4&ref=api&scene=common
 */
class DetailPlugin implements PluginInterface
{
    public function assembly(Rocket $rocket, Closure $next): Rocket
    {
        Logger::debug('[Alipay][Member][DetailPlugin] 插件开始装载', ['rocket' => $rocket]);

        $params = $rocket->getParams();

        $rocket->mergePayload([
            'auth_token' => $params['auth_token'] ?? $params['_auth_token'] ?? '',
            'method' => 'alipay.user.info.share',
            'biz_content' => [],
        ]);

        Logger::info('[Alipay][Member][DetailPlugin] 插件装载完毕', ['rocket' => $rocket]);

        return $next($rocket);
    }
}
