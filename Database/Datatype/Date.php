<?php
namespace CEC\Toolbox\Database\DataType;

class Date extends \CEC\Toolbox\Database\DataType
{
    const NAME = 'DATE';

    public function setLength($length)
    {
        $this->length =  null;
    }
}
