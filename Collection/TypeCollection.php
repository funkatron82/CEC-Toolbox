<?php
namespace CEC\Toolbox\Collection;

abstract class TypeCollection extends \CEC\Toolbox\Collection
{
    protected $type;

    public function offsetSet($offset, $value)
    {
        if (!$value instanceof $this->type) {
            throw new \InvalidArgumentException("Value must be of type `($this->type)`.");
        }
        parent::offsetSet($offset, $value);
    }
}
