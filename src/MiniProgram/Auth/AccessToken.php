<?php
/**
 * This is NOT a freeware, use is subject to license terms
 * @copyright Copyright (c) 2010-2099 Jinan Larva Information Technology Co., Ltd.
 * @link http://www.larva.com.cn/
 * @license http://www.larva.com.cn/license/
 */

namespace EasyBytedance\MiniProgram\Auth;

use EasyWeChat\Kernel\AccessToken as BaseAccessToken;
use Psr\Http\Message\RequestInterface;

/**
 * Class AccessToken
 * @author Tongle Xu <xutongle@gmail.com>
 */
class AccessToken extends BaseAccessToken
{
    /**
     * @var string
     */
    protected $endpointToGetToken = 'https://developer.toutiao.com/api/apps/token';

    /**
     * {@inheritdoc}
     */
    protected function getCredentials(): array
    {
        return [
            'appid' => $this->app['config']['app_id'],
            'secret' => $this->app['config']['app_secret'],
            'grant_type' => 'client_credential',
        ];
    }

    /**
     * @param \Psr\Http\Message\RequestInterface $request
     * @param array $requestOptions
     *
     * @return \Psr\Http\Message\RequestInterface
     *
     * @throws \EasyWeChat\Kernel\Exceptions\HttpException
     * @throws \Psr\SimpleCache\InvalidArgumentException
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidConfigException
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidArgumentException
     * @throws \EasyWeChat\Kernel\Exceptions\RuntimeException
     */
    public function applyToRequest(RequestInterface $request, array $requestOptions = []): RequestInterface
    {
        if ($request->getMethod() == 'POST') {
            if (($params = $this->isJson($request->getBody()->getContents())) != false) {
                $params = \GuzzleHttp\json_encode(array_merge($this->getQuery(), $params),JSON_UNESCAPED_UNICODE);
                return \GuzzleHttp\Psr7\modify_request($request, ['body' => $params]);
            }
            parse_str($request->getBody()->getContents(), $params);
            $params = array_merge($this->getQuery(), $params);
            return \GuzzleHttp\Psr7\modify_request($request, ['body' => $params]);
        } else {
            return parent::applyToRequest($request, $requestOptions);
        }
    }

    /**
     * 判断字符串是否为 Json 格式
     *
     * @param string $data Json 字符串
     * @param bool $assoc 是否返回关联数组。默认返回对象
     *
     * @return array|bool|object 成功返回转换后的对象或数组，失败返回 false
     */
    protected function isJson($data = '', $assoc = true)
    {
        $data = json_decode($data, $assoc);
        if ($data && is_array($data)) {
            return $data;
        }
        return false;
    }

}