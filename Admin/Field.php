<?php
namespace CEC\Toolbox\Admin;

class Field
{
    const REQUIRED = 1;
    const DISABLED = 2;
    const READONLY = 4;

    public $flags = 0;

    public function isRequired()
    {
        return bool(self::REQUIRED & $this->flags);
    }

    public function isDisabled()
    {
        return bool(self::DISABLED & $this->flags);
    }

    public function isReadonly()
    {
        return bool(self::READONLY & $this->flags);
    }
}
