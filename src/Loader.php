<?php

namespace devtransition\jobbers;

class Loader
{

    private $_classes = [];
    private $_registered = false;

    public function add($classes)
    {
        $this->_classes = array_merge($this->_classes, $classes);
        if (!$this->_registered) {
            $this->register();
        }
    }

    public function register()
    {
        #spl_autoload_register(array($this, 'autoLoad'), true, true);
        $this->_registered = true;
    }

    protected function autoLoad($class)
    {
        #echo "try to load: $class<br \>\n";
        #exit;
    }

}