<?php
namespace CEC\Toolbox\Admin;

trait Tree
{
    public $children = [];

    public function appendChild(\CEC\Toolbox\Admin\Node $node)
    {
        $this->children[] = $node;
        return $this;
    }

    public function appendChildren(array $nodes)
    {
        foreach ($nodes as $node) {
            $this->appendChild($node);
        }
        return $this;
    }
}
