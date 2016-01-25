<?php

namespace devtransition\Jobbers;

use devtransition\Jobbers\exception\DublciateException;

class Pool {

    private $_jobs = [];
    private $_results = [];

    public function add(Job &$job)
    {
        if (isset($this->_jobs[$job->getId()])) {
            throw new DublciateException('job with given id already exists in pool');
        }
        $this->_jobs[$job->getId()] = $job;
        $this->_results[$job->getId()] = &$job->getResult();
        return true;
    }

    public function remove($id)
    {
        if (!isset($this->_jobs[$id])) {
            throw new \InvalidArgumentException('id does not exist in pool');
        }
        unset($this->_jobs[$id]);
        return true;
    }

    public function &get($id=null)
    {
        if ($id) {
            if (!isset($this->_jobs[$id])) {
                throw new \InvalidArgumentException('id does not exist in pool');
            }
            return $this->_results[$id];
        } else {
            // All
            return $this->_results;
        }
    }

    public function &run()
    {
        foreach ($this->_jobs as $id => $job) {
            $job->run();
        }

        return $this->_results;
    }

}