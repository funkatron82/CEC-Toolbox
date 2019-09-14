<?php
namespace CEC\Toolbox\Renderable\Node;

class Fragment implements \CEC\Toolbox\Renderable\Node
{
    use \CEC\Toolbox\Renderable\Node\Tree;
    public function __construct(\CEC\Toolbox\Renderable\RenderableList $children)
    {
        $this->children = $children;
    }

    public function render()
    {
        return $this->children->render();
    }

    public function __toString()
    {
        return $this->render();
    }
}
