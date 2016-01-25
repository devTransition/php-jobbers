<?php

namespace devtransition\Jobbers;

class Jobbers {

    /* @var Jobbers Singleton instance of Jobbers */
    private static $_instance;

    /* @var Loader Loader instance */
    private $_loader;

    // default config
    private $_config = [
        'timeout' => 10,
    ];

    static public function isInit()
    {
        return (self::$_instance !== null);
    }

    static public function init()
    {
        if (!self::$_instance) {
            self::$_instance = new self;
        }
    }

    static public function getInstance()
    {
        return self::$_instance;
    }

    static public function config($config)
    {
        self::init();
        self::$_instance->setConfig($config);
    }

    public function getConfig()
    {
        return $this->_config;
    }

    public function setConfig($config)
    {
        $this->_config = array_merge(
            $this->_config,
            $config
        );
    }

}