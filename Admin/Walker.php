<?php
namespace CEC\Toolbox\Admin;

abstract class Walker
{
    public $maxDepth = 0;

    public $topLevel = [];

    public $childLevels = [];

    public $values;

    public function reset()
    {
        $this->maxDepth = 0;
        $this->topLevel = [];
        $this->childLevels = [];
    }

    public function isChosen(Choice $choice)
    {
        if (empty($this->values)) {
            return false;
        }
        $values = array_map(
            function ($value) {
                return (string) $value;
            },
            $this->values
        );
        return in_array((string) $choice->value, $values);
    }

    public function walkChoices(array $choices, $depth)
    {
        return array_map(function ($choice) use ($depth) {
            if (($this->maxDepth == 0 || $this->maxDepth > $depth + 1) && isset($this->childLevels[ $choice->value ])) {
                $elements = $this->walkChoices($this->childLevels[$choice->value], $depth+1);
                $sublevel = $this->createLevel($elements, $depth+1);
                unset($this->childLevels[ $choice->value ]);
            }
            return $this->createElement($choice, $depth, $sublevel);
        }, array_filter($choices));
    }

    abstract public function createLevel(array $elements, $depth);

    abstract public function createElement(Choice $choice, $depth, Node $sublevel = null);

    public function walk($choices, $maxDepth)
    {
        //invalid parameter or nothing to walk
        if ($maxDepth < -1 || empty($choices)) {
            return [];
        }

        $choices = array_filter($choices);
        $this->reset();
        $this->maxDepth = (int) $maxDepth;

        // flat display
        if (-1 == $maxDepth) {
            $elements = $this->walkChoices($choices, 0);
            return array_filter($elements);
        }

        //hierarchical display
        foreach ($choices as $choice) {
            if (empty($choice->parent)) {
                $this->topLevel[] = $choice;
            } else {
                $this->childLevels[ $choice->parent ][] = $choice;
            }
        }

        if (empty($this->topLevel)) {
            $first = array_slice($choices, 0, 1);
            $root  = $first[0];

            $this->reset();
            $this->maxDepth = (int) $maxDepth;
            foreach ($choices as $choice) {
                if ($root->parent == $choice->parent) {
                    $this->topLevel[] = $choice;
                } else {
                    $this->childLevels[ $choice->parent ][] = $choice;
                }
            }
        }

        $elements = $this->walkChoices($this->topLevel, 0);

        //Display any orphans
        if (($this->maxDepth == 0) && count($this->childLevels) > 0) {
            $orphans = [];
            foreach ($this->childLevels as $key => $level) {
                foreach ($level as $orphan) {
                    $orphans[] = $orphan;
                }
                unset($this->childLevels[$key]);
            }
            $orphanElements =  $this->walkChoices($orphans, 0);
            $elements = array_merge($elements, $orphanElements);
        }

        return array_filter($elements);
    }
}
