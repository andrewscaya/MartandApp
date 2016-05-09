<?php

namespace Application\Model;

trait BackendTrait
{
    
    protected $adapter;
    
    protected $sqlObject;
    
    protected $testTableGateway;
    
    protected $entityManager;
    
    protected $entity;
    
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
     * @return the $sqlInsert
     */
    public function getSqlObject()
    {
        return $this->sqlObject;
    }

    /**
     * @param field_type $sqlInsert
     */
    public function setSqlObject($sqlObject)
    {
        $this->sqlObject = $sqlObject;
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
    
    /**
     * @return the $entityManager
     */
    public function getEntityManager()
    {
        return $this->entityManager;
    }

    /**
     * @param field_type $entityManager
     */
    public function setEntityManager($entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @return the $entity
     */
    public function getEntity()
    {
        return $this->entity;
    }

    /**
     * @param field_type $entity
     */
    public function setEntity($entity)
    {
        $this->entity = $entity;
    }

}