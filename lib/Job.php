<?php

namespace devtransition\Jobbers;

use devtransition\Jobbers\exception\JobPendingException;

class Job
{

    private $_proxy;

    private $_id;
    private $_timeout;

    private $_result;

    /**
     * @param $proxy Proxy
     */
    public function __construct(&$proxy)
    {
        $this->_proxy = $proxy;

        $this->applyOptions();

        /*
         * generate 16 hex random id
         */
        if (!$this->_id) {
            $this->_id = bin2hex(openssl_random_pseudo_bytes(8));
        }

        /*
         * set dummy result
         */
        $this->_result = new JobPendingException('not started yet');
    }

    public function id($id)
    {
        $this->_id = $id;
        return clone($this);
    }

    public function timeout($seconds)
    {
        $this->_timeout = $seconds;
        return clone($this);
    }

    public function &run()
    {
        $this->_result = call_user_func_array([$this->_proxy->getClass(), $this->_proxy->getMethod()], $this->_proxy->getArgs());
        return $this->_result;
    }

    public function &attach(Pool $pool)
    {
        $pool->add($this);
        return $this->_result;
    }

    public function getId()
    {
        return $this->_id;
    }

    public function &getResult()
    {
        return $this->_result;
    }

    protected function applyOptions()
    {
        $defaults = $this->_proxy->getDefaults();

        // Timeout
        if (isset($defaults['timeout'])) {
            $this->_timeout = $defaults['timeout'];
        }

        /* TODO: Add Priority? */
    }

}
