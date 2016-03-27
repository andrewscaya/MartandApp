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

class IndexController extends AbstractActionController
{
	
	protected $adapter;
	
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
    
    public function rssAction()
    {
		$output = [
			'title'       => 'Hi Martin!',
			'link'        => 'http://localhost:81/',
			'description' => 'http://localhost:81 Martin and Andrew learning ZF2!',
			'items'        => [
				'title'       => 'Item 1',
				'link'        => 'http://localhost:81/application/index/index',
				'description' => 'Martin and Andrew learning ZF2!',
			],
		];
		
		return new FeedModel($output);
		//return new JsonModel($output);
        //return new ViewModel();
    }
    
    public function getAdapter()
    {
		return $this->adapter;
	}
	
	public function setAdapter($adapter)
    {
		$this->adapter = $adapter;
	}
    
}
