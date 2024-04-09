<?php
namespace Dizhu\YaVerify\Rules;

use Dizhu\YaVerify\YavCode;
use Dizhu\YaVerify\YavException;

/**
 * 校验：检测值是否为 正整数
 */
class DigitsVerify extends RulesBase
{
    /**
     * @throws YavException
     */
    public function verify($data, $fields): void
    {
        foreach ($fields as $k => $v) {
            $key = $k;
            if (is_numeric($k)) {
                $key = $v;
            }
            $msg = !is_numeric($k) ? $v : "参数[".$key."]必须为正整数";

            if (isset($data[$key]) && (
                    !is_numeric($data[$key]) ||
                    intval($data[$key]) - abs($data[$key]) != 0 || //是否是小数以及负数
                    count(explode('.',$data[$key])) > 1)) {   //是否是类似 1.00 类似的小数
                throw new YavException($msg, YavCode::PARAM_NOT_DIGITS_NUMBER);
            }
        }
    }
}
