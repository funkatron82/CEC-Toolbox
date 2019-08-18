<?php
namespace CEC\Toolbox;

/**
 * A renderable object that renderes into text
 */
interface Renderable
{
    /**
     * Returns a string
     * @return  string string representation of object
     */
    public function render();
}
