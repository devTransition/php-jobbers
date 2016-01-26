<?php

namespace devtransition\jobbers\helper;

use yii\base\Exception;
use yii\helpers\VarDumper;

class DocBlock
{

    private $_reflector;

    const ALLOWED_CLASS_OPTIONS = [
        'timeout',
        'prio',
    ];

    const ALLOWED_METHOD_OPTIONS = [
        'timeout',
        'prio',
    ];

    /**
     * @param $class
     */
    public function __construct(&$class)
    {
        $this->_class = $class;
        $this->_reflector = new \Nette\Reflection\ClassType($this->_class);
    }

    public function getClassOptions()
    {
        $annotation = $this->_reflector->getAnnotation('jobbers');

        if (!$annotation) {
            return [];
        }

        foreach ($annotation as $option => $value) {
            if (!in_array($option, self::ALLOWED_METHOD_OPTIONS)) {
                throw new \Exception("option [$option] unknown");
            }
        }

        return (array)$annotation;
    }

    public function getMethodOptions($method)
    {
        $annotation = $this->_reflector->getMethod($method)->getAnnotation('jobbers');

        if (!$annotation) {
            return [];
        }

        foreach ($annotation as $option => $value) {
            if (!in_array($option, self::ALLOWED_METHOD_OPTIONS)) {
                throw new \Exception("option [$option] unknown");
            }
        }

        return (array)$annotation;
    }

}