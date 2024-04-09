<?php
namespace Dizhu\YaVerify\Rules;

use Dizhu\YaVerify\YavCode;
use Dizhu\YaVerify\YavException;

/**
 * 校验：检测字符串长度是否在限定范围内
 */
class LengthLimitVerify extends RulesBase
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

            $len = mb_strlen($data[$k], 'utf8');

            if (isset($v['min']) && $len < $v['min']) {
                $msg = !empty($v['min_err_msg']) ? $v['min_err_msg'] : "参数[". $k ."]过短";
                throw new YavException($msg, YavCode::PARAM_TOO_SHORT);
            }

            if (isset($v['max']) && $len > $v['max']) {
                $msg = !empty($v['max_err_msg']) ? $v['max_err_msg'] : "参数[". $k ."]过长";
                throw new YavException($msg, YavCode::PARAM_TOO_LONG);
            }
        }
    }
}
