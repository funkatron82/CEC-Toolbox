<?php
namespace CEC\Toolbox\Database\Column;

class Collection
{
    private $columns = [];

    public function add(\CEC\Toolbox\Database\Column $value)
    {
        $name = $value->getName();
        $this->columns[$name] = $value;
    }

    public function get($name)
    {
        if (array_key_exists($name, $this->columns)) {
            return $this->columns[$name];
        }
    }

    public function __set($name, \CEC\Toolbox\Database\Column $value)
    {
        $this->add($name, $value);
    }

    public function __get($name)
    {
        return $this->get($name);
    }

    public function render()
    {
        $output = array_map(function ($column) {
            return $column->render();
        }, $this->columns);

        return implode(",\n", $output);
    }
}
