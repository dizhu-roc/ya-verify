<?php
namespace Dizhu\YaVerify;

class Yav
{
    public $sets = array();

    public function __construct(array $sets)
    {
        $this->sets = $sets;
    }

    /**
     * @throws YavException
     */
    public function verify(array $data): void
    {
        if ($this->sets) {
            try {
                foreach ($this->sets as $type => $item) {
                    $obj = YavFactory::create($type);
                    $obj->verify($data, $item);
                }
            } catch (YavException $e) {
                throw new YavException($e->getMessage(), $e->getCode());
            }
        }
    }
}