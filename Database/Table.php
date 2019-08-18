<?php
namespace CEC\Toolbox\Database;

class Table
{
    private $name;
    private $indexes;
    private $primary;
    private $unique;
    private $columns = [];

    public function __construct($name, $columns, $constraints)
    {
    }

    public function addColumn(Column $column)
    {
        $columns[] = $column;
    }

    public function addColumns($columns)
    {
        foreach ($columns as $column) {
            $this->addColumn($column);
        }
    }
}
