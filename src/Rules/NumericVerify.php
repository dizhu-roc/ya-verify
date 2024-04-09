<?php
namespace Dizhu\YaVerify\Rules;

use Dizhu\YaVerify\YavCode;
use Dizhu\YaVerify\YavException;

/**
 * 校验：检测值是否为数字
 */
class NumericVerify extends RulesBase
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
            $msg = !is_numeric($k) ? $v : "参数[".$key."]必须为数字";

            if (isset($data[$key]) && !is_numeric($data[$key])) {
                throw new YavException($msg, YavCode::PARAM_NOT_NUMBER);
            }
        }
    }
}
