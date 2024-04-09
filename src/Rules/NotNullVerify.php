<?php
namespace Dizhu\YaVerify\Rules;

use Dizhu\YaVerify\YavCode;
use Dizhu\YaVerify\YavException;

/**
 * 校验：检测值是否是空值
 */
class NotNullVerify extends RulesBase
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
            $msg =  !is_numeric($k) ? $v :"参数[".$key."]的值不能为空";

            if (!isset($data[$key])) {
                throw new YavException($msg, YavCode::PARAM_IS_EMPTY);
            }

            if (is_array($data[$key])) {
                if (count($data[$key]) < 1) {
                    throw new YavException($msg, YavCode::PARAM_IS_EMPTY);
                }
            } else if (trim($data[$key]) == '') {
                throw new YavException($msg, YavCode::PARAM_IS_EMPTY);
            }
        }
    }
}
