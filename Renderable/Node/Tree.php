<?php
namespace CEC\Toolbox\Renderable\Node;

trait Tree
{
    protected $children;
    protected $parent;

    public function appendChild(\CEC\Toolbox\Renderable $child)
    {
        if ($child instanceof \CEC\Toolbox\Renderable\Node) {
            $child->addParent($this);
        }
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

    public function addParent(\CEC\Toolbox\Renderable\Node $parent)
    {
        $this->parent = $parent;
    }

    public function removeParent()
    {
        unset($this->parent);
    }
}
