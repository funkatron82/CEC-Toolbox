<?php
namespace CEC\Toolbox\Admin\Node;

class Fragment implements \CEC\Toolbox\Admin\Node
{
    use \CEC\Toolbox\Admin\Tree;

    public function __construct(array $children = [])
    {
        if (!empty($children)) {
            $this->appendChildren($children);
        }
    }

    public static function create(array $children = [])
    {
        return new Fragment($children);
    }

    public function render()
    {
        $childrenString = "";
        foreach ($this->children as $child) {
            $childrenString .= $child;
        }

        return $childrenString;
    }

    public function __toString()
    {
        return $this->render();
    }
}
