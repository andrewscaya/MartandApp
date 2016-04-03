<?php

namespace Application\Model;

trait BackendTrait
{
    
    protected $adapter;
    
    protected $testTableGateway;
    
    /**
     * @return the $adapter
     */
    public function getAdapter()
    {
        return $this->adapter;
    }

    /**
     * @param field_type $adapter
     */
    public function setAdapter($adapter)
    {
        $this->adapter = $adapter;
    }
    
    /**
     * @return the $testTableGateway
     */
    public function getTestTableGateway()
    {
        return $this->testTableGateway;
    }

    /**
     * @param field_type $testTableGateway
     */
    public function setTestTableGateway($testTableGateway)
    {
        $this->testTableGateway = $testTableGateway;
    }

}