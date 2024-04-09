<?php
namespace Dizhu\YaVerify\Rules;

use Dizhu\YaVerify\YavCode;
use Dizhu\YaVerify\YavException;

/**
 * 是否邮箱
 */
class IsEmailVerify extends RulesBase
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

            $msg = !is_numeric($k) ? $v : '参数[' . $key . ']的值必须为邮箱';
            if (!preg_match("/^([_a-z0-9-]+)(\.[_a-z0-9-]+)*@([a-z0-9-]+)(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/", $data[$key])) {
                throw new YavException($msg, YavCode::PARAM_NOT_EMAIL);
            }
        }
    }
}
