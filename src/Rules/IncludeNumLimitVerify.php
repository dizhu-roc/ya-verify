<?php
namespace Dizhu\YaVerify\Rules;

use Dizhu\YaVerify\YavCode;
use Dizhu\YaVerify\YavException;

/**
 * 校验：检测字段内包含元素的数量是否在限定范围内
 */
class IncludeNumLimitVerify extends RulesBase
{
    /**
     * @throws YavException
     */
    public function verify($data, $fields): void
    {
        foreach ($fields as $k => $v) {
            $len = empty($data[$k]) ? 0 : count(array_filter(explode(',', $data[$k])));

            // 最小数量校验
            if ( isset($v['min']) && $len < $v['min'] ) {
                $code = $v['min_err_code'] ?? YavCode::PARAM_TOO_SHORT;
                throw new YavException($k, $code);
            }

            // 最大数量校验
            if ( isset($v['max']) && $len > $v['max'] ) {
                $code = $v['max_err_code'] ?? YavCode::PARAM_TOO_LONG;
                throw new YavException($k, $code);
            }
        }
    }
}
