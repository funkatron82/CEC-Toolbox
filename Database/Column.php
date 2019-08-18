<?php
namespace CEC\Toolbox\Database;

class Column
{
    private $name;
    public $dataType;
    public $default;
    public $notNull = false;
    public $autoIncrement = false;

    public function __construct($name, DataType $dataType, $notNull = false, $default = null, $autoIncrement = false)
    {
        $this->name = $name; /* @TODO Sanitize this*/
        $this->dataType = $dataType;
        $this->notNull = (bool) $notNull;
        $this->autoIncrement = (bool) $autoIncrement;
        $this->default = $default;  /* @TODO Sanitize this*/
    }

    public function getName()
    {
        return $this->name;
    }

    public function render()
    {
        $output = $this->name . ' ' . $this->dataType->render();
        $output .= $this->notNull ? ' NOT NULL' : '';
        $output .= !empty($this->default) ? ' DEFAULT ' . $this->default : '';
        $output .= $this->autoIncrement ? ' AUTO_INCREMENT' : '';

        return $output;
    }
}
