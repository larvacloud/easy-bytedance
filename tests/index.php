<?php
/**
 * This is NOT a freeware, use is subject to license terms
 * @copyright Copyright (c) 2010-2099 Jinan Larva Information Technology Co., Ltd.
 * @link http://www.larva.com.cn/
 * @license http://www.larva.com.cn/license/
 */
include '../vendor/autoload.php';

$config = [
    'app_id' => 'ttfa4c8cf16576d6a6',
    'app_secret' => '5a800ea4c0cad24032737aad86e3198deace6497',
];

$app = \EasyBytedance\Factory::miniProgram($config);

$res = $app->qrcode->create([
    'appname'=>'toutiao'
]);

print_r($res);

