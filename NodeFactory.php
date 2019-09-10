<?php
namespace CEC\Toolbox;

use \CEC\Toolbox\Renderable\Node;
use \CEC\Toolbox\Renderable;

class NodeFactory
{
    public function createTextNode($text)
    {
        return new \CEC\Toolbox\Renderable\Node\TextNode($text);
    }

    public function createRenderableList()
    {
        return new \CEC\Toolbox\Renderable\RenderableList();
    }

    public function createClassList()
    {
        return new \CEC\Toolbox\Renderable\ClassList();
    }

    public function createAttributes()
    {
        return new \CEC\Toolbox\Renderable\Attributes();
    }

    public function createElement($tagName)
    {
        return new \CEC\Toolbox\Renderable\Node\Element(
            $tagName,
            $this->createAttributes(),
            $this->createClassList(),
            $this->createRenderableList()
        );
    }

    public function createFragment()
    {
        return new \CEC\Toolbox\Renderable\Node\Fragment($this->createRenderableList());
    }
}
