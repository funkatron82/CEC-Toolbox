<?php
namespace CEC\Toolbox\Renderable\Node;

class Fragment implements \CEC\Toolbox\Admin\Node
{
    public function __construct(\CEC\Toolbox\Renderable\RenderableList $children)
    {
        $this->children = $children;
    }

    public function appendChild(\CEC\Toolbox\Renderable $child)
    {
        $this->children[] = $child;
        return $this;
    }

    public function appendChildren(array $children)
    {
        foreach ($children as $child) {
            $this->appendChild($child);
        }
        return $this;
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
