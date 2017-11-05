<?php

namespace IceTea\Routing;

use ArrayAccess;

class BindedValue implements ArrayAccess
{
   
    /**
     * @var array
     */
    private $container = [];

    public function __construct($data)
    {
        $this->container = $data;
    }

    public function toArray()
    {
        return $this->container;
    }

    public function offsetSet($offset, $value)
    {
        if (is_null($offset)) {
            $this->container[] = $value;
        } else {
            $this->container[$offset] = $value;
        }
    }

    public function offsetExists($offset)
    {
        return isset($this->container[$offset]);
    }

    public function offsetUnset($offset)
    {
        unset($this->container[$offset]);
    }

    public function offsetGet($offset)
    {
        return isset($this->container[$offset]) ? $this->container[$offset] : null;
    }

    public function __debugInfo()
    {
        return $this->container;
    }
}
