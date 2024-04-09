<?php
namespace Dizhu\YaVerify\Rules;

use Dizhu\YaVerify\YavCode;
use Dizhu\YaVerify\YavException;

/**
 * 校验：检测值是否为价格
 */
class PriceVerify extends RulesBase
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
            $msg = !is_numeric($k) ? $v : "参数[".$key."]不是有效金额";

            if (isset($data[$key])
                && (!is_numeric($data[$key])
                    || (!preg_match('/^[0-9]+\.\d{2}$/',$data[$key]) && $data[$key] != 0))) {
                throw new YavException($msg, YavCode::PARAM_NOT_PRICE);
            }
        }
    }
}
