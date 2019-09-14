<?php
namespace CEC\Toolbox\Renderable;

interface Node extends \CEC\Toolbox\Renderable
{
    public function appendChild(\CEC\Toolbox\Renderable $child);

    public function appendChildren(array $children);

    public function addParent(\CEC\Toolbox\Renderable\Node $parent);
}
