<?php
namespace Dizhu\YaVerify\Rules;

use Dizhu\YaVerify\YavCode;
use Dizhu\YaVerify\YavException;

/**
 * 校验：检测值是否是一个可以转化成时间戳的日期
 */
class IsDateVerify extends RulesBase
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

            $msg = !is_numeric($k) ? $v :"参数[".$key."]的日期格式不正确";

            if (isset($data[$key]) &&
                strtotime($data[$key]) === false) {
                throw new YavException($msg, YavCode::PARAM_NOT_DATE_TIME);
            }
        }
    }
}
