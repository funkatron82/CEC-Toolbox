<?php
namespace CEC\Toolbox\Admin\Node;

class Text implements \CEC\Toolbox\Admin\Node
{
    protected $text;
    public function __construct($text)
    {
        $this->text  = (string) $text;
    }

    public function edit($text)
    {
        $this->text  = (string) $text;
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
