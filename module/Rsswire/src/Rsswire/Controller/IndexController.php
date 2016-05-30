<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Rsswire\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\FeedModel;

class IndexController extends AbstractActionController
{
	
    public function indexAction()
    {
        $rsswire = file_get_contents(getcwd() . '/data/rsswire.json');
        
        $rsswire = json_decode($rsswire);
        
        $output = [
        	'title'       => 'MartandApp - Our latest member',
        	'link'        => 'http://localhost:8181/rss',
        	'description' => $rsswire->fname . ' is our latest member!',
        	/*'items'        => [
        		'title'       => 'Our latest member',
        		'link'        => 'http://localhost:8181/application/index/index',
        		'description' => 'A description',
        	],*/
        ];
        
        return new FeedModel($output);
    }
    
}
