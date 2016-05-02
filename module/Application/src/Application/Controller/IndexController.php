<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\View\Model\JsonModel;
use Zend\View\Model\FeedModel;
use Application\Model\BackendTrait;
use Zend\Db\Adapter\Adapter;

class IndexController extends AbstractActionController
{
	
    use BackendTrait;


    protected $form;
	

    public function onBootstrap($e)
	{
		/*$e->getApplication()->getEventManager()->getSharedManager()->attach('Zend\Mvc\Controller\AbstractActionController', 'dispatch', function($e) {
			$controller = $e->getTarget();
			$controller->redirect()->toRoute('app-foo');
		}, 100);*/
	}
	
    public function indexAction()
    {
        $adapter = $this->adapter;
        $statement = $adapter->query('SELECT * FROM testtable');
        $results = $statement->execute();
		
        return new ViewModel(['results' => $results]);
    }
    
    public function formAction()
    {
        $data = '';
        
        $person = '';
        
        if ($this->getRequest()->isPost()) {
            
            $data = $this->params()->fromPost();
            
            $this->form->setData($data);
            
            if ($this->form->isValid()) {
            
                $fname = $data['fname'];
                
                $this->entity->setName($fname);
                
                $this->entityManager->persist($this->entity);
                
                $this->entityManager->flush();
                
                $qb = $this->entityManager->createQueryBuilder();
                
                $qb->select('t')
                   ->from('Application\Entity\Testtable', 't')
                   ->where('t.id = :id')
                   ->setParameter(':id', $this->entity->getId());
                
                // display info
                if ($personObject = $qb->getQuery()->getSingleResult()) {
                    $person['id'] = $personObject->getId();
                    $person['name'] = $personObject->getName();
                }
                else {
                    echo 'Person Not Found <br />' . PHP_EOL;
                }
                
                // OR IF MULTIPLE RESULTS WITH DOCTRINE : display info
                /*if ($result = $qb->getQuery()->getResult()) {
                    foreach ($result as $personObject) {
                        $person['id'] = $personObject->getId();
                        $person['name'] = $personObject->getName();
                    }
                } else {
                    echo 'Person Not Found <br />' . PHP_EOL;
                }*/
                
                /* OR (WITH Zend\Db\Adapter\Adapter):
                 * $insert = $this->sqlObject->insert('testtable');
                 * $insertData = ['id' => '', 'name' => $fname];
                 * $insert->values($insertData);
                 * $selectString = $this->sqlObject->getSqlStringForSqlObject($insert);
                 * $this->adapter->query($selectString, Adapter::QUERY_MODE_EXECUTE);
                 * $statement = $this->adapter->query('SELECT * FROM testtable ORDER BY id DESC LIMIT 1');
                 * $results = $statement->execute();
                 * $person = $results->current();
                 */
                
                /* OR (WITH Zend\Db\TableGateway\TableGateway):
                 * $tableGateway = $this->testTableGateway;
                 * $tableGateway->insert(['id' => '', 'name' => $fname]);
                 * $rowset = $tableGateway->select(['id' => $tableGateway->lastInsertValue]);
                 * $person = $rowset->current();
                 */
                
                $viewModel = new ViewModel(['person' => $person]);
                
                $viewModel->setTemplate('application/index/valid.phtml');
                
                return $viewModel;
                
            }
            
            $viewModel = new ViewModel(['form' => $this->form, 'data' => $data,]);
            
            $viewModel->setTemplate('application/index/form.phtml');
                        
            $invalidView = new ViewModel();
            
            $invalidView->setTemplate('application/index/invalid.phtml');
            
            $invalidView->addChild($viewModel, 'formdiv');
            
            return $invalidView;
            
        }
        
        $viewModel = new ViewModel(['form' => $this->form,]);
        
        $viewModel->setTemplate('application/index/form.phtml');
        
        return $viewModel;
        
    }
    
    public function rssAction()
    {
		$output = [
			'title'       => 'Hi Martin!',
			'link'        => 'http://localhost:8181/',
			'description' => 'http://localhost:8181 Martin and Andrew learning ZF2!',
			'items'        => [
				'title'       => 'Item 1',
				'link'        => 'http://localhost:8181/application/index/index',
				'description' => 'Martin and Andrew learning ZF2!',
			],
		];
		
		return new FeedModel($output);
		//return new JsonModel($output);
        //return new ViewModel();
    }
    
    /**
     * @return the $form
     */
    public function getForm()
    {
        return $this->form;
    }
    
    /**
     * @param field_type $form
     */
    public function setForm($form)
    {
        $this->form = $form;
    }
    
}
