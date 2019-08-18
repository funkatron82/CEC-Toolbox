<?php
namespace CEC\Toolbox\Database;

class DataType
{
    private $length;
    private $allowedArgs = array();

    public function __construct($length = null, $args = array())
    {
        $this->setLength($length);
        $this->setArgs($args);
    }

    public function setLength($length)
    {
        $this->length =  absint($length);
    }

    public function setArgs($args)
    {
        $args = array_intersect_key($args, array_flip($this->allowedArgs));
        foreach ($args as $key => $value) {
            $this->$key = $value;
        }
    }

    public function renderLength()
    {
        if (empty($this->length)) {
            return;
        }

        return sprintf('(%s)', implode(',', (array) $this->length));
    }

    public function renderArgs()
    {
        return;
    }

    public function render()
    {
        return self::NAME . $this->renderLength() . $this->renderArgs();
    }

    public function __toString()
    {
        return $this->render();
    }
}
