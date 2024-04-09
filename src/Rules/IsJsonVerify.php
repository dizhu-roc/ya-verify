<?php
namespace Dizhu\YaVerify\Rules;

use Dizhu\YaVerify\YavCode;
use Dizhu\YaVerify\YavException;

/**
 * 校验：检测值是否是json
 */
class IsJsonVerify extends RulesBase
{
    /**
     * @throws YavException
     */
    public function verify($data, $fields): void
    {
        foreach($fields as $k => $v) {
            $key = $k;
            if(is_numeric($k)){
                $key = $v;
            }
            if(!isset($data[$key])){
                continue;
            }

            $msg = !is_numeric($k) ? $v :"参数[".$key."]的值必须为Json字符串";

            if(empty($data[$key]) || !is_array(json_decode($data[$key],true))){
                throw new YavException($msg, YavCode::PARAM_NOT_JSON_VALUE);
            }
        }
    }
}
