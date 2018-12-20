<?php

/**
 * @Author: Jingxinpo
 * @Date:   2018-12-20 14:38:27
 * @Last Modified by:   Jingxinpo
 * @Last Modified time: 2018-12-20 15:07:32
 */
return [
    'driver' => env('SESSION_DRIVER', 'file'),//默认使用file驱动，你可以在.env中配置
    'lifetime' => 120,//缓存失效时间
    'expire_on_close' => false,
    'encrypt' => false,
    'files' => storage_path('framework/sessions'),//file缓存保存路径
    'connection' => null,
    'table' => 'sessions',
    'lottery' => [2, 100],
    'cookie' => 'laravel_session',
    'path' => '/',
    'domain' => null,
    'secure' => false,
];