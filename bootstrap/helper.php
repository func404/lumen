<?php

/**
 * @Author: Jingxinpo
 * @Date:   2018-12-20 15:08:25
 * @Last Modified by:   Jingxinpo
 * @Last Modified time: 2018-12-20 15:20:41
 */
if (! function_exists('number_rand')) {

    /**
     * 生成随机数
     *
     * @param number $length            
     * @return number|string
     */
    function number_rand($length = 4)
    {
        $first = rand(0, 9);
        if ($length == 1) {
            return $first;
        }
        return $first . rand(pow(10, $length - 2), pow(10, $length - 1) - 1);
    }
}

if (! function_exists('hex2str')) {

    /**
     * 将十六进制转化成字符
     *
     * @param string $hex            
     * @param string $delimiter            
     * @return string
     */
    function hex2str($hex, $delimiter = '')
    {
        $string = '';
        if ($delimiter) {
            $hex = explode($delimiter, $hex);
            $size = count($hex);
            for ($i = 0; $i < $size; $i ++) {
                $string .= chr(hexdec($hex[$i]));
            }
            return $string;
        }
        
        if (stripos('0x', $hex)) {
            $hex = substr(strtolower($hex), 2);
            $hex = explode('0x', $hex);
            $size = count($hex);
            for ($i = 0; $i < $size; $i ++) {
                $string .= chr(hexdec($hex[$i]));
            }
        } else {
            $size = strlen($hex);
            for ($i = 0; $i < $size; $i += 2) {
                $string .= chr(hexdec($hex[$i] . $hex[$i + 1]));
            }
        }
        
        return $string;
    }
}

if (! function_exists('str2hex')) {

    /**
     * 字符串转十六进制
     *
     * @param string $str            
     * @param boolean $_0x
     *            格式 0: 不带0x; 1: 带0x
     * @param boolean $case
     *            格式 0: 小写; 1 大写
     * @param string $delimiter
     *            连接符 默认为'' 例如 -
     * @return string
     */
    function str2hex($str, $_0x = false, $case = false, $delimiter = '')
    {
        $hex = '';
        $size = strlen($str);
        
        if ($_0x) {
            for ($i = 0; $i < $size; $i ++) {
                $hex .= '0x' . dechex(ord($str[$i])) . $delimiter;
            }
        } else {
            for ($i = 0; $i < $size; $i ++) {
                $hex .= dechex(ord($str[$i])) . $delimiter;
            }
        }
        
        $hex = ($delimiter) ? substr($hex, 0, - strlen($delimiter)) : $hex;
        
        return ($case) ? strtoupper($hex) : $hex;
    }
}

if (! function_exists('cache_set')) {

    /**
     *
     * @param string $key            
     * @param string $value            
     * @param int|\Datetime $expire
     *            有效时长:以分钟为单位,或者有效期至： 默认为0 不过期 ;
     */
    function cache_set($key, $value, $expire = 0, $prefix = '')
    {
        if (empty($prefix)) {
            $prefix = env('CACHE_PREFIX');
        }
        $key = $prefix . $key;
        if ($expire === 0) {
            Illuminate\Support\Facades\Cache::forever($key, $value);
            return true;
        }
        if (Illuminate\Support\Facades\Cache::has($key)) {
            Illuminate\Support\Facades\Cache::put($key, $value, $expire);
        } else {
            Illuminate\Support\Facades\Cache::add($key, $value, $expire);
        }
        return true;
    }
}

if (! function_exists('cache_get')) {

    /**
     * 获取值
     *
     * @param string $key            
     * @param string $prefix            
     * @return boolean
     */
    function cache_get($key, $prefix = '')
    {
        if (empty($prefix)) {
            $prefix = env('CACHE_PREFIX');
        }
        $key = $prefix . $key;
        return (bool) Illuminate\Support\Facades\Cache::has($key) ? Illuminate\Support\Facades\Cache::get($key) : false;
    }
}

if (! function_exists('cache_flush')) {

    /**
     * 注意安全!!!!!!!
     * 会清除所有cache
     *
     * @param string $key            
     * @param
     *            boolean 清空所有 cache
     */
    function cache_flush()
    {
        return (bool) Illuminate\Support\Facades\Cache::flush();
    }
}

if (! function_exists('cache_has')) {

    /**
     *
     * @param string $key            
     * @param string $prefix            
     * @return boolean
     */
    function cache_has($key, $prefix = '')
    {
        if (empty($prefix)) {
            $prefix = env('CACHE_PREFIX');
        }
        $key = $prefix . $key;
        return (bool) Illuminate\Support\Facades\Cache::has($key);
    }
}

if (! function_exists('cache_unset')) {

    /**
     * 根据key清除缓存
     *
     * @param string $key            
     * @return boolean
     */
    function cache_unset($key, $prefix)
    {
        if (empty($prefix)) {
            $prefix = env('CACHE_PREFIX');
        }
        $key = $prefix . $key;
        return (bool) Illuminate\Support\Facades\Cache::forget($key);
    }
}

if (! function_exists('gbk2utf8')) {

    /**
     * gbk 转 utf-8
     *
     * @param unknown $gbk_string            
     * @return string
     */
    function gbk2utf8($gbk_string)
    {
        return iconv("GBK", "UTF-8", $gbk_string);
    }
}

if (! function_exists('utf82gbk')) {

    /**
     * utf-8 转gbk
     *
     * @param unknown $utf8_string            
     * @return string
     */
    function utf82gbk($utf8_string)
    {
        return iconv("UTF-8", "GBK//IGNORE", $utf8_string);
    }
}

if (! function_exists('is_ipv4')) {

    /**
     *
     * @param string $ipv4            
     * @return boolean
     */
    function is_ipv4($ipv4)
    {
        return (bool) filter_var($ipv4, FILTER_VALIDATE_IP);
    }
}
if (! function_exists('is_email')) {

    /**
     * 验证email 是否合法
     *
     * @param unknown $email            
     * @return boolean
     */
    function is_email($email)
    {
        return (bool) filter_var($email, FILTER_VALIDATE_EMAIL);
    }
}
if (! function_exists('is_url')) {

    /**
     * 验证url是否合法
     *
     * @param string $url            
     * @return boolean
     */
    function is_url($url)
    {
        return (bool) filter_var($url, FILTER_VALIDATE_URL);
    }
}
if (! function_exists('is_phone')) {

    /**
     * 验证手机号是否合法
     *
     * @see configs/const.php
     * @param string $phone            
     * @return boolean
     */
    function is_phone($phone)
    {
        return (bool) preg_match(config('const.PHONE'), trim($phone));
    }
}
if (! function_exists('is_realname')) {

    /**
     * 验证中文姓名是否合法
     *
     * @see config/const.php
     * @param string $realname            
     * @return boolean
     */
    function is_realname($realname)
    {
        return (bool) preg_match(config('const.REALNAME'), trim($realname));
    }
}
if (! function_exists('is_nickname')) {

    /**
     * 验证昵称是否合法
     *
     * @see config/const.php
     * @param string $nickname            
     * @return boolean
     */
    function is_nickname($nickname)
    {
        return (bool) preg_match(config('const.NICKNAME'), trim($nickname));
    }
}
if (! function_exists('is_account')) {

    /**
     * 验证帐号是否合法
     *
     * @see config/const.php
     * @param string $account            
     * @return boolean
     */
    function is_account($account)
    {
        return (bool) preg_match(config('const.ACCOUNT'), trim($account));
    }
}
if (! function_exists('is_idcard')) {

    /**
     * 验证身份证是否合法
     *
     * @see config/const.php
     * @param string $idcard            
     * @return boolean
     */
    function is_idcard($idcard)
    {
        return (bool) preg_match(config('const.IDCARD'), trim($idcard));
    }
}

if (! function_exists('id_number')) {

    /**
     * 创建一个整型ID
     * WOKR_ID 在.env 文件中定义 0-99
     *
     * @return string
     */
    function id_number()
    {
        try {
            $sn = sprintf("%d", microtime(true) * 10000);
            $mark = env('APP_KEY', 'lastid') . '_lastid';
            if (Illuminate\Support\Facades\Redis::exists($mark)) {
                if ($sn <= Illuminate\Support\Facades\Redis::exists($mark)) {
                    Illuminate\Support\Facades\Redis::increment($mark);
                    $sn = Illuminate\Support\Facades\Redis::get($mark);
                }
            }
            Illuminate\Support\Facades\Redis::set($mark, $sn);
            return $sn . sprintf("%02d", ENV('WORK_ID', '99'));
        } catch (\Exception $e) {
            return sprintf("%d", microtime(true) * 10000) . sprintf("%02d", env('WORK_ID', '99'));
        }
    }
}

if (! function_exists('trade_no')) {

    /**
     * 创建一个交易流水号 年月日时分秒开头
     * WOKR_ID 在.env 文件中定义 0-99
     *
     * @param string $prefix
     *            前缀
     * @return string
     */
    function trade_no($prefix = '')
    {
        try {
            list ($second, $microsecond) = explode('.', microtime(true));
            $tradeNO = date("YmdHis", $second) . $microsecond;
            $mark = env('APP_KEY', 'last_trade_no') . '_last_trade_no';
            if (Illuminate\Support\Facades\Redis::exists($mark)) {
                if ($tradeNO <= Illuminate\Support\Facades\Redis::exists($mark)) {
                    Illuminate\Support\Facades\Redis::increment($mark);
                    $tradeNO = Illuminate\Support\Facades\Redis::get($mark);
                }
            }
            Illuminate\Support\Facades\Redis::set($mark, $tradeNO);
            return $prefix . $tradeNO . sprintf("%02d", env('WORK_ID', '99'));
        } catch (\Exception $e) {
            list ($second, $microsecond) = explode('.', microtime(true));
            $tradeNO = date("YmdHis", $second) . $microsecond;
            return $prefix . $tradeNO . sprintf("%02d", env('WORK_ID', '99'));
        }
    }
}

if (! function_exists('trade_number')) {

    /**
     * trade_no 别名
     * 创建一个交易流水号 年月日时分秒开头
     * WOKR_ID 在.env 文件中定义 0-99
     *
     * @param string $prefix
     *            前缀
     * @return string
     */
    function trade_number($prefix = '')
    {
        return trade_no($prefix);
    }
}

if (! function_exists('card_rand')) {

    /**
     * 根据当前无重复的$codes，补充生成长度为$length,总数为$amount的
     *
     * @param int $length
     *            长度
     * @param int $amount
     *            需要总数
     * @param string $prefix
     *            前缀
     * @param array $codes
     *            初始codes
     * @return array $codes 无重复的codes,含输入参数
     */
    function card_rand($length, $amount = 1, $prefix = '', $codes = [])
    {
        $seed = [
            '2',
            '3',
            '4',
            '5',
            '6',
            '7',
            '8',
            '9',
            'A',
            'B',
            'C',
            'D',
            'E',
            'F',
            'G',
            'H',
            'J',
            'K',
            'L',
            'M',
            'N',
            'P',
            'Q',
            'R',
            'S',
            'T',
            'U',
            'V',
            'W',
            'X',
            'Y',
            'Z'
        ];
        $codes_tmp = [];
        $need = $amount - count($codes);
        for ($c = 0; $c < $need; $c ++) {
            $code = '';
            for ($i = 0; $i < $length; $i ++) {
                $index = rand(0, 31);
                $code .= $seed[$index];
            }
            $codes_tmp[] = $prefix . $code;
        }
        $codes = array_unique(array_merge($codes, $codes_tmp));
        unset($codes_tmp);
        $number = count($codes);
        
        $d = $amount - $number;
        if ($d > 0) {
            $codes = array_unique(array_merge($codes, card_rand($length, $amount, $prefix, $codes)));
        }
        return $codes;
    }
}

if (! function_exists('json')) {

    function json($code, $data = [], $message = null)
    {
        $response = [
            'code' => $code,
            'message' => $message ?? trans('rest.' . $code)
        ];
        if ($code == 0) {
            if (empty($data))
                $response['data'] = null;
            else if (preg_match('/^\[/', json_encode($data))) {
                $response['data']['data'] = $data;
            } else {
                $response['data'] = $data;
            }
        }
        return json_encode($response);
    }
}

if (! function_exists('validate')) {

    /**
     *
     * 验证输入参数是否合法
     *
     *
     * @rules config/validator.php
     * @response resources/lang/{local}/validator.php
     *
     * @example validate('demo', [
     *          'title' => '2017-11-02'
     *          ]);
     *         
     *         
     * @param string $method            
     * @param array $parameters            
     * @return boolean 验证通过返回false 验证失败，返回第一条错误信息；
     */
    function validate($method, $parameters = [])
    {
        $validator = Illuminate\Support\Facades\Validator::make($parameters, config('validator.' . $method), trans('validator.' . $method));
        if ($validator->fails()) {
            echo $validator->errors()->first();
        } else {
            return false;
        }
    }
}
if (! function_exists('broadcast')) {

    function broadcast($channel_id, $message)
    {
        $redis = new \Redis();
        $redis->connect(env('REDIS_HOST'), env('REDIS_PORT'), 0.5);
        $redis->auth(env('REDIS_PASSWORD'));
        if ($redis->isConnected()) {
            $redis->publish($channel_id, $message);
            return true;
        } else {
            return false;
        }
    }
}

if (! function_exists('underline2camel')) {

    function underline2camel($string, $ucfirst = true)
    {
        $return = preg_replace_callback('/_+([a-z0-9])/i', function ($matches) {
            return strtoupper($matches[1]);
        }, $string);
        return ($ucfirst) ? ucfirst($return) : $return;
    }
}

if (! function_exists('camel2underline')) {

    function camel2underline($string, $first = false)
    {
        $return = preg_replace_callback('/[A-Z]/', function ($matches) {
            return '_' . strtolower($matches[0]);
        }, $string);
        return ($first) ? $return : substr($return, 1);
    }
}

if (! function_exists('pluralize')) {

    /**
     * 单数转复数
     *
     * @param string $string            
     * @return bool|string|mixed
     */
    function pluralize($string)
    {
        $plural = [
            [
                '/(quiz)$/i',
                "$1zes"
            ],
            [
                '/^(ox)$/i',
                "$1en"
            ],
            [
                '/([m|l])ouse$/i',
                "$1ice"
            ],
            [
                '/(matr|vert|ind)ix|ex$/i',
                "$1ices"
            ],
            [
                '/(x|ch|ss|sh)$/i',
                "$1es"
            ],
            [
                '/([^aeiouy]|qu)y$/i',
                "$1ies"
            ],
            [
                '/([^aeiouy]|qu)ies$/i',
                "$1y"
            ],
            [
                '/(hive)$/i',
                "$1s"
            ],
            [
                '/(?:([^f])fe|([lr])f)$/i',
                "$1$2ves"
            ],
            [
                '/sis$/i',
                "ses"
            ],
            [
                '/([ti])um$/i',
                "$1a"
            ],
            [
                '/(buffal|tomat)o$/i',
                "$1oes"
            ],
            [
                '/(bu)s$/i',
                "$1ses"
            ],
            [
                '/(alias|status)$/i',
                "$1es"
            ],
            [
                '/(octop|vir)us$/i',
                "$1i"
            ],
            [
                '/(ax|test)is$/i',
                "$1es"
            ],
            [
                '/s$/i',
                "s"
            ],
            [
                '/$/',
                "s"
            ]
        ];
        
        $singular = [
            [
                "/s$/",
                ""
            ],
            [
                "/(n)ews$/",
                "$1ews"
            ],
            [
                "/([ti])a$/",
                "$1um"
            ],
            [
                "/((a)naly|(b)a|(d)iagno|(p)arenthe|(p)rogno|(s)ynop|(t)he)ses$/",
                "$1$2sis"
            ],
            [
                "/(^analy)ses$/",
                "$1sis"
            ],
            [
                "/([^f])ves$/",
                "$1fe"
            ],
            [
                "/(hive)s$/",
                "$1"
            ],
            [
                "/(tive)s$/",
                "$1"
            ],
            [
                "/([lr])ves$/",
                "$1f"
            ],
            [
                "/([^aeiouy]|qu)ies$/",
                "$1y"
            ],
            [
                "/(s)eries$/",
                "$1eries"
            ],
            [
                "/(m)ovies$/",
                "$1ovie"
            ],
            [
                "/(x|ch|ss|sh)es$/",
                "$1"
            ],
            [
                "/([m|l])ice$/",
                "$1ouse"
            ],
            [
                "/(bus)es$/",
                "$1"
            ],
            [
                "/(o)es$/",
                "$1"
            ],
            [
                "/(shoe)s$/",
                "$1"
            ],
            [
                "/(cris|ax|test)es$/",
                "$1is"
            ],
            [
                "/([octop|vir])i$/",
                "$1us"
            ],
            [
                "/(alias|status)es$/",
                "$1"
            ],
            [
                "/^(ox)en/",
                "$1"
            ],
            [
                "/(vert|ind)ices$/",
                "$1ex"
            ],
            [
                "/(matr)ices$/",
                "$1ix"
            ],
            [
                "/(quiz)zes$/",
                "$1"
            ]
        ];
        
        $irregular = [
            [
                'move',
                'moves'
            ],
            [
                'sex',
                'sexes'
            ],
            [
                'child',
                'children'
            ],
            [
                'man',
                'men'
            ],
            [
                'person',
                'people'
            ]
        ];
        
        $uncountable = [
            'sheep',
            'fish',
            'series',
            'species',
            'money',
            'rice',
            'information',
            'equipment'
        ];
        
        if (in_array(strtolower($string), $uncountable))
            return $string;
        foreach ($irregular as $noun) {
            if (strtolower($string) == $noun[0])
                return $noun[1];
        }
        
        foreach ($plural as $pattern) {
            if (preg_match($pattern[0], $string)) {
                return preg_replace($pattern[0], $pattern[1], $string);
            }
        }
        
        return $string;
    }
}

if (! function_exists('curl_request')) {

    /**
     *
     * @param string $url
     *            请求地址
     * @param array $parameters
     *            请求参数
     * @param string $method
     *            请求方式 POST GET
     * @param array $cookie
     *            发送的cookie
     * @param number $returnCookie            
     * @return string|unknown
     */
    function curl_request($url, $parameters = [], $method = 'get', $cookie = [], $returnCookie = 0)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_USERAGENT, 'WLXS 1.0;Du Xin;');
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
        // curl_setopt($curl, CURLOPT_AUTOREFERER, 1);
        // curl_setopt($curl, CURLOPT_REFERER, "http://XXX");
        if ('post' == $method) {
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($parameters));
        } else {
            $url .= strpos($url, '?') ? '&' : '?';
            $url .= http_build_query($parameters);
        }
        if ($cookie) {
            $cookies = http_build_query($cookie);
            $cookies = str_replace('=', ';', $cookies) . ';';
            curl_setopt($curl, CURLOPT_COOKIE, $cookies);
        }
        curl_setopt($curl, CURLOPT_HEADER, $returnCookie);
        curl_setopt($curl, CURLOPT_TIMEOUT, 10);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // 跳过证书检查  
        // curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, true);
        $data = curl_exec($curl);
        if (curl_errno($curl)) {
            return curl_error($curl);
        }
        curl_close($curl);
        if ($returnCookie) {
            list ($header, $body) = explode("\r\n\r\n", $data, 2);
            preg_match_all("/Set\-Cookie:([^;]*);/", $header, $matches);
            $info['cookie'] = substr($matches[1][0], 1);
            $info['content'] = $body;
            return $info;
        } else {
            return $data;
        }
    }
}

if (! function_exists('curl_post')) {

    function curl_post($url, $parameters = [])
    {
        return curl_request($url, $parameters, $method = 'post');
        // $client->url .= strpos($client->url, '?') ? '&' : '?';
        // $client->url .= $parameters_string;
    }
}

if (! function_exists('fsock')) {

    function fg_post($url, $data)
    {
        $data = http_build_query($data);
        // $data = json_encode($data);
        $json = file_get_contents($url, 0, stream_context_create(array(
            'http' => array(
                'timeout' => 30,
                'method' => 'POST',
                'content' => $data
            )
        )));
    }
}

if (! function_exists('curl_get')) {

    function curl_get($url, $parameters = [])
    {
        return curl_request($url, $parameters, $method = 'get');
    }
}


if (! function_exists('curljson')) {


    function curljson($url,$parameters)
    { 
        $header = [
            "Accept:application/json",
            "Content-Type:application/json;charset=utf-8",
            "Authorization:wlxs"
        ];
        $ch = curl_init();
        $res = curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($parameters));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        $result = curl_exec($ch);
        if ($result) {
           return $rst = json_decode($result);
        }
        return false;
    }
}

if (! function_exists('sendTplSms')) {

    /**
     * 发送短信
     *
     * @param number $to
     *            手机号
     * @param array $datas
     *            参数列表 和模板ID匹配
     * @param number $tempId
     *            模板ID
     * @return boolean 成功true 失败false
     */
    function sendTplSms($to = 0, $datas = [], $tempId = 0)
    {
        $datetime = date("YmdHis");
        
        $parameters = [
            'to' => $to,
            'templateId' => $tempId,
            'appId' => config('sms.appId'),
            'datas' => $datas
        ];
        
        $header = [
            "Accept:application/json",
            "Content-Type:application/json;charset=utf-8",
            "Authorization:" . base64_encode(config('sms.accountSid') . ":" . $datetime)
        ];
        
        $sig = strtoupper(md5(config('sms.accountSid') . config('sms.accountToken') . $datetime));
        $url = 'https://' . config('sms.serverIP') . ':' . config('sms.serverPort') . '/' . config('sms.softVersion') . '/Accounts/' . config('sms.accountSid') . '/SMS/TemplateSMS?sig=' . $sig;
        $ch = curl_init();
        $res = curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($parameters));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        $result = curl_exec($ch);
        if ($result) {
            $rst = json_decode($result);
            if ($rst->statusCode == '000000') {
                return true;
            }
            return false;
        }
        return false;
    }
}

if (! function_exists('redirect')) {

    function redirect($url)
    {
        echo '<script window.location.href=">' . $url . '</script>';
        exit();
    }
}
if (! function_exists('dt')) {

    /**
     * 时间格式化
     *
     * @param number $type
     *            类型
     *            [0]=>2017-10-11 02:20:23
     *            [1]=>20171011022023
     *            [2]=>2017-10-11
     *            [3]=>20171011
     * @return string|boolean
     */
    function dt($type = 0)
    {
        $time = time();
        switch ($type) {
            case 0:
                return date("Y-m-d H:i:s", $time);
                break;
            case 1:
                return date("Ymdhis", $time);
                break;
            case 2:
                return date("Y-m-d", $time);
                break;
            case 3:
                return date("Ymd", $time);
                break;
            default:
                return false;
                break;
        }
    }
}

if (! function_exists('command_shopping')) {

    /**
     * 购买开门
     *
     * @param int $device_id
     *            设备ID
     * @param string $door_open_id
     *            开门ID
     * @return boolean
     */
    function command_shopping($device_id, $door_open_id)
    {
        $command = 'SHOPPING';
        return broadcast(config('const.BROADCAST_CHANNEL.CLIENT'), json_encode([
            'command' => $command,
            'data' => [
                'device_id' => $device_id,
                'transaction_number' => $door_open_id
            ]
        ]));
    }
}

if (! function_exists('command_store')) {

    /**
     * 备货
     *
     * @param int $device_id
     *            设备ID
     * @param string $door_open_id
     *            开门ID
     * @return boolean
     */
    function command_store($device_id, $store_id)
    {
        $command = 'STORE';
        return broadcast(config('const.BROADCAST_CHANNEL.CLIENT'), json_encode([
            'command' => $command,
            'data' => [
                'device_id' => $device_id,
                'transaction_number' => $door_open_id
            ]
        ]));
    }
}

if (! function_exists('command_inventory')) {

    /**
     * 设备盘存
     *
     * @param int $device_id
     *            设备ID
     * @param string $inventory_id
     *            盘存ID
     * @return boolean
     */
    function command_inventory($device_id, $inventory_id)
    {
        $command = 'INVENTORY';
        return broadcast(config('const.BROADCAST_CHANNEL.CLIENT'), json_encode([
            'command' => $command,
            'data' => [
                'device_id' => $device_id,
                'transaction_number' => $inventory_id
            ]
        ]));
    }
}

if (! function_exists('command_refresh')) {

    /**
     * 刷新
     *
     * @param int $device_id
     *            设备ID
     * @param string $refresh_id
     *            刷新ID
     * @return boolean
     */
    function command_refresh($device_id, $refresh_id)
    {
        $command = 'REFRESH';
        return broadcast(config('const.BROADCAST_CHANNEL.CLIENT'), json_encode([
            'command' => $command,
            'data' => [
                'device_id' => $device_id,
                'transaction_number' => $refresh_id
            ]
        ]));
    }
}

if (! function_exists('command_close')) {

    /**
     * 关闭客户端连接
     *
     * @param array|int $devices
     *            设备ID
     * @param string $close_id
     *            关门业务ID
     * @return boolean
     */
    function command_close($devices, $close_id)
    {
        $command = 'CLOSE';
        return broadcast(config('const.BROADCAST_CHANNEL.CLIENT'), json_encode([
            'command' => $command,
            'data' => [
                'device_id' => $device_id,
                'transaction_number' => $close_id
            ]
        ]));
    }
}

if (! function_exists('command_status')) {

    /**
     * 检查服务器连接情况
     *
     * @param string $check_id
     *            检查ID
     * @return boolean
     */
    function command_status($check_id)
    {
        $command = 'STATUS';
        return broadcast(config('const.BROADCAST_CHANNEL.CLIENT'), json_encode([
            'command' => $command,
            'data' => [
                'transaction_number' => $check_id
            ]
        ]));
    }
}

if (! function_exists('dwz_response')) {

    /**
     *
     * @param unknown $statusCode            
     * @param string $message            
     * @param string $callbackType
     *            "closeCurrentNavTab|closeCurrentDialog",
     * @param string $navTabId            
     * @param string $rel            
     * @param string $forwardUrl            
     * @param string $confirmMsg            
     * @param string $extra            
     */
    function dwz_response($statusCode, $message = '', $callbackType = '', $navTabId = '', $rel = '', $forwardUrl = '', $confirmMsg = '', $extra = '')
    {
        if ($statusCode == 0 || $statusCode == 200) {
            $statusCode = 200;
            $message = $message == '' ? 'success' : $message;
        } elseif ($statusCode == 301) {
            $message = $message == '' ? 'timeout' : $message;
        } else {
            $statusCode = 300;
            $message = $message == '' ? 'timeout' : $message;
        }
        
        return json_encode(compact('statusCode', 'message', 'navTabId', 'rel', 'callbackType', 'forwardUrl', 'confirmMsg', 'extra'));
    }
}

if (! function_exists('xml_post')) {

    function xml_post($url, $data, $auth = 0)
    {

       
       function arrayToXml($arr)
        {
            $xml = "<xml>";
            foreach ($arr as $key => $val) {
                 if (is_numeric($val)) {
                    $xml .= "<" . $key . ">" . $val . "</" . $key . ">";
                } else {
                    $xml .= "<" . $key . "><![CDATA[" . $val . "]]></" . $key . ">";
                }
            }
            $xml .= "</xml>";
            return $xml;
        }

        $data1 = arrayToXml($data);
        $header = [
            "Content-Type:text/xml;charset=utf-8",
        ]; 
        $ch = curl_init(); //初始化curl  
        curl_setopt($ch, CURLOPT_URL, $url);//设置链接  
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);//设置是否返回信息  
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);//设置HTTP头  
        curl_setopt($ch, CURLOPT_POST, 1);//设置为POST方式  
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data1); //POST数据 
        if ($auth == 1) {  //curl 请求进行证书认证
               curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,1);//证书检查
               curl_setopt($ch,CURLOPT_SSLCERTTYPE,'pem');
               curl_setopt($ch,CURLOPT_SSLCERT,'../resources/cert/apiclient_cert.pem');
               curl_setopt($ch,CURLOPT_SSLCERTTYPE,'pem');
               curl_setopt($ch,CURLOPT_SSLKEY,'../resources/cert/apiclient_key.pem');
        } 
        
        $response = curl_exec($ch);//接收返回信息  
        if(curl_errno($ch)){//出错则显示错误信息  
            return curl_error($ch);  
        }  
        curl_close($ch); //关闭curl链接 
        return $response;
    }

    if (!function_exists('export_csv')) {
       function export_csv($data)
      {
          $string="";
          foreach ($data as $key => $value) 
          {
              $string .= implode(",",$value)."\n"; //用英文逗号分开 
          }
          $filename = date('Ymd').'.csv'; //设置文件名
          header("Content-type:text/csv"); 
          header("Content-Disposition:attachment;filename=".$filename); 
          header('Cache-Control:must-revalidate,post-check=0,pre-check=0'); 
          header('Expires:0'); 
          header('Pragma:public'); 
          echo $string; die;
      }
    }

    if (!function_exists('write_log')) {
         function write_log($words='')
        { 
          return Illuminate\Support\Facades\Log::channel('single')->debug(date('Y-m-d H:i:s').':'.$words);
        }
    }

    if (!function_exists('session')) {
    	function session($key,$value=false)
    	{
    		if (func_num_args() == 2) {
    			return app('session')->put($key,$value);
    		}else{
                return app('session')->get($key);
    		}
    	}
    }
}
