<?php

namespace devtransition\Jobbers\bridge;


use devtransition\Jobbers\Jobbers;


class Yii extends \yii\base\Component {

    private $_config;

    public function init()
    {
        Jobbers::init();
    }

    public function setConfig($config)
    {
        $this->_config = $config;
        Jobbers::config($this->_config);
    }

}