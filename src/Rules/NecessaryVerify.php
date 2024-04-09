<?php
namespace Dizhu\YaVerify\Rules;

use Dizhu\YaVerify\YavCode;
use Dizhu\YaVerify\YavException;

/**
 * 校验：检测是否传了指定字段，字段值可为0或空字符串
 */
class NecessaryVerify extends RulesBase
{
    /**
     * @throws YavException
     */
    public function verify($data, $fields): void
    {
        foreach($fields as $k => $v) {
            // 索引数组
            if (is_numeric($k)) {
                $key  = $v;
                $msg  = "请求缺少参数:" . $v;
            // 非索引数组
            } else {
                $key  = $k;
                $msg  = $v;
            }

            // 只判断是否有该字段，值可为0或空串
            if (!isset($data[$key])) {
                throw new YavException($msg, YavCode::MISS_REQUEST_PARAMS);
            }
        }
    }
}
