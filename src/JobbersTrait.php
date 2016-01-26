<?php

namespace devtransition\jobbers;

trait JobbersTrait
{

    /**
     * @return $this
     */
    public function Jobbers()
    {
        if (!Jobbers::isInit()) {
            throw new \Exception("Jobbers not initialized");
        }
        return new Proxy($this);
    }

}