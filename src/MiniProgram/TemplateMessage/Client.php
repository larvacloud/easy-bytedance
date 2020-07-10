<?php
/**
 * This is NOT a freeware, use is subject to license terms
 * @copyright Copyright (c) 2010-2099 Jinan Larva Information Technology Co., Ltd.
 * @link http://www.larva.com.cn/
 * @license http://www.larva.com.cn/license/
 */

namespace EasyBytedance\MiniProgram\TemplateMessage;

use EasyBytedance\MiniProgram\BaseClient;
use EasyWeChat\Kernel\Exceptions\InvalidArgumentException;

/**
 * Class Client
 * @author Tongle Xu <xutongle@gmail.com>
 */
class Client extends BaseClient
{
    /**
     * @var array
     */
    protected $format = [
        'touser' => '',
        'template_id' => '',
        'page' => '',
        'form_id' => '',
        'data' => [],
    ];

    /**
     * @var array
     */
    protected $required = [
        ['touser'],
        ['template_id'],
        ['form_id'],
        ['data'],
    ];

    /**
     * 发送模板消息
     * @param array $data
     * @return \Psr\Http\Message\ResponseInterface
     * @throws InvalidArgumentException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function send(array $data)
    {
        return $this->httpPost('/api/apps/game/template/send', $this->format($data));
    }

    /**
     * @param array $data
     *
     * @return array
     * @throws InvalidArgumentException
     */
    protected function format(array $data): array
    {
        $format = [];
        foreach (array_keys($this->format) as $field) {
            isset($data[$field]) && $format[$field] = $data[$field];
        }
        foreach ($this->required as $required) {
            $valid = false;
            foreach ($required as $field) {
                if (isset($format[$field])) {
                    $valid = true;
                    break;
                }
            }
            if (!$valid) {
                throw new InvalidArgumentException(sprintf('[%s]不能同时为空!', implode(',', $required)));
            }
        }
        return $format;
    }
}