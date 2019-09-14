<?php
namespace CEC\Toolbox\Renderable\Node;

class TextNode implements \CEC\Toolbox\Renderable\Node
{
    use \CEC\Toolbox\Renderable\Node\Tree;
    protected $text;
    public function __construct($text)
    {
        $this->text  = (string) $text;
    }

    public function edit($text)
    {
        $this->text  = (string) $text;
    }

    public function appendChild(\CEC\Toolbox\Renderable $child)
    {
        $this->text .= $child->render();
        return $this;
    }

    public function render()
    {
        return $this->text;
    }

    public function __toString()
    {
        return $this->render();
    }
}
