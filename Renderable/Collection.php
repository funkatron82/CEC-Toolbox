<?php
namespace CEC\Toolbox\Renderable;

interface Collection extends \CEC\Toolbox\Renderable
{
    public function appendChild(\CEC\Toolbox\Renderable $child);
    public function appendChildren(array $children);
    public function renderChildren();
}
