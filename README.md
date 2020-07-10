## EasyBytedance

字节跳动小程序SDK，参照[easy-wechat](https://github.com/overtrue/wechat)实现


## 功能
- [x] 小程序

## 安装

```bash
composer require larvacloud/easy-bytedance -vv
```

## 基本使用

参考[easy-wechat](https://github.com/overtrue/wechat)使用文档，用法基本上和easy-wechat一致。

```php
// 配置好config，获取code...

$app = EasyBytedance\Factory::miniProgram($config);

```

## License

MIT License