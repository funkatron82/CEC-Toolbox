<?php
namespace CEC\Toolbox\Admin;

class Choice
{
    public $label;
    public $value;
    public $parent;
    public $disabled = false;

    public function __construct($value, $label='', $parent = null, $disabled = false)
    {
        $this->value = $value;
        $this->label = empty($label) ? (string) $this->value : (string) $label;
        $this->parent = $parent;
        $this->disabled = (bool) $disabled;
    }

    public function __toString()
    {
        return (string) $this->label;
    }
}
