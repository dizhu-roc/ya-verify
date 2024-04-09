<?php
namespace Dizhu\YaVerify\Rules;

use Dizhu\YaVerify\YavCode;
use Dizhu\YaVerify\YavException;

/**
 * 校验：检测值是否是mobile
 */
class IsMobileVerify extends RulesBase
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
            if (!isset($data[$key])) {
                continue;
            }

            $msg = !is_numeric($k) ? $v : "参数[" . $key . "]的值必须为手机号";
            if (!preg_match("/^1[0-9]{10}$/", $data[$key])) {
                throw new YavException($msg, YavCode::PARAM_NOT_MOBILE);
            }
        }
    }
}
