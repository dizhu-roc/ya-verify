<?php
namespace Dizhu\YaVerify;

class YavFactory
{
    /**
     * @param string $type
     * @return mixed
     * @throws YavException
     */
    public static function create(string $type)
    {
        $name = str_replace('_', '', ucwords($type, '_'));

        $class = 'Dizhu\YaVerify\Rules\\'.$name.'Verify';
        if (!class_exists($class)) {
            throw new YavException('验证类 ['.$class.'] 不存在', YavCode::VERIFY_CLASS_NOT_EXISTS);
        }

        return new $class;
    }
}