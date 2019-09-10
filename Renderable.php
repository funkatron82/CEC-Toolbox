<?php
namespace CEC\Toolbox;

/**
 * A renderable object that renders into text
 */
interface Renderable
{
    /**
     * Returns a string
     * @return  string string representation of object
     */
    public function render();
}
