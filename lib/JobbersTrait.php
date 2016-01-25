<?php

namespace devtransition\Jobbers;

trait JobbersTrait {

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