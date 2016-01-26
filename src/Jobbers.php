<?php

namespace devtransition\jobbers;

class Jobbers
{
    /* @var Jobbers Singleton instance of Jobbers */
    private static $_instance;

    /* @var Loader Loader instance */
    private $_loader;

    // default config
    private $_config = [
        'timeout' => 10,
    ];

    public static function isInit()
    {
        return (self::$_instance !== null);
    }

    public static function getInstance()
    {
        return self::$_instance;
    }

    public static function config($config)
    {
        self::init();
        self::$_instance->setConfig($config);
    }

    public static function init()
    {
        if (!self::$_instance) {
            self::$_instance = new self;
        }
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