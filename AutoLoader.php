<?php
namespace CEC\Toolbox;

if (!class_exists('\CEC\Toolbox\AutoLoader')) {
    class AutoLoader
    {
        private $base;
        private $prefix = "CEC\\Toolbox";

        public function __construct($base, $prefix = "CEC\\Toolbox")
        {
            $this->base = trailingslashit($base);
            $this->prefix = $prefix;
        }

        public function init()
        {
            spl_autoload_register([$this, 'register']);
        }

        public function register($class)
        {
            if (0 !== strpos($class, $this->prefix)) {
                return;
            }

            // Remove the prefix from the class name.
            $class = str_replace($this->prefix, '', $class);
            $class = ltrim($class, "\\");

            //Put parts together
            $file = $this->base . str_replace('\\', '/', $class) . '.php';

            //Include file
            if (file_exists($file)) {
                include_once $file;
            }
        }
    }
}
