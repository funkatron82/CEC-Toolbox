<?php
namespace CEC\Toolbox\Renderable;

class ClassList implements \CEC\Toolbox\Renderable
{
    protected $classes = [];

    public function sanitize($class)
    {
        //Make alphanumeric with dashes and underscores (removes all other characters)
        $class = preg_replace("/[^a-z0-9A-Z_-]/", "", $class);
        //Classes only begin with an underscore or letter
        $class = preg_replace("/^-*[0-9]+/", "", $class);
        return 2 <= strlen($class) ? $class : '';
    }

    public function add(...$classes)
    {
        array_walk($classes, function ($class) {
            $class = $this->sanitize($class);
            $this->classes[$class] = true;
        });
    }

    public function remove(...$classes)
    {
        array_walk($classes, function ($class) {
            $class = $this->sanitize($class);
            $this->classes[$class] = false;
        });
    }

    public function removeAll()
    {
        array_walk($this->classes, function (&$class, $key) {
            $class = false;
        });
    }

    public function contains($class)
    {
        $class = $this->sanitize($class);
        return (isset($this->$classes[$class]) && $this->$classes[$class]);
    }

    public function toggle($class, $force = null)
    {
        $class = $this->sanitize($class);
        $this->classes[$class] = is_bool($force) ? $force : !$this->classes[$class];
        return $this->classes[$class];
    }

    public function replace($old, $new)
    {
        $this->remove($old);
        $this->add($new);
    }

    public function render()
    {
        return implode(' ', array_keys(array_filter($this->classes)));
    }
}
