<?php
namespace Dizhu\YaVerify\Rules;

use Dizhu\YaVerify\YavCode;
use Dizhu\YaVerify\YavException;
use App\Sdks\Helpers\Utils;

/**
 * 校验：检测值是否在给定的数组中
 */
class InArrayVerify extends RulesBase
{
    /**
     * @throws \ReflectionException
     * @throws YavException
     */
    public function verify($data, $fields): void
    {
        foreach ($fields as $k => $v) {
            if (!isset($data[$k])) {
                continue;
            }

            // 给定的配置不是数组的情况
            if (!is_array($v['array'])) {
                list($class, $method) = explode('::', $v['array']);
                $arr = Utils::callMethod($class, $method, []);
            } else {
                $arr = $v['array'];
            }

            $msg = !empty($v['err_msg']) ? $v['err_msg'] : "参数[" . $k . "]的值不在正确范围内";

            // 判定
            if (!in_array($data[$k], $arr)) {
                throw new YavException($msg, YavCode::PARAM_NOT_IN_ARRAY);
            }
        }
    }
}
