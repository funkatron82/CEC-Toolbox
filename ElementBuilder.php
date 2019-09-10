<?php
namespace CEC\Toolbox;

/**
 * Builds Element objects
 */
interface ElementBuilder
{
    /**
     * Builds Elements
     * @return  \CEC\Toolbox\Admin\Node\Element Element object
     */
    public function build();
}
