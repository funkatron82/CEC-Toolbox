<?php
namespace CEC\Toolbox\Database\Datatype;

class Factory
{
    public $parentTypes = array( 'text', 'int', 'blob' );

    public function build($type, $length = null, $args = array())
    {
        $class = ucfirst($type);
        $class = $this->formatSubType($class);
        $class = sprintf("%s\\%s", __NAMESPACE__, $class);
        if (class_exists($class)) {
            return new $class($length, $args);
        }
    }

    public function formatSubType($text)
    {
        foreach ($this->parentTypes as $type) {
            $text = str_replace($type, ucfirst($type), $text);
        }

        return $text;
    }
}
