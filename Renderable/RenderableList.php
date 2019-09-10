<?php
namespace CEC\Toolbox\Renderable;

class RenderableList extends \CEC\Toolbox\Collection\TypeCollection implements \CEC\Toolbox\Renderable
{
    protected $type = '\CEC\Toolbox\Renderable';

    public function render()
    {
        return array_reduce($this->array, function ($renderString, $item) {
            return $renderString . $item->render();
        });
    }
}
