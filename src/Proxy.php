<?php

namespace devtransition\jobbers;

use devtransition\jobbers\helper\DocBlock;
use yii\helpers\VarDumper;

class Proxy
{
    private $_class;
    private $_method;
    private $_args;

    private $_reflector;
    private $_defaults;

    /**
     * @param $class
     */
    public function __construct(&$class)
    {
        $this->_class = $class;
    }

    public function __call($name, $arguments)
    {
        $this->_method = $name;
        $this->_args = $arguments;

        $this->_prepareDefaults();

        return new Job($this);
    }

    public function getClass()
    {
        return $this->_class;
    }

    public function getMethod()
    {
        return $this->_method;
    }

    public function getArgs()
    {
        return $this->_args;
    }

    public function getDefaults()
    {
        return $this->_defaults;
    }

    private function _prepareDefaults()
    {
        $helper = new DocBlock($this->_class);

        $this->_defaults = array_merge(
            Jobbers::getInstance()->getConfig(),
            $helper->getClassOptions(),
            $helper->getMethodOptions($this->_method)
        );
    }

}