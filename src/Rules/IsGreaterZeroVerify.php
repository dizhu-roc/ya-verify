<?php
namespace Dizhu\YaVerify\Rules;

use Dizhu\YaVerify\YavCode;
use Dizhu\YaVerify\YavException;

/**
 * 是否大于 0
 */
class IsGreaterZeroVerify extends RulesBase
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
            $msg = !is_numeric($k) ? $v : '参数[' . $key . ']的值必须大于0';

            if (!is_int((int)$data[$k]) || $data[$k] <= 0) {
                throw new YavException($msg, YavCode::PARAM_NOT_GREATER_THAN_ZERO);
            }
        }
    }
}
