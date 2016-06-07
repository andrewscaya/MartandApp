<?php

namespace ApplicationTest\Controller;

use Zend\Test\PHPUnit\Controller\AbstractHttpControllerTestCase;
use Zend\Mvc\MvcEvent;
use Application\Controller\IndexController;

/**
 * IndexController test case.
 */
class IndexControllerTest extends AbstractHttpControllerTestCase
{

    protected $traceError = true;

    protected $indexController;

    protected $viewModel;


    /**
     * Prepares the environment before running tests.
     */
    protected function setUp()
    {
        $this->setApplicationConfig(
            include __DIR__
                    . DIRECTORY_SEPARATOR
                    . '..'
                    . DIRECTORY_SEPARATOR
                    . '..'
                    . DIRECTORY_SEPARATOR
                    . '..'
                    . DIRECTORY_SEPARATOR
                    . '..'
                    . DIRECTORY_SEPARATOR
                    . '..'
                    . DIRECTORY_SEPARATOR
                    . 'config'
                    . DIRECTORY_SEPARATOR
                    . 'application.config.test.php'
        );

        parent::setUp();
    }

    /**
     * Cleans up the environment after running a test.
     */
    protected function tearDown()
    {
        parent::tearDown();
    }

    /**
     * Tests IndexController->indexAction()
     */
    public function testIndexActionCanBeAccessed()
    {
        $this->dispatch('/');
        $this->assertResponseStatusCode(200);

        $this->assertModuleName('Application');
        $this->assertControllerName('application-controller-index');
        $this->assertControllerClass('IndexController');
        $this->assertMatchedRouteName('home');
    }

    /**
     * Tests IndexController->formAction()
     */
    public function testFormActionReturnsEmptyDataArrayWithGetMethod()
    {
        $controller = new IndexController();
        $viewModel = $controller->formAction();
        $this->assertEmpty($viewModel->getVariable('data'));
    }

    /**
     * Tests IndexController->formAction()
     */
    public function testFormActionReturnsDataArrayWithPostMethodAndValidForm()
    {
        $em = $this->getApplication()->getEventManager();
        $em->attach(
            MvcEvent::EVENT_RENDER,
            function ($e) {
                $this->viewModel = $e->getViewModel();
            },
            1000
        );
        $sm = $this->getApplicationServiceLocator();
        $sm->setAllowOverride(true);
        $sm->setService(
            'db-params',
            [
                'driver' => 'pdo_sqlite',
                'path' => __DIR__ . '/../../../../../data/db/mock.db'
            ]
        );
        $params = $sm->get('db-params');
        $sm->setAllowOverride(false);
        $this->dispatch('/register', 'POST', ['fname' => 'Doug', 'submit' => 'Envoyer']);
        $childViewModel = $this->viewModel->getChildrenByCaptureTo('content');
        $template = $childViewModel[0]->getTemplate();
        $this->assertSame('application/index/valid.phtml', $template);
    }

    /**
     * Tests IndexController->formAction()
     */
    public function testFormActionReturnsDataArrayWithPostMethodAndInvalidForm()
    {
        $em = $this->getApplication()->getEventManager();
        $em->attach(
            MvcEvent::EVENT_RENDER,
            function ($e) {
                $this->viewModel = $e->getViewModel();
            },
            1000
        );
        $this->dispatch('/register', 'POST', ['fname' => '', 'submit' => 'Envoyer']);
        $childViewModel = $this->viewModel->getChildrenByCaptureTo('content');
        $template = $childViewModel[0]->getTemplate();
        $this->assertSame('application/index/invalid.phtml', $template);
    }
}
