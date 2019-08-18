<?php
namespace CEC\Toolbox\Admin\Walker;

use CEC\Toolbox\Admin\Walker;

class Option extends \CEC\Toolbox\Admin\Walker
{
    public function createElement(\CEC\Toolbox\Admin\Choice $choice, $depth, \CEC\Toolbox\Admin\Node $sublevel = null)
    {
        $indent = str_repeat('&nbsp;', $depth * 4);
        $label = new \CEC\Toolbox\Admin\Node\Text($indent . $choice->label);
        $option = new \CEC\Toolbox\Admin\Node\Element('option', ['value'=>$choice->value, 'selected'=>$this->isChosen($choice), 'disabled'=>$choice->disabled], [$label]);
        $fragment = new \CEC\Toolbox\Admin\Node\Fragment([$option]);
        if (!empty($sublevel)) {
            $fragment->appendChild($sublevel);
        }
        return $fragment;
    }

    public function createLevel(array $elements, $depth)
    {
        return new \CEC\Toolbox\Admin\Node\Fragment($elements);
    }
}
