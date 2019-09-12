<?php

namespace CEC\Toolbox;

abstract class Collection implements \ArrayAccess, \Iterator, \Countable
{
    protected $array = [];

    public function offsetGet($offset)
    {
        return isset($this->array[$offset]) ? $this->array[$offset] : null;
    }

    public function offsetSet($offset, $value)
    {
        if (is_null($offset)) {
            $this->array[] = $value;
        } else {
            $this->array[$offset] = $value;
        }
    }

    public function offsetExists($offset)
    {
        return isset($this->array[$offset]);
    }

    public function offsetUnset($offset)
    {
        unset($this->array[$offset]);
    }

    public function current()
    {
        return current($this->array);
    }

    public function next()
    {
        next($this->array);
    }

    public function key()
    {
        return key($this->array);
    }

    public function valid()
    {
        return isset($this->array[$this->key()]);
    }

    public function rewind()
    {
        reset($this->array);
    }

    public function count()
    {
        return count($this->array);
    }
}
