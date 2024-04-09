<?php
namespace Dizhu\YaVerify\Rules;

use Dizhu\YaVerify\YavCode;
use Dizhu\YaVerify\YavException;

/**
 * 校验：检测值是否在给定的数组中
 */
class IsArrayVerify extends RulesBase
{
    /**
     * @throws YavException
     */
    public function verify($data, $fields): void
    {
        foreach ($fields as $k => $v) {
            if (!isset($data[$k])) {
                continue;
            }

            $key = $k;
            if (is_numeric($k)) {
                $key = $v;
            }
            if (!isset($data[$key])) {
                continue;
            }

            $msg = !is_numeric($k) ? $v :"参数[".$key."]的值必须为数组";

            if (!is_array($data[$key])) {
                throw new YavException($msg, YavCode::PARAM_NOT_ARRAY_VALUE);
            }
        }
    }
}
