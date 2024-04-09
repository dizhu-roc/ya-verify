<?php
namespace Dizhu\YaVerify\Rules;

abstract class RulesBase
{
    abstract function verify($data, $fields);
}
