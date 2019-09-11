<?php
namespace CEC\Toolbox\Renderable;

class Attributes extends \CEC\Toolbox\Collection implements \CEC\Toolbox\Renderable
{
    public function sanitizeName($name)
    {
        //Lower case everything
        $name = strtolower($name);
        //Make alpha (removes all other characters)
        $name = preg_replace("/[^a-z_\s-]/", "", $name);
        //Clean up multiple dashes or whitespaces
        $name = preg_replace("/[\s-]+/", " ", $name);
        //Convert whitespaces and underscore to dash
        $name = preg_replace("/[\s_]/", "-", $name);
        return $name;
    }

    public function offsetGet($offset)
    {
        $offset = $this->sanitizeName($offset);
        return isset($this->array[$offset]) ? $this->array[$offset] : null;
    }

    public function offsetSet($offset, $value)
    {
        $offset = $this->sanitizeName($offset);
        if (is_null($offset)) {
            throw new \InvalidArgumentException("Attribute names must be defined.");
        }
        $this->array[$offset] = is_bool($value) ? $value : @htmlspecialchars((string) $value, ENT_COMPAT | ENT_HTML5);
    }

    public function offsetExists($offset)
    {
        $offset = $this->sanitizeName($offset);
        return isset($this->array[$offset]);
    }

    public function offsetUnset($offset)
    {
        $offset = $this->sanitizeName($offset);
        unset($this->array[$offset]);
    }

    public function renderSingle($offset)
    {
        $offset = $this->sanitizeName($offset);
        $value = $this->array[$offset];
        if (is_bool($value) && true === $value) {
            return sprintf(" %s", $offset);
        } elseif (is_string($value) && !empty($value)) {
            return sprintf(" %s='%s'", $offset, $value);
        }

        return '';
    }
    public function render()
    {
        return array_reduce(array_keys($this->array), function ($renderString, $offset) {
            return $renderString . $this->renderSingle($offset);
        });
    }
}
